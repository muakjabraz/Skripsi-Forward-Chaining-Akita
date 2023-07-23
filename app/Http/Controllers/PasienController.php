<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\Kasus;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pasien.index', [
            'title' => 'Pasien',
            'pasien' => Pasien::orderByDesc('created_at')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pasien.create', [
            'title' => 'Pasien',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'card_id' => 'nullable|numeric',
            'umur' => 'nullable|numeric',
            'phone' => 'nullable|numeric',
        ]);

        Pasien::create([
            'card_id' => $request->card_id,
            'nama' => $request->nama,
            'umur' => $request->umur,
            'phone' => $request->phone,
        ]);

        return redirect()->route('pasien.index')->with('status', 'Data pasien berhasil tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('pasien.edit', [
            'title' => 'Pasien',
            'get_pasien' => Pasien::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'card_id' => 'nullable|numeric',
            'umur' => 'nullable|numeric',
            'phone' => 'nullable|numeric',
        ]);

        Pasien::where('id',$id )->update([
            'card_id' => $request->card_id,
            'nama' => $request->nama,
            'umur' => $request->umur,
            'phone' => $request->phone,
        ]);

        return redirect()->route('pasien.index')->with('status', 'Data pasien berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $get_pasien = Pasien::where('id', $id)->get();
        $get_pasien->each->delete();

        return redirect()->route('pasien.index')->with('status', 'Data pasien berhasil terhapus!');
    }
}
