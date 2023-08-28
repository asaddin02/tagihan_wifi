<?php

namespace App\Http\Controllers;

use App\Models\Spending;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SpendingController extends Controller
{
    // Menampilkan data dari tabel spending
    public function index()
    {
        $title = 'Pengeluaran';

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
        
        return view('finance.spending', compact('title', 'datas', 'carbon'));
    }

    // Menambahkan data ke tabel spending
    public function store(Request $request)
    {
        $request->validate([
            'total_pengeluaran' => ['required', 'numeric'],
        ]);

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

    // Update data dari tabel spending
    public function update(Request $request, string $id)
    {
        $request->validate([
            'total_pengeluaran' => ['required', 'numeric'],
        ]);

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

    // Hapus data dari tabel spending
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
