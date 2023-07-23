<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
{

    public function autoCode()
    {
        $lates_evidence = Gejala::orderby('id', 'desc')->first();
        $code = $lates_evidence->kode;
        $order = (int) substr($code, 1, 4);
        $order++;
        $letter = "J";
        $code = $letter . sprintf("%04s", $order);
        return $code;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('gejala.index', [
            'title' => 'Gejala',
            'gejala' => Gejala::orderByDesc('kode')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gejala.create', [
            'title' => 'Gejala',
            'get_kode' => $this->autoCode(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        Gejala::create([
            'kode' => $this->autoCode(),
            'nama' => $request->nama,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('gejala.index')->with('status', 'Data gejala berhasil tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('gejala.edit', [
            'title' => 'Gejala',
            'get_gejala' => Gejala::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        Gejala::where('id',$id )->update([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('gejala.index')->with('status', 'Data gejala berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $get_gejala = Gejala::where('id', $id)->get();
        $get_gejala->each->delete();
        return redirect()->route('gejala.index')->with('status', 'Data gejala berhasil terhapus!');
    }
}
