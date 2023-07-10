@extends('layouts.template')

@section('title', 'Instalation Table')

@section('main')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Instalasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Instalasi</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @if (count($installations) > 0)

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-user">
                                <i class="fas fa-plus"></i> Tambah Data
                            </button>
                            <div class="modal fade" id="tambah-teknisi">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah Data Teknisi</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" action="{{ route('create.teknisi') }}"
                                                method="post">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="namaTeknisi" class="col-sm-4 col-form-label">Nama
                                                        Teknisi</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="nama_teknisi" class="form-control"
                                                            id="namaTeknisi" placeholder="Nama Teknisi">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="alamatTeknisi" class="col-sm-4 col-form-label">Alamat
                                                        Teknisi</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="alamat" class="form-control"
                                                            id="alamatTeknisi" placeholder="Alamat Teknisi">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="notelp" class="col-sm-4 col-form-label">Nomor
                                                        Telepon</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" name="no_telepon" class="form-control"
                                                            id="notelp" placeholder="ex : 08**********">
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger"
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
                                                placeholder="Cari">
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
                                            <th>NO</th>
                                            <th>Jenis Paket</th>
                                            <th>Nama User</th>
                                            <th>Nama Teknisi</th>
                                            <th>Alamat</th>
                                            <th>Nomor Telepon</th>
                                            <th>Harga Pemasangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($installations as $installation)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $installation->package->jenis_paket }}</td>
                                                <td>{{ $installation->user->name }}</td>
                                                <td>{{ $installation->teknisi_id }}</td>
                                                <td>{{ $installation->alamat_pemasangan }}</td>
                                                <td>{{ $installation->status_pemasangan }}</td>
                                                <td>Rp. {{ number_format($installation->package->harga_pemasangan, 0, ',', '.'); }}</td>
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
            <p>Tidak Ada Installasi yang dilakukan</p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-user">
                <i class="fas fa-plus"></i> Tambah Data
            </button>
        </div>
    @endif

    <div class="modal fade" id="tambah-user">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ route('user.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="id_user" class="col-sm-4 col-form-label">ID User</label>
                            <div class="col-sm-8">
                                <input type="number" name="user_id" class="form-control" id="id_user"
                                    placeholder="ex : 0000" required autofocus>
                                <span class="text-danger">Nomor harus 4 digit</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_telp" class="col-sm-4 col-form-label">No Telepon</label>
                            <div class="col-sm-8">
                                <input type="number" name="no_telepon" class="form-control" id="no_telp"
                                    placeholder="ex : 08**********" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="ex : a@gmail.com" required>
                            </div>
                        </div>
                        <input type="hidden" name="password" value="user1234">
                        <input type="hidden" name="role" value="Customer">
                        <p class="mb-2">Note :</p>
                        <p class="mb-2">Masukkan user terlebih dahulu sebelum melakukan instalasi.</p>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tambah-instalasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Instalasi</h4>
                </div>
                <form class="form-horizontal" action="{{ route('create.pemasangan') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group row">
                            <label for="package_id" class="col-sm-4 col-form-label">Paket WiFi</label>
                            <div class="col-sm-8">
                                <select name="package_id" class="form-control" id="package_id">
                                    @foreach ($packages as $package)
                                        <option value="{{ $package->id }}">{{ $package->jenis_paket }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="technision_id" class="col-sm-4 col-form-label">Teknisi</label>
                            <div class="col-sm-8">
                                <select name="technision_id" class="form-control" id="technision_id">
                                    @foreach ($technisians as $teknisi)
                                        <option value="{{ $teknisi->id }}">{{ $teknisi->nama_teknisi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_pemasangan" class="col-sm-4 col-form-label">Tanggal Pemasangan</label>
                            <div class="col-sm-8">
                                <input type="text" name="tanggal_pemasangan" class="form-control"
                                    id="tanggal_pemasangan" value="{{ $date }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-4 col-form-label">Alamat Pemasangan</label>
                            <div class="col-sm-8">
                                <input type="text" name="alamat_pemasangan" class="form-control" id="alamat"
                                    placeholder="Masukkan alamat">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-save"></i> Simpan
                            Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
