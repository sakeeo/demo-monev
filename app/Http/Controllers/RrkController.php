<?php

namespace App\Http\Controllers;

use App\Models\paguAnggaranDetail;
use App\Models\sumberAnggaran;
use App\Models\desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class RrkController extends Controller
{
    public function index()
    {
        $data['title'] = 'REALISAI KEGIATAN GLOBAL';
        $data['sumberAnggaran'] = sumberAnggaran::all();
        $data['desa'] = desa::all();
        return view('transaksi.rrk.index', $data);
    }

    public function getdata(Request $request)
    {
        $input = $request->all();

        if ($input['sumber_anggaran_id']=='SEMUA') {
            $rs = DB::table('view_rkk')
            ->where('desa_id',$input['desa_id'])
            ->where('tahun',$input['tahun'])
            ->get();
        } else {
              $rs = DB::table('view_rkk')
            ->where('desa_id',$input['desa_id'])
            ->where('sumber_anggaran_id',$input['sumber_anggaran_id'])
            ->where('tahun',$input['tahun'])
            ->get();
        }
      
        
        $data['tbody']='';
        $data['tfoot']='';
        $no=0;
        $total_pagu=0;
        $total_realisasi=0;
        foreach ($rs as $item) {
            $no++;
    
            $sisa = $item->pagu-$item->realisasi;
            $tr  = "<tr>"
                    ."<td>".$no."</td>"
                    ."<td>".$item->bidang."</td>"
                    ."<td>".$item->sub_bidang."</td>"
                    ."<td>".$item->kegiatan."</td>"
                    ."<td>".$item->pekerjaan."</td>"
                    ."<td>".$item->kode."</td>"
                    ."<td>".number_format($item->pagu,2,",",".")."</td>"
                    ."<td>".number_format($item->realisasi,2,",",".")."</td>"
                    ."<td>".number_format($sisa,2,",",".")."</td>"
                    ."</tr>";
                $data['tbody'] .= $tr;

                $total_pagu += $item->pagu;
                $total_realisasi += $item->realisasi;
        }

        $total_sisa = $total_pagu-$total_realisasi;
        $data['tfoot']= "<tr>"
                        ."<th colspan='6'>JUMLAH</th>"
                        ."<th>".number_format($total_pagu,2,",",".")."</th>"
                        ."<th>".number_format($total_realisasi,2,",",".")."</th>"
                        ."<th>".number_format($total_sisa,2,",",".")."</th>"
                        ."</tr>";


        return Response()->json($data);
    }
    
    public function print(Request $request)
    {
        $input = $request->all();
        if ($input['print-sumber']=="SEMUA") {
            $data['rs'] = DB::table('view_rkk')
            ->where('desa_id',$input['print-desa'])
            ->where('tahun',$input['print-tahun'])
            ->get();
            $data['kode'] = $input['print-sumber'];

        } else {
             $data['rs'] = DB::table('view_rkk')
            ->where('desa_id',$input['print-desa'])
            ->where('sumber_anggaran_id',$input['print-sumber'])
            ->where('tahun',$input['print-tahun'])
            ->get();

            $x = sumberAnggaran::where('id',$input['print-sumber'])->select('kode')->first();
            $data['kode'] = $x->kode;
        }
       

        $data['tahun'] = $input['print-tahun'];
        $data['desa_id'] = $input['print-desa'];

        $y = desa::where('id',$input['print-desa'])->select('namadesa')->first();
        $data['namadesa'] = $y->namadesa;

        $pdf = PDF::loadView('transaksi.rrk.laporan', $data)->setPaper('a4', 'landscape');;
        return $pdf->download('rrk.pdf');

    }
}
