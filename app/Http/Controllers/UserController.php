<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\Kasus;
use App\Models\Penyakit;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function admin_index()
    {
        return view('user.index',[
            'title' => 'Admin',
            'user' => User::where('role', 'admin')->get(),
        ]);
    }
    public function pakar_index()
    {
        return view('user.index',[
            'title' => 'Dokter',
            'user' => User::where('role', 'dokter')->get(),
        ]);
    }
    public function perawat_index()
    {
        return view('user.index',[
            'title' => 'Perawat',
            'user' => User::where('role', 'perawat')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:6',
            'repassword' => 'required|min:6|same:password|max:100',
            'nip' => 'nullable|numeric|max_digits:100',
            'phone' => 'nullable|numeric|min_digits:12|max_digits:15',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone'=> $request->phone,
            'nip' => $request->nip,
            'role' => $request->role
        ]);

        return redirect()->back()->with('status', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $get = User::find($id);

        $request->validate([
            'nama' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $get->id,
            'repassword' => 'same:password',
            'nip' => 'nullable|numeric|max_digits:100',
            'phone' => 'nullable|numeric|min_digits:12|max_digits:15',
        ]);
        
        if($request->password == ''){
            $password = User::findOrFail($id)->password;
        } else {
            $password = bcrypt($request->password);
        }

        User::where('id', $id)->update([
            'email' => $request->email,
            'password' => $password,
            'nama' => $request->nama,
            'nip' => $request->nip,
            'phone' => $request->phone,
        ]);

        return redirect()->back()->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $get_user = User::where('id', $id)->get();
        $get_user->each->delete();

        return redirect()->back()->with('status','Data berhasil di hapus');
    }
}
