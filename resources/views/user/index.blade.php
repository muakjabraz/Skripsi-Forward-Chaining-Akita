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
                    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addUser"><i class="fa fa-plus"></i> Add {{ $title }}</button>
                    <!-- Modal -->
                    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserTitle" aria-hidden="true">
                      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add {{ $title }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="{{ route('user.store') }}" method="post">
                            @csrf
                            <div class="modal-body">
                              <div class="mb-3">
                                @if ($title == 'Admin')
                                <input type="hidden" name="role" value="admin">
                                @elseif ($title == 'Dokter') 
                                <input type="hidden" name="role" value="dokter">
                                @else
                                <input type="hidden" name="role" value="perawat">
                                @endif
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" required>
                              </div>
                              <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                              </div>
                              <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                              </div>
                              <div class="mb-3">
                                <label for="repassword" class="form-label">Repassword</label>
                                <input type="password" name="repassword" class="form-control" id="repassword" required>
                              </div>
                              <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="number" name="nip" class="form-control" id="nip">
                              </div>
                              <div class="mb-3">
                                <label for="phone" class="form-label">No. Telpon</label>
                                <input type="number" name="phone" class="form-control" id="phone">
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    @if ($errors->any()) 
                    <div class="alert alert-dismissible alert-danger">
                      <button class="close" type="button" data-dismiss="alert">×</button>
                      <h6>{{ $title }} gagal di simpan!</h6>
                      @foreach ($errors->all() as $error)
                        <strong>{{ $error }}</strong> <br>
                      @endforeach
                    </div>
                    @endif

                    @if (session('status'))   
                    <div class="alert alert-dismissible alert-success">
                      <button class="close" type="button" data-dismiss="alert">×</button>
                      <strong>{{ session('status') }}</strong>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>nip</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($user as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->nip }}</td>
                                    <td>
                                      <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#addEdit{{ $item->id }}"><i class="fa fa-edit"></i> Edit</button>
                                      <!-- Modal -->
                                      <div class="modal fade" id="addEdit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="addEdit{{ $item->id }}Title" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLongTitle">Edit {{ $title }}</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <form action="{{ route('user.update', $item->id) }}" method="post">
                                              @csrf
                                              @method('put')
                                              <div class="modal-body">
                                                <div class="mb-3">
                                                  <label for="nama" class="form-label">Nama</label>
                                                  <input name="nama" value="{{ $item->nama}}" type="text" class="form-control" id="nama" required>
                                                </div>
                                                <div class="mb-3">
                                                  <label for="email" class="form-label">Email</label>
                                                  <input name="email" value="{{ $item->email}}" type="email" class="form-control" id="email" required>
                                                </div>
                                                <div class="mb-3">
                                                  <label for="passowrd" class="form-label">Passowrd</label>
                                                  <input name="password" type="passowrd" class="form-control" id="passowrd">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="repassword" class="form-label">Repassword</label>
                                                  <input name="repassword" type="password" class="form-control" id="repassword">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="nip" class="form-label">NIP</label>
                                                  <input name="nip" value="{{ $item->nip}}" type="number" class="form-control" id="nip">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="phone" class="form-label">No. Telpon</label>
                                                  <input name="phone" value="{{ $item->phone}}" type="number" class="form-control" id="phone">
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
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
                                              <form action="{{ route('user.delete', $item->id) }}" method="post">
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
