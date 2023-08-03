@extends('layouts.template')

@section('title', 'Tabel Customer')

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
                        <div class="mb-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#tambah-tagihan-customer">
                                <i class="fas fa-plus"></i> Tambah Tagihan Customer
                            </button>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-tools">
                                    <form action="" method="GET">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="customer_filter_name" class="form-control float-right"
                                                placeholder="Cari Id / Nama">
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
                                            <th>Id Customer</th>
                                            <th>Nama</th>
                                            <th>Jenis Paket</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $index => $data)
                                            <tr class="text-center">
                                                <td>{{ $index + $datas->firstItem() }}</td>
                                                <td>{{ $data->user->user_id }}</td>
                                                <td>
                                                    <a href="{{ url('customer/detail/' . $data->id) }}"
                                                        class="text-decoration-none">{{ $data->user->name }}</a>
                                                </td>
                                                <td>{{ $data->package->jenis_paket }}</td>
                                                <td>{{ $data->alamat_pemasangan }}</td>
                                                <td>
                                                    <a href="{{ url('/customer/invoice/' . $data->id) }}"
                                                        class="btn btn-success" title="Cek Tagihan"><i class="fa fa-receipt"></i></a>
                                                </td>
                                            </tr>
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
                <br>
                Note : Silahkan ke halaman <a href="{{ url('installation') }}"
                    class="text-black">instalasi</a> untuk menambahkan customer
            </div>
            <a href="{{ url('/customer') }}" class="btn btn-primary">Kembali</a>
        </div>
    @endif

    <div class="modal fade" id="tambah-tagihan-customer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Tagihan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="{{ route('invoice.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <p class="fw-bold">Tagihan Bulan</p>
                            </div>
                            <div class="col-sm-8">
                                <p>: {{ date('m', strToTime($carbon)) }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <p class="fw-bold">Tagihan Tahun</p>
                            </div>
                            <div class="col-sm-8">
                                <p>: {{ date('Y', strToTime($carbon)) }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <p class="fw-bold">Keterangan</p>
                            </div>
                            <div class="col-sm-8">
                                <p>: Tagihan ini untuk semua customer</p>
                            </div>
                        </div>
                        <input type="hidden" name="hari" value="{{ date('d', strToTime($carbon)) }}">
                        <input type="hidden" name="bulan" value="{{ date('m', strToTime($carbon)) }}">
                        <input type="hidden" name="tahun" value="{{ date('Y', strToTime($carbon)) }}">
                        <input type="hidden" name="status_tagihan" value="Belum Dibayar" required>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
