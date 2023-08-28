<?php

namespace App\Http\Controllers;

use App\Models\Installation;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Menampilkan data dari tabel instalasi
    public function index()
    {
        $title = 'Customer';

        $name = request('customer_filter_name');

        $query = Installation::query();
        $carbon = Carbon::now();

        if ($name != '') {
            $query->whereHas('user', function ($query) use ($name) {
                $query->where('name', 'LIKE', '%' . $name . '%')->orwhere('user_id', $name);
            });
        }

        $query->where('status_pemasangan', 'Terpasang');

        $datas = $query->paginate(10);

        return view('customer.table', compact('title', 'datas', 'carbon'));
    }

    // Detail customer
    public function detail($id)
    {
        $installation = Installation::find($id);
        $invoices = Invoice::where('installation_id', $id)->where('status_tagihan', 'Belum Dibayar')->paginate(10);
        return view('customer.detail', compact('installation', 'invoices'));
    }

    // Detail invoice
    public function invoice($id)
    {
        $title = 'Tagihan';
        
        $reqMonth = request('invoice_filter_month');
        $reqYear = request('invoice_filter_year');
        $status = request('invoice_filter_status');

        $query = Invoice::query();
        
        $carbon = Carbon::now();
        $month = date('m', strtotime($carbon));
        $year = date('Y', strtotime($carbon));

        $installation = Installation::find($id);
        $invoiceCheck = Invoice::where('status_tagihan', 'Belum Dibayar')->first();

        if ($reqMonth != '' && $reqMonth != 'All') {
            $query->where('bulan', $reqMonth);
        }

        if ($reqYear != '' && $reqYear != 'All') {
            $query->where('tahun', $reqYear);
        }

        if ($status != '' && $status != 'All') {
            $query->where('status_tagihan', $status);
        }

        $query->where('installation_id', $id);

        $datas = $query->paginate(10);

        return view('customer.invoice', compact('title', 'datas', 'carbon', 'month', 'year', 'installation', 'invoiceCheck'));
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

    // Menghapus data dari tabel instalasi
    public function deleteCustomer(Request $request, $id)
    {
        $installation = Installation::find($id);
        $user = User::find($request->user_id);
        $invoices = Invoice::where('installation_id', $id)->get();

        foreach($invoices as $invoice) {
            $invoice->delete();
        }
        $delete = $installation->delete();
        $user->delete();
        
        if ($delete) {
            $status = 'success';
            $message = 'Instalasi berhasil dihapus!';
        } else {
            $status = 'error';
            $message = 'Instalasi gagal dihapus!';
        }

        return redirect('customer')->with($status, $message);
    }
}
