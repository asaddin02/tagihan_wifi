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
        Technisian::create($request->all());
        return redirect()->back();
    }

    // Edit data teknisi
    public function edit(Request $request,$id)
    {
        $technisians = Technisian::find($id);
        $technisians->update($request->all());
        return redirect()->back();
    }

    // Menghapus data teknisi
    public function delete($id)
    {
        $technisians = Technisian::find($id);
        $technisians->delete();
        return redirect()->back();
    }
}
