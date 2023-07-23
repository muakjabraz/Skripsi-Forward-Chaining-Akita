<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\Gejala;
use App\Models\Kasus;
use App\Models\Pasien;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class AturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('aturan.index', [
            'title' => 'Aturan Dokter',
            'gejala' => Aturan::all(),
            'kasus' => Kasus::where('type', 'aturan')->orderByDesc('created_at')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aturan.create', [
            'title' => 'Aturan Dokter',
            // 'pasien' => Pasien::orderByDesc('created_at')->get(),
            'gejala' => Gejala::all(),
            'penyakit' => Penyakit::orderByDesc('created_at')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'pasien_id' => 'required',
            'penyakit_id' => 'required',
        ]);

        if (is_null($request->gejala) || count($request->gejala) < 3) {
            return redirect()->back()->with('error', 'Setidaknya pilih minmal 3 gejala');
        }

        $get_new_kasus = Kasus::create([
            // 'pasien_id' => $request->pasien_id,
            'user_id' => auth()->user()->id,
            'penyakit_id' => $request->penyakit_id,
            'bobot' => 1.0,
            'type' => 'aturan',
        ]);

        foreach ($request->gejala as $value) {
            Aturan::create([
                'gejala_id' => $value,
                'kasus_id' => $get_new_kasus->id,
            ]);
        }

        return redirect()->route('aturan.index', $get_new_kasus->id)->with('status', 'Aturan baru berhasil dibuat silakan edit untuk mengatur gejala jika diperlukan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $id_gejala_kasus = array();
        foreach (Aturan::where('kasus_id', $id)->get() as $value) {
            $id_gejala_kasus[] = $value->gejala->id;
        }
        $id_gejala_exprt = array();
        foreach (Gejala::all() as $value) {
            $id_gejala_exprt[] = $value->id;
        }
        $select_gejala = array_diff($id_gejala_exprt, $id_gejala_kasus);

        return view('aturan.edit', [
            'title' => 'Aturan',
            'aturan' => Aturan::where('kasus_id', $id)->get(),
            'kasus' => Kasus::where('id', $id)->first(),
            'select_gejala' => $select_gejala,
            'gejala' => Gejala::all(),
            'penyakit' => Penyakit::all()
        ]);
    }

    public function tambah_gejala_aturan(Request $request)
    {
        Aturan::create([
            'gejala_id' => $request->gejala_id,
            'kasus_id' => $request->kasus_id,
        ]);

        return redirect()->route('aturan.edit', $request->kasus_id)->with('status', 'Gejala berhasil ditambahkan!');
    }

    public function hapus_gejala_aturan($id)
    {
        Aturan::destroy($id);
        return redirect()->back()->with('status', 'Gejala berhasil dihapus!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kasus = Kasus::findOrFail($id);
        $kasus->penyakit_id =  $request->penyakit_id;
        $kasus->catatan = $request->catatan;
        $kasus->save();
        return redirect()->route('aturan.index')->with('status', 'Status kasus berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $get_aturan = Kasus::where('id', $id)->get();
        $get_aturan->each->delete();

        return redirect()->route('aturan.index')->with('status', 'Data aturan berhasil terhapus!');
    }

    public function change_status(Request $request, $id)
    {

        $status = Kasus::findOrFail($id);
        if (!is_null($status->penyakit_id)) {
            $status->status = $request->status;
            $status->save();
            return redirect()->back()->with('status', 'Status kasus berhasil diubah!');
        }
        return redirect()->back()->with('status', 'Status kasus gagal diubah! Tentukan penyakit terlebih dahulu.');
    }
}
