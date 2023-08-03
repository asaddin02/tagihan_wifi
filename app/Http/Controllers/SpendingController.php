<?php

namespace App\Http\Controllers;

use App\Models\Spending;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SpendingController extends Controller
{
    // Baca data dari tabel
    public function index()
    {
        $month = request('spending_filter_month');
        $year = request('spending_filter_year');
        
        $query = Spending::query();
        $carbon = Carbon::now();
        
        if ($month != '') {
            if ($month != 'All') {
                $query->where('bulan', $month);
            }
        }
        
        if ($year != '') {
            if ($year != 'All') {
                $query->where('tahun', $year);
            }
        }

        $datas = $query->paginate(10);
        
        return view('finance.spending', compact('datas', 'carbon'));
    }

    // Menambahkan data ke tabel
    public function store(Request $request)
    {
        $create = Spending::create($request->all());

        if ($create) {
            $status = 'success';
            $message = 'Data berhasil ditambahkan!';
        } else {
            $status = 'error';
            $message = 'Data gagal ditambahkan!';
        }

        return redirect('spending')->with($status, $message);
    }

    // Update data tabel
    public function update(Request $request, string $id)
    {
        $spending = Spending::find($id);

        $update = $spending->update([
            'total_pengeluaran' => $request->total_pengeluaran,
            'keterangan' => $request->keterangan,
        ]);

        if ($update) {
            $status = 'success';
            $message = 'Data berhasil diupdate!';
        } else {
            $status = 'error';
            $message = 'Data gagal diupdate!';
        }

        return redirect('spending')->with($status, $message);
    }

    // Hapus data tabel
    public function destroy(string $id)
    {
        $spending = Spending::find($id);

        $delete = $spending->delete();

        if ($delete) {
            $status = 'success';
            $message = 'Data berhasil dihapus!';
        } else {
            $status = 'error';
            $message = 'Data gagal dihapus!';
        }
        
        return redirect('spending')->with($status, $message);
    }
}
