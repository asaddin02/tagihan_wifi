<?php

namespace App\Http\Controllers;

use App\Models\Spending;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SpendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Spending::paginate(10);
        $carbon = Carbon::now();
        return view('finance.spending', compact('datas', 'carbon'));
    }

    public function filter(Request $request)
    {
        $carbon = Carbon::now();
        if ($request->month == 'All' || $request->year == 'All') {
            if ($request->month == 'All' && $request->year == 'All') {
                return redirect('income');
            } else {
                $datas = Spending::where('bulan', $request->month)
                ->orWhere('tahun', $request->year)
                ->paginate(10);
            }
        } else {
            $datas = Spending::where('bulan', $request->month)
            ->Where('tahun', $request->year)
            ->paginate(10);
        }
        return view('finance.spending', compact('datas', 'carbon'));
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
        $create = Spending::create($request->all());
        if ($create) {
            $status = 'success';
            $message = 'Data berhasil ditambahkan!';
        } else {
            $status = 'error';
            $message = 'Data gagal ditambahkan!';
        }
        return redirect('spending')->with($status, $message);
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
        $spending = Spending::find($id);
        $update = $spending->update([
            'total_pengeluaran' => $request->total_pengeluaran,
            'keterangan' => $request->keterangan,
        ]);
        if ($update) {
            $status = 'success';
            $message = 'Data berhasil diupdate!';
        } else {
            $status = 'error';
            $message = 'Data gagal diupdate!';
        }
        return redirect('spending')->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $spending = Spending::find($id);
        $delete = $spending->delete();
        if ($delete) {
            $status = 'success';
            $message = 'Data berhasil dihapus!';
        } else {
            $status = 'error';
            $message = 'Data gagal dihapus!';
        }
        return redirect('spending')->with($status, $message);
    }
}
