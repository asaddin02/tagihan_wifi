<?php

namespace App\Http\Controllers;

use App\Models\Income;

class IncomeController extends Controller
{
    // Menampilkan data dari tabel income
    public function index()
    {
        $month = request('income_filter_month');
        $year = request('income_filter_year');
        
        $query = Income::query();
        
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
        return view('finance.income', compact('datas'));
    }

    // Hapus data dari tabel income
    public function destroy(string $id)
    {
        $income = Income::find($id);
        $delete = $income->delete();

        if ($delete) {
            $status = 'success';
            $message = 'Data berhasil dihapus!';
        } else {
            $status = 'error';
            $message = 'Data gagal dihapus!';
        }
        
        return redirect('income')->with($status, $message);
    }
}
