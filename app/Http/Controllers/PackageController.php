<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    // Menampilkan data dari tabel paket
    public function index()
    {
        $name = request('package_filter_name');

        $query = Package::query();

        if ($name != '') {
            $query->where('jenis_paket', 'LIKE', '%' . $name . '%');
        }

        $datas = $query->paginate(10);

        return view('package.table', compact('datas'));
    }

    // Menambahkan data ke tabel paket
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

    // Update data dari tabel paket
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

    // Hapus data dari tabel paket
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
