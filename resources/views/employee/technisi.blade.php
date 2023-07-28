@extends('layouts.template')

@section('title', 'Tabel Teknisi')

@section('main')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Teknisi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active">Teknisi</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @if (count($datas) > 0)
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#tambah-teknisi">
                                <i class="fas fa-plus"></i> Tambah Teknisi
                            </button>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-tools">
                                    <form action="" method="GET">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="technisian_search" class="form-control float-right"
                                                placeholder="Cari Nama">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap text-center">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Nomor Telepon</th>
                                            <th class="text-start">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $index => $data)
                                            <tr class="text-center">
                                                <td>{{ $index + $datas->firstItem() }}</td>
                                                <td>{{ $data->nama_teknisi }}</td>
                                                <td>{{ $data->alamat }}</td>
                                                <td>{{ $data->no_telepon }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#edit-teknisi{{ $data->id }}" title="Edit">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#hapus-teknisi{{ $data->id }}" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="edit-teknisi{{ $data->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form class="form-horizontal"
                                                            action="{{ route('edit.teknisi', $data->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group row">
                                                                    <label for="edit-nama-teknisi"
                                                                        class="col-sm-4 col-form-label">Nama
                                                                        Teknisi</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" name="nama_teknisi"
                                                                            class="form-control"
                                                                            id="edit-nama-teknisi"
                                                                            value="{{ $data->nama_teknisi }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="edit-alamat-teknisi"
                                                                        class="col-sm-4 col-form-label">Alamat
                                                                        Teknisi</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" name="alamat"
                                                                            class="form-control"
                                                                            id="edit-alamat-teknisi"
                                                                            value="{{ $data->alamat }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="edit-nomor-teknisi"
                                                                        class="col-sm-4 col-form-label">Nomor
                                                                        Telepon</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="number" name="no_telepon"
                                                                            class="form-control"
                                                                            id="edit-nomor-teknisi"
                                                                            value="{{ $data->no_telepon }}"
                                                                            max="99999999999">
                                                                        <p class="text-danger mt-1 ms-3 d-none"
                                                                            id="edit-nomor-teknisi-alert">Nomor hp
                                                                            maksimal
                                                                            12 karakter</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Tutup</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <div class="modal fade" id="hapus-teknisi{{ $data->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-danger">
                                                        <form
                                                            action="{{ route('delete.teknisi', $data->id) }}">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <h4 class="modal-title">Yakin mau hapus?
                                                                    {{ $data->nama_teknisi }}</h4>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-light"
                                                                    data-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-light">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        @if ($datas->firstItem() != $datas->lastItem())
                            <p>Menampilkan {{ $datas->firstItem() }} sampai {{ $datas->lastItem() }} dari
                                {{ $datas->total() }} data</p>
                        @endif
                        
                        @if ($datas->total() > 10)
                            <nav aria-label="...">
                                <ul class="pagination">
                                    @if ($datas->onFirstPage())
                                        <li class="page-item disabled">
                                            <a class="page-link">Previous</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $datas->previousPageUrl() }}">Previous</a>
                                        </li>
                                    @endif

                                    @foreach ($datas->getUrlRange(1, $datas->lastPage()) as $page => $url)
                                        @if ($page == $datas->currentPage())
                                            <li class="page-item active" aria-current="page">
                                                <a class="page-link">{{ $page }}</a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($datas->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $datas->nextPageUrl() }}">Next</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <a class="page-link">Next</a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    @else
        <div class="text-center">
            <div class="alert alert-warning" role="alert">
                Tidak ada data yang bisa ditampilkan!
            </div>
            <a href="{{ url('technic') }}" class="btn btn-primary">Kembali</a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-teknisi">
                <i class="fas fa-plus"></i> Tambah Teknisi
            </button>
        </div>
    @endif

    <div class="modal fade" id="tambah-teknisi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Teknisi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="{{ route('create.teknisi') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="tambah-nama-teknisi" class="col-sm-4 col-form-label">Nama
                                Teknisi</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama_teknisi" class="form-control" id="tambah-nama-teknisi"
                                    placeholder="ex : Nama Teknisi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tambah-alamat-teknisi" class="col-sm-4 col-form-label">Alamat
                                Teknisi</label>
                            <div class="col-sm-8">
                                <input type="text" name="alamat" class="form-control" id="tambah-alamat-teknisi"
                                    placeholder="Alamat detail">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tambah-nomor-teknisi" class="col-sm-4 col-form-label">Nomor
                                Telepon</label>
                            <div class="col-sm-8">
                                <input type="number" name="no_telepon" class="form-control" id="tambah-nomor-teknisi"
                                    placeholder="ex : 08**********" max="99999999999">
                                <p class="text-danger mt-1 ms-3 d-none" id="tambah-nomor-teknisi-alert">Nomor hp maksimal
                                    12 karakter</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
