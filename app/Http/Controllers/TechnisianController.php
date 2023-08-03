<?php

namespace App\Http\Controllers;

use App\Models\Technisian;
use Illuminate\Http\Request;

class TechnisianController extends Controller
{
    // Menampilan data teknisi
    public function index()
    {
        $name = request('technisian_filter_name');

        $query = Technisian::query();

        if ($name != '') {
            $query->where('nama_teknisi', 'LIKE', '%' . $name  . '%');
        }

        $datas = $query->paginate(10);

        return view('employee.technisi', compact('datas'));
    }

    // Link ke whatsapp
    public function whatsapp(Request $request) 
    {
        $country = '62';
        $phone_number = ltrim($request->no_telepon, '0');
        $whatsappURL = 'https://wa.me/' . $country . $phone_number;

        return redirect()->away($whatsappURL);
    }

    // Menambah data teknisi
    public function create(Request $request)
    {
        $create = Technisian::create($request->all());

        if ($create) {
            $status = 'success';
            $message = 'Data berhasil ditambahkan';
        } else {
            $status = 'error';
            $message = 'Data gagal ditambahkan';
        }

        return redirect('technic')->with($status, $message);
    }

    // Edit data teknisi
    public function edit(Request $request, $id)
    {
        $technisian = Technisian::find($id);
        $update = $technisian->update($request->all());

        if ($update) {
            $status = 'success';
            $message = 'Data berhasil diupdate';
        } else {
            $status = 'error';
            $message = 'Data gagal diupdate';
        }

        return redirect('technic')->with($status, $message);
    }

    // Menghapus data teknisi
    public function delete($id)
    {
        $technisian = Technisian::find($id);

        $delete = $technisian->delete();

        if ($delete) {
            $status = 'success';
            $message = 'Data berhasil dihapus';
        } else {
            $status = 'error';
            $message = 'Data gagal dihapus';
        }
        
        return redirect('technic')->with($status, $message);
    }
}
