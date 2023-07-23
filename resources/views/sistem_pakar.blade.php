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

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Buat {{ $title }} Baru</h6>
                </div>
                <div class="card-body ">
                    @if ($errors->any()) 
                    <div class="alert alert-dismissible alert-danger">
                      <button class="close" type="button" data-dismiss="alert">×</button>
                      <h6>{{ $title }} gagal di simpan!</h6>
                      @foreach ($errors->all() as $error)
                        <strong>{{ $error }}</strong> <br>
                      @endforeach
                    </div>
                    @endif
                    <form method="post" action="{{ route('hasil_pakar') }}">
                      @csrf
                      <div class="col-lg-6 col-md-12">
                        <div class="mb-3">
                            <input type="hidden" name="pasien_id" id="pasien_id" value="{{ old('id') }}" required>
                            <label for="card_id" class="form-label">Kartu tanda identitas</label>
                            <input name="card_id" type="text" class="form-control" id="card_id" value="{{ old('card_id') }}" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input name="nama" type="text" class="form-control" id="nama" value="{{ old('nama') }}" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="umur" class="form-label">Umur</label>
                            <input name="umur" type="text" class="form-control" id="umur" value="{{ old('umur') }}" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">No. Telpon</label>
                            <input name="phone" type="text" class="form-control" id="phone" value="{{ old('phone') }}" required readonly>
                        </div>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#datapasien"><i class="fa fa-users"></i> Pilih Pasien</button>
                        <!-- Modal -->
                        <div class="modal fade" id="datapasien" tabindex="-1" role="dialog" aria-labelledby="datapasienTitle" aria-hidden="true">
                          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Pilih Pasien</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="table-responsive">
                                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                      <thead>
                                          <tr>
                                              <th>No</th>
                                              <th>Kartu tanda identitas</th>
                                              <th>Nama</th>
                                              <th>Umur</th>
                                              <th>Pilih</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($pasien as $item)
                                          <tr>
                                            <td><input type="hidden" id="pasienId{{ $item->id }}" value="{{ $item->id }}">{{ $loop->iteration }}</td>
                                            <td><input type="hidden" id="card_id{{ $item->id }}" value="{{ $item->card_id }}">{{ $item->card_id }}</td>
                                            <td><input type="hidden" id="nama{{ $item->id }}" value="{{ $item->nama }}">{{ $item->nama }}</td>
                                            <td><input type="hidden" id="umur{{ $item->id }}" value="{{ $item->umur }}">{{ $item->umur }}</td>
                                            <td>
                                              <input type="hidden" id="phone{{ $item->id }}" value="{{ $item->phone }}"><button type="button" class="btn btn-success btn-sm" onclick="pilih{{ $item->id }}()" data-dismiss="modal">Pilih</button>
                                              <script>
                                                function pilih{{ $item->id }}() {
                                                  let varpasienId{{ $item->id }} = {{ $item->id }};
                                                  let varcard_id{{ $item->id }} = document.getElementById("card_id{{ $item->id }}").value;
                                                  let varnama{{ $item->id }} = document.getElementById("nama{{ $item->id }}").value;
                                                  let varumur{{ $item->id }} = document.getElementById("umur{{ $item->id }}").value;
                                                  let varphone{{ $item->id }} = document.getElementById("phone{{ $item->id }}").value;

                                                  document.getElementById("pasien_id").value = varpasienId{{ $item->id }};
                                                  document.getElementById("card_id").value = varcard_id{{ $item->id }};
                                                  document.getElementById("nama").value = varnama{{ $item->id }};
                                                  document.getElementById("umur").value = varumur{{ $item->id }};
                                                  document.getElementById("phone").value = varphone{{ $item->id }};
                                                }
                                              </script>
                                            </td>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gejala</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($gejala as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                      <div class="form-check">
                                        <input class="form-check-input" name="gejala_id[]" type="checkbox" value="{{ $item->id }}" id="gejala{{ $item->id }}">
                                        <label for="gejala{{ $item->id }}">{{ $item->nama }}</label>
                                      </div>
                                    </td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                      </div>
                      <div class="text-right">
                        <button type="submit" class="btn btn-success"><i class="fa fa-cog"></i> Proses</button>
                        <a href="{{ url()->previous() }}" type="button" class="btn btn-secondary"><i class="fa fa-arrow-right"></i> Kembali</a>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection
