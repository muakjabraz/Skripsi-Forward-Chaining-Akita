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
                    <h6 class="m-0 font-weight-bold text-success">Edit {{ $title }}</h6>
                </div>
                <div class="card-body">
                  <form action="{{ route('gejala.update', $get_gejala->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                      <label for="kode" class="form-label">Kode</label>
                      <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror" id="kode" value="{{ $get_gejala->kode }}" readonly>
                      @error('kode') <div class="form-control-feedback text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                      <label for="nama" class="form-label">Nama</label>
                      <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama', $get_gejala->nama) }}">
                      @error('nama') <div class="form-control-feedback text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                      <label for="keterangan" class="form-label">Keterangan</label>
                      <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" rows="3">{{ old('keterangan', $get_gejala->keterangan) }}</textarea>
                      @error('keterangan') <div class="form-control-feedback text-danger">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    <a href="{{ route('gejala.index') }}" type="button" class="btn btn-secondary"><i class="fa fa-arrow-right"></i> Kembali</a>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection
