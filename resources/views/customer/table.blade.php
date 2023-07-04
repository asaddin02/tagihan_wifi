@extends('layouts.template')

@section('title', 'Customer Table')

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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Customer</li>
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
                                        <th>User ID</th>
                                        <th>Nama</th>
                                        <th>Nomor Telepon</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->user_id }}</td>
                                            <td><a href="{{ url('customer/detail/'.$data->id) }}">{{ $data->name }}</a></td>
                                            <td>{{ $data->no_telepon }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td class="d-flex flex-wrap ">
                                                <form action="{{ route('customer.update', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" class="d-none" name="">
                                                    <button type="submit" class="btn btn-success">Bayar Cash</button>
                                                </form>
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
