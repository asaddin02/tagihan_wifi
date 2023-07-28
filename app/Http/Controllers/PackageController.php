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
                $datas = Package::where('jenis_paket', 'LIKE', '%' . $_GET['package_search'] . '%')->paginate(10);
            }
        } else {
            $datas = Package::paginate(10);
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
            return redirect('package')->with('error', 'Nama paket tidak boleh sama!');
        } else {
            $create = Package::create($request->all());
        }
        if ($create) {
            $status = 'success';
            $message = 'Data berhasil ditambahkan';
        } else {
            $status = 'error';
            $message = 'Data gagal ditambahkan';
        }
        return redirect('package')->with($status, $message);
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
            $update = $package->update($request->all());
        } elseif ($check_2) {
            return redirect('package')->with('error', 'Nama tidak boleh sama!');
        } else {
            $update = $package->update($request->all());
        }
        if ($update) {
            $status = 'success';
            $message = 'Data berhasil diupdate!';
        } else {
            $status = 'error';
            $message = 'Data gagal diupdate!';
        }
        return redirect('package')->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $package = Package::find($id);
        $delete = $package->delete();
        if ($delete) {
            $status = 'success';
            $message = 'Data berhasil dihapus!';
        } else {
            $status = 'error';
            $message = 'Data gagal dihapus!';
        }
        return redirect('package')->with($status, $message);
    }
}
