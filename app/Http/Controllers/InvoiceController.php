<?php

namespace App\Http\Controllers;

use App\Models\Installation;
use App\Models\Invoice;
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
        $invoice = Invoice::where('installation_id', $request->installation_id)->where('bulan', $request->bulan)->first();
        if (isset($invoice)) {
            return back()->with('error', 'Tagihan bulan ini sudah ada!');
        } else {
            $alert = Invoice::create($request->all());
        }
        if ($alert) {
            return back()->with('success', 'Tagihan berhasil ditambahkan!');
        } else {
            return back()->with('error', 'Tagihan gagal ditambahkan!');
        }
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
        $alert = $invoice->update($request->all());
        if ($alert) {
            return back()->with('success', 'Pembayaran sukses!');
        } else {
            return back()->with('error', 'Pembayaran gagal!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
