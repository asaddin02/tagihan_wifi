@extends('layouts.template')

@section('title', 'User Profile')

@section('main')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Customer Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Home</li>
                        <li class="breadcrumb-item"><a href="{{ url('/customer') }}" class="text-decoration-none">Customer</a></li>
                        <li class="breadcrumb-item active">Detail</li>
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
                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('template/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">
                                {{ Str::title(Str::limit($installation->user->name, 20, '.')) }}
                            </h3>
                            <p class="text-muted text-center">User ID {{ $installation->user->user_id }}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Role</b> <a
                                        class="float-right text-decoration-none">{{ $installation->user->role }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a
                                        class="float-right text-decoration-none">{{ $installation->user->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>No HP</b> <a
                                        class="float-right text-decoration-none">{{ $installation->user->no_telepon }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Paket</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Tunggakan</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Jenis Paket</b> <a
                                                class="float-right text-decoration-none">{{ $installation->package->jenis_paket }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Teknisi Yang Memasang</b> <a
                                                class="float-right text-decoration-none">{{ $installation->technisian->nama_teknisi }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Tanggal Pemasangan</b> <a
                                                class="float-right text-decoration-none">{{ date('d M Y', strToTime($installation->tanggal_pemasangan)) }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="activity">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Bulan</th>
                                                <th>Tahun</th>
                                                <th>Total Tagihan</th>
                                                <th>Status Tagihan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoices as $invoice)
                                                <tr class="text-center">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $invoice->bulan }}</td>
                                                    <td>{{ $invoice->tahun }}</td>
                                                    <td>Rp. {{ number_format($invoice->total_tagihan, 0, ',', '.') }}</td>
                                                    <td><span class="text-danger">{{ $invoice->status_tagihan }}</span></td>
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
        </div>
    </section>
@endsection
