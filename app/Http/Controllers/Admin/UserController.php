<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view('admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required|string|max:255'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.user.index')->with('success', 'Akun Baru Admin Berhasil dibuat');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::findOrfail($id);
        return view('admin.user.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = User::find($id);

        if (empty($data)) {
            # code...
            return abort(404);
        }

        if ($request->password) {
            # code...
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
                'email' => 'required|string|email|max:255',
                'name' => 'required|string|max:255'
            ]);

            $data->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        } else {
            # code...

            $request->validate([
                'email' => 'required|string|email|max:255',
                'name' => 'required|string|max:255'
            ]);

            $data->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
        }


        return redirect()->route('admin.user.index')->with('success', 'Akun Baru Admin Berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id);

        if (empty($data)) {
            # code...
            return abort(404);
        }

        if ($data->id == auth()->user()->id) {
            # code...
            return back()->with('galat', 'Tidak Bisa Hapus AKun diri sendiri');
        }

        $data->delete();
        return redirect()->route('admin.user.index')->with('success', 'Akun Baru Admin Berhasil di hapus');
    }
}
