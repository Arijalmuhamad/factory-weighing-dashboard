@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data FFB</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="content-header">
        <!-- Infobox for Total Data and Total Tonase -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-database fa-3x text-primary mr-3"></i>
                    <div>
                        <h5 class="card-title text-dark mb-2">Total Data Transaksi FFB</h5>
                        <p class="card-text text-muted">Jumlah total data transaksi dan total tonase yang tercatat dalam
                            sistem.</p>
                    </div>
                </div>
                <div class="text-center">
                    <h3 class="font-weight-bold">{{ $query_current_ffb->total() }}</h3>
                    <p class="text-success">Data tersedia dalam <strong>{{ $query_current_ffb->lastPage() }}</strong>
                        halaman.</p>
                    <p class="text-dark font-weight-bold mt-2">Total Tonase Hari Ini: <span
                            class="text-primary">{{ number_format($total_tonase, 2) }} Ton</span></p>
                    <small class="text-muted mt-2">* Total tonase ini dihitung berdasarkan truck yang sudah melakukan
                        registrasi keluar (Reg-out).</small>
                </div>
            </div>
        </div>

        <!-- FFB CURRENT DATA -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">FFB (Fresh Fruit Bunch)</h3>

                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <!-- Previous Page Link -->
                        @if ($query_current_ffb->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">&laquo;</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $query_current_ffb->previousPageUrl() }}">&laquo;</a>
                            </li>
                        @endif

                        <!-- Page Number Links -->
                        @foreach ($query_current_ffb->getUrlRange(1, $query_current_ffb->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $query_current_ffb->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <!-- Next Page Link -->
                        @if ($query_current_ffb->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $query_current_ffb->nextPageUrl() }}">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-disabled="true">&raquo;</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>WB Ticket</th>
                            <th>Supir</th>
                            <th>Plat No</th>
                            <th>Supplier</th>
                            <th>Janjang</th>
                            <th>WB In</th>
                            <th>WB Out</th>
                            <th>Netto AG</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($query_current_ffb as $index => $data)
                            <tr>
                                <td>{{ $index + 1 + ($query_current_ffb->currentPage() - 1) * 5 }}.</td>
                                <!-- Perhitungan nomor urut -->
                                <td>{{ $data->wbsid }}</td>
                                <td>{{ $data->driver }}</td>
                                <td>{{ $data->vehicleno }}</td>
                                <td>{{ $data->supplier }}</td>
                                <td>{{ $data->janjang }}</td>
                                <td>{{ $data->wbin }}</td>
                                <td>{{ $data->wbout }}</td>
                                <td>{{ $data->netto_ag }}</td>
                                <td>
                                    @if ($data->regis_in == 'T' && $data->weighing_in == 'T' && $data->weighing_out == 'T' && $data->regis_out == 'T')
                                        <span class="badge bg-success">Reg-out</span>
                                    @elseif ($data->regis_in == 'T' && $data->weighing_in == 'T' && $data->weighing_out == 'T')
                                        <span class="badge bg-warning">Weig-out</span>
                                    @elseif ($data->regis_in == 'T' && $data->weighing_in == 'T')
                                        <span class="badge bg-danger">Weig-in</span>
                                    @elseif ($data->regis_in == 'T')
                                        <span class="badge bg-info">Reg-in</span>
                                    @else
                                        @if ($data->regis_in == 'T')
                                            <span class="badge bg-info">Reg-in</span>
                                        @elseif ($data->weighing_in == 'T')
                                            <span class="badge bg-danger">Weig-in</span>
                                        @elseif ($data->weighing_out == 'T')
                                            <span class="badge bg-warning">Weig-out</span>
                                        @elseif ($data->regis_out == 'T')
                                            <span class="badge bg-success">Reg-out</span>
                                        @else
                                            <span class="badge bg-secondary">No Status</span>
                                            <!-- Default jika tidak ada status -->
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
