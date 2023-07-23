@extends('layouts.main')

@section('container')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-6 mb-4">
            <!-- Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Tambah {{ $title }}</h6>
                </div>
                <div class="card-body">
                  <form action="{{ route('pasien.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                      <label for="card_id" class="form-label">Nomor kartu Identitas</label>
                      <input type="number" name="card_id" class="form-control @error('card_id') is-invalid @enderror" id="card_id" value="{{ old('card_id') }}">
                      @error('card_id') <div class="form-control-feedback text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                      <label for="nama" class="form-label">Nama</label>
                      <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama') }}" required>
                      @error('nama') <div class="form-control-feedback text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                      <label for="umur" class="form-label">Umur</label>
                      <input type="number" name="umur" class="form-control @error('umur') is-invalid @enderror" id="umur" value="{{ old('umur') }}">
                      @error('umur') <div class="form-control-feedback text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                      <label for="phone" class="form-label">No Telp</label>
                      <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ old('phone') }}">
                      @error('phone') <div class="form-control-feedback text-danger">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    <a href="{{ route('pasien.index') }}" type="button" class="btn btn-secondary"><i class="fa fa-arrow-right"></i> Kembali</a>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection
