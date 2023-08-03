<?php

namespace App\Http\Controllers;

use App\Models\Installation;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Baca data dari tabel
    public function index()
    {
        $name = request('customer_filter_name');

        $query = Installation::query();
        $carbon = Carbon::now();

        if ($name != '') {
            $query->whereHas('user', function ($query) use ($name) {
                $query->where('name', 'LIKE', '%' . $name . '%')->orwhere('user_id', $name);
            });
        }

        $datas = $query->paginate(10);

        return view('customer.table', compact('datas', 'carbon'));
    }

    // Detail customer
    public function detail($id)
    {
        $installation = Installation::find($id);
        $invoices = Invoice::where('installation_id', $id)->where('status_tagihan', 'Belum Dibayar')->get();
        return view('customer.detail', compact('installation', 'invoices'));
    }

    // Detail invoice
    public function invoice($id)
    {
        $month = request('invoice_filter_month');
        $year = request('invoice_filter_year');
        $status = request('invoice_filter_status');

        $query = Invoice::query();
        $carbon = Carbon::now();

        if ($month != '' && $month != 'All') {
            $query->where('bulan', $month);
        }

        if ($year != '' && $year != 'All') {
            $query->where('tahun', $year);
        }

        if ($status != '' && $status != 'All') {
            $query->where('status_tagihan', $status);
        }

        $query->where('installation_id', $id);

        $datas = $query->paginate(10);

        return view('customer.invoice', compact('datas', 'carbon'));
    }

    // Whatsapp
    public function whatsapp(Request $request)
    {
        $country = '62';
        $phone_number = ltrim($request->no_telepon, '0');
        $message = 'Halo pelanggan, Anda belum membayar tagihan bulan ini';
        $whatsappURL = 'https://wa.me/' . $country . $phone_number . '?text=' . $message;

        return redirect()->away($whatsappURL);
    }
}
