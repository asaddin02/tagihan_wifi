@extends('layouts.template')

@section('title', 'technisian')

@section('main')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tabel Pegawai</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Simple Tables</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Teknisi</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#tambah-teknisi">
                                            <i class="fas fa-plus"></i> Tambah Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr class="text-center">
                                        <th>NO</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Nomor Telepon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($technisians)
                                        @foreach ($technisians as $technisi)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $technisi->nama_teknisi }}</td>
                                                <td>{{ $technisi->alamat }}</td>
                                                <td>{{ $technisi->no_telepon }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal"
                                                        data-target="#edit-teknisi{{ $technisi->id }}" title="Edit">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                        data-target="#hapus-teknisi{{ $technisi->id }}" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            {{-- Modal Edit --}}
                                            <div class="modal fade" id="edit-teknisi{{ $technisi->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data Teknisi</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal"
                                                                action="{{ route('edit.teknisi', $technisi->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="form-group row">
                                                                    <label for="namaTeknisi"
                                                                        class="col-sm-4 col-form-label">Nama Teknisi</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" name="nama_teknisi"
                                                                            class="form-control" id="namaTeknisi"
                                                                            value="{{ $technisi->nama_teknisi }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="alamatTeknisi"
                                                                        class="col-sm-4 col-form-label">Alamat Teknisi</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" name="alamat"
                                                                            class="form-control" id="alamatTeknisi"
                                                                            value="{{ $technisi->alamat }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="notelp" class="col-sm-4 col-form-label">Nomor
                                                                        Telepon</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="number" name="no_telepon"
                                                                            class="form-control" id="notelp"
                                                                            value="{{ $technisi->no_telepon }}">
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-end">
                                                            <button type="submit" class="btn btn-sm btn-secondary">Edit
                                                                Data</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>

                                            {{-- Modal Hapus --}}
                                            <div class="modal fade" id="hapus-teknisi{{ $technisi->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Teknisi</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin ingin menghapus <span
                                                                    class="text-danger">{{ $technisi->nama_teknisi }}</span> ?
                                                            </p>
                                                            <form class="form-horizontal"
                                                                action="{{ route('delete.teknisi', $technisi->id) }}">
                                                        </div>
                                                        <div class="modal-footer justify-content-end">
                                                            <button type="submit"
                                                                class="btn btn-sm btn-primary">Tambahkan</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal Tambah --}}
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
                    <form class="form-horizontal" action="{{ route('create.teknisi') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="namaTeknisi" class="col-sm-4 col-form-label">Nama Teknisi</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama_teknisi" class="form-control" id="namaTeknisi"
                                    placeholder="Nama Teknisi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamatTeknisi" class="col-sm-4 col-form-label">Alamat Teknisi</label>
                            <div class="col-sm-8">
                                <input type="text" name="alamat" class="form-control" id="alamatTeknisi"
                                    placeholder="Alamat Teknisi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="notelp" class="col-sm-4 col-form-label">Nomor Telepon</label>
                            <div class="col-sm-8">
                                <input type="number" name="no_telepon" class="form-control" id="notelp"
                                    placeholder="Nomor Telepon">
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary">Tambahkan</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
