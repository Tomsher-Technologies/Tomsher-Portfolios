<?php
namespace App\Http\Controllers;

use App\Models\Industry;
use Illuminate\Http\Request;

class IndustryController extends Controller {

    public function index(Request $request) {

        $search = $request->has('search') ? $request->search : '';
        $status = $request->has('status') ? $request->status : '';

        $industries = Industry::orderBy('name','ASC');

        if($search){
            $industries->where('name', 'like', '%'.$search.'%');
        }

        if($status){
            if($status == 2){
                $status = 0;
            }
            $industries->where('status', $status);
        }

        $industries = $industries->paginate(20);
        return view('backend.industries.index', compact('industries','search','status'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:industries|max:255'
        ]);

        Industry::create(['name' => $request->name,'created_by' => auth()->user()->id]);

        flash('Industry added successfully.')->success();
        return response()->json(['success' => 'Industry added successfully.']);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|unique:industries,name,' . $id
        ]);

        $industry = Industry::findOrFail($id);
        $industry->update(['name' => $request->name,'updated_by' => auth()->user()->id]);

        flash('Industry updated successfully.')->success();
        return response()->json(['success' => 'Industry updated successfully.']);
    }

    public function updateStatus(Request $request)
    {
        $industry = Industry::findOrFail($request->id);
        $industry->status = $request->status;
        $industry->save();
     
        return 1;
    }

    public function destroy($id)
    {
        Industry::destroy($id);

        flash('Industry '.trans('messages.deleted_msg'))->success();
        return redirect()->route('industries.index');
    }
}
