@extends('layouts.template')

@section('title', 'Tabel Tagihan')

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
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ url('/customer') }}"
                                class="text-decoration-none">Customer</a>
                        </li>
                        <li class="breadcrumb-item active">Tagihan</li>
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
                            <div class="card-tools">
                                <form action="" method="GET">
                                    <div class="input-group input-group-sm" style="width: 250px;">
                                        <select name="invoice_filter_month" class="form-control float-right">
                                            <option value="All" hidden>Bulan</option>
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
                                        <select name="invoice_filter_year" class="form-control float-right">
                                            <option value="All" hidden>Tahun</option>
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
                                        <input list="invoice_filter_status_list" name="invoice_filter_status"
                                            class="form-control float-right" placeholder="Status" title="Status Tagihan">
                                        <datalist id="invoice_filter_status_list">
                                            <option value="All">
                                            <option value="Lunas">
                                            <option value="Dalam Proses">
                                            <option value="Belum Dibayar">
                                        </datalist>
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
                                        <th>Id Instalasi</th>
                                        <th>Nama User</th>
                                        <th>Tagihan Untuk Bulan</th>
                                        <th>Tahun</th>
                                        <th>Total Tagihan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @if (count($datas) > 0)
                                    <tbody>
                                        @foreach ($datas as $index => $data)
                                            <tr class="text-center">
                                                <td>{{ $index + $datas->firstItem() }}</td>
                                                <td>{{ $data->installation_id }}</td>
                                                <td>{{ $data->installation->user->name }}</td>
                                                <td>
                                                    @if ($data->bulan == '01')
                                                        Januari
                                                    @elseif ($data->bulan == '02')
                                                        Februari
                                                    @elseif ($data->bulan == '03')
                                                        Maret
                                                    @elseif ($data->bulan == '04')
                                                        April
                                                    @elseif ($data->bulan == '05')
                                                        Mei
                                                    @elseif ($data->bulan == '06')
                                                        Juni
                                                    @elseif ($data->bulan == '07')
                                                        Juli
                                                    @elseif ($data->bulan == '08')
                                                        Agustus
                                                    @elseif ($data->bulan == '09')
                                                        September
                                                    @elseif ($data->bulan == '10')
                                                        Oktober
                                                    @elseif ($data->bulan == '11')
                                                        November
                                                    @elseif ($data->bulan == '12')
                                                        Desember
                                                    @endif
                                                </td>
                                                <td>{{ $data->tahun }}</td>
                                                <td>Rp. {{ number_format($data->total_tagihan, 0, ',', '.') }}</td>
                                                @if ($data->status_tagihan == 'Belum Dibayar')
                                                    <td><span class="fw-bold text-danger">{{ $data->status_tagihan }}</span>
                                                    </td>
                                                @elseif ($data->status_tagihan == 'Dalam Proses')
                                                    <td><span
                                                            class="fw-bold text-warning">{{ $data->status_tagihan }}</span>
                                                    </td>
                                                @else
                                                    <td><span
                                                            class="fw-bold text-success">{{ $data->status_tagihan }}</span>
                                                    </td>
                                                @endif
                                                <td>
                                                    @if ($data->status_tagihan != 'Lunas')
                                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                                            data-target="#bayar-tagihan-customer{{ $data->id }}"
                                                            title="Bayar Cash">
                                                            <i class="fa fa-money-bill"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                                            data-target="#whatsapp-customer{{ $data->id }}"
                                                            title="Whatsapp">
                                                            <i class="fa fa-phone"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
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
                                                                        <p>: {{ $data->installation_id }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-4">
                                                                        <p class="fw-bold">Customer</p>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <p>: {{ $data->installation->user->name }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-4">
                                                                        <p class="fw-bold">Pembayaran Bulan</p>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <p>: {{ date('m', strToTime($carbon)) }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-4">
                                                                        <p class="fw-bold">Tagihan
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <p>: Rp.
                                                                            {{ number_format($data->installation->package->harga_paket, 0, ',', '.') }}
                                                                        </p>
                                                                    </div>
                                                                    <input type="hidden" name="total_pendapatan"
                                                                        value="{{ $data->installation->package->harga_paket }}"
                                                                        required>
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
                                            <div class="modal fade" id="whatsapp-customer{{ $data->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('whatsapp.customer') }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <h4 class="modal-title">Ini akan mengarahkan ke Whatsapp
                                                                    <br>
                                                                    {{ $data->installation->user->name }}
                                                                </h4>
                                                                <input type="hidden" name="no_telepon"
                                                                    value="{{ $data->installation->user->no_telepon }}">
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
                                @endif
                            </table>
                            @if (count($datas) <= 0)
                                <div class="text-center">
                                    <div class="alert alert-warning" role="alert">
                                        Tidak ada data yang bisa ditampilkan!
                                        <br>
                                        Silahkan menambahkan tagihan di menu <a href="{{ url('/customer') }}"
                                            class="text-black">Customer</a>
                                    </div>
                                </div>
                            @endif
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

@endsection
