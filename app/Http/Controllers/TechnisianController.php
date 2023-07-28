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
                $datas = [];
            } else {
                $check = Technisian::where('nama_teknisi', 'LIKE', '%'.$_GET['technisian_search'].'%')->paginate(10);
                if (isset($check)) {
                    $datas = $check;
                } else {
                    $datas = [];
                }
            }
        } else {
            $datas = Technisian::paginate(10);   
        }
        return view('employee.technisi',compact('datas'));
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
    public function edit(Request $request,$id)
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
