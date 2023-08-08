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
    // Menambahkan data ke tabel
    public function store(Request $request)
    {
        $installations = Installation::all();
        $invoice = Invoice::where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)->first();

        if (isset($invoice)) {
            return redirect('customer')->with('error', 'Tagihan bulan ini sudah ada!');
        } else {
            foreach ($installations as $installation) {
                if ($installation->status_pemasangan == 'Terpasang') {
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

    // Update data tabel
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
}
