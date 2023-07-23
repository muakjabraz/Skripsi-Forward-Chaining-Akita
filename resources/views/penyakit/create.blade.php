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
                  <form action="{{ route('penyakit.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                      <label for="kode" class="form-label">Kode</label>
                      <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror" id="kode" value="{{ $get_kode }}" readonly>
                      @error('kode') <div class="form-control-feedback text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                      <label for="nama" class="form-label">Nama</label>
                      <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama') }}">
                      @error('nama') <div class="form-control-feedback text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                      <label for="definisi" class="form-label">Definisi</label>
                      <textarea class="form-control @error('definisi') is-invalid @enderror" name="definisi" id="definisi" rows="3">{{ old('definisi') }}</textarea>
                      @error('definisi') <div class="form-control-feedback text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                      <label for="solusi" class="form-label">Solusi</label>
                      <textarea class="form-control @error('solusi') is-invalid @enderror" name="solusi" id="solusi" rows="3">{{ old('solusi') }}</textarea>
                      @error('solusi') <div class="form-control-feedback text-danger">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    <a href="{{ route('penyakit.index') }}" type="button" class="btn btn-secondary"><i class="fa fa-arrow-right"></i> Kembali</a>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection
