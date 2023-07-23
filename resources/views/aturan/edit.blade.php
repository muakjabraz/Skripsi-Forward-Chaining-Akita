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
                    <h6 class="m-0 font-weight-bold text-success">Edit {{ $title }}</h6>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addGejalaAturan"><i class="fa fa-plus"></i> Add {{ $title }}</button>
                    <!-- Modal -->
                    <div class="modal fade" id="addGejalaAturan" tabindex="-1" role="dialog" aria-labelledby="addGejalaAturanTitle" aria-hidden="true">
                      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Gejala {{ $title }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="{{ route('tambah_gejala_aturan') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="gejala_id" class="form-label">Pilih Gejala</label>
                                    <input type="hidden" name="kasus_id" value="{{ $kasus->id }}">
                                    <select class="form-select form-control" name="gejala_id" id="gejala_id">
                                        @foreach ($select_gejala as $item)
                                        <option value="{{ $item }}">
                                        {{ $gejala->where('id', $item)->first()->nama }}
                                        </option>
                                    @endforeach
                                    </select>
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
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Gejala</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody id="items">
                                @foreach ($aturan as $item)
                                <tr>
                                    <td><input type="hidden" name="gejala_id[]" value="{{ $item->gejala->id }}"> {{ $item->gejala->kode }}</td>
                                    <td>{{ $item->gejala->nama }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteGejalaAturan{{ $item->id }}"><i class="fa fa-trash"></i> Delete</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteGejalaAturan{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteGejalaAturan{{ $item->id }}Title" aria-hidden="true">
                                            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete {{ $title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin untuk menghapus gejala dengan kode "{{ $item->gejala->kode }}"?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('hapus_gejala_aturan', $item->id) }}" method="post">
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
                    <form action="{{ route('aturan.update', $kasus->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-3 mt-3">
                            <label for="penyakit_id" class="form-label">Diagnosa</label>
                            <select class="form-control form-select form-select-lg" name="penyakit_id" id="penyakit_id" required>
                                <option selected value="">Pilih gejala</option>
                                @foreach ($penyakit as $item)
                                <option @if (old('penyakit_id',$kasus->penyakit_id) == $item->id) selected @endif value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control" name="catatan" id="catatan" rows="3">{{ old('catatan',$kasus->catatan) }}</textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                            <a href="{{ route('aturan.index') }}" type="button" class="btn btn-secondary"><i class="fa fa-arrow-right"></i> Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
{{-- <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    var el = document.getElementById('items');
    var sortable = Sortable.create(el);
</script> --}}
@endsection
