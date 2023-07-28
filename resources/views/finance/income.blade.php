@extends('layouts.template')

@section('title', 'Tabel Pendapatan')

@section('main')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pendapatan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active">Pendapatan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    @if (count($datas) > 0)
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info" role="alert">
                            <p>Note :</p>
                            <ul>
                                <li>
                                    <span>Pendapatan diambil dari Instalasi dan Tagihan customer</span>
                                </li>
                                <li>
                                    <span>Untuk melihat total pendapatan bulanan atau tahunan silahkan ke <a href="{{ url('/') }}" class=" text-black">Dashbor</a></span>
                                </li>
                            </ul>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-tools">
                                    <form action="{{ route('income.filter') }}" method="POST">
                                        @csrf
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <select name="month" class="form-control float-right">
                                                <option value="All">Bulan</option>
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
                                            <select name="year" class="form-control float-right">
                                                <option value="All">Tahun</option>
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
                                <table class="table table-hover text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pendapatan</th>
                                            <th>Hari</th>
                                            <th>Bulan</th>
                                            <th>Tahun</th>
                                            <th>Keterangan</th>
                                            <th class="text-start">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $index => $data)
                                            <tr>
                                                <td>{{ $index + $datas->firstItem() }}</td>
                                                <td>
                                                    <span class="text-success fw-bold">Rp.
                                                        {{ number_format($data->total_pendapatan, '0', ',', '.') }}
                                                        ++</span>
                                                </td>
                                                <td>{{ $data->hari }}</td>
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
                                                <td>{{ $data->keterangan }}</td>
                                                <td class="d-flex flex-wrap ">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#hapus-income{{ $data->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="hapus-income{{ $data->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-danger">
                                                        <form action="{{ route('income.destroy', $data->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-body">
                                                                <h4 class="modal-title">Yakin mau hapus?</h4>
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
            <a href="{{ url('income') }}" class="btn btn-primary">Kembali</a>
        </div>
    @endif

@endsection
