<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Installation;
use App\Models\Package;
use App\Models\Technisian;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InstallationController extends Controller
{
    // Menunjukkan data installation
    public function getInstallation()
    {
        if (isset($_GET['installation_filter']) || isset($_GET['installation_search'])) {
            if ($_GET['installation_filter'] == 'All' && $_GET['installation_search'] == '') {
                return redirect('installation');
            } elseif ($_GET['installation_search'] != '') {
                $datas = Installation::whereHas('user', function ($query) {
                    $query->where('name', 'LIKE', '%' . $_GET['installation_search'] . '%');
                })->orWhere('status_pemasangan', $_GET['installation_filter'])->paginate(10);
            } elseif ($_GET['installation_filter'] != 'All') {
                $datas = [];
            }
        } else {
            $datas = Installation::paginate(10);
        }
        $packages = Package::paginate(10);
        $technisians = Technisian::paginate(10);
        $date = Carbon::now();
        return view('installation.table', compact('datas', 'packages', 'technisians', 'date'));
    }

    // Menambah proses installasi
    public function createInstallation(Request $request)
    {
        $latestUser = User::where('role', 'Customer')->latest()->first();
        $create = Installation::create([
            'package_id' => $request->package_id,
            'user_id' => $latestUser->id,
            'teknisi_id' => $request->technision_id,
            'tanggal_pemasangan' => $request->tanggal_pemasangan,
            'alamat_pemasangan' => $request->alamat_pemasangan,
            'status_pemasangan' => 'Belum Terpasang',
        ]);
        if ($create) {
            $status = 'success';
            $message = 'User dan Instalasi berhasil ditambahkan!';
        } else {
            $status = 'error';
            $message = 'User dan Instalasi gagal ditambahkan!';
        }
        return redirect('installation')->with($status, $message);
    }

    // Mengubah status installation
    public function updateInstallation(Request $request, $id)
    {
        $installation = Installation::find($id);
        $package = Package::find($request->package_id);
        $date = Carbon::now();
        if ($request->status_pemasangan == 'Dalam Proses') {
            $installation->update([
                'status_pemasangan' => $request->status_pemasangan
            ]);
        } else {
            $installation->update([
                'status_pemasangan' => $request->status_pemasangan
            ]);
            Income::create([
                'total_pendapatan' => $package->harga_paket + $package->harga_pemasangan,
                'hari' => date('d', strToTime($date)),
                'bulan' => date('m', strToTime($date)),
                'tahun' => date('Y', strToTime($date)),
                'keterangan' => 'Pembayaran instalasi',
            ]);
        }
        return back()->with('success', 'Status berhasil di ubah!');
    }

    // Mengubah alamat instalasi
    public function updateInstallationAddress(Request $request, $id)
    {
        $installation = Installation::find($id);
        $update = $installation->update([
            'alamat_pemasangan' => $request->alamat_pemasangan,
        ]);
        if ($update) {
            $status = 'success';
            $message = 'Alamat instalasi berhasil diupdate!';
        } else {
            $status = 'error';
            $message = 'Alamat instalasi gagal diupdate!';
        }
        return redirect('installation')->with($status, $message);
    }
}
