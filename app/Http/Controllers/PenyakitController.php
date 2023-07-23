<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\Kasus;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    public function autoCode()
    {
        $lates_evidence = Penyakit::orderby('id', 'desc')->first();
        $code = $lates_evidence->kode;
        $order = (int) substr($code, 1, 4);
        $order++;
        $letter = "K";
        $code = $letter . sprintf("%04s", $order);
        return $code;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('penyakit.index', [
            'title' => 'penyakit',
            'penyakit' => Penyakit::orderByDesc('kode')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penyakit.create', [
            'title' => 'Penyakit',
            'get_kode' => $this->autoCode(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'definisi' => 'required',
            'solusi' => 'required',
        ]);

        Penyakit::create([
            'kode' => $this->autoCode(),
            'nama' => $request->nama,
            'definisi' => $request->definisi,
            'solusi' => $request->solusi
        ]);

        return redirect()->route('penyakit.index')->with('status', 'Data penyakit berhasil tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penyakit $penyakit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('penyakit.edit', [
            'title' => 'penyakit',
            'get_penyakit' => Penyakit::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'definisi' => 'required',
            'solusi' => 'required',
        ]);

        Penyakit::where('id',$id )->update([
            'nama' => $request->nama,
            'definisi' => $request->definisi,
            'solusi' => $request->solusi,
        ]);

        return redirect()->route('penyakit.index')->with('status', 'Data penyakit berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $get_penyakit = Penyakit::where('id', $id)->get();
        $get_penyakit->each->delete();
        return redirect()->route('penyakit.index')->with('status', 'Data penyakit berhasil terhapus!');
    }
}
