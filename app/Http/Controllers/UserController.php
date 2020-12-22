<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function edit($id){
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update($id, Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'no_hp' => 'required|numeric',
            'address' => 'nullable|string',
            'role_id' => 'required',

        ]);

        $is_verified = $request->is_verified ?? false;

        User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'address' => $request->address,
            'is_verified' => $is_verified,
            'role_id' => $request->role_id,
            'updated_at' => Carbon::now()
        ]);

        Toastr::success('User edited successfully', 'Success!');
        return redirect()->route('user.index');
    }

    public function destroy($id){
        User::find($id)->delete();

        Toastr::success('User deleted successfully', 'Success!');
        return redirect()->route('user.index');
    }
}
