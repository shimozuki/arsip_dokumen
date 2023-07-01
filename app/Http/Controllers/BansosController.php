<?php

namespace App\Http\Controllers;

use App\Imports\Bansosimport;
use Illuminate\Http\Request;
use App\Models\bansos;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class BansosController extends Controller
{
    public function index()
    {
        $data = bansos::all();

        return view('bansos.index', compact('data'));
    }

    function importExcel(Request $request)
    {
        // validasi file
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // Ambil file excel
        $file = $request->file('file');
        // rename file
        $nama_file = rand() . $file->getClientOriginalName();
        // upload ke file_pt
        $file->move('file_pt', $nama_file);
        // Import data
        $data =  Excel::import(new BansosImport, public_path('/file_pt/' . $nama_file));
        // notif session
        Session::flash('success', 'Data Berhasil di Import');
        // redirect
        return redirect('/bansos');
    }

    function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'jenis' => 'required',
            'alamat' => 'required',
        ]);

        Bansos::create([
            'nama_penerima' => $request->nama,
            'jenis_bantuan' => $request->jenis,
            'alamat' => $request->alamat,
        ]);
        alert()->success('Success!', 'Data Berhasil Ditambahkan!')->autoclose(3500);
        return redirect('bansos');
    }

    function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'jenis' => 'required',
            'alamat' => 'required',
        ]);

        $bansos = Bansos::findOrFail($id);
        $bansos->update([
            'nama_penerima' => $request->nama,
            'jenis_bantuan' => $request->jenis,
            'alamat' => $request->alamat,
        ]);
        if ($bansos) {
            alert()->success('Success!', 'Data Berhasil Diubah!')->autoclose(3500);
            return redirect('bansos');
        }
    }

    function destroy($id)
    {
        $bansos = Bansos::findOrFail($id);
        $bansos->delete();

        if ($bansos) {
            alert()->success('Success!', 'Data Berhasil Dihapus!')->autoclose(3500);
            return redirect('bansos');
        }
    }
}
