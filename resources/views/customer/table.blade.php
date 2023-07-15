@extends('layouts.template')

@section('title', 'Customer Table')

@section('main')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Customer</li>
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
                        <div class="card">
                            <div class="card-header">
                                <div class="card-tools">
                                    <form action="" method="GET">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="customer_search" class="form-control float-right"
                                                placeholder="Cari Id / Nama">
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
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Id Customer</th>
                                            <th>Nama</th>
                                            <th>Jenis Paket</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $data)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->user->user_id }}</td>
                                                <td>
                                                    <a href=""
                                                        class="text-decoration-none">{{ $data->user->name }}</a>
                                                </td>
                                                <td>{{ $data->package->jenis_paket }}</td>
                                                <td>{{ $data->alamat_pemasangan }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#edit-alamat-customer{{ $data->id }}" title="Edit">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                    <div class="modal fade" id="edit-alamat-customer{{ $data->id }}">
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
                                                                    action="{{ route('customer.update', $data->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class="form-group row">
                                                                            <label for="form-edit-alamat-customer"
                                                                                class="col-sm-4 col-form-label">Alamat
                                                                                Pemasangan</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text"
                                                                                    name="alamat_pemasangan"
                                                                                    class="form-control"
                                                                                    id="form-edit-alamat-customer"
                                                                                    value="{{ $data->alamat_pemasangan }}">
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
                                                    <a href="{{ url('/customer/invoice/' . $data->id) }}"
                                                        class="btn btn-success">Tagihan</a>
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
    @else
        <div class="text-center">
            <div class="alert alert-warning" role="alert">
                Tidak ada data yang bisa ditampilkan!
            </div>
            <a href="{{ url('/customer') }}" class="btn btn-primary">Kembali</a>
        </div>
    @endif

@endsection
