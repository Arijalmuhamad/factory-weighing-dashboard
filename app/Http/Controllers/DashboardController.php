<?php

namespace App\Http\Controllers;

use App\Models\DataTbs;
use App\Models\Sales;
use App\Models\Transfer;
use App\Models\LainLain;
use App\Models\SiteInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Method untuk menampilkan dashboard dengan data ringkasan
     */
    public function index()
    {
        // Ambil data ringkasan
        $summaryData = $this->getSummaryData();

        // Ambil data truck
        $truckData = $this->getTruckData();

        // Ambil data ritasi FFB
        $ritasiFFBData = $this->getRitasiFFBData();

        // Ambil total tonase FFB
        $totalTonaseFFB = $this->getTotalTonaseFFB();

        // Ambil total tonase Sales
        $totalTonaseSales = $this->getTotalTonaseSales();

        // Ambil total tonase Lain-Lain
        $totalTonaseLainLain = $this->getTotalTonaseLainLain();

        // Ambil total tonase Transfer
        $totalTonaseTransfer = $this->getTotalTonaseTransfer();

        // Ambil site name
        // $siteName = $this->getSiteName();

        $siteInfo = $this->getSiteInfo();

        // Kirimkan data ke view
        return view('admin.index', compact('summaryData', 'truckData', 'ritasiFFBData', 'totalTonaseFFB', 'totalTonaseSales', 'totalTonaseLainLain', 'totalTonaseTransfer', 'siteInfo'));
    }

    /**
     * Mengambil data ringkasan untuk dashboard
     */
	 private function getSummaryData()
    {
        // Cek apakah sekarang sudah lewat jam 07:00
        $today = Carbon::now()->hour >= 7 ? Carbon::today() : Carbon::yesterday();

        return [
            'regist_masuk' => DataTbs::where('regis_in', 'T')->whereDate('dateout', $today)->count() +
                Sales::where('regis_in', 'T')->whereDate('dateout', $today)->count() +
                Transfer::where('regis_in', 'T')->whereDate('dateout', $today)->count() +
                LainLain::where('regis_in', 'T')->whereDate('dateout', $today)->count(),

            'timbang_masuk' => DataTbs::where('weighing_in', 'T')->whereDate('dateout', $today)->count() +
                Sales::where('weighing_in', 'T')->whereDate('dateout', $today)->count() +
                Transfer::where('weighing_in', 'T')->whereDate('dateout', $today)->count() +
                LainLain::where('weighing_in', 'T')->whereDate('dateout', $today)->count(),

            'timbang_keluar' => DataTbs::where('weighing_out', 'T')->whereDate('dateout', $today)->count() +
                Sales::where('weighing_out', 'T')->whereDate('dateout', $today)->count() +
                Transfer::where('weighing_out', 'T')->whereDate('dateout', $today)->count() +
                LainLain::where('weighing_out', 'T')->whereDate('dateout', $today)->count(),

            'regist_keluar' => DataTbs::where('regis_out', 'T')->whereDate('dateout', $today)->count() +
                Sales::where('regis_out', 'T')->whereDate('dateout', $today)->count() +
                Transfer::where('regis_out', 'T')->whereDate('dateout', $today)->count() +
                LainLain::where('regis_out', 'T')->whereDate('dateout', $today)->count(),
        ];
    }



    /**
     * Mengambil data truck untuk dashboard
     */
    private function getTruckData()
    {
        // Cek apakah sekarang sudah lewat jam 07:00
        $today = Carbon::now()->hour >= 7 ? Carbon::today() : Carbon::yesterday();

        return [
            'total_truck_ffb' => DataTbs::where('weighing_out', 'T')
                ->where('wbout', '<>', 0)
                ->where('regis_out', 'T')
                ->whereDate('dateout', $today)
                ->count(),

            'total_truck_penjualan' => Sales::where('weighing_out', 'T')
                ->where('wbout', '<>', 0)
                ->where('regis_out', 'T')
                ->whereDate('dateout', $today)
                ->count(),

            'total_truck_lain_lain' => LainLain::where('weighing_out', 'T')
                ->where('wbout', '<>', 0)
                ->where('regis_out', 'T')
                ->whereDate('dateout', $today)
                ->count(),

            'total_truck_transfer' => Transfer::where('weighing_out', 'T')
                ->where('wbout', '<>', 0)
                ->where('regis_out', 'T')
                ->whereDate('dateout', $today)
                ->count()
        ];
    }

    /**
     * Mengambil data ritasi FFB
     */
    private function getRitasiFFBData()
    {
        return DataTbs::selectRaw('
                supplier,
                CONCAT(COALESCE(b.BP_NAME, ""), " ", COALESCE(c.ESTNAME, "")) AS nama_supplier,
                SUM(wb_automation_datatbs_tab.netto_ag) AS total_netto,
                COUNT(wb_automation_datatbs_tab.wbsid) AS total_rit
            ')
            ->leftJoin('bridge_bp as b', 'wb_automation_datatbs_tab.supplier', '=', 'b.BP_CODE')
            ->leftJoin('bridge_businessunit as c', 'wb_automation_datatbs_tab.estate', '=', 'c.PLANT')
            ->groupBy('supplier', 'b.BP_NAME', 'c.ESTNAME')
            ->get();
    }

    /**
     * Fungsi untuk menghitung total tonase FFB
     */
    private function getTotalTonaseFFB()
    {
        $today = Carbon::now()->hour >= 7 ? Carbon::today() : Carbon::yesterday();

        return DataTbs::where('weighing_out', 'T')
                ->where('wbout', '<>', 0)
                ->where('regis_out', 'T')
                ->whereDate('dateout', $today)
                ->sum('netto_ag');  // Menghitung total netto untuk FFB
    }

    /**
     * Fungsi untuk menghitung total tonase untuk Sales
     */
    private function getTotalTonaseSales()
    {
        $today = Carbon::now()->hour >= 7 ? Carbon::today() : Carbon::yesterday();

        return Sales::where('weighing_out', 'T')
                ->where('wbout', '<>', 0)
                ->where('regis_out', 'T')
                ->whereDate('dateout', $today)
                ->sum('netto');  // Menghitung total netto
    }

    /**
     * Fungsi untuk menghitung total tonase untuk Lain-Lain
     */
    private function getTotalTonaseLainLain()
    {
        $today = Carbon::now()->hour >= 7 ? Carbon::today() : Carbon::yesterday();

        return LainLain::where('weighing_out', 'T')
                ->where('wbout', '<>', 0)
                ->where('regis_out', 'T')
                ->whereDate('dateout', $today)
                ->sum('netto');  // Menghitung total netto untuk Lain-Lain
    }

    /**
     * Fungsi untuk menghitung total tonase untuk Transfer
     */
    private function getTotalTonaseTransfer()
    {
        $today = Carbon::now()->hour >= 7 ? Carbon::today() : Carbon::yesterday();

        return Transfer::where('weighing_out', 'T')
                ->where('wbout', '<>', 0)
                ->where('regis_out', 'T')
                ->whereDate('dateout', $today)
                ->sum('netto');  // Menghitung total netto untuk Transfer
    }

    /**
     * Method untuk mengambil data terbaru dalam format JSON
     */
    public function getDashboardData()
    {
        try {
            // Ambil data ringkasan
            $summaryData = $this->getSummaryData();

            // Ambil data truck
            $truckData = $this->getTruckData();

            // Ambil data ritasi FFB
            $ritasiFFBData = $this->getRitasiFFBData();

            // Hitung total tonase untuk FFB, Sales, Lain-Lain, Transfer
            $totalTonaseFFB = $this->getTotalTonaseFFB();
            $totalTonaseSales = $this->getTotalTonaseSales();
            $totalTonaseLainLain = $this->getTotalTonaseLainLain();
            $totalTonaseTransfer = $this->getTotalTonaseTransfer();

            return response()->json([
                'summaryData' => $summaryData,
                'truckData' => $truckData,
                'ritasiFFBData' => $ritasiFFBData,
                'totalTonaseFFB' => $totalTonaseFFB,
                'totalTonaseSales' => $totalTonaseSales,
                'totalTonaseLainLain' => $totalTonaseLainLain,
                'totalTonaseTransfer' => $totalTonaseTransfer
            ]);
        } catch (\Exception $e) {
            // Menangani error jika terjadi masalah dalam pengambilan data
            Log::error('Error fetching dashboard data: ' . $e->getMessage());
            return response()->json(['error' => 'Data gagal diambil', 'message' => $e->getMessage()], 500);
        }
    }

       /**
     * Fungsi untuk mengambil informasi nama pabrik
     */
    // private function getSiteName()
    // {
    //     return SiteInfo::value('company_name','sitename');
    // }

    private function getSiteInfo()
    {
        return SiteInfo::select('company_name', 'sitename')->first();
    }
}
