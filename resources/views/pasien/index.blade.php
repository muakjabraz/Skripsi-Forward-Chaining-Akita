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

                    @if (session('status'))   
                    <div class="alert alert-dismissible alert-success">
                      <button class="close" type="button" data-dismiss="alert">×</button>
                      <strong>{{ session('status') }}</strong>
                    </div>
                    @endif
                    <a href="{{ route('pasien.create') }}" type="button" class="btn btn-success mt-3 mb-3"><i class="fa fa-plus"></i> Tambah {{ $title }}</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Kartu Identitas</th>
                                    <th>Nama pasien</th>
                                    <th>Umur</th>
                                    <th>Phone</th>
                                    <th>No Telp</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($pasien as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->card_id }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->umur }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>
                                      <a href="{{ route('pasien.edit', $item->id) }}" type="button" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                      
                                      <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteUser{{ $item->id }}"><i class="fa fa-trash"></i> Delete</button>
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
                                              <p>Apakah anda yakin untuk menghapus data {{ $item->nama }}?</p>
                                            </div>
                                            <div class="modal-footer">
                                              <form action="{{ route('pasien.destroy', $item->id) }}" method="post">
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
