<?php

namespace App\Http\Controllers;

use App\Models\Technisian;
use Illuminate\Http\Request;

class TechnisianController extends Controller
{
    // Menampilan data teknisi
    public function index()
    {
        if (isset($_GET['technisian_search'])) {
            if ($_GET['technisian_search'] == '') {
                $technisians = [];
            } else {
                $check = Technisian::where('nama_teknisi', 'LIKE', '%'.$_GET['technisian_search'].'%')->get();
                if (isset($check)) {
                    $technisians = $check;
                } else {
                    $technisians = [];
                }
            }
        } else {
            $technisians = Technisian::all();   
        }
        return view('employee.technisi',compact('technisians'));
    }

    // Menambah data teknisi
    public function create(Request $request)
    {
        $alert = Technisian::create($request->all());
        if ($alert) {
            return redirect('technic')->with('success', 'Teknisi berhasil ditambahkan!');
        } else {
            return redirect('technic')->with('error', 'Teknisi gagal ditambahkan!');
        }
    }

    // Edit data teknisi
    public function edit(Request $request,$id)
    {
        $technisians = Technisian::find($id);
        $alert = $technisians->update($request->all());
        if ($alert) {
            return redirect('technic')->with('success', 'Teknisi berhasil diupdate!');
        } else {
            return redirect('technic')->with('error', 'Teknisi gagal diupdate!');
        }
    }

    // Menghapus data teknisi
    public function delete($id)
    {
        $technisians = Technisian::find($id);
        $alert = $technisians->delete();
        if ($alert) {
            return redirect('technic')->with('success', 'Teknisi berhasil dihapus!');
        } else {
            return redirect('technic')->with('error', 'Teknisi gagal dihapus!');
        }
    }
}
