@extends('layouts.main')

@section('container')

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Content Row -->
  <div class="row">
    <!-- Content Column -->
    <div class="col-lg-12 mb-4">
      <!-- Table -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-success">Data {{ $title }}</h6>
        </div>
        <div class="card-body">
        <a href="{{ route('kasus_report') }}" target="_blank" class="btn btn-sm btn-primary mb-3"><i class="fa fa-print"></i> Print</a>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Diagnosa</th>
                <th>Perawat yang melayani</th>
                <th>Tanggal Diagnosa</th>
                <th>Detail</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($kasus as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->pasien->nama }}</td>
                <td>
                  @if (is_null($item->penyakit_id))
                  <i>"Dijadwalkan bertemu dengan Dokter"</i>
                  @else
                  {{ $item->penyakit->nama }}
                  @endif
                </td>
                <td>{{ $item->user->nama }}</td>
                <td>{{ date_format(date_create($item->created_at), "d M Y")   }}</td>
                <td>
                  <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#detailKasus{{ $item->id }}"><i class="fa fa-eye"></i> Detail</button>
                  <!-- Modal -->
                  <div class="modal fade" id="detailKasus{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="detailKasus{{ $item->id }}Title" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Detail - {{ $item->pasien->nama }}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <table>
                            <tbody>
                              <tr>
                                <td style="border:0px !important;">Nama Pasien</td>
                                <td style="border:0px !important;">:</td>
                                <td style="border:0px !important;">{{ $item->pasien->nama }}</td>
                              </tr>
                              <tr>
                                <td style="border:0px !important;">Nomor kartu identitas</td>
                                <td style="border:0px !important;">:</td>
                                <td style="border:0px !important;">{{ $item->pasien->card_id }}</td>
                              </tr>
                              <tr>
                                <td style="border:0px !important;">Perawat yang melayani</td>
                                <td style="border:0px !important;">:</td>
                                <td style="border:0px !important;">{{ $item->user->nama }}</td>
                              </tr>
                              <tr>
                                <td style="border:0px !important;">Tanggal periksa</td>
                                <td style="border:0px !important;">:</td>
                                <td style="border:0px !important;">{{ date_format($item->created_at,'d/m/Y') }}</td>
                              </tr>
                              <tr>
                                <td style="border:0px !important;">Diagnosa</td>
                                <td style="border:0px !important;">:</td>
                                <td style="border:0px !important;">
                                  @if (is_null($item->penyakit_id))
                                  <i>"Dijadwalkan bertemu dengan Dokter"</i>
                                  @else
                                  {{ $item->penyakit->nama }}
                                </td>
                                @endif
                                <td>
                              </tr>
                              <tr>
                                <td style="border:0px !important;">Gejala</td>
                                <td style="border:0px !important;">:</td>
                                <td style="border:0px !important;">
                                  <ul>
                                    @foreach ($get_diagnosa->where('kasus_id', $item->id) as $itemGejala)
                                    <li>{{ $itemGejala->gejala->nama }}</li>
                                    @endforeach
                                  </ul>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

@endsection