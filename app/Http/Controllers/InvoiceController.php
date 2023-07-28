<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Installation;
use App\Models\Invoice;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $installations = Installation::all();
        $invoice = Invoice::where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)->first();
        if (isset($invoice)) {
            return back()->with('error', 'Tagihan bulan ini sudah ada!');
        } else {
            foreach ($installations as $installation) {
                $create = Invoice::create([
                    'installation_id' => $installation->id,
                    'hari' => $request->hari,
                    'bulan' => $request->bulan,
                    'tahun' => $request->tahun,
                    'total_tagihan' => $installation->package->harga_paket,
                    'status_tagihan' => $request->status_tagihan,
                ]);
            }
        }
        if ($create) {
            $status = 'success';
            $message = 'Tagihan berhasil ditambahkan!';
        } else {
            $status = 'error';
            $message = 'Tagihan gagal ditambahkan!';
        }
        return redirect('customer')->with($status, $message);
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
        $invoice = Invoice::find($id);
        $date = Carbon::now();
        Income::create([
            'total_pendapatan' => $request->total_pendapatan,
            'hari' => date('d', strToTime($date)),
            'bulan' => date('m', strToTime($date)),
            'tahun' => date('Y', strToTime($date)),
            'keterangan' => 'Pembayaran Tagihan Bulanan',
        ]);
        $update = $invoice->update($request->all());
        if ($update) {
            $status = 'success';
            $message = 'Pembayaran sukses!';
        } else {
            $status = 'error';
            $message = 'Pembayaran gagal!';
        }
        return back()->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
