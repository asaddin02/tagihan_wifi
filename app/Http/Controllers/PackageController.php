<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET['package_search'])) {
            if ($_GET['package_search'] == '') {
                $datas = [];
            } else {
                $datas = Package::where('jenis_paket', 'LIKE', '%' . $_GET['package_search'] . '%')->get();
            }
        } else {
            $datas = Package::all();
        }
        return view('package.table', compact('datas'));
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
        $check = Package::where('jenis_paket', $request->jenis_paket)->first();
        if ($check) {
            return back()->with('error', 'Nama paket tidak boleh sama!');
        } else {
            $alert = Package::create($request->all());
        }
        if ($alert) {
            return back()->with('success', 'Paket baru telah ditambahkan!');
        } else {
            return back()->with('error', 'Paket baru gagal ditambahkan!');
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
    public function update(Request $request, $id)
    {
        $package = Package::find($id);
        $check_1 = Package::where('jenis_paket', $request->jenis_paket)->where('id', $id)->first();
        $check_2 = Package::where('jenis_paket', $request->jenis_paket)->first();
        if (isset($check_1)) {
            $alert = $package->update($request->all());
        } elseif ($check_2) {
            return back()->with('error', 'Nama tidak boleh sama!');
        } else {
            $alert = $package->update($request->all());
        }
        if ($alert) {
            return back()->with('success', 'Paket telah diupdate!');
        } else {
            return back()->with('error', 'Paket gagal diupdate!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $package = Package::find($id);
        $alert = $package->delete();
        if ($alert) {
            return back()->with('success', 'Paket telah dihapus!');
        } else {
            return back()->with('error', 'Paket gagal dihapus!');
        }
    }
}
