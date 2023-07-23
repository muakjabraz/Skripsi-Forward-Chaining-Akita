<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\Gejala;
use App\Models\Kasus;
use App\Models\Pasien;
use App\Models\Penyakit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        return view('index', [
            'title' => 'Sistem Pakar Gangguan Kesehatan Mental'
        ]);
    }

    public function Dashboard()
    {
        return view('dashboard',[
            'title' => 'Dashboard',
            'cnt_user' => User::all()->count(),
            'cnt_gejala' => Gejala::all()->count(),
            'cnt_penyakit' => Penyakit::all()->count(),
            'cnt_kasus' => Kasus::where('type', 'riwayat')->get()->count(),
            'data_kasus' => Kasus::where('type', 'riwayat')->where('status', 'selesai')->orderByDesc('created_at')->get(),
            'data_diagnosa' => Aturan::all(),
            'data_penyakit' => Penyakit::orderBy('created_at', 'desc')->get(),
            'cnt_kasus_crt' => Kasus::where('type', 'riwayat')->where('status', 'selesai')->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function sistem_pakar()
    {
        return view('sistem_pakar',[
            'title' => 'Sistem Pakar',
            'pasien' => Pasien::orderByDesc('created_at')->get(),
            'gejala' => Gejala::all(),
        ]);
    }

    public function hasil_pakar(Request $request)
    {
        // validasi nama tidak boleh kosong
        $request->validate([
            'pasien_id' => 'required',
            'nama' => 'required'
        ]);

        $arr_req = array();
        foreach($request->gejala_id as $itemR){
            $arr_req[] = $itemR;
        }
        
        $kasus = Kasus::where('type', 'aturan')->get();
        $aturan = Aturan::all();
        
        $arr_data = array();
        foreach ($kasus as $itemK) {
            $arr_kas = array();
            foreach ($aturan->where('kasus_id', $itemK->id) as $itemA) {
                $arr_kas[] = $itemA->gejala_id;
            }

            $arr_data[] = [
                'arr_data_penyakit_id' => $itemK->penyakit->id,
                'arr_data_penyakit' => $itemK->penyakit->nama,
                'arr_data_solusi' => $itemK->penyakit->solusi,
                'arr_data_bobot' => $itemK->bobot,
                'arr_data_gejala' => $arr_kas,
                'arr_data_gejala_sama' => array_intersect($arr_req, $arr_kas),
                'arr_data_nilai_kemungkinan' => count(array_intersect($arr_req, $arr_kas)) / count($arr_kas),
            ];

        }

        // mendapatkan nilai similiarity tertinggi
        $arr_data_nilai_kemungkinan = 0;
        foreach ($arr_data as $record) {
            if ($record['arr_data_nilai_kemungkinan'] > $arr_data_nilai_kemungkinan) {
                $arr_data_penyakit_id = $record['arr_data_penyakit_id'];
                $arr_data_penyakit = $record['arr_data_penyakit'];
                $arr_data_solusi = $record['arr_data_solusi'];
                $arr_data_bobot = $record['arr_data_bobot'];
                $arr_data_nilai_kemungkinan = $record['arr_data_nilai_kemungkinan'];
            }
        }

        // sorting nilai dari yang tertinggi ke yang terendah
        $columns = array_column($arr_data, 'arr_data_nilai_kemungkinan');
        array_multisort($columns, SORT_DESC, $arr_data);

        // simpan data kasus tebaru
        $get_new_kasus = Kasus::create([
            'pasien_id'=> $request->pasien_id,
            'user_id' => auth()->user()->id,
            'penyakit_id' => $arr_data_penyakit_id,
            'bobot' => $arr_data_nilai_kemungkinan,
        ]);
        
        // cek jika nilai sama tapi penyakit beda maka status menjadi tunggu jika tidak maka selesai
        if($arr_data_nilai_kemungkinan == $arr_data_bobot) {
            if ($arr_data_penyakit_id != $arr_data_penyakit_id) {
                $get_new_kasus->status = 'tunggu';
            }
            $get_new_kasus->status = 'selesai';
        } else {
            $get_new_kasus->status = 'selesai';
        }
        
        $get_new_kasus->save();
        
        // input data gejala yang dipilih tadi ke data aturan
        foreach ($request->gejala_id as $value) {
            Aturan::create([
                'gejala_id' => $value,
                'kasus_id' => $get_new_kasus->id,
            ]);
        }

        // resturn view
        return view('hasil_pakar',[
            'data_nama' => $request->nama,
            'data_card_id' => $request->card_id,
            'data_umur' => $request->umur,
            'data_gejala' =>  $request->gejala_id,
            'data_gejala_nama' => Gejala::all(),
            'arr_data' => $arr_data,
            'arr_data_penyakit' => $arr_data_penyakit,
            'arr_data_solusi' => $arr_data_solusi,
            'arr_data_nilai_kemungkinan' => $arr_data_nilai_kemungkinan,
        ]);
    }

    // kasus
    public function kasus_index()
    {
        return view('kasus.index',[
            'title' => 'Kasus',
            'kasus' => Kasus::where('type', 'riwayat')->orderByDesc('created_at')->get(),
            'get_diagnosa' => Aturan::all(),
        ]);
    }

    public function kasus_report()
    {
        return view('kasus.report', [
            'title' => 'Laporan Diagnosa',
            'kasus' => Kasus::where('type', 'riwayat')->orderByDesc('created_at')->get(),
            'date' => Carbon::now(),
        ]);
    }
}
