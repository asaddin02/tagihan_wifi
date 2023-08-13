@extends('layouts.template')

@section('title', 'User Profile')

@section('main')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Customer Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/customer') }}"
                                class="text-decoration-none">Customer</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('template/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">
                                {{ Str::title(Str::limit($installation->user->name, 20, '.')) }}
                            </h3>
                            <p class="text-muted text-center">User Id {{ $installation->user->user_id }}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Role</b> <a
                                        class="float-right text-decoration-none">{{ $installation->user->role }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a
                                        class="float-right text-decoration-none">{{ $installation->user->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>No HP</b> <a
                                        class="float-right text-decoration-none">{{ $installation->user->no_telepon }}</a>
                                </li>
                            </ul>
                            @if (Auth::user()->role == 'Customer Service')
                                <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                                    data-target="#hapus-customer{{ $installation->id }}" title="Hapus">
                                    <i class="fas fa-trash"></i> <span>Hapus Customer</span>
                                </button>
                                <div class="modal fade" id="hapus-customer{{ $installation->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                            <form action="{{ route('hapus.customer', $installation->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <h4 class="modal-title">Yakin mau hapus
                                                        customer ?</h4>
                                                    <input type="hidden" name="user_id"
                                                        value="{{ $installation->user_id }}" required>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-light"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-light">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Paket</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Tunggakan</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Jenis Paket</b> <a
                                                class="float-right text-decoration-none">{{ $installation->package->jenis_paket }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Teknisi Yang Memasang</b> <a
                                                class="float-right text-decoration-none">{{ $installation->technisian->nama_teknisi }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Tanggal Pemasangan</b> <a
                                                class="float-right text-decoration-none">{{ date('d M Y', strToTime($installation->tanggal_pemasangan)) }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="activity">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Bulan</th>
                                                <th>Tahun</th>
                                                <th>Total Tagihan</th>
                                                <th>Status Tagihan</th>
                                            </tr>
                                        </thead>
                                        @if (count($invoices) > 0)
                                            <tbody>
                                                @foreach ($invoices as $index => $invoice)
                                                    <tr class="text-center">
                                                        <td>{{ $index + $invoices->firstItem() }}</td>
                                                        <td>{{ $invoice->bulan }}</td>
                                                        <td>{{ $invoice->tahun }}</td>
                                                        <td>Rp. {{ number_format($invoice->total_tagihan, 0, ',', '.') }}
                                                        </td>
                                                        <td><span class="text-danger">{{ $invoice->status_tagihan }}</span>
                                                        </td>
                                                    </tr>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
