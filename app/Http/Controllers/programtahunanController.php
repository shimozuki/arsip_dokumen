<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\program_tahunan;
use Session;
use DB;

class programtahunanController extends Controller
{
    public function index()
    {
        $data = DB::table('program_tahunan')->distinct()->get();

        return view('program_tahunan.index', compact('data'));
    }

    function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'start' => 'required',
            'end' => 'required',
            'keterangan' => 'required',
        ]);

        program_tahunan::create([
            'judul_program' => $request->judul,
            'keterangan' => $request->keterangan,
            'tgl_mulai' => $request->start,
            'tg_akhir' => $request->end,
        ]);
        alert()->success('Success!', 'Data Berhasil Ditambahkan!')->autoclose(3500);
        return redirect('program');
    }

    function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required',
            'start' => 'required',
            'end' => 'required',
            'keterangan' => 'required',
        ]);

        $program = program_tahunan::findOrFail($id);
        $program->update([
            'judul_program' => $request->judul,
            'keterangan' => $request->keterangan,
            'tgl_mulai' => $request->start,
            'tgl_akhir' => $request->end,
        ]);
        if ($program) {
            alert()->success('Success!', 'Data Berhasil Diubah!')->autoclose(3500);
            return redirect('program');
        }
    }

    function destroy($id)
    {
        $program = program_tahunan::findOrFail($id);
        $program->delete();

        if ($program) {
            alert()->success('Success!', 'Data Berhasil Dihapus!')->autoclose(3500);
            return redirect('program');
        }
    }

    public function show($id)
    {
        $program = program_tahunan::find($id);
        return view('program_tahunan.ditail', compact('program'));
    }
}
