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
        </div>
    </section>

    <div class="content-header">
        <div class="card mb-4 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-database fa-3x text-primary mr-3"></i>
                    <div>
                        <h5 class="card-title text-dark mb-2">Total Data Transaksi FFB</h5>
                        <p class="card-text text-muted">
                            Jumlah total data transaksi dan total tonase dalam sistem.
                        </p>
                    </div>
                </div>

                <div class="text-center">
                    <h3 class="font-weight-bold">{{ $query_current_ffb->total() }}</h3>
                    <p class="text-success">
                        Data tersedia dalam <strong>{{ $query_current_ffb->lastPage() }}</strong> halaman.
                    </p>
                    <p class="text-dark font-weight-bold mt-2">
                        Total Tonase Hari Ini:
                        <span class="text-primary">{{ number_format($total_tonase, 2) }} Ton</span>
                    </p>
                    <small class="text-muted">* Tonase dihitung dari data yang sudah Reg-out</small>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="card-title mt-2">FFB (Fresh Fruit Bunch)</h3>

                    <div class="row align-items-center">

                        <div class="col-md-auto">
                            <form method="GET" action="" class="form-inline">
                                <label for="status-select" class="mr-2 font-weight-bold">Status:</label>
                                <select name="status" id="status-select" class="form-control form-control-sm"
                                    onchange="this.form.submit()">
                                    <option value="">-- Semua --</option>
                                    <option value="regin" {{ request('status') == 'regin' ? 'selected' : '' }}>Reg-in
                                    </option>
                                    <option value="weighin" {{ request('status') == 'weighin' ? 'selected' : '' }}>Weigh-in
                                    </option>
                                    <option value="weighout" {{ request('status') == 'weighout' ? 'selected' : '' }}>
                                        Weigh-out</option>
                                    <option value="regout" {{ request('status') == 'regout' ? 'selected' : '' }}>Reg-out
                                    </option>
                                    <option value="nostatus" {{ request('status') == 'nostatus' ? 'selected' : '' }}>Tanpa
                                        Status</option>
                                </select>
                            </form>
                        </div>

                        <div class="col-md-auto ml-3">
                            <span class="badge badge-primary p-2" style="font-size: 14px;">
                                Total Data: <strong>{{ $query_current_ffb->total() }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card-tools d-flex justify-content-end">
                    {{ $query_current_ffb->links('pagination::bootstrap-4') }}
                </div>
            </div>

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
                                <td>{{ $index + 1 + ($query_current_ffb->currentPage() - 1) * $query_current_ffb->perPage() }}.
                                </td>
                                <td>{{ $data->wbsid }}</td>
                                <td>{{ $data->driver }}</td>
                                <td>{{ $data->vehicleno }}</td>
                                <td>{{ $data->estate_or_bp_name }}</td>
                                <td>{{ $data->janjang }}</td>
                                <td>{{ $data->wbin }}</td>
                                <td>{{ $data->wbout }}</td>
                                <td>{{ $data->netto_ag }}</td>

                                <td>
                                    @if ($data->regis_in == 'T' && $data->weighing_in == 'T' && $data->weighing_out == 'T' && $data->regis_out == 'T')
                                        <span class="badge bg-success">Reg-out</span>
                                    @elseif ($data->regis_in == 'T' && $data->weighing_in == 'T' && $data->weighing_out == 'T')
                                        <span class="badge bg-warning">Weigh-out</span>
                                    @elseif ($data->regis_in == 'T' && $data->weighing_in == 'T')
                                        <span class="badge bg-danger">Weigh-in</span>
                                    @elseif ($data->regis_in == 'T')
                                        <span class="badge bg-info">Reg-in</span>
                                    @else
                                        <span class="badge bg-secondary">No Status</span>
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
