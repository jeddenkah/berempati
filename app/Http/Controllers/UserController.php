<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function profile()
    {
        return view('user.profile');
    }
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update($id, Request $request)
    {
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

    public function updateUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'no_hp' => 'required|numeric',
            'address' => 'nullable|string',
        ]);

        User::find(Auth::user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ]);

        Toastr::success('Profile updated successfully', 'Success!');
        return redirect()->route('user.profile');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        //delete bid
        foreach ($user->bids as $bid) {
            $bid->delete();
        }

        //delete auction
        foreach ($user->auctions as $auction) {

            foreach ($auction->bids as $bid) {
                $bid->delete();
            }
            $existingImage = $auction->image;

            Storage::disk('public')->delete('images/auction/' . $existingImage);

            $auction->delete();
        }

        //delete donation
        foreach ($user->donations as $donation) {
            $donation->delete();
        }

        //delete crowdfund
        foreach ($user->crowdfunds as $crowdfund) {

            //delete auction
            foreach ($crowdfund->auctions as $auction) {

                //delete bids
                foreach ($auction->bids as $bid) {
                    $bid->delete();
                }

                $existingImage = $auction->image;
                Storage::disk('public')->delete('images/auction/' . $existingImage);
                $auction->delete();
            }
            //delete donation
            $donations = $crowdfund->donations;
            foreach ($donations as $donation) {
                $donation->delete();
            }

            $existingImage = $crowdfund->image;

            Storage::disk('public')->delete('images/crowdfund/' . $existingImage);

            $crowdfund->delete();
        }


        User::find($id)->delete();

        Toastr::success('User deleted successfully', 'Success!');
        return redirect()->route('user.index');
    }

    public function changePassword(Request $request)
    {
        $validatedData = $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8',
        ]);
        if ($request->new_password != $request->confirm_new_password) {
            Toastr::error('', 'Konfirmasi password baru tidak sama!');
            return redirect()->route('user.profile');
        }

        $user = Auth::user();

        if (Hash::check($request->old_password, $user->password)) {
            User::find($user->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
        } else {
            Toastr::error('', 'Password Lama salah!');
            return redirect()->route('user.profile');
        }

        Toastr::success('Password changed successfully', 'Success!');
        return redirect()->route('user.profile');
    }
}
