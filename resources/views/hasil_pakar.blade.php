@extends('layouts.main')

@section('container')

<div class="container-xl px-4 mt-4">
    <!-- Invoice-->
    <div class="card invoice" id="expert_result_report">
        <div class="card-header p-4 p-md-5 border-bottom-0 bg-gradient-success-to-secondary text-white-50 bg-success">
            <div class="row justify-content-between align-items-center">
                <div class="col-12 col-lg-auto mb-5 mb-lg-0 text-center text-lg-start">
                    <!-- Invoice branding-->
                    <img class="invoice-brand-img rounded-circle mb-4" src="assets/img/demo/demo-logo.svg" alt="">
                    <div class="h2 text-white mb-0">Sistem Pakar diagnosa Gangguan Kesehatan Mental</div>
                    Puskesmas Sekargadung
                </div>
                <div class="col-12 col-lg-auto text-center text-lg-end">
                    <!-- Invoice details-->
                    <div class="h3 text-white">Hasil Pakar</div>
                    {{-- #29301 --}}
                    <br>
                    {{-- {{ $data_tanggal }} --}}
                </div>
            </div>
        </div>
        <div class="card-body p-4 p-md-5">
            <!-- Invoice table-->
            <div class="table-responsive">
                <h4>Pasien</h4>
                <table width="100%">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $data_nama }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Kartu Identitas</td>
                        <td>:</td>
                        <td>{{ $data_card_id }}</td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td>:</td>
                        <td>{{ $data_umur }}</td>
                    </tr>
                </table>
                <hr>
                <h4>Gejala yang dialami</h4>
                <ul>
                    @foreach ($data_gejala as $item)
                    <li>{{ $data_gejala_nama->where('id', $item)->first()->nama }} </li>
                    @endforeach
                </ul>
                <hr>
                <h4>Hasil diagnosa pakar</h4>
                <table width="100%">
                    <tr>
                        <td>Nilai Kemungkinan</td>
                        <td>:</td>
                        <td>{{ $arr_data_nilai_kemungkinan }}</td>
                    </tr>
                    <tr>
                        <td>Diagnosa</td>
                        <td>:</td>
                        <td>{{ $arr_data_penyakit }}</td>
                    </tr>
                    <tr>
                        <td>Solusi</td>
                        <td>:</td>
                        <td>{{ $arr_data_solusi }}</td>
                    </tr>
                </table>
                <hr>
                <h4>Hasil Perhitungan Probabilitas</h4>
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Penyakit</th>
                                <th>Gejala pada kasus</th>
                                <th>Gejala yang sama</th>
                                <th>Nilai keungkinan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($arr_data as $itemD)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $itemD['arr_data_penyakit'] }}</td>
                                <td>
                                    <ul>
                                        @foreach ($itemD['arr_data_gejala'] as $itemG)
                                        <li>
                                            {{ $data_gejala_nama->where('id', $itemG)->first()->nama}}
                                        </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        @foreach ($itemD['arr_data_gejala_sama'] as $itemGS)
                                        <li>{{ $data_gejala_nama->where('id', $itemGS)->first()->nama}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ number_format($itemD['arr_data_nilai_kemungkinan'],2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
            </div>
        </div>
        <div class="card-footer p-4 p-lg-5 border-top-0">
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <!-- Invoice - sent from info-->
                    <div class="h6 mb-0">Sistem Pakar diagnosa Gangguan Kesehatan Mental</div>
                    <div class="small">Puskesmas Sekargadung.</div>
                    <div class="small">Jl. Sekarsono, Sekargadung, Kec. Bugul Kidul, Kota Pasuruan, Jawa Timur 67118</div>
                </div>
                <div class="col-md-6 col-lg-8">
                    <!-- Invoice - additional notes-->
                    <div class="small text-muted text-uppercase text-justify fw-700 mb-2">Note</div>
                    <div class="small mb-0">Diperlukan perbaikan lebih lanjut pada sistem pakar untuk meningkatkan akurasi rekomendasi yang diberikan. Evaluasi lebih lanjut perlu dilakukan untuk mengidentifikasi faktor-faktor yang mempengaruhi hasil yang kurang akurat. Dengan peningkatan yang sesuai, sistem pakar ini memiliki potensi untuk memberikan rekomendasi yang lebih akurat dan berguna bagi pengguna.</div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-row-reverse">
        <button class="btn btn-success m-3" onclick="printContent('expert_result_report')"><i class="fa fa-print"></i> Print</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary m-3"><i class="fa fa-arrow-right"></i> Kembali</a>
    </div>
</div>

<script>
    function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>

@endsection