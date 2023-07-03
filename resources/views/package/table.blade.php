@extends('layouts.template')

@section('title', 'Package Table')

@section('main')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Package</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Table</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#tambah-paket">
                            Tambah Paket
                        </button>
                        <div class="modal fade" id="tambah-paket">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah Data</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('package.store') }}" method="POST">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="form-group">
                                                <label for="jenis-paket">Jenis Paket</label>
                                                <input type="text" class="form-control" id="jenis-paket"
                                                    placeholder="Ex: paket_1" name="jenis_paket" autofocus required>
                                            </div>
                                            <div class="form-group">
                                                <label for="keunggulan">Keunggulan</label>
                                                <input type="text" class="form-control" id="keunggulan"
                                                    placeholder="Input Keunggulan Paket" name="keunggulan" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga-paket">Harga Paket</label>
                                                <input type="number" class="form-control" id="harga-paket"
                                                    name="harga_paket" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga-pemasangan">Harga Pemasangan</label>
                                                <input type="number" class="form-control" id="harga-pemasangan"
                                                    name="harga_pemasangan" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <form action="" method="GET">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="package_search" class="form-control float-right"
                                            placeholder="Search">
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
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Jenis Paket</th>
                                        <th>Keunggulan</th>
                                        <th>Harga Paket</th>
                                        <th>Harga Pemasangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->jenis_paket }}</td>
                                            <td>{{ $data->keunggulan }}</td>
                                            <td>{{ $data->harga_paket }}</td>
                                            <td>{{ $data->harga_pemasangan }}</td>
                                            <td class="d-flex flex-wrap ">
                                                <button type="button" class="btn btn-primary mx-1" data-toggle="modal"
                                                    data-target="#edit-paket{{ $data->id }}">
                                                    Edit Paket
                                                </button>
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
                                                                method="POST">
                                                                <div class="modal-body">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group">
                                                                        <label for="jenis-paket">Jenis Paket</label>
                                                                        <input type="text" class="form-control"
                                                                            id="jenis-paket" placeholder="Ex: paket_1"
                                                                            name="jenis_paket"
                                                                            value="{{ $data->jenis_paket }}" autofocus
                                                                            required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="keunggulan">Keunggulan</label>
                                                                        <input type="text" class="form-control"
                                                                            id="keunggulan"
                                                                            placeholder="Input Keunggulan Paket"
                                                                            name="keunggulan"
                                                                            value="{{ $data->keunggulan }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="harga-paket">Harga Paket</label>
                                                                        <input type="number" class="form-control"
                                                                            id="harga-paket" name="harga_paket"
                                                                            value="{{ $data->harga_paket }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="harga-pemasangan">Harga
                                                                            Pemasangan</label>
                                                                        <input type="number" class="form-control"
                                                                            id="harga-pemasangan" name="harga_pemasangan"
                                                                            value="{{ $data->harga_pemasangan }}"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default"
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
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#hapus-paket{{ $data->id }}">
                                                    Hapus
                                                </button>
                                                <div class="modal fade" id="hapus-paket{{ $data->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content bg-danger">
                                                            <form action="{{ route('package.destroy', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-body">
                                                                    <h4 class="modal-title">Yakin mau hapus?</h4>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-light"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-light">Hapus</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection
