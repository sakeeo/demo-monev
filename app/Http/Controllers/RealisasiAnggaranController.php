<?php

namespace App\Http\Controllers;

use App\Models\paguAnggaran;
use App\Models\paguAnggaranDetail;
use App\Models\RealisasiAnggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class RealisasiAnggaranController extends Controller
{
    public function index()
    {
        $data['title'] = 'REALISASI ANGGARAN';
        $data['pagu'] = paguAnggaran::getdata();
        return view('transaksi.realisasiAnggaran.index', $data);
    }
    public function detail($id)
    {
        $data['title'] = 'REALISASI ANGGARAN';
        $data['pagu'] = paguAnggaran::getdetail($id);
        $data['id'] = $id; 
        $data['sumber_dana'] = DB::table('pagu_anggaran_details')
        ->join('sumber_anggarans','sumber_anggarans.id','pagu_anggaran_details.sumber_anggaran_id')
        ->where('pagu_anggaran_details.pagu_anggaran_id',$id)
        ->where('pagu_anggaran_details.periode','tahun berjalan')
        ->select(
            'pagu_anggaran_details.sumber_anggaran_id',
            'sumber_anggarans.kode'
        )
        ->get();

        $data['realisasi'] = RealisasiAnggaran::getdatabyidpagu($id);
        return view('transaksi.realisasiAnggaran.form', $data);
    }

    public function getdetail($id)
    {
        $realisasi= RealisasiAnggaran::getdatabyidpagu($id);
        $data['tbody']="";
        $data['id'] = $id;
        $no=1;
        foreach ($realisasi as $val) {
            $tr =  "<tr>"
                    ."<td scope='row'>".$no++."</td>"
                    ."<td>".$val->kode."</td>"
                    ."<td>".$val->tanggal1."</td>"
                    ."<td>".number_format($val->jumlah1,2,",",".")."</td>"
                    ."<td>".$val->tanggal2."</td>"
                    ."<td>".number_format($val->jumlah2,2,",",".")."</td>"
                    ."<td>".$val->tanggal3."</td>"
                    ."<td>".number_format($val->jumlah3,2,",",".")."</td>"
                    ."</tr>";
            $data['tbody'] .=$tr;
        }

        return Response()->json($data);
    }

    public function update(Request $request)
    {
        $input =$request->all();
        $tahap = $input['tahap'];
        $sumber_anggaran_id = $input['sumber_anggaran_id'];
        $pagu_anggaran_detail_id = paguAnggaranDetail::where("sumber_anggaran_id",$sumber_anggaran_id)
        ->where("pagu_anggaran_id",$input['pagu_anggaran_id'])
        ->first();
        
        $data=[
            'tanggal'.$tahap => $input['tanggal'],
            'jumlah'.$tahap  => $input['jumlah']
        ];
        RealisasiAnggaran::where([
            "pagu_anggaran_id"=>$input['pagu_anggaran_id'],
            "pagu_anggaran_detail_id"=>$pagu_anggaran_detail_id->id,
        ])
        ->update($data);
        return Response()->json($data);
    }

    public function print($id)
    {
        $data['title'] = 'REALISASI ANGGARAN';
        $data['pagu'] = paguAnggaran::getdetail($id);
        $data['realisasi'] = RealisasiAnggaran::getdatabyidpagu($id);
        $pdf = PDF::loadView('transaksi.realisasiAnggaran.laporan', $data)->setPaper('a4', 'landscape');;
        return $pdf->download('realisasianggaran.pdf');
    }
}
