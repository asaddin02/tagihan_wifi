<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerserviceController extends Controller
{
    // Menampilkan data dari tabel user
    public function index()
    {
        $title = 'Customer Service';

        $name = request('cs_filter_name');

        $query = User::query();

        if ($name != '') {
            $query->where('name', 'LIKE', '%' . $name  . '%');
        }

        $query->where('role', 'Customer Service');

        $datas = $query->paginate(10);

        return view('employee.customerservice', compact('title', 'datas'));
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
        $checkId = User::where('user_id', $request->user_id)->first();
        $checkEmail = User::where('email', $request->email)->first();

        if (isset($checkId) && isset($checkEmail)) return redirect('cs')->with('error', 'User Id atau Email sudah ada!');

        $validate = $request->validate(
            [
                'user_id' => ['required', 'numeric', 'unique:users'],
                'name' => ['required', 'string', 'min:5', 'max:20'],
                'no_telepon' => ['required', 'numeric'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required'],
                'role' => ['required'],
            ],
            [
                'user_id.numeric' => 'Inputan harus berupa angka.',
                'user_id.unique' => 'User Id tersebut sudah ada.',
                'name.min' => 'Nama minimal :min karakter.',
                'email.unique' => 'Email tersebut sudah ada.',
            ]
        );

        $hash = Hash::make($validate['password']);
        $validate['password'] = $hash;
        $create = User::create($validate);

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
