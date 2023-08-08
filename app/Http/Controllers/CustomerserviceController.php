<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerserviceController extends Controller
{
    // Menampilkan data dari tabel user
    public function index()
    {
        $name = request('cs_filter_name');

        $query = User::query();

        if ($name != '') {
            $query->where('name', 'LIKE', '%' . $name  . '%');
        }

        $query->where('role', 'Customer Service');

        $datas = $query->paginate(10);

        return view('employee.customerservice', compact('datas'));
    }

    // Link ke whatsapp
    public function whatsapp(Request $request) 
    {
        $country = '62';
        $phone_number = ltrim($request->no_telepon, '0');
        $whatsappURL = 'https://wa.me/' . $country . $phone_number;

        return redirect()->away($whatsappURL);
    }

    // Menambahkan data ke tabel user
    public function store(Request $request)
    {
        $create = User::create($request->all());

        if ($create) {
            $status = 'success';
            $message = 'Data berhasil ditambahkan';
        } else {
            $status = 'error';
            $message = 'Data gagal ditambahkan';
        }

        return redirect('cs')->with($status, $message);
    }

    // Update data dari tabel user
    public function update(Request $request, string $id)
    {
        $cs = User::find($id);
        $update = $cs->update($request->all());

        if ($update) {
            $status = 'success';
            $message = 'Data berhasil diupdate';
        } else {
            $status = 'error';
            $message = 'Data gagal diupdate';
        }

        return redirect('cs')->with($status, $message);
    }

    // Hapus data dari tabel user
    public function destroy(string $id)
    {
        $cs = User::find($id);

        $delete = $cs->delete();

        if ($delete) {
            $status = 'success';
            $message = 'Data berhasil dihapus';
        } else {
            $status = 'error';
            $message = 'Data gagal dihapus';
        }
        
        return redirect('cs')->with($status, $message);
    }
}
