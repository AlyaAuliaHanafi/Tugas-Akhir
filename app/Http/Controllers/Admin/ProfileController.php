<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('admin.profile.index');
    }

    public function sandi()
    {
        return view('admin.profile.password');
    }

    public function profile_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        User::find(auth()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->route('admin.profile')->with('success', 'Berhasil Mengganti Profile');
    }

    public function sandi_update(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("galat", "Password Sebelumnya Salah");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("success", "Password Berhasil diganti");
    }
}
