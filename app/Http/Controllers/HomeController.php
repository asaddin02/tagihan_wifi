<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Installation;
use App\Models\Invoice;
use App\Models\Spending;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Menampilkan data dari tabel
    public function index()
    {
        $date = Carbon::now();
        $customers = Installation::where('status_pemasangan', 'Terpasang')->get();
        $incomePerMonth = 0;
        $incomePerYear = 0;
        $spendingPerMonth = 0;
        $spendingPerYear = 0;

        $getMonth = date('m', strToTime($date));
        $getYear = date('Y', strToTime($date));

        $incomesMonth = Income::where('bulan', $getMonth)->where('tahun', $getYear)->get();
        $incomesYear = Income::where('tahun', $getYear)->get();

        $spendingsMonth = Spending::where('bulan', $getMonth)->where('tahun', $getYear)->get();
        $spendingsYear = Spending::where('tahun', $getYear)->get();

        $invoices = Invoice::where('status_tagihan', 'Belum Dibayar')->paginate(10);

        $incomeChartResult = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
        $spendingChartResult = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];

        foreach ($incomesYear as $data) {
            $incomeChartResult[intval($data->bulan) - 1] = $data->total_pendapatan;
        }

        foreach ($spendingsYear as $data) {
            $spendingChartResult[intval($data->bulan) - 1] = $data->total_pengeluaran;
        }

        foreach ($incomesMonth as $income) {
            $incomePerMonth += $income->total_pendapatan;
        }

        foreach ($incomesYear as $income) {
            $incomePerYear += $income->total_pendapatan;
        }

        foreach ($spendingsMonth as $spending) {
            $spendingPerMonth += $spending->total_pengeluaran;
        }
        
        foreach ($spendingsYear as $spending) {
            $spendingPerYear += $spending->total_pengeluaran;
        }

        $loss = $incomePerMonth - $spendingPerMonth;

        return view('homepage', compact('customers', 'incomePerMonth', 'incomePerYear', 'spendingPerMonth', 'spendingPerYear', 'loss', 'invoices', 'incomeChartResult', 'spendingChartResult'));
    }
}
