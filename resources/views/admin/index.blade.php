@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-end">

                <div class="col-12 col-sm-6 d-flex flex-column">
                    <h1 class="m-0 text-dark d-flex align-items-center" style="font-size: 1.4rem;">
                        <i class="fas fa-tachometer-alt fa-lg mr-3 text-info"></i>
                        <span class="font-weight-bold">DASHBOARD MONITORING</span>
                    </h1>

                    <p class="text-muted mt-1 mb-0 ml-5 d-block d-sm-none" style="font-size: 0.85rem;">
                        <i class="far fa-calendar-alt mr-1 text-secondary"></i> Data Hari Ini:
                        <strong class="text-dark">{{ date('d M Y') }}</strong>
                    </p>

                    <p class="text-muted mt-1 mb-0 ml-5 d-none d-sm-block" style="font-size: 0.9rem;">
                        <i class="far fa-calendar-alt mr-1 text-secondary"></i> Data Hari Ini:
                        <strong class="text-dark">{{ date('l, d F Y') }}</strong>
                    </p>
                </div>
                <div class="col-12 col-sm-6 text-left text-sm-right pt-2 pt-sm-0">
                    <p class="text-secondary mb-0" style="font-size: 0.8rem; font-weight: 500;">
                        LOKASI PABRIK:
                    </p>

                    <div class="d-flex flex-column align-items-sm-end">

                        <p class="mb-1 text-dark font-weight-bold" style="font-size: 1rem;">
                            <i class="fas fa-building mr-2 text-secondary"></i>
                            {{ $siteInfo->company_name ?? '-' }}
                        </p>

                        <p class="mb-0 text-dark" style="font-size: 0.95rem; font-weight: 500;">
                            <i class="fas fa-map-marker-alt mr-2 text-secondary"></i>
                            {{ $siteInfo->sitename ?? '-' }}
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <hr class="mt-2 mb-4" style="border-top: 1px solid #e0e0e0;">
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Small boxes (Stat box) -->
            <div class="row">

                <!-- Small box 1 -->
                <!-- Small box 1 -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 id="regist_masuk">0</h3>
                            <p>Registrations in</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->

                <!-- Small box 2 -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 id="timbang_masuk">0</h3>
                            <p>Weighed in</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->

                <!-- Small box 3 -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 id="timbang_keluar">0</h3>
                            <p>Weighed out</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-truck"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->

                <!-- Small box 4 -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="regist_keluar">0</h3>
                            <p>Registrations out</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->

                <!-- ./col -->
            </div>


            <div class="card bg-light mb-4">
                <div class="card-body">
                    <h5 class="card-title text-dark">
                        <i></i> <strong>Total Truck dan Tonase</strong>
                    </h5>
                </div>
            </div>


            <div class="row">
                <!-- Info box: FFB -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex flex-column align-items-center text-center">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-seedling fa-2x text-primary mr-2"></i>
                                <div>
                                    <h5 class="card-title text-dark mb-0">
                                        <a href="{{ route('admin.data-ffb') }}" class="text-dark"
                                            style="text-decoration: none;">FFB</a>
                                    </h5>
                                    <p class="card-text text-muted" style="font-size: 0.875rem;">Truck FFB</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between w-100">
                                <div class="px-3 py-2 rounded">
                                    <h3 class="font-weight-bold" id="total_truck_ffb"
                                        style="font-size: 1.25rem; color: #6c757d;">0</h3>
                                    <small class="text-muted" style="font-size: 0.75rem;">Truck</small>
                                </div>
                                <div class="px-3 py-2 rounded">
                                    <h3 class="font-weight-bold" id="total_tonase_ffb"
                                        style="font-size: 1.25rem; color: #6c757d;">0 Ton</h3>
                                    <small class="text-muted" style="font-size: 0.75rem;">Tonase (kg)</small>
                                </div>
                            </div>
                            <!-- Menambahkan link "More info" dengan perubahan yang diminta -->
                            <a href="{{ route('admin.data-ffb') }}" class="small-box-footer mt-2"
                                style="text-decoration: none; color: #007bff; padding: 6px 10px; border-radius: 8px; font-size: 0.75rem; margin-top: 8px;">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>


                <!-- Info box: Sales -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex flex-column align-items-center text-center">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-truck fa-2x text-danger mr-2"></i>
                                <div>
                                    <h5 class="card-title text-dark mb-0">
                                        <a href="{{ route('admin.data-sales') }}" class="text-dark"
                                            style="text-decoration: none;">Sales</a>
                                    </h5>
                                    <p class="card-text text-muted" style="font-size: 0.875rem;">Penjualan (kg)</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between w-100">
                                <div class="px-3 py-2 rounded">
                                    <h3 class="font-weight-bold" id="total_truck_penjualan"
                                        style="font-size: 1.25rem; color: #6c757d;">0 Kg</h3>
                                    <small class="text-muted" style="font-size: 0.75rem;">Truck</small>
                                </div>
                                <div class="px-3 py-2 rounded">
                                    <h3 class="font-weight-bold" id="total_tonase_sales"
                                        style="font-size: 1.25rem; color: #6c757d;">0 Kg</h3>
                                    <small class="text-muted" style="font-size: 0.75rem;">Tonase (kg)</small>
                                </div>
                            </div>
                            <!-- Menambahkan link "More info" -->
                            <a href="{{ route('admin.data-sales') }}" class="small-box-footer mt-2"
                                style="text-decoration: none; color: #007bff; padding: 6px 10px; border-radius: 8px; font-size: 0.75rem; margin-top: 8px;">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Info box: Lain-lain -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex flex-column align-items-center text-center">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-cogs fa-2x text-success mr-2"></i>
                                <div>
                                    <h5 class="card-title text-dark mb-0">
                                        <a href="{{ route('admin.data-others') }}" class="text-dark"
                                            style="text-decoration: none;">Lain-lain</a>
                                    </h5>
                                    <p class="card-text text-muted" style="font-size: 0.875rem;">Data lain-lain</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between w-100">
                                <div class="px-3 py-2 rounded">
                                    <h3 class="font-weight-bold" id="total_truck_lain_lain"
                                        style="font-size: 1.25rem; color: #6c757d;">0 Kg</h3>
                                    <small class="text-muted" style="font-size: 0.75rem;">Truck</small>
                                </div>
                                <div class="px-3 py-2 rounded">
                                    <h3 class="font-weight-bold" id="total_tonase_lain_lain"
                                        style="font-size: 1.25rem; color: #6c757d;">0 Kg</h3>
                                    <small class="text-muted" style="font-size: 0.75rem;">Tonase (kg)</small>
                                </div>
                            </div>
                            <!-- Menambahkan link "More info" -->
                            <a href="{{ route('admin.data-others') }}" class="small-box-footer mt-2"
                                style="text-decoration: none; color: #007bff; padding: 6px 10px; border-radius: 8px; font-size: 0.75rem; margin-top: 8px;">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Info box: Transfer -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex flex-column align-items-center text-center">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-exchange-alt fa-2x text-warning mr-2"></i>
                                <div>
                                    <h5 class="card-title text-dark mb-0">
                                        <a href="https://your-transfer-link.com" class="text-dark"
                                            style="text-decoration: none;">Transfer</a>
                                    </h5>
                                    <p class="card-text text-muted" style="font-size: 0.875rem;">Transfer kirim / terima
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between w-100">
                                <div class="px-3 py-2 rounded">
                                    <h3 class="font-weight-bold" id="total_truck_transfer"
                                        style="font-size: 1.25rem; color: #6c757d;">0 Kg</h3>
                                    <small class="text-muted" style="font-size: 0.75rem;">Truck</small>
                                </div>
                                <div class="px-3 py-2 rounded">
                                    <h3 class="font-weight-bold" id="total_tonase_transfer"
                                        style="font-size: 1.25rem; color: #6c757d;">0 Kg</h3>
                                    <small class="text-muted" style="font-size: 0.75rem;">Tonase (kg)</small>
                                </div>
                            </div>
                            <!-- Menambahkan link "More info" -->
                            <a href="{{ route('admin.data-transfer') }}" class="small-box-footer mt-2"
                                style="text-decoration: none; color: #007bff; padding: 6px 10px; border-radius: 8px; font-size: 0.75rem; margin-top: 8px;">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>




                <!-- Info box: Note -->
                <div class="col-12">
                    <div class="card shadow-sm border-secondary">
                        <div class="card-body text-center">
                            <small><strong>Note:</strong> Tonase dihitung berdasarkan truck yang sudah melakukan registrasi
                                keluar (Reg-out).</small>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Data Ritasi FFB -->
            <!-- Data Timbang Sales -->
        </div>
    </section>

    <script>
        // 1. FUNGSI UNTUK FORMAT ANGKA (Digunakan untuk semua data: Registrasi, Truk, dan Tonase)
        // Contoh: 20000.56 -> 20.001 (dibulatkan) atau 20000 -> 20.000
        function formatNumber(number) {
            if (number === undefined || number === null || isNaN(number)) return '0';

            // Mengubah string ke float (jika diperlukan) lalu memformat.
            // Intl.NumberFormat secara otomatis akan melakukan pembulatan ke bilangan bulat terdekat.
            return new Intl.NumberFormat('id-ID', {
                maximumFractionDigits: 0, // Memastikan tidak ada angka di belakang koma
                minimumFractionDigits: 0
            }).format(parseFloat(number));
        }

        // Fungsi untuk mengambil data dari server
        function fetchDashboardData() {
            fetch('http://172.16.73.11:46/wb/dashboard/public/api/dashboard-data')
                .then(response => response.json())
                .then(data => {
                    // --- UPDATE DATA ANGKA BIASA (Registrasi & Truk) ---
                    document.getElementById('regist_masuk').textContent = formatNumber(data.summaryData.regist_masuk);
                    document.getElementById('timbang_masuk').textContent = formatNumber(data.summaryData.timbang_masuk);
                    document.getElementById('timbang_keluar').textContent = formatNumber(data.summaryData
                        .timbang_keluar);
                    document.getElementById('regist_keluar').textContent = formatNumber(data.summaryData.regist_keluar);

                    document.getElementById('total_truck_ffb').textContent = formatNumber(data.truckData
                        .total_truck_ffb);
                    document.getElementById('total_truck_penjualan').textContent = formatNumber(data.truckData
                        .total_truck_penjualan);
                    document.getElementById('total_truck_lain_lain').textContent = formatNumber(data.truckData
                        .total_truck_lain_lain);
                    document.getElementById('total_truck_transfer').textContent = formatNumber(data.truckData
                        .total_truck_transfer);

                    // --- UPDATE DATA TONASE (Menggunakan formatNumber untuk menghilangkan desimal) ---

                    // Update Total Tonase FFB Hari Ini
                    document.getElementById('total_tonase_ffb').textContent = formatNumber(data.totalTonaseFFB);

                    // Update Total Tonase Sales
                    document.getElementById('total_tonase_sales').textContent = formatNumber(data.totalTonaseSales);

                    // Update Total Tonase Lain-Lain
                    document.getElementById('total_tonase_lain_lain').textContent = formatNumber(data
                        .totalTonaseLainLain);

                    // Update Total Tonase Transfer
                    document.getElementById('total_tonase_transfer').textContent = formatNumber(data
                        .totalTonaseTransfer);
                })
                .catch(error => console.error('Error fetching dashboard data:', error));
        }

        // Lakukan polling setiap 5 detik
        setInterval(fetchDashboardData, 5000);

        // Panggil fetchDashboardData sekali saat halaman pertama kali dimuat
        document.addEventListener('DOMContentLoaded', fetchDashboardData);
    </script>
@endsection
