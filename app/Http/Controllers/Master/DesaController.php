<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class DesaController extends Controller
{
    public function index()
    {
        $data['title'] = 'DATA DESA';
        $data['arrDesa'] = desa::all();
        return view('master.desa.index', $data);
    }

    public function form()
    {
        $data['title'] = 'FORM TAMBAH DESA';
        return view('master.desa.form', $data);
    }

    public function form_edit($id)
    {
        $data['title'] = 'FORM EDIT DESA';
        $data['desa']  = desa::find($id);
        return view('master.desa.form-edit', $data);
    }

    public function print()
    {
        $data['title'] = 'DATA DESA';
        $data['arrDesa'] = desa::all();

        $pdf = PDF::loadView('master.desa.laporan', $data)->setPaper('a4', 'portrait');;
        return $pdf->download('desa.pdf');
    }

    public function simpan(Request $request)
    {
        $input = $request->all();
        $desa = New desa;
        $desa->namadesa      = $input['namadesa'];
        $desa->kepaladesa    = $input['kepaladesa'];
        $desa->sekertaris    = $input['sekertaris'];
        $desa->keuangan      = $input['keuangan'];
        $desa->kaur_umum            = $input['kaur_umum'];
        $desa->kasi_pemerintahan    = $input['kasi_pemerintahan'];
        $desa->kaur_kesejahteraan   = $input['kaur_kesejahteraan'];
        $desa->kode_desa            = $input['kode_desa'];
        
        DB::beginTransaction();
        try {
            $desa->save();
            DB::commit();
        } catch (\Throwable $th) {
            return redirect()->route('data.desa')->with('message', $th);
            DB::rollBack();
        }
        return redirect()->route('data.desa')->with('message', 'Success!');
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $data=[
            'namadesa'   => $input['namadesa'],
            'kepaladesa' => $input['kepaladesa'],
            'sekertaris' => $input['sekertaris'],
            'keuangan'   => $input['keuangan'],
            'kaur_umum'   => $input['kaur_umum'],
            'kasi_pemerintahan'   => $input['kasi_pemerintahan'],
            'kaur_kesejahteraan'   => $input['kaur_kesejahteraan'],
            'kode_desa'   => $input['kode_desa'],
        ];
        
        DB::beginTransaction();
        try {
            desa::where('id',$input['id'])->update($data);
            DB::commit();
        } catch (\Throwable $th) {
            return redirect()->route('data.desa')->with('message', 'Error!');
            DB::rollBack();
        }
        return redirect()->route('data.desa')->with('message', 'Success!');
    }

    public function hapus($id)
    {
        desa::where('id',$id)->delete();
        return redirect()->route('data.desa')->with('message', 'Success!');
    }
}
