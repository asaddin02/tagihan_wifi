@extends('layouts.template')

@section('title', 'Tabel Customer Service')

@section('main')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer Service</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active">Customer Service</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-cs">
                                <i class="fas fa-plus"></i> Tambah Customer Service
                            </button>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-tools">
                                    <form action="" method="GET">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="cs_filter_name" class="form-control float-right"
                                                placeholder="Cari Nama">
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
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>User Id</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Nomor Telepon</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $index => $data)
                                            <tr class="text-center">
                                                <td>{{ $index + $datas->firstItem() }}</td>
                                                <td>{{ $data->user_id }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->email }}</td>
                                                <td>{{ $data->no_telepon }}</td>
                                                <td>{{ $data->photo_profile }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#edit-cs{{ $data->id }}" title="Edit">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#hapus-cs{{ $data->id }}" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target="#whatsapp-cs{{ $data->id }}" title="Whatsapp">
                                                        <i class="fas fa-phone"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="edit-cs{{ $data->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form class="form-horizontal"
                                                            action="{{ route('cs.update', $data->id) }}" method="post" autocomplete="off">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-4 col-form-label">User Id</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="number" name="user_id"
                                                                            class="form-control"
                                                                            value="{{ $data->user_id }}"
                                                                            placeholder="ex : 0000" min="1"
                                                                            max="9999" autofocus required>
                                                                        <p
                                                                            class="text-danger mt-1 ms-3 d-none input-number-alert">
                                                                            Nomor Id
                                                                            maksimal 4
                                                                            karakter.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-4 col-form-label">Nama
                                                                        CS</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" name="name"
                                                                            class="form-control"
                                                                            value="{{ $data->name }}"
                                                                            placeholder="ex : Nama" minlength="3"
                                                                            maxlength="15" required>
                                                                        <p
                                                                            class="text-danger mt-1 ms-3 d-none input-text-alert">
                                                                            Nama minimal 3 karakter.
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-4 col-form-label">Email</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="email" name="email"
                                                                            class="form-control"
                                                                            value="{{ $data->email }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-4 col-form-label">Nomor
                                                                        Telepon</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="tel" name="no_telepon"
                                                                            class="form-control"
                                                                            value="{{ $data->no_telepon }}"
                                                                            placeholder="ex : 08**********"
                                                                            pattern="(0)8[1-9][0-9]{6,9}$" required>
                                                                        <p
                                                                            class="text-danger mt-1 ms-3 d-none input-tel-alert">
                                                                            Nomor hp maksimal
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
                                            <div class="modal fade" id="hapus-cs{{ $data->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-danger">
                                                        <form action="{{ route('cs.destroy', $data->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-body">
                                                                <h4 class="modal-title">Yakin mau hapus?
                                                                    {{ $data->name }}</h4>
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
                                            <div class="modal fade" id="whatsapp-cs{{ $data->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('whatsapp.cs') }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <h4 class="modal-title">Ini akan mengarahkan ke Whatsapp
                                                                    <br>
                                                                    {{ $data->name }}
                                                                </h4>
                                                                <input type="hidden" name="no_telepon"
                                                                    value="{{ $data->no_telepon }}">
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Ya</button>
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
            <a href="{{ url('cs') }}" class="btn btn-primary">Kembali</a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-cs">
                <i class="fas fa-plus"></i> Tambah Customer Service
            </button>
        </div>
    @endif

    <div class="modal fade" id="tambah-cs">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Tambah CS</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="{{ route('cs.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">User Id</label>
                            <div class="col-sm-8">
                                <input type="number" name="user_id" class="form-control" placeholder="ex : 0000"
                                    min="1" max="9999" autofocus required>
                                <p class="text-danger mt-1 ms-3 d-none input-number-alert">Nomor Id maksimal 4
                                    karakter.</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nama
                                CS</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" placeholder="ex : Nama"
                                    minlength="3" maxlength="15" required>
                                <p class="text-danger mt-1 ms-3 d-none input-text-alert">Nama minimal 3 karakter.
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" name="email" class="form-control"
                                    placeholder="ex : example@gmail.com" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nomor
                                Telepon</label>
                            <div class="col-sm-8">
                                <input type="tel" name="no_telepon" class="form-control"
                                    placeholder="ex : 08**********" pattern="(0)8[1-9][0-9]{6,9}$" required>
                                <p class="text-danger mt-1 ms-3 d-none input-tel-alert">Nomor hp maksimal
                                    12 karakter</p>
                            </div>
                        </div>
                        <div class="alert alert-info text-start" role="alert">
                            <p>Note :</p>
                            <ul>
                                <li>
                                    <span>Password default customer service adalah cs123.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <input type="hidden" name="password" value="cs123" required>
                    <input type="hidden" name="role" value="Customer Service" required>
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
