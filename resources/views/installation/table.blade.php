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
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-tools">
                                    <form action="" method="GET">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="installation_search"
                                                class="form-control float-right" placeholder="Cari Nama User">
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
                                            <th>Tanggal Pemasangan</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Harga Pemasangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($installations as $installation)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $installation->package->jenis_paket }}</td>
                                                <td>{{ $installation->user->name }}</td>
                                                <td>{{ $installation->technisian->nama_teknisi }}</td>
                                                <td>{{ date('d M Y', strToTime($installation->tanggal_pemasangan)) }}</td>
                                                <td>{{ $installation->alamat_pemasangan }}</td>
                                                <td>{{ $installation->status_pemasangan }}</td>
                                                <td>Rp.
                                                    {{ number_format($installation->package->harga_pemasangan, 0, ',', '.') }}
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
            <a href="{{ url('installation') }}" class="btn btn-primary">Kembali</a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-user">
                <i class="fas fa-plus"></i> Tambah Data
            </button>
        </div>
    @endif

    <div class="modal fade" id="tambah-user">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="{{ route('user.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="tambah-id-user" class="col-sm-4 col-form-label">ID User</label>
                            <div class="col-sm-8">
                                <input type="number" name="user_id" class="form-control" id="tambah-id-user"
                                    placeholder="ex : 0000" required autofocus max="9999">
                                <p class="text-danger mt-1 ms-3 d-none" id="tambah-id-user-alert">Nomor maksimal
                                    4 karakter</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tambah-nama-user" class="col-sm-4 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" id="tambah-nama-user"
                                    placeholder="ex : Nama User" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tambah-nomor-user" class="col-sm-4 col-form-label">No Telepon</label>
                            <div class="col-sm-8">
                                <input type="number" name="no_telepon" class="form-control" id="tambah-nomor-user"
                                    placeholder="ex : 08**********" required max="99999999999">
                                <p class="text-danger mt-1 ms-3 d-none" id="tambah-nomor-user-alert">Nomor hp maksimal
                                    12 karakter</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tambah-email-user" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" name="email" class="form-control" id="tambah-email-user"
                                    placeholder="ex : example@gmail.com" required>
                            </div>
                        </div>
                        <input type="hidden" name="password" value="user1234">
                        <input type="hidden" name="role" value="Customer">
                        <p class="mb-2">Note :</p>
                        <ul>
                            <li>
                                <p class="mb-2">Tambahkan user terlebih dahulu sebelum melakukan instalasi.</p>
                            </li>
                            <li>
                                <p class="mb-2">Pastikan data yang di inputkan benar.</p>
                            </li>
                        </ul>
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
                            <label for="tambah-paket-id" class="col-sm-4 col-form-label">Paket WiFi</label>
                            <div class="col-sm-8">
                                <select name="package_id" class="form-control" id="tambah-paket-id">
                                    @foreach ($packages as $package)
                                        <option value="{{ $package->id }}">{{ $package->jenis_paket }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tambah-teknisi-id" class="col-sm-4 col-form-label">Teknisi</label>
                            <div class="col-sm-8">
                                <select name="technision_id" class="form-control" id="tambah-teknisi-id">
                                    @foreach ($technisians as $teknisi)
                                        <option value="{{ $teknisi->id }}">{{ $teknisi->nama_teknisi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tambah-tanggal-pemasangan" class="col-sm-4 col-form-label">Tanggal
                                Pemasangan</label>
                            <div class="col-sm-8">
                                <span>{{ date('d M Y', strToTime($date)) }}</span>
                                <input type="hidden" name="tanggal_pemasangan" class="form-control"
                                    id="tambah-tanggal-pemasangan" value="{{ $date }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tambah-alamat-pemasangan" class="col-sm-4 col-form-label">Alamat
                                Pemasangan</label>
                            <div class="col-sm-8">
                                <input type="text" name="alamat_pemasangan" class="form-control"
                                    id="tambah-alamat-pemasangan" placeholder="Masukkan alamat">
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
