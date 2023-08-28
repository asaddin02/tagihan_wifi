<?php

namespace App\Http\Controllers;

use App\Models\Installation;
use App\Models\Technisian;
use Illuminate\Http\Request;

class TechnisianController extends Controller
{
    // Menampilkan data dari tabel teknisi
    public function index()
    {
        $title = 'Teknisi';

        $name = request('technisian_filter_name');

        $query = Technisian::query();

        if ($name != '') {
            $query->where('nama_teknisi', 'LIKE', '%' . $name  . '%');
        }

        $datas = $query->paginate(10);

        return view('employee.technisi', compact('title', 'datas'));
    }

    // Link ke whatsapp
    public function whatsapp(Request $request)
    {
        $country = '62';
        $phone_number = ltrim($request->no_telepon, '0');
        $whatsappURL = 'https://wa.me/' . $country . $phone_number;

        return redirect()->away($whatsappURL);
    }

    // Menambah data ke tabel teknisi
    public function create(Request $request)
    {
        $validate = $request->validate(
            [
                'nama_teknisi' => ['required', 'string', 'min:5', 'max:20'],
                'alamat' => ['required', 'string', 'min:5', 'max:50'],
                'no_telepon' => ['required', 'numeric'],
            ],
            [
                'nama_teknisi.min' => 'Nama minimal :min karakter.',
                'nama_teknisi.max' => 'Nama maksimal :max karakter.',
                'alamat.min' => 'Alamat minimal :min karakter.',
                'alamat.max' => 'Alamat maksimal :max karakter.',
            ]
        );

        $create = Technisian::create($validate);

        if ($create) {
            $status = 'success';
            $message = 'Data berhasil ditambahkan';
        } else {
            $status = 'error';
            $message = 'Data gagal ditambahkan';
        }

        return redirect('technic')->with($status, $message);
    }

    // Edit data dari tabel teknisi
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

    // Menghapus data dari tabel teknisi
    public function delete($id)
    {
        $checkTechnisian = Installation::where('teknisi_id', $id)->first();
        $technisian = Technisian::find($id);

        if (isset($checkTechnisian)) return redirect('technic')->with('error', 'Teknisi masih berhubungan dengan instalasi!');

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
