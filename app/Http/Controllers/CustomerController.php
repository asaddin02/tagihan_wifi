<?php

namespace App\Http\Controllers;

use App\Models\Installation;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Installation::paginate(10);
        $carbon = Carbon::now();
        return view('customer.table', compact('datas', 'carbon'));
    }

    public function search(Request $request)
    {
        $carbon = Carbon::now();
        if ($request->customer_search == '') {
            $datas = [];
        } else {
            $datas = Installation::whereHas('user', function ($query) use($request) {
                $query->where('name', 'LIKE', '%' . $request->customer_search . '%')->orWhere('user_id', $request->customer_search);
            })->get();
        }
        return view('customer.table', compact('datas', 'carbon'));
    }

    public function detail($id)
    {
        $installation = Installation::find($id);
        $invoices = Invoice::where('installation_id', $id)->where('status_tagihan', 'Belum Dibayar')->get();
        return view('customer.detail', compact('installation', 'invoices'));
    }

    public function invoice($id)
    {
        if (isset($_GET['invoice_month']) && isset($_GET['invoice_year'])) {
            if ($_GET['invoice_month'] == '' || $_GET['invoice_year'] == '') {
                $datas = [];
            } elseif ($_GET['invoice_month'] == 'all' || $_GET['invoice_year'] == 'all') {
                $datas = Invoice::where('installation_id', $id)->get();
            } else {
                $datas = Invoice::where('installation_id', $id)
                    ->where('bulan', $_GET['invoice_month'])
                    ->where('tahun', $_GET['invoice_year'])->get();
            }
        } else {
            $datas = Invoice::where('installation_id', $id)->paginate(10);
        }
        $installation = Installation::find($id);
        $carbon = Carbon::now();
        return view('customer.invoice', compact('datas', 'installation', 'carbon'));
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
