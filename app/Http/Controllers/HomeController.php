<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Spending;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $date = Carbon::now();
        $customers = User::where('role', 'Customer')->get();
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

        return view('homepage', compact('customers', 'incomePerMonth', 'incomePerYear', 'spendingPerMonth', 'spendingPerYear', 'loss'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
