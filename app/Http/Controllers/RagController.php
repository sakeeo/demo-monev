<?php

namespace App\Http\Controllers;

use App\Models\paguAnggaranDetail;
use App\Models\sumberAnggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class RagController extends Controller
{
    public function index()
    {
        $data['title'] = 'REALISAI ANGGARAN GLOBAL';
        $data['sumberAnggaran'] = sumberAnggaran::all();
        return view('transaksi.rag.index', $data);
    }

    public function getdata(Request $request)
    {
        $input = $request->all();

        if ($input['sumber_anggaran_id']!='SEMUA') {
           $rs = DB::table('view_rag')
            ->where([
                'periode'=>'tahun berjalan',
                'tahun'=>$input['tahun'],
                'sumber_anggaran_id'=>$input['sumber_anggaran_id']
            ]) ->get();
        } else {
            $rs = DB::table('view_rag')
            ->where([
                'periode'=>'tahun berjalan',
                'tahun'=>$input['tahun']
            ]) ->get();
        }
        
        $data['tbody']='';
        $data['tfoot']='';
        $no=0;
        $totalanggaran=0;
        $totalreal=0;
        foreach ($rs as $item) {
            $no++;
    
            $totalrealisasi = $item->jumlah1+$item->jumlah2+$item->jumlah3;
            $persentase = $totalrealisasi/$item->jumlah*100;
            $tr  = "<tr>"
                    ."<td>".$no."</td>"
                    ."<td>".$item->namadesa."</td>"
                    ."<td>".$item->kode."</td>"
                    ."<td>".number_format($item->jumlah,2,",",".")."</td>"
                    ."<td>".number_format($totalrealisasi,2,",",".")."</td>"
                    ."<td>".number_format($persentase,2,",",".")." %</td>"
                    ."</tr>";
                $data['tbody'] .= $tr;
            
                $totalanggaran  += $item->jumlah;
                $totalreal      += $totalrealisasi;
        }


        $totalpersentase = $totalreal/$totalanggaran*100;
        $data['tfoot']= "<tr>"
                        ."<th colspan='3'>JUMLAH</th>"
                        ."<th>".number_format($totalanggaran,2,",",".")."</th>"
                        ."<th>".number_format($totalreal,2,",",".")."</th>"
                        ."<th>".number_format($totalpersentase,2,",",".")." %</th>"
                        ."</tr>";
        return Response()->json($data);
    }
    
    public function print(Request $request)
    {
        $data['title'] = 'REALISASI ANGGARAN';
        $input = $request->all();
        
        if ($input['print-id']!='SEMUA') {
           $data['rs'] = DB::table('view_rag')
            ->where([
                'periode'=>'tahun berjalan',
                'tahun'=>$input['print-tahun'],
                'sumber_anggaran_id'=>$input['print-id']
            ]) ->get();
            $x = sumberAnggaran::where('id',$input['print-id'])->select('kode')->first();
            $data['kode'] = $x->kode;

        } else {
            $data['rs'] = DB::table('view_rag')
            ->where([
                'periode'=>'tahun berjalan',
                'tahun'=>$input['print-tahun']
            ]) ->get();
            $data['kode'] = $input['print-id'];
        }
        
        $data['tahun'] = $input['print-tahun'];
        

        $pdf = PDF::loadView('transaksi.rag.laporan', $data)->setPaper('a4', 'landscape');;
        return $pdf->download('rag.pdf');

    }
}
