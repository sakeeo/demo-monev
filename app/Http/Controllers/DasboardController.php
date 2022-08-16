<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DasboardController extends Controller
{
    public function index()
    {
        $data['title'] = 'DASBOARD';
        return view('dasboard', $data);
    }

    public function chart()
    {

        $rs = DB::table('pagu_anggaran_details')
        ->join('pagu_anggarans','pagu_anggaran_details.pagu_anggaran_id','pagu_anggarans.id')
        ->join('desas','pagu_anggarans.desa_id','desas.id')
        ->join('sumber_anggarans','pagu_anggaran_details.sumber_anggaran_id','sumber_anggarans.id')
        ->join('realisasi_anggarans','pagu_anggaran_details.id','realisasi_anggarans.pagu_anggaran_detail_id')
        ->where([
            'pagu_anggaran_details.periode'=>'tahun berjalan',
            'pagu_anggarans.tahun'=>2022,
        ])
        ->select(
            'pagu_anggarans.tahun',
            'pagu_anggarans.desa_id',
            'desas.namadesa',
            'pagu_anggaran_details.jumlah',
            'pagu_anggaran_details.periode',
            'pagu_anggaran_details.sumber_anggaran_id',
            'sumber_anggarans.kode',
            'realisasi_anggarans.jumlah1',
            'realisasi_anggarans.jumlah2',
            'realisasi_anggarans.jumlah3'
        )
        ->get();
    
        $data['kode']=[];
        $data['jumlah']=[];
        $data['realisasi']=[];
        foreach ($rs as $item) {
    
            $totalrealisasi = $item->jumlah1+$item->jumlah2+$item->jumlah3;
            array_push($data['kode'],$item->kode);
            array_push($data['jumlah'],$item->jumlah);
            array_push($data['realisasi'],$totalrealisasi);

        }
        return Response()->json($data);
    }
}
