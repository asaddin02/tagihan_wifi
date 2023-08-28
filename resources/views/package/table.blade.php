@extends('layouts.template')

@section('title', $title)

@section('main')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Paket Wifi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active">Paket Wifi</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    @if (count($datas) > 0)
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-paket">
                                <i class="fas fa-plus"></i>
                                <span>Tambah Paket</span>
                            </button>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-tools">
                                    <form action="" method="GET">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="package_filter_name"
                                                class="form-control float-right" placeholder="Cari Nama Paket">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default" title="Cari">
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
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Paket</th>
                                            <th>Keunggulan</th>
                                            <th>Harga Paket</th>
                                            <th>Harga Pemasangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $index => $data)
                                            <tr>
                                                <td>{{ $index + $datas->firstItem() }}</td>
                                                <td>{{ $data->jenis_paket }}</td>
                                                <td>{{ $data->keunggulan }}</td>
                                                <td>Rp. {{ number_format($data->harga_paket, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($data->harga_pemasangan, 0, ',', '.') }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary mx-1" data-toggle="modal"
                                                        data-target="#edit-paket{{ $data->id }}" title="Edit">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#hapus-paket{{ $data->id }}" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="edit-paket{{ $data->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('package.update', $data->id) }}"
                                                            method="POST" autocomplete="off">
                                                            <div class="modal-body">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group row">
                                                                    <label class="col-sm-4 col-form-label">Jenis
                                                                        Paket</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="ex : paket_1" name="jenis_paket"
                                                                            value="{{ $data->jenis_paket }}" autofocus
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label
                                                                        class="col-sm-4 col-form-label">Keunggulan</label>
                                                                    <div class="col-sm-8">
                                                                        <textarea name="keunggulan" class="form-control text-area" cols="1" rows="1"
                                                                            placeholder="Input keunggulan paket" minlength="3" required>{{ $data->keunggulan }}</textarea>
                                                                    </div>
                                                                    <p
                                                                        class="text-danger mt-1 ms-3 d-none input-text-area-alert">
                                                                        Keunggulan minimal 3 karakter.
                                                                    </p>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-4 col-form-label">Harga
                                                                        Paket</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="number" class="form-control"
                                                                            name="harga_paket"
                                                                            value="{{ $data->harga_paket }}"
                                                                            placeholder="min : 50.000 max : 10.000.000"
                                                                            min="50000" max="10000000" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-4 col-form-label">Harga
                                                                        Pemasangan</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="number" class="form-control"
                                                                            name="harga_pemasangan"
                                                                            value="{{ $data->harga_pemasangan }}"
                                                                            placeholder="min : 50.000 max : 10.000.000"
                                                                            min="50000" max="10000000" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal" title="Batal"><i
                                                                        class="fa fa-times"></i></button>
                                                                <button type="submit" class="btn btn-primary"
                                                                    title="Simpan"><i class="fa fa-save"></i></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <div class="modal fade" id="hapus-paket{{ $data->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-danger">
                                                        <form action="{{ route('package.destroy', $data->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-body">
                                                                <h4 class="modal-title">Yakin mau hapus
                                                                    {{ $data->jenis_paket }} ?</h4>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-light"
                                                                    data-dismiss="modal" title="Batal"><i
                                                                        class="fa fa-times"></i></button>
                                                                <button type="submit" class="btn btn-light"
                                                                    title="Hapus"><i class="fa fa-trash"></i></button>
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
            <a href="{{ url('package') }}" class="btn btn-primary">Kembali</a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-paket">
                <i class="fas fa-plus"></i> Tambah Paket
            </button>
        </div>
    @endif

    <div class="modal fade" id="tambah-paket">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Tambah Paket</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('package.store') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Jenis
                                Paket</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="ex : paket_1" name="jenis_paket"
                                    autofocus required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Keunggulan</label>
                            <div class="col-sm-8">
                                <textarea name="keunggulan" class="form-control text-area" cols="1" rows="1"
                                    placeholder="Input keunggulan paket" minlength="3" required></textarea>
                                <p class="text-danger mt-1 ms-3 d-none input-text-area-alert">
                                    Keunggulan minimal 3 karakter.
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Harga
                                Paket</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="harga_paket"
                                    placeholder="min : 50.000 max : 10.000.000" min="50000" max="10000000" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Harga
                                Pemasangan</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="harga_pemasangan"
                                    placeholder="min : 50.000 max : 10.000.000" min="50000" max="10000000" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" title="Batal"><i
                                class="fa fa-times"></i></button>
                        <button type="submit" class="btn btn-primary" title="Simpan"><i
                                class="fa fa-save"></i></button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
