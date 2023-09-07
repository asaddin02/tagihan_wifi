<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Installation;
use App\Models\Invoice;
use App\Models\Invoicenote;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    // Menambahkan data ke tabel
    public function store(Request $request)
    {
        $carbon = Carbon::now();
        $day = date('d', strtotime($carbon));
        $month = date('m', strtotime($carbon));
        $year = date('Y', strtotime($carbon));

        $installations = Installation::all();

        $invoice = Invoice::where('bulan', $month)
            ->where('tahun', $year)->first();

        if (isset($invoice)) return redirect('customer')->with('error', 'Tagihan bulan ini sudah ada!');

        foreach ($installations as $installation) {
            $invoiceNote = Invoicenote::where('installation_id', $installation->id)->first();

            if ($installation->status_pemasangan == 'Terpasang') {
                if (date('m', strtotime($installation->tanggal_pemasangan)) != $month && date('Y', strtotime($installation->tanggal_pemasangan)) == $year) {
                    if (isset($invoiceNote)) {
                        if ($year >= $invoiceNote->mulai_tahun && $year <= $invoiceNote->sampai_tahun) {
                            if ($month > $invoiceNote->mulai_bulan && $month <= $invoiceNote->sampai_bulan) {
                                Invoice::create([
                                    'installation_id' => $installation->id,
                                    'hari' => $day,
                                    'bulan' => $month,
                                    'tahun' => $year,
                                    'total_tagihan' => $installation->package->harga_paket,
                                    'status_tagihan' => 'Lunas',
                                ]);
                            }
                        }
                    } else {
                        Invoice::create([
                            'installation_id' => $installation->id,
                            'hari' => $day,
                            'bulan' => $month,
                            'tahun' => $year,
                            'total_tagihan' => $installation->package->harga_paket,
                            'status_tagihan' => 'Belum Dibayar',
                        ]);
                    }
                }
            }
        }

        return redirect('customer')->with('success', 'Tagihan berhasil ditambahkan!');
    }

    // Update data tabel
    public function update(Request $request, string $id)
    {
        $invoice = Invoice::find($id);
        $carbon = Carbon::now();
        $year = intval(date('Y', strtotime($carbon)));
        $month = intval(date('m', strtotime($carbon)));
        $untilYear = intval($request->sampai_tahun);
        $untilMonth = intval($request->sampai_bulan);
        $bill = intval($request->tagihan);
        $invoiceNote = Invoicenote::where('installation_id', $request->installation_id)->first();

        if (isset($request->sampai_bulan) && isset($request->sampai_tahun)) {
            if ($untilMonth <= $month && $untilYear == $year) return back()->with('error', 'Pembayaran double harus lebih dari bulan ini.');
            if ($request->sampai_bulan != 'null' && $request->sampai_tahun != 'null') {
                if ($untilYear - $year == 0) {
                    $totalBill = $bill * ($untilMonth - $month + 1);
                } else if ($untilYear - $year == 1) {
                    $totalBill = $bill * (12 - $month + $untilMonth + 1);
                } else if ($untilYear - $year > 1) {
                    $totalBill = $bill * (12 - $month + (12 * ($untilYear - $year - 1)) + $untilMonth + 1);
                }
                $bill = $totalBill;
                if (isset($invoiceNote)) {
                    $invoiceNote->update([
                        'mulai_bulan' => $month,
                        'sampai_bulan' => $untilMonth,
                        'mulai_tahun' => $year,
                        'sampai_tahun' => $untilYear,
                    ]);
                } else {
                    Invoicenote::create([
                        'installation_id' => $request->installation_id,
                        'mulai_bulan' => $month,
                        'sampai_bulan' => $untilMonth,
                        'mulai_tahun' => $year,
                        'sampai_tahun' => $untilYear,
                    ]);
                }
            }
        }

        $update = $invoice->update([
            'status_tagihan' => 'Lunas'
        ]);

        Income::create([
            'total_pendapatan' => $bill,
            'hari' => date('d', strToTime($carbon)),
            'bulan' => date('m', strToTime($carbon)),
            'tahun' => date('Y', strToTime($carbon)),
            'keterangan' => 'Pembayaran Tagihan Bulanan',
        ]);

        if ($update) {
            $status = 'success';
            $message = 'Pembayaran sukses!';
        } else {
            $status = 'error';
            $message = 'Pembayaran gagal!';
        }

        return back()->with($status, $message);
    }

    // Export PDF
    public function exportPdf($id)
    {
        $data = Invoice::find($id);
        Pdf::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = Pdf::loadView('customer.invoice-export-pdf', compact('data'));
        return $pdf->download('invoice.pdf');
        // return view('customer.invoice-export-pdf', compact('data'));
    }
}
