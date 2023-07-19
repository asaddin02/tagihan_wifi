@extends('layouts.template')

@section('title', 'Invoice Table')

@section('main')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tagihan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Home</li>
                        <li class="breadcrumb-item"><a href="{{ url('/customer') }}" class="text-decoration-none">Customer</a>
                        </li>
                        <li class="breadcrumb-item active">Tagihan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @if (count($datas) <= 0)
        <div class="alert alert-warning" role="alert">
            Tidak ada data yang bisa ditampilkan!
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#tambah-tagihan-customer">
                            <i class="fas fa-plus"></i> Tambah Data
                        </button>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <form action="" method="GET">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <select name="invoice_month" class="form-control float-right">
                                            <option value="all">Bulan</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                        <select name="invoice_year" class="form-control float-right">
                                            <option value="all">Tahun</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                        </select>
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
                                        <th>Id Instalasi</th>
                                        <th>Nama User</th>
                                        <th>Tagihan Untuk Bulan</th>
                                        <th>Total Tagihan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->installation_id }}</td>
                                            <td>{{ $data->installation->user->name }}</td>
                                            <td>{{ $data->bulan }}</td>
                                            <td>Rp. {{ number_format($data->total_tagihan, 0, ',', '.') }}</td>
                                            @if ($data->status_tagihan == 'Belum Dibayar')
                                                <td><span class="text-danger">{{ $data->status_tagihan }}</span></td>
                                            @elseif ($data->status_tagihan == 'Dalam Proses')
                                                <td><span class="text-warning">{{ $data->status_tagihan }}</span></td>
                                            @else
                                                <td><span class="text-success">{{ $data->status_tagihan }}</span></td>
                                            @endif
                                            <td>
                                                @if ($data->status_tagihan != 'Lunas')
                                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target="#bayar-tagihan-customer{{ $data->id }}">
                                                        Bayar Cash
                                                    </button>
                                                @endif
                                                <div class="modal fade" id="bayar-tagihan-customer{{ $data->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Pembayaran</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form class="form-horizontal"
                                                                action="{{ route('invoice.update', $data->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body text-start">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-4">
                                                                            <p class="fw-bold">Id Instalasi</p>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <p>: {{ $installation->id }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-4">
                                                                            <p class="fw-bold">Customer</p>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <p>: {{ $installation->user->name }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-4">
                                                                            <p class="fw-bold">Pembayaran Bulan</p>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <p>: {{ date('M', strToTime($carbon)) }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-4">
                                                                            <p class="fw-bold">Tagihan
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <p>: Rp.
                                                                                {{ number_format($installation->package->harga_paket, 0, ',', '.') }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="status_tagihan"
                                                                        value="Lunas" required>
                                                                </div>
                                                                <div class="modal-footer justify-content-end">
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-primary">Bayar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
    <div class="modal fade" id="tambah-tagihan-customer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="{{ route('invoice.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <p class="fw-bold">Id Instalasi</p>
                            </div>
                            <div class="col-sm-8">
                                <p>: {{ $installation->id }}</p>
                            </div>
                            <input type="hidden" name="installation_id" value="{{ $installation->id }}">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <p class="fw-bold">Customer</p>
                            </div>
                            <div class="col-sm-8">
                                <p>: {{ $installation->user->name }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <p class="fw-bold">Bulan</p>
                            </div>
                            <div class="col-sm-8">
                                <p>: {{ date('M', strToTime($carbon)) }}</p>
                            </div>
                            <input type="hidden" name="hari" value="{{ date('d', strToTime($carbon)) }}">
                            <input type="hidden" name="bulan" value="{{ date('m', strToTime($carbon)) }}">
                            <input type="hidden" name="tahun" value="{{ date('Y', strToTime($carbon)) }}">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <p class="fw-bold">Total Tagihan</p>
                            </div>
                            <div class="col-sm-8">
                                <p>: Rp. {{ number_format($installation->package->harga_paket, 0, ',', '.') }}</p>
                            </div>
                            <input type="hidden" name="total_tagihan"
                                value="{{ $installation->package->harga_paket }}">
                        </div>
                        <input type="hidden" name="status_tagihan" value="Belum Dibayar" required>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
