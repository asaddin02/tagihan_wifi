@extends('layouts.template')

@section('title', 'Tabel Instalasi')

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

    @if (count($datas) > 0)
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-user">
                                <i class="fas fa-plus"></i> Tambah User
                            </button>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-tools">
                                    <form action="" method="GET">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input class="form-control float-right" list="filter-status-instalasi"
                                                id="input-filter-status-instalasi" placeholder="Status"
                                                name="installation_filter_status">
                                            <datalist id="filter-status-instalasi">
                                                <option value="All">
                                                <option value="Terpasang">
                                                <option value="Dalam Proses">
                                                <option value="Belum Terpasang">
                                            </datalist>
                                            <input type="text" name="installation_filter_name"
                                                class="form-control float-right" placeholder="Nama" title="Nama Customer">
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
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Jenis Paket</th>
                                            <th>Nama User</th>
                                            <th>Nama Teknisi</th>
                                            <th>Tanggal Pemasangan</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Harga Paket</th>
                                            <th>Harga Pemasangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $index => $data)
                                            <tr class="text-center">
                                                <td>{{ $index + $datas->firstItem() }}</td>
                                                <td>{{ $data->package->jenis_paket }}</td>
                                                <td>{{ $data->user->name }}</td>
                                                <td>{{ $data->technisian->nama_teknisi }}</td>
                                                <td>{{ date('d M Y', strToTime($data->tanggal_pemasangan)) }}</td>
                                                <td>{{ $data->alamat_pemasangan }}</td>
                                                <td>
                                                    @if ($data->status_pemasangan == 'Belum Terpasang')
                                                        <span
                                                            class="fw-bold text-danger">{{ $data->status_pemasangan }}</span>
                                                    @elseif ($data->status_pemasangan == 'Dalam Proses')
                                                        <span
                                                            class="fw-bold text-warning">{{ $data->status_pemasangan }}</span>
                                                    @else
                                                        <span
                                                            class="fw-bold text-success">{{ $data->status_pemasangan }}</span>
                                                    @endif
                                                </td>
                                                <td>Rp.
                                                    {{ number_format($data->package->harga_paket, 0, ',', '.') }}
                                                </td>
                                                <td>Rp.
                                                    {{ number_format($data->package->harga_pemasangan, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#edit-alamat-instalasi{{ $data->id }}"
                                                        title="Edit Alamat Instalasi">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                    @if ($data->status_pemasangan == 'Belum Terpasang')
                                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                                            data-target="#instalasi-dalam-proses{{ $data->id }}"
                                                            title="Ubah Status">
                                                            <i class="fa fa-box-open"></i>
                                                        </button>
                                                    @elseif ($data->status_pemasangan == 'Dalam Proses')
                                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                                            data-target="#instalasi-terpasang{{ $data->id }}"
                                                            title="Ubah Status">
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="edit-alamat-instalasi{{ $data->id }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('edit.alamat', $data->id) }}"
                                                            method="POST">
                                                            <div class="modal-body">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="edit-alamat-pemasangan">Alamat
                                                                        Instalasi</label>
                                                                    <input type="text" class="form-control"
                                                                        id="edit-alamat-pemasangan" name="alamat_pemasangan"
                                                                        value="{{ $data->alamat_pemasangan }}" autofocus
                                                                        required>
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
                                                </div>
                                            </div>
                                            <div class="modal fade" id="instalasi-dalam-proses{{ $data->id }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-yellow">
                                                        <form action="{{ route('edit.pemasangan', $data->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <h4 class="modal-title">Mau mengubah status
                                                                    menjadi <br> Dalam Proses ?</h4>
                                                                <input type="hidden" name="status_pemasangan"
                                                                    value="Dalam Proses" required>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-light"
                                                                    data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-light">Ubah</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="instalasi-terpasang{{ $data->id }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-yellow">
                                                        <form action="{{ route('edit.pemasangan', $data->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <h4 class="modal-title">Mau mengubah status
                                                                    menjadi <br> Terpasang ?</h4>
                                                                <input type="hidden" name="package_id"
                                                                    value="{{ $data->package_id }}" required>
                                                                <input type="hidden" name="status_pemasangan"
                                                                    value="Terpasang" required>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-light"
                                                                    data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-light">Ubah</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
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
            <a href="{{ url('installation') }}" class="btn btn-primary">Kembali</a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-user">
                <i class="fas fa-plus"></i> Tambah User
            </button>
        </div>
    @endif

    <div class="modal fade" id="tambah-user">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Tambah User</h4>
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
                                <span>{{ date('d m Y', strToTime($date)) }}</span>
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
                        <p class="mb-2">Note :</p>
                        <ul>
                            <li>
                                <p class="mb-2">Pastikan data alamat yang di inputkan benar.</p>
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan
                            Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
