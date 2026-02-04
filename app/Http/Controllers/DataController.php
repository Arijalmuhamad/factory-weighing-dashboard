<?php

// DataController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Carbon\Carbon; // Pastikan Carbon di-import

class DataController extends Controller
{

    // current data FFB

    public function getDataFFB(Request $request): View
    {
        // Mengambil parameter filet status
        $status = $request->input('status');

        // Query utama transaksi FFB
        $query = DB::table('wb_automation_datatbs_tab as a')
            ->leftJoin('bridge_bp as b', 'a.supplier', '=', 'b.BP_CODE')
            ->leftJoin('bridge_businessunit as c', 'a.estate', '=', 'c.PLANT')
            ->select(
                'a.wbsid',
                'a.driver',
                'a.vehicleno',
                DB::raw("
                    CASE
                        WHEN a.estate = 'LUAR' THEN b.BP_NAME
                        ELSE c.ESTNAME
                    END AS estate_or_bp_name
                "),
                'a.janjang',
                'a.total_brondolan',
                'a.wbin',
                'a.wbout',
                'a.netto_ag',
                'a.regis_in',
                'a.weighing_in',
                'a.weighing_out',
                'a.regis_out'
            )
            ->whereRaw("
                DATE(a.dateout) =
                CASE
                    WHEN HOUR(NOW()) >= 7 THEN DATE(NOW())
                    ELSE DATE(NOW() - INTERVAL 1 DAY)
                END
            ");

        // Filter berdasarkan status
        if ($status === 'regin') {
            $query->where('a.regis_in', 'T')
                ->where('a.weighing_in', 'F')
                ->where('a.weighing_out', 'F')
                ->where('a.regis_out', 'F');
        } elseif ($status === 'weighin') {
            $query->where('a.weighing_in', 'T')
                ->where('a.weighing_out', 'F');
        } elseif ($status === 'weighout') {
            $query->where('a.weighing_out', 'T')
                ->where('a.regis_out', 'F');
        } elseif ($status === 'regout') {
            $query->where('a.regis_out', 'T');
        } elseif ($status === 'nostatus') {
            $query->where('a.regis_in', 'F')
                ->where('a.weighing_in', 'F')
                ->where('a.weighing_out', 'F')
                ->where('a.regis_out', 'F');
        }

        // Pagination dengan query string supaya filter tetap saat pindah halaman
        $query_current_ffb = $query->paginate(5)->appends($request->query());

        // Mendapatkan total tonase berdasarkan tanggal yang sama
        $total_tonase = DB::table('wb_automation_datatbs_tab')
            ->whereRaw('DATE(dateout) =
            CASE
                WHEN HOUR(NOW()) >= 7 THEN DATE(NOW())
                ELSE DATE(NOW()) - INTERVAL 1 DAY
            END')
            ->sum('netto_ag');

        // Mengembalikan data ke view
        return view('admin.data-ffb', compact('query_current_ffb', 'total_tonase'));
    }




    public function getDataSales(Request $request)
    {
        $query_current_sales = DB::table('wb_automation_datacpo_tab')
            ->select('wbsid', 'vehicleno', 'driver', 'partname', 'wbin', 'wbout', 'netto', 'regis_in', 'weighing_in', 'weighing_out', 'regis_out')
            ->whereRaw('DATE(dateout) =
        CASE
            WHEN HOUR(NOW()) >= 7 THEN DATE(NOW())
            ELSE DATE(NOW()) - INTERVAL 1 DAY
        END')
            ->paginate(5);

        $total_tonase_part = DB::table('wb_automation_datacpo_tab')
            ->select('partname', DB::raw('SUM(netto) as total_netto'), DB::raw('COUNT(*) as transactions_count'))
            ->whereRaw('DATE(dateout) =
                CASE
                    WHEN HOUR(NOW()) >= 7 THEN DATE(NOW())
                    ELSE DATE(NOW()) - INTERVAL 1 DAY
                END')
            ->where('regis_out', 'T')
            ->groupBy('partname')
            ->get();

        // Hitung total netto untuk semua komoditi
        $total_sales_tonase = $total_tonase_part->sum('total_netto');  // Menjumlahkan total netto dari setiap komoditi

        return view('admin.data-sales', compact('query_current_sales', 'total_tonase_part', 'total_sales_tonase'));
    }



    public function getDataTransfers(Request $request)
    {
        $query_current_transfer = DB::table('wb_automation_producttrans_tab')
            ->select('wbsid', 'vehicleno', 'driver', 'partcat', 'wbin', 'wbout', 'netto', 'regis_in', 'weighing_in', 'weighing_out', 'regis_out')
            ->whereRaw('DATE(dateout) =
        CASE
            WHEN HOUR(NOW()) >= 7 THEN DATE(NOW())
            ELSE DATE(NOW()) - INTERVAL 1 DAY
        END')
            ->paginate(5);

        $total_tonase_part = DB::table('wb_automation_producttrans_tab')
            ->select('partcat', DB::raw('SUM(netto) as total_netto'), DB::raw('COUNT(*) as transactions_count'))
            ->whereRaw('DATE(dateout) =
                CASE
                    WHEN HOUR(NOW()) >= 7 THEN DATE(NOW())
                    ELSE DATE(NOW()) - INTERVAL 1 DAY
                END')
            ->where('regis_out', 'T')
            ->groupBy('partcat')
            ->get();

        // Hitung total netto untuk semua komoditi
        $total_transfer_tonase = $total_tonase_part->sum('total_netto');

        return view('admin.data-transfers', compact('query_current_transfer', 'total_tonase_part', 'total_transfer_tonase'));
    }


    public function getDataOthers(Request $request)
    {
        // Mendapatkan data transaksi lain-lain berdasarkan tanggal hari ini
        $query_current_lainlain = DB::table('wb_automation_data_tab as a')
            ->select('a.wbsid', 'a.vehicleno', 'a.driver', 'b.partname', 'a.wbin', 'a.wbout', 'a.netto', 'a.regis_in', 'a.weighing_in', 'a.weighing_out', 'a.regis_out')
            ->join('wbs_part_lain_lain_tab as b', 'a.partid', '=', 'b.partid')
            ->whereDate('a.dateout', today())
            ->paginate(5);

        // Mendapatkan total netto per komoditi (part) berdasarkan tanggal hari ini
        $total_tonase_part = DB::table('wb_automation_data_tab as a')
            ->join('wbs_part_lain_lain_tab as b', 'a.partid', '=', 'b.partid')
            ->select('b.partname', DB::raw('SUM(a.netto) as total_netto'), DB::raw('COUNT(*) as transactions_count'))
            ->whereRaw('DATE(a.dateout) =
        CASE
            WHEN HOUR(NOW()) >= 7 THEN DATE(NOW())
            ELSE DATE(NOW()) - INTERVAL 1 DAY
        END')
            ->where('a.regis_out', 'T')
            ->groupBy('a.partid', 'b.partname')  // Menambahkan 'b.partname' di sini
            ->get();


        // Menghitung total netto untuk semua komoditi hari ini
        $total_lainlain_tonase = $total_tonase_part->sum('total_netto');

        // Mengirim data ke view
        return view('admin.data-others', compact('query_current_lainlain', 'total_tonase_part', 'total_lainlain_tonase'));
    }
}
