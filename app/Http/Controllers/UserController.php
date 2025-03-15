<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class UserController extends Controller {

    public function index(Request $request) {

        $search = $request->has('search') ? $request->search : '';
        $status = $request->has('status') ? $request->status : '';

        $user = User::where('user_type','user')->orderBy('name','ASC');

        if($search){
            $user->where(function ($query) use ($search){
                $query->where('name', 'like','%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        if($status){
            if($status == 2){
                $status = 0;
            }
            $user->where('status', $status);
        }

        $users = $user->paginate(20);
        return view('backend.users.index', compact('users','search','status'));
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'required|unique:users|max:255',
            'name' => 'required'
        ]);

        User::create(['name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make('zxcvbnm'),
                    'created_by' => auth()->user()->id]
                );

        flash('User added successfully.')->success();
        return response()->json(['success' => 'User added successfully.']);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id
        ]);

        $user = User::findOrFail($id);
        $user->update(['name' => $request->name,'email' => $request->email,'updated_by' => auth()->user()->id]);

        flash('User updated successfully.')->success();
        return response()->json(['success' => 'User updated successfully.']);
    }

    public function updateStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $request->status;
        $user->save();
     
        return 1;
    }

    public function destroy($id)
    {
        User::destroy($id);

        flash('User '.trans('messages.deleted_msg'))->success();
        return redirect()->route('users.index');
    }
}
