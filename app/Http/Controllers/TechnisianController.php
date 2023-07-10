<?php

namespace App\Http\Controllers;

use App\Models\Technisian;
use Illuminate\Http\Request;

class TechnisianController extends Controller
{
    // Menampilan data teknisi
    public function index()
    {
        $technisians = Technisian::all();
        return view('employee.technisi',compact('technisians'));
    }

    // Menambah data teknisi
    public function create(Request $request)
    {
        $alert = Technisian::create($request->all());
        if ($alert) {
            return redirect()->back()->with('success', 'Teknisi baru telah ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Teknisi baru gagal ditambahkan!');
        }
    }

    // Edit data teknisi
    public function edit(Request $request,$id)
    {
        $technisians = Technisian::find($id);
        $alert = $technisians->update($request->all());
        if ($alert) {
            return redirect()->back()->with('success', 'Teknisi baru telah diupdate!');
        } else {
            return redirect()->back()->with('error', 'Teknisi baru gagal diupdate!');
        }
    }

    // Menghapus data teknisi
    public function delete($id)
    {
        $technisians = Technisian::find($id);
        $alert = $technisians->delete();
        if ($alert) {
            return redirect()->back()->with('success', 'Teknisi baru telah dihapus!');
        } else {
            return redirect()->back()->with('error', 'Teknisi baru gagal dihapus!');
        }
    }
}
