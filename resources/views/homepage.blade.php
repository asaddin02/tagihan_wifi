@extends('layouts.template')

@section('title', 'Homepage')

@section('main')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dasbor</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ count($customers) }}</h3>
                            <p>Pelanggan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ url('/customer') }}" class="small-box-footer">Cek Pelanggan <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                @if (Auth::user()->role == 'Admin')
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ number_format($incomePerMonth, 0, ',', '.') }}</h3>
                                <p>Pendapatan Bulan Ini</p>
                                <div class="collapse" id="cek-pendapatan-per-tahun">
                                    <h3>{{ number_format($incomePerYear, 0, ',', '.') }}</h3>
                                    <p>Pendapatan Tahun Ini</p>
                                    <a href="{{ url('/income') }}" class="text-white text-decoration-none">Cek Tabel
                                        Pendapatan
                                        <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a class="small-box-footer" data-bs-toggle="collapse" href="#cek-pendapatan-per-tahun"
                                role="button" aria-expanded="false" aria-controls="collapseExample">
                                Cek Pendapatan <i class="fas fa-arrow-circle-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ number_format($spendingPerMonth, 0, ',', '.') }}</h3>
                                <p>Pengeluaran Bulan Ini</p>
                                <div class="collapse" id="cek-pengeluaran-per-tahun">
                                    <h3>{{ number_format($spendingPerYear, 0, ',', '.') }}</h3>
                                    <p>Pengeluaran Tahun Ini</p>
                                    <a href="{{ url('/spending') }}" class="text-white text-decoration-none">Cek Tabel
                                        Pengeluaran <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a class="small-box-footer" data-bs-toggle="collapse" href="#cek-pengeluaran-per-tahun"
                                role="button" aria-expanded="false" aria-controls="collapseExample">
                                Cek Pengeluaran <i class="fas fa-arrow-circle-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    @if ($loss < 0)
                                        <span class="text-white">{{ number_format(ltrim($loss, '-'), 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-white">0</span>
                                    @endif
                                </h3>
                                <p class="text-white">Kerugian</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ url('/spending') }}" class="small-box-footer"><span class="text-white">Cek
                                    Pengeluaran</span> <i class="fas fa-arrow-circle-right text-white"></i></a>
                        </div>
                    </div>
                @endif
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-6 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    @if (Auth::user()->role == 'Customer Service')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Customer yang belum membayar bulan ini
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id Instalasi</th>
                                            <th>Nama User</th>
                                            <th>Total Tagihan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    @if (count($invoices) > 0)
                                        <tbody>
                                            @foreach ($invoices as $index => $data)
                                                <tr class="text-center">
                                                    <td>{{ $index + $invoices->firstItem() }}</td>
                                                    <td>{{ $data->installation_id }}</td>
                                                    <td>{{ $data->installation->user->name }}</td>
                                                    <td>Rp. {{ number_format($data->total_tagihan, 0, ',', '.') }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                                            data-target="#whatsapp-customer{{ $data->id }}"
                                                            title="Whatsapp">
                                                            <i class="fa fa-phone"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="whatsapp-customer{{ $data->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="{{ route('whatsapp.customer') }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <h4 class="modal-title">Ini akan mengarahkan ke
                                                                        Whatsapp
                                                                        <br>
                                                                        {{ $data->installation->user->name }}
                                                                    </h4>
                                                                    <input type="hidden" name="no_telepon"
                                                                        value="{{ $data->installation->user->no_telepon }}">
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal">Batal</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Ya</button>
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
                                <div class="m-2">
                                    @if (count($invoices) <= 0)
                                        <div class="text-center">
                                            <div class="alert alert-warning" role="alert">
                                                Tidak ada data yang bisa ditampilkan!
                                                <br>
                                                Silahkan menambahkan tagihan di menu <a href="{{ url('/customer') }}"
                                                    class="text-black">Customer</a>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($invoices->firstItem() != $invoices->lastItem())
                                        <p>Menampilkan {{ $invoices->firstItem() }} sampai {{ $invoices->lastItem() }}
                                            dari
                                            {{ $invoices->total() }} data</p>
                                    @endif

                                    @if ($invoices->total() > 10)
                                        <nav aria-label="...">
                                            <ul class="pagination">
                                                @if ($invoices->onFirstPage())
                                                    <li class="page-item disabled">
                                                        <a class="page-link">Previous</a>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link"
                                                            href="{{ $invoices->previousPageUrl() }}">Previous</a>
                                                    </li>
                                                @endif

                                                @foreach ($invoices->getUrlRange(1, $invoices->lastPage()) as $page => $url)
                                                    @if ($page == $invoices->currentPage())
                                                        <li class="page-item active" aria-current="page">
                                                            <a class="page-link">{{ $page }}</a>
                                                        </li>
                                                    @else
                                                        <li class="page-item">
                                                            <a class="page-link"
                                                                href="{{ $url }}">{{ $page }}</a>
                                                        </li>
                                                    @endif
                                                @endforeach

                                                @if ($invoices->hasMorePages())
                                                    <li class="page-item">
                                                        <a class="page-link"
                                                            href="{{ $invoices->nextPageUrl() }}">Next</a>
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
                            </div><!-- /.card-body -->
                        </div>
                    @endif
                    @if (Auth::user()->role == 'Admin')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Kecepatan internet
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <div class="chart tab-pane active" id="revenue-chart"
                                        style="position: relative; height: 300px;">
                                        <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                    @endif
                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-6 connectedSortable">
                    @if (Auth::user()->role == 'Admin')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Kecepatan internet
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <!-- Morris chart - Sales -->
                                <div class="chart tab-pane active" id="revenue-chart"
                                    style="position: relative; height: 300px;">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    @endif
                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
