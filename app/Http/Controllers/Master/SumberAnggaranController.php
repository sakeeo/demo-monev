<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\sumberAnggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class SumberAnggaranController extends Controller
{
    public function index()
    {
        $data['title'] = 'DATA SUMBER ANGGARAN';
        $data['arrSumberAnggaran'] = sumberAnggaran::all();
        return view('master.sumberAnggaran.index', $data);
    }

    public function form()
    {
        $data['title'] = 'FORM TAMBAH SUMBER ANGGARAN';
        return view('master.sumberAnggaran.form', $data);
    }

    public function form_edit($id)
    {
        $data['title'] = 'FORM EDIT SUMBER ANGGARAN';
        $data['sumberAnggaran']  = sumberAnggaran::find($id);
        return view('master.sumberAnggaran.form-edit', $data);
    }

    public function print()
    {
        $data['title'] = 'DATA SUMBER ANGGARAN';
        $data['arrSumberAnggaran'] = sumberAnggaran::all();

        $pdf = PDF::loadView('master.sumberAnggaran.laporan', $data)->setPaper('a4', 'portrait');;
        return $pdf->download('sumberAnggaran.pdf');
    }

    public function simpan(Request $request)
    {
        $input = $request->all();
        $sumberAnggaran = New sumberAnggaran();
        $sumberAnggaran->kode      = $input['kode'];
        $sumberAnggaran->uraian    = $input['uraian'];
        
        DB::beginTransaction();
        try {
            $sumberAnggaran->save();
            DB::commit();
        } catch (\Throwable $th) {
            return redirect()->route('data.sumberAnggaran')->with('message', 'Error!');
            DB::rollBack();
        }
        return redirect()->route('data.sumberAnggaran')->with('message', 'Success!');
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $data=[
            'kode'   => $input['kode'],
            'uraian' => $input['uraian'],
        ];
        
        DB::beginTransaction();
        try {
            sumberAnggaran::where('id',$input['id'])->update($data);
            DB::commit();
        } catch (\Throwable $th) {
            return redirect()->route('data.sumberAnggaran')->with('message', 'Error!');
            DB::rollBack();
        }
        return redirect()->route('data.sumberAnggaran')->with('message', 'Success!');
    }

    public function hapus($id)
    {
        sumberAnggaran::where('id',$id)->delete();
        return redirect()->route('data.sumberAnggaran')->with('message', 'Success!');
    }
}
