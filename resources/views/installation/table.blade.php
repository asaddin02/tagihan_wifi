@extends('layouts.template')

@section('title', $title)

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
                            @if (Auth::user()->role == 'Customer Service')
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#tambah-user">
                                    <i class="fas fa-plus"></i> Tambah User
                                </button>
                            @endif
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
                                            <th>Nama Customer</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th></th>
                                            @if (Auth::user()->role == 'Customer Service')
                                                <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $index => $data)
                                            <tr class="text-center">
                                                <td>{{ $index + $datas->firstItem() }}</td>
                                                <td>{{ $data->user->name }}</td>
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
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#detail-instalasi{{ $data->id }}"
                                                        title="Detail Instalasi">
                                                        <i class="fa fa-info-circle"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    @if (Auth::user()->role == 'Customer Service')
                                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#edit-data-instalasi{{ $data->id }}"
                                                            title="Edit Instalasi">
                                                            <i class="fas fa-pen"></i>
                                                        </button>
                                                        @if ($data->status_pemasangan == 'Belum Terpasang')
                                                            <button type="button" class="btn btn-success"
                                                                data-toggle="modal"
                                                                data-target="#instalasi-dalam-proses{{ $data->id }}"
                                                                title="Ubah Status">
                                                                <i class="fa fa-box-open"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger"
                                                                data-toggle="modal"
                                                                data-target="#hapus-instalasi-belum-terpasang{{ $data->id }}"
                                                                title="Hapus">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @elseif ($data->status_pemasangan == 'Dalam Proses')
                                                            <button type="button" class="btn btn-success"
                                                                data-toggle="modal"
                                                                data-target="#instalasi-terpasang{{ $data->id }}"
                                                                title="Ubah Status">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                        @endif
                                                        @if ($data->status_pemasangan == 'Terpasang')
                                                            <button type="button" class="btn btn-danger"
                                                                data-toggle="modal"
                                                                data-target="#hapus-instalasi-sudah-terpasang{{ $data->id }}"
                                                                title="Hapus">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="detail-instalasi{{ $data->id }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Detail Instalasi</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <label class="col-sm-5 col-form-label">Jenis Paket</label>
                                                                <div class="col-sm-7">
                                                                    <p class="text-black">:
                                                                        {{ $data->package->jenis_paket }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-5 col-form-label">Nama Teknisi</label>
                                                                <div class="col-sm-7">
                                                                    <p class="text-black">:
                                                                        {{ $data->technisian->nama_teknisi }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-5 col-form-label">Tanggal
                                                                    Pemasangan</label>
                                                                <div class="col-sm-7">
                                                                    <p class="text-black">:
                                                                        {{ date('d M Y', strToTime($data->tanggal_pemasangan)) }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-5 col-form-label">Harga Paket</label>
                                                                <div class="col-sm-7">
                                                                    <p class="text-black">: Rp.
                                                                        {{ number_format($data->package->harga_paket, 0, ',', '.') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-5 col-form-label">Harga
                                                                    Pemasangan</label>
                                                                <div class="col-sm-7">
                                                                    <p class="text-black">: Rp.
                                                                        {{ number_format($data->package->harga_pemasangan, 0, ',', '.') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="edit-data-instalasi{{ $data->id }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Form Edit Data</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('edit.data.pemasangan', $data->id) }}"
                                                            method="POST" autocomplete="off">
                                                            <div class="modal-body">
                                                                @csrf
                                                                <div class="form-group row">
                                                                    <label class="col-sm-4 col-form-label">Paket
                                                                        WiFi</label>
                                                                    <div class="col-sm-8">
                                                                        <select name="package_id" class="form-control">
                                                                            @foreach ($packages as $package)
                                                                                <option value="{{ $package->id }}"
                                                                                    @selected($package->id == $data->package_id)>
                                                                                    {{ $package->jenis_paket }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-4 col-form-label">Teknisi</label>
                                                                    <div class="col-sm-8">
                                                                        <select name="teknisi_id" class="form-control">
                                                                            @foreach ($technisians as $teknisi)
                                                                                <option value="{{ $teknisi->id }}"
                                                                                    @selected($teknisi->id == $data->teknisi_id)>
                                                                                    {{ $teknisi->nama_teknisi }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-4 col-form-label">Alamat
                                                                        Instalasi</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control"
                                                                            id="edit-alamat-pemasangan"
                                                                            name="alamat_pemasangan"
                                                                            value="{{ $data->alamat_pemasangan }}"
                                                                            minlength="5" autofocus required>
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
                                                                    data-dismiss="modal" title="Batal"><i
                                                                        class="fa fa-times"></i></button>
                                                                <button type="submit" class="btn btn-light"
                                                                    title="Simpan"><i class="fa fa-save"></i></button>
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
                                                                <input type="hidden" name="customer_name"
                                                                    value="{{ $data->user->name }}" required>
                                                                <input type="hidden" name="status_pemasangan"
                                                                    value="Terpasang" required>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-light"
                                                                    data-dismiss="modal" title="Batal"><i
                                                                        class="fa fa-times"></i></button>
                                                                <button type="submit" class="btn btn-light"
                                                                    title="Simpan"><i class="fa fa-save"></i></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade"
                                                id="hapus-instalasi-belum-terpasang{{ $data->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-danger">
                                                        <form action="{{ route('hapus.pemasangan', $data->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <h4 class="modal-title">Yakin mau hapus
                                                                    instalasi ?</h4>
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ $data->user_id }}" required>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-light"
                                                                    data-dismiss="modal" title="Batal"><i
                                                                        class="fa fa-times"></i></button>
                                                                <button type="submit" class="btn btn-light"
                                                                    title="Simpan"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <div class="modal fade"
                                                id="hapus-instalasi-sudah-terpasang{{ $data->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-danger">
                                                        <form action="{{ route('hapus.pemasangan', $data->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <h4 class="modal-title mb-2">Yakin mau hapus
                                                                    instalasi ?</h4>
                                                                <div class="alert alert-danger text-start" role="alert">
                                                                    <p>Note :</p>
                                                                    <ul>
                                                                        <li>
                                                                            <span>Ini akan menghapus customer juga.</span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ $data->user_id }}" required>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-light"
                                                                    data-dismiss="modal" title="Batal"><i
                                                                        class="fa fa-times"></i></button>
                                                                <button type="submit" class="btn btn-light"
                                                                    title="Simpan"><i class="fa fa-trash"></i></button>
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
            <a href="{{ url('installation') }}" class="btn btn-primary">Kembali</a>
            @if (Auth::user()->role == 'Customer Service')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-user">
                    <i class="fas fa-plus"></i> Tambah User
                </button>
            @endif
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
                <form class="form-horizontal" action="{{ route('user.store') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">ID User</label>
                            <div class="col-sm-8">
                                <input type="number" name="user_id"
                                    class="form-control @error('user_id') is-invalid @enderror" placeholder="ex : 0000"
                                    value="{{ old('user_id') }}" autofocus required>
                                <p class="text-danger mt-1 d-none input-number-alert">User Id maksimal 4
                                    karakter.</p>
                                @error('user_id')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-8">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="ex : Nama User"
                                    value="{{ old('name') }}" minlength="5" maxlength="20" required>
                                <p class="text-danger mt-1 ms-3 d-none input-text-alert">Nama minimal 5 karakter.
                                </p>
                                @error('name')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    placeholder="ex : example@gmail.com" required>
                                @error('email')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">No Telepon</label>
                            <div class="col-sm-8">
                                <input type="tel" name="no_telepon"
                                    class="form-control @error('no_telepon') is-invalid @enderror"
                                    value="{{ old('no_telepon') }}" placeholder="ex : 08**********"
                                    pattern="(0)8[1-9][0-9]{6,9}$" required>
                                <p class="text-danger mt-1 ms-3 d-none input-tel-alert">Nomor hp maksimal
                                    12 karakter</p>
                                @error('no_telepon')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="password" value="user123">
                        <input type="hidden" name="role" value="Customer">
                        <div class="alert alert-info" role="alert">
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
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="submit" class="btn btn-sm btn-primary" title="Lanjut"><i
                                class="fa fa-long-arrow-alt-right"></i></button>
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
                <form class="form-horizontal" action="{{ route('create.pemasangan') }}" method="post"
                    autocomplete="off">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Paket WiFi</label>
                            <div class="col-sm-7">
                                <select name="package_id" class="form-control">
                                    @foreach ($packages as $package)
                                        <option value="{{ $package->id }}">{{ $package->jenis_paket }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Teknisi</label>
                            <div class="col-sm-7">
                                <select name="teknisi_id" class="form-control">
                                    @foreach ($technisians as $teknisi)
                                        <option value="{{ $teknisi->id }}">{{ $teknisi->nama_teknisi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Tanggal
                                Pemasangan</label>
                            <div class="col-sm-7">
                                <p>: {{ date('d M Y', strToTime($date)) }}</p>
                                <input type="hidden" name="tanggal_pemasangan" class="form-control"
                                    value="{{ $date }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Alamat
                                Pemasangan</label>
                            <div class="col-sm-7">
                                <input type="text" name="alamat_pemasangan" class="form-control"
                                    placeholder="Masukkan alamat" minlength="5" required>
                            </div>
                        </div>
                        <div class="alert alert-info" role="alert">
                            <p class="mb-2">Note :</p>
                            <ul>
                                <li>
                                    <p class="mb-2">Pastikan data alamat yang di inputkan benar.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="submit" class="btn btn-sm btn-primary" title="Simpan"><i
                                class="fas fa-save"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
