<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Income::paginate(10);
        return view('finance.income', compact('datas'));
    }

    public function filter(Request $request)
    {
        if ($request->month == 'All' || $request->year == 'All') {
            if ($request->month == 'All' && $request->year == 'All') {
                return redirect('income');
            } else {
                $datas = Income::where('bulan', $request->month)
                ->orWhere('tahun', $request->year)
                ->paginate(10);
            }
        } else {
            $datas = Income::where('bulan', $request->month)
            ->Where('tahun', $request->year)
            ->paginate(10);
        }
        return view('finance.income', compact('datas'));
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
        $income = Income::find($id);
        $delete = $income->delete();
        if ($delete) {
            $status = 'success';
            $message = 'Data berhasil dihapus!';
        } else {
            $status = 'error';
            $message = 'Data gagal dihapus!';
        }
        return redirect('income')->with($status, $message);
    }
}
