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
        <div class="col-lg-12 mb-4">
            <!-- Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Data {{ $title }}</h6>
                </div>
                <div class="card-body">

                    @if (session('status'))
                    <div class="alert alert-dismissible alert-success mb-3">
                        <button class="close" type="button" data-dismiss="alert">×</button>
                        <strong>{{ session('status') }}</strong>
                    </div>
                    @endif
                    @if (auth()->user()->role == 'dokter')
                    <a href="{{ route('aturan.create') }}" type="button" class="btn btn-success mb-3"><i class="fa fa-plus"></i> Tambah {{ $title }}</a>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    {{-- <th>Nama Pasien</th>
                                    <th>Perawat yang melayani</th> --}}
                                    <th>Diagnosa</th>
                                    <th>Gejala</th>
                                    <th>Catatan</th>
                                    <th>Tanggal periksa</th>
                                    @if (auth()->user()->role == 'dokter')
                                    <th>Edit Aturan</th>
                                    @endif
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kasus as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    {{-- <td>{{ $item->pasien->nama }}</td>
                                    <td>{{ $item->user->nama }}</td> --}}
                                    <td>
                                        @if (is_null($item->penyakit_id))
                                        <i>"Dijadwalkan bertemu dengan Dokter"</i>
                                        @else
                                        {{ $item->penyakit->nama }}
                                        @endif
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($gejala->where('kasus_id', $item->id) as $itemG)
                                            <li>{{ $itemG->gejala->nama }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        @empty($item->catatan)
                                        <i>"Tidak ada catatan"</i>
                                        @else
                                        {{ $item->catatan }}
                                        @endempty
                                    </td>
                                    <td>
                                        {{ date_format($item->created_at,'d/m/Y') }}
                                    </td>
                                    @if (auth()->user()->role == 'dokter')
                                    <td>
                                        <a href="{{ route('aturan.edit', $item->id) }}" class="btn btn-sm btn-warning btn-sm mb-3"><i class="fa fa-edit"></i> Edit </a>
                                        <button type="button" class="btn btn-sm btn-danger mb-3" data-toggle="modal" data-target="#deleteUser{{ $item->id }}"><i class="fa fa-trash"></i> Delete</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteUser{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteUser{{ $item->id }}Title" aria-hidden="true">
                                            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Delete {{ $title }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin untuk menghapus data aturan?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('aturan.destroy', $item->id) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    <td>
                                        @if (auth()->user()->role == 'perawat')
                                        @if ($item->status == 'selesai')
                                        <span class="badge bg-success text-light">Selesai</span>
                                        @else
                                        <span class="badge bg-warning text-light">Tunggu</span>
                                        @endif
                                        @else
                                        <div class="dropdown">
                                            <button class="btn btn-sm @if ($item->status == 'selesai') btn-success @else btn-warning @endif dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                @if ($item->status == 'selesai') Selesai @else Tunggu @endif
                                            </button>
                                            <div class="dropdown-menu p-0 m-0">
                                                <div class="dropdown-item bg-success p-0">
                                                    <form action="{{ route('change_status', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <button class="btn btn-block btn-success btn-sm" type="submit" value="selesai" name="status">Selesai</button>
                                                    </form>
                                                </div>
                                                <div class="dropdown-item bg-warning p-0">
                                                    <form action="{{ route('change_status', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <button class="btn btn-block btn-warning btn-sm" type="submit" value="tunggu" name="status">Tunggu</button>
                                                    </form>
                                                </div>
                                            </div>
                                            @endif
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