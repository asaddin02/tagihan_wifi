@extends('layouts.template')

@section('main')
    @if (count($installations) > 0)
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

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Bordered Table</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Task</th>
                                            <th>Progress</th>
                                            <th style="width: 40px">Label</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>Update software</td>
                                            <td>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-danger">55%</span></td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>Clean database</td>
                                            <td>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar bg-warning" style="width: 70%"></div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-warning">70%</span></td>
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td>Cron job running</td>
                                            <td>
                                                <div class="progress progress-xs progress-striped active">
                                                    <div class="progress-bar bg-primary" style="width: 30%"></div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-primary">30%</span></td>
                                        </tr>
                                        <tr>
                                            <td>4.</td>
                                            <td>Fix and squish bugs</td>
                                            <td>
                                                <div class="progress progress-xs progress-striped active">
                                                    <div class="progress-bar bg-success" style="width: 90%"></div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-success">90%</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="text-center">
        <p>Tidak Ada Installasi yang dilakukan</p>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-user">
            <i class="fas fa-plus"></i> Tambah Data
        </button>
    </div>

    {{-- Modal User --}}
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
                                    placeholder="ex : 0000">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_telp" class="col-sm-4 col-form-label">No Telepon</label>
                            <div class="col-sm-8">
                                <input type="number" name="no_telepon" class="form-control" id="no_telp"
                                    placeholder="ex : 08**********">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" name="alamat" class="form-control" id="email"
                                    placeholder="ex : a@gmail.com">
                            </div>
                        </div>
                        <input type="hidden" name="password" value="user1234">
                        <input type="hidden" name="role" value="Customer">
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-save"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Instalasi --}}
    <div class="modal fade" id="tambah-instalasi">
        <div class="modal-dialog modal-lg">
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
                            <label for="technision_id" class="col-sm-4 col-form-label">Penanggung Jawab</label>
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
                                <input type="date" name="tanggal_pemasangan" class="form-control"
                                    id="tanggal_pemasangan">
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

    <script>
        $(document).ready(function() {
            $('#tambah-instalasi').modal('show');
        });
    </script>
@endsection
