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
        if (isset($_GET['customer_search'])) {
            $user = User::where('name', 'LIKE', '%'. $_GET['customer_search'] .'%')
                    ->orWhere('user_id', $_GET['customer_search'])
                    ->first();
            if (isset($user)) {
                $datas = Installation::where('user_id', $user->id)->get();
            } else {
                $datas = [];
            }
        } else {
            $datas = Installation::all();
        }
        return view('customer.table', compact('datas'));
    }

    public function detail($id)
    {
        $user = User::find($id);
        return view('customer.detail', compact('user'));
    }

    public function invoice($id)
    {
        $datas = Invoice::where('installation_id', $id)->get();
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
        $installation = Installation::find($id);
        $alert = $installation->update($request->all());
        if ($alert) {
            return back()->with('success', 'Data berhasil diedit!');
        } else {
            return back()->with('error', 'Data gagal diedit!');
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
