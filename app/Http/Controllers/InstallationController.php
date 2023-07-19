<?php

namespace App\Http\Controllers;

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
        if (isset($_GET['installation_search'])) {
            if ($_GET['installation_search'] == '') {
                $installations = [];
            } else {
                $installations = Installation::whereHas('user', function($query) {
                    $query->where('name', 'LIKE', '%'.$_GET['installation_search'].'%');
                })->get();
            }
        } else {
            $installations = Installation::all();
        }
        $packages = Package::all();
        $technisians = Technisian::all();
        $date = Carbon::now();
        return view('installation.table',compact('installations', 'packages', 'technisians', 'date'));
    }

    // Menambah proses installasi
    public function createInstallation(Request $request)
    {
        $latestUser = User::where('role','Customer')->latest()->first();
        $installation = Installation::create([
            'package_id' => $request->package_id,
            'user_id' => $latestUser->id,
            'teknisi_id' => $request->technision_id,
            'tanggal_pemasangan' => $request->tanggal_pemasangan,
            'alamat_pemasangan' => $request->alamat_pemasangan,
            'status_pemasangan' => 'Belum Terpasang'
        ]);
        if($installation){
            return redirect('installation')->with('success', 'User dan Instalasi berhasil ditambahkan!');
        }else{
            return redirect('installation')->with('error', 'User dan Instalasi gagal ditambahkan!');
        }
    }

    // Mengubah status installation
    public function updateInstallation(Request $request,$id)
    {
        $installation = Installation::find($id);
        if($request->has('proses')){
            $installation->update([
                'status_pemasangan' => 'Dalam Proses'
            ]);
            return redirect()->back();
        }
        $installation->update([
            'status_pemasangan' => 'Terpasang'
        ]);
        $installation->delete();
        return redirect()->back();
    }
}
