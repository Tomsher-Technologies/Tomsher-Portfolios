<?php
namespace App\Http\Controllers;

use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller {

    public function index(Request $request) {

        $search = $request->has('search') ? $request->search : '';
        $status = $request->has('status') ? $request->status : '';

        $technologies = Technology::orderBy('name','ASC');

        if($search){
            $technologies->where('name', 'like', '%'.$search.'%');
        }

        if($status){
            if($status == 2){
                $status = 0;
            }
            $technologies->where('status', $status);
        }

        $technologies = $technologies->paginate(20);
        return view('backend.technologies.index', compact('technologies','search','status'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:technologies|max:255'
        ]);

        Technology::create(['name' => $request->name,'created_by' => auth()->user()->id]);

        flash('Technology added successfully.')->success();
        return response()->json(['success' => 'Technology added successfully.']);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|unique:technologies,name,' . $id
        ]);

        $technology = Technology::findOrFail($id);
        $technology->update(['name' => $request->name,'updated_by' => auth()->user()->id]);

        flash('Technology updated successfully.')->success();
        return response()->json(['success' => 'Technology updated successfully.']);
    }

    public function updateStatus(Request $request)
    {
        $technology = Technology::findOrFail($request->id);
        $technology->status = $request->status;
        $technology->save();
     
        return 1;
    }

    public function destroy($id)
    {
        Technology::destroy($id);

        flash('Technology '.trans('messages.deleted_msg'))->success();
        return redirect()->route('technologies.index');
    }
}
