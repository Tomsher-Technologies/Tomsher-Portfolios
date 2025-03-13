<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    public function index(Request $request) {

        $search = $request->has('search') ? $request->search : '';
        $status = $request->has('status') ? $request->status : '';

        $categories = Category::orderBy('name','ASC');

        if($search){
            $categories->where('name', 'like', '%'.$search.'%');
        }

        if($status){
            if($status == 2){
                $status = 0;
            }
            $categories->where('status', $status);
        }

        $categories = $categories->paginate(20);
        return view('backend.categories.index', compact('categories','search','status'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:categories|max:255'
        ]);

        Category::create(['name' => $request->name,'created_by' => auth()->user()->id]);

        flash('Category added successfully.')->success();
        return response()->json(['success' => 'Category added successfully.']);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id
        ]);

        $category = Category::findOrFail($id);
        $category->update(['name' => $request->name,'updated_by' => auth()->user()->id]);

        flash('Category updated successfully.')->success();
        return response()->json(['success' => 'Category updated successfully.']);
    }

    public function updateStatus(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->status;
        $category->save();
     
        return 1;
    }

    public function destroy($id)
    {
        Category::destroy($id);

        flash('Category '.trans('messages.deleted_msg'))->success();
        return redirect()->route('categories.index');
    }
}
