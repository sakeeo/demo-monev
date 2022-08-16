<?php

namespace App\Http\Controllers;

use App\Models\desa;
use App\Models\paguAnggaran as paguAnggaran;
use App\Models\paguAnggaranDetail;
use App\Models\RealisasiAnggaran;
use App\Models\sumberAnggaran;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;

class paguAnggaranController extends Controller
{
    public function index()
    {
        $data['title'] = 'PAGU ANGGARAN';
        $pagu = paguAnggaran::getdata();
        $data['pagu'] = [];
        foreach ($pagu as $item) {

            $jmlpagu = paguAnggaranDetail::where('pagu_anggaran_id',$item->id)
                                    ->where('periode','tahun berjalan')
                                    ->sum('jumlah');
            
            $jmlsisa = paguAnggaranDetail::where('pagu_anggaran_id',$item->id)
            ->where('periode','sisa tahun sebelumnya')
            ->sum('jumlah');

            $newpagu = [
                'id'            => $item->id,
                'tahun'         => $item->tahun,
                'namadesa'      => $item->namadesa,
                'jumlahpagu'    => number_format($jmlpagu,2,",","."),
                'jumlahsisa'    => number_format($jmlsisa,2,",",".")
            ];

            array_push($data['pagu'],$newpagu);
        }

        return view('transaksi.pagu.index', $data);
    }

    public function form()
    {
        $data['title'] = 'PAGU ANGGARAN';
        $data['desa'] = desa::all();
        $data['sumberAnggaran'] = sumberAnggaran::all();
        return view('transaksi.pagu.form', $data);
    }


    public function simpan(Request $request)
    {   
        $input = $request->all();
        $pagu  = new paguAnggaran;
        $pagu->tahun = $input['tahun'];
        $pagu->desa_id = $input['desa_id'];
        $newpagu = $pagu->save();
        
        foreach($input['thb'] as $key => $val ){
            $detailpagu = new paguAnggaranDetail;
            $detailpagu->pagu_anggaran_id = $pagu->id;
            $detailpagu->sumber_anggaran_id = $val['id'];
            $detailpagu->jumlah             = $val['jumlah'];
            $detailpagu->periode        = 'tahun berjalan';
            $detailpagu->save();

            $realisasi = new RealisasiAnggaran; 
            $realisasi->pagu_anggaran_detail_id = $detailpagu->id;
            $realisasi->pagu_anggaran_id = $detailpagu->pagu_anggaran_id;
            $realisasi->save();
        }

        foreach($input['ths'] as $key => $val ){
            $detailpagu = new paguAnggaranDetail;
            $detailpagu->pagu_anggaran_id   = $pagu->id;
            $detailpagu->sumber_anggaran_id = $val['id'];
            $detailpagu->jumlah             = $val['jumlah'];
            $detailpagu->periode            = 'sisa tahun sebelumnya';
            $detailpagu->save();
        }

        return Response()->json($input);
    }
    

    public function detail($id)
    {
        $data['title'] = 'PAGU ANGGARAN';
        $data['pagu_berjalan'] = paguAnggaran::paguBerjalan($id);
        $data['pagu_sisa'] =     paguAnggaran::paguSisa($id);
        $data['pagu'] =          paguAnggaran::getdetail($id);
        return view('transaksi.pagu.detail', $data);
    }

    public function form_edit($id)
    {
        $data['title'] = 'PAGU ANGGARAN';
        $data['desa'] = desa::all();
        $data['sumberAnggaran'] = sumberAnggaran::all();
        $data['pagu_berjalan'] =paguAnggaran::paguBerjalan($id);
        $data['pagu_sisa'] = paguAnggaran::paguSisa($id);
        $data['pagu'] =     paguAnggaran::getdetail($id);
        $data['pagu_id']    = $id;
        return view('transaksi.pagu.form-edit', $data);
    }

    public function hapus($id)
    {
        paguAnggaran::where('id',$id)->delete();
        paguAnggaranDetail::where('pagu_anggaran_id',$id)->delete();
        return redirect()->route('paguAnggaran')->with('message', 'Success!');
    }

    public function hapus_item($id,$pagu_id)
    {     
        paguAnggaranDetail::where('id',$id)->delete();
        return redirect()->route('form.edit.pagu',$pagu_id);
    }

    public function addNewItem(Request $request)
    {
        $input = $request->all();
        $detailpagu = new paguAnggaranDetail;
        $detailpagu->pagu_anggaran_id   = $input['pagu_anggaran_id'];
        $detailpagu->sumber_anggaran_id = $input['sumber_anggaran_id'];
        $detailpagu->jumlah             = $input['jumlah'];
        $detailpagu->periode            = $input['periode'];
        $x = $detailpagu->save();
        
        if($input['periode']=='tahun berjalan'){
            $realisasi = new RealisasiAnggaran; 
            $realisasi->pagu_anggaran_detail_id = $detailpagu->id;
            $realisasi->save();
        }
        

        return Response()->json($input);

    }

    public function simpan_perubahan(Request $request)
    {
        $input=$request->all();
        paguAnggaran::where('id',$input['pagu_anggaran_id'])
        ->update([
            'tahun'=>$input['tahun'],
            'desa_id'=>$input['desa_id']
        ]);
        return Response()->json($input);
    }
}
