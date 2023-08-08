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
        // Tanggal
        $date = Carbon::now();

        $getMonth = date('m', strToTime($date));
        $getYear = date('Y', strToTime($date));

        // Customer
        $customers = Installation::where('status_pemasangan', 'Terpasang')->get();

        // Income Dan Chart Income
        $incomePerMonth = 0;
        $incomePerYear = 0;
        $incomeChartResult = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];

        $incomesMonth = Income::where('bulan', $getMonth)->where('tahun', $getYear)->get();
        $incomesYear = Income::where('tahun', $getYear)->get();

        foreach ($incomesMonth as $income) {
            $incomePerMonth += $income->total_pendapatan;
        }

        foreach ($incomesYear as $income) {
            $incomePerYear += $income->total_pendapatan;
            $incomeChartResult[intval($income->bulan) - 1] = $income->total_pendapatan;
        }

        // Spending Dan Chart Spending
        $spendingPerMonth = 0;
        $spendingPerYear = 0;
        $spendingChartResult = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];

        $spendingsMonth = Spending::where('bulan', $getMonth)->where('tahun', $getYear)->get();
        $spendingsYear = Spending::where('tahun', $getYear)->get();

        foreach ($spendingsMonth as $spending) {
            $spendingPerMonth += $spending->total_pengeluaran;
        }
        
        foreach ($spendingsYear as $spending) {
            $spendingPerYear += $spending->total_pengeluaran;
            $spendingChartResult[intval($spending->bulan) - 1] = $spending->total_pengeluaran;
        }

        // Invoice
        $invoices = Invoice::where('status_tagihan', 'Belum Dibayar')->paginate(10);

        // Kerugian
        $loss = $incomePerMonth - $spendingPerMonth;

        return view('homepage', compact('customers', 'incomePerMonth', 'incomePerYear', 'spendingPerMonth', 'spendingPerYear', 'loss', 'invoices', 'incomeChartResult', 'spendingChartResult', 'getYear'));
    }
}
