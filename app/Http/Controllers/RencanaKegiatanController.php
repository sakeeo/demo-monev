<?php

namespace App\Http\Controllers;

use App\Models\bidang;
use App\Models\desa;
use App\Models\kegiatan;
use App\Models\RencanaKegiatan;
use App\Models\RencanaKegiatanHeader;
use App\Models\subBidang;
use App\Models\sumberAnggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class RencanaKegiatanController extends Controller
{
    public function index()
    {
        $data['title'] = 'RENCANA KEGIATAN';
        return view('transaksi.rencanakegiatan.index', $data);
    }

    public function form(){
        $data['title'] = 'RENCANA KEGIATAN';
        $data['desa'] = desa::all();
        $data['sumberAnggaran'] = sumberAnggaran::all();
        $data['bidang'] = bidang::all();
        $rkHeader = new RencanaKegiatanHeader;
        $rkHeader->tahun = date('Y');
        $rkHeader->desa_id = 1;
        $rkHeader->save();        
        $data['id'] = $rkHeader->id;
        return view('transaksi.rencanakegiatan.form', $data);
    }

    public function getpelaksana(Request $request)
    {

        $input = $request->all();
        $pelaksana  = desa::where('id',$input['desa_id'])->first();
        return Response()->json($pelaksana);
    }

    public function getSubbidang(Request $request)
    {   
        $input = $request->all();
        $subbidang = subBidang::where('bidang_id',$input['bidang_id'])->get();
        $data['option'] = "";
        foreach ($subbidang as $val) {
            $option =  "<option value='".$val->id."'>".$val->sub_bidang."</option>";
            $data['option'] .=$option;
        }
        return Response()->json($data);
    }

    public function getKegiatan(Request $request)
    {   
        $input = $request->all();
        $kegiatan = kegiatan::where('sub_bidang_id',$input['sub_bidang_id'])
        ->where('bidang_id',$input['bidang_id'])
        ->get();
        $data['option'] = "";
        foreach ($kegiatan as $val) {
            $option =  "<option value='".$val->id."'>".$val->kegiatan."</option>";
            $data['option'] .=$option;
        }
        return Response()->json($data);
    }

    public function updateHeader(Request $request)
    {
        $input = $request->all();
        $data = [
            'tahun'     => $input['tahun'],
            'desa_id'   => $input['desa_id']
        ];
        RencanaKegiatanHeader::where('id',$input['id'])->update($data);
        return Response()->json($input);
    }

    public function additem(Request $request)
    {
        $input= $request->all();
        $kegiatan = kegiatan::where('bidang_id',$input['bidang_id'])
        ->where('sub_bidang_id',$input['sub_bidang_id'])
        ->select('id')
        ->first();

        $rk = new RencanaKegiatan; 
        $rk->rencana_kegiatan_header_id = $input['id'];
        $rk->kegiatan_id = $kegiatan->id;
        $rk->pekerjaan = $input['pekerjaan'];
        $rk->pagu = $input['pagu'];
        $rk->sumber_anggaran_id = $input['sumber_anggaran_id'];
        $rk->pelaksana = $input['pelaksana'];
        $rk->save();
        return Response()->json($input);
    }

    public function loaddata()
    {
        $rk = DB::table('rencana_kegiatan_header')
        ->join('desas','desas.id','rencana_kegiatan_header.desa_id')
        ->select(
            'rencana_kegiatan_header.id',
            'rencana_kegiatan_header.tahun',
            'desas.namadesa',
        )
        ->get();

        $data['tbody']="";
        $no=1;
        foreach ($rk as $val) {
            
            $tr =  "<tr>"
                    ."<td scope='row'>".$no++."</td>"
                    ."<td>".$val->tahun."</td>"
                    ."<td>".$val->namadesa."</td>"
                    ."<td width='100px'>"
                        ."<a href='".url('rKegiatan/print',$val->id)."' target='_blank' class='btn btn-sm  text-left btn-primary'>"
                        ."<i class='fa fa-print'></i> </a> "
                        ."<a href='".url('rKegiatan/form/edit',$val->id)."' class='btn btn-sm  text-left btn-success'>"
                        ."<i class='fa fa-edit'></i> </a> "
                        ."<a href='".url('rKegiatan/delete',$val->id)."' class='btn btn-sm  text-left btn-danger' onclick='delete(".$val->id.")'>"
                        ."<i class='fa fa-trash'></i> </a> "
                    ."</td>"
                    ."</tr>";
            $data['tbody'] .=$tr;

        }
        return Response()->json($data);
    }

    public function print($id)
    {
        $data['title'] = 'RENCANA KEGIATAN';
        $data['rk'] = DB::table('rencana_kegiatan_header')
        ->join('desas','desas.id','rencana_kegiatan_header.desa_id')
        ->where('rencana_kegiatan_header.id',$id)
        ->first();

        $data['item_rk']=DB::table('rencana_kegiatans')
        ->join("sumber_anggarans","sumber_anggarans.id","rencana_kegiatans.sumber_anggaran_id")
        ->join("kegiatans","rencana_kegiatans.kegiatan_id","kegiatans.id")
        ->join("bidangs","kegiatans.bidang_id","bidangs.id")
        ->join("sub_bidangs","kegiatans.sub_bidang_id","sub_bidangs.id")
        ->where("rencana_kegiatans.rencana_kegiatan_header_id",$id)
        ->get();

        // /dd($data);

        $pdf = PDF::loadView('transaksi.rencanakegiatan.laporan', $data)->setPaper('a4', 'landscape');;
        return $pdf->download('rencanakegiatan.pdf');
    }

    public function form_edit($id){
        $data['title'] = 'RENCANA KEGIATAN';
        $data['desa'] = desa::all();
        $data['sumberAnggaran'] = sumberAnggaran::all();
        $data['bidang'] = bidang::all();
        $data['rkheader'] = RencanaKegiatanHeader::where('id',$id)->first();
        return view('transaksi.rencanakegiatan.form-edit', $data);
    }
    public function delete($id)
    {
        RencanaKegiatanHeader::where('id',$id)->delete();
        RencanaKegiatan::where('rencana_kegiatan_header_id',$id)->delete();
        return redirect()->route('rKegiatan')->with('message', 'Success!');
    }

    public function deleteitem(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        RencanaKegiatan::where('id',$id)->delete();
        return Response()->json($input);
    }

    public function loaddataitem(Request $request)
    {
        $input = $request->all();
        $id=$input['id'];
        $item_rk=DB::table('rencana_kegiatans')
        ->join("sumber_anggarans","sumber_anggarans.id","rencana_kegiatans.sumber_anggaran_id")
        ->join("kegiatans","rencana_kegiatans.kegiatan_id","kegiatans.id")
        ->join("bidangs","kegiatans.bidang_id","bidangs.id")
        ->join("sub_bidangs","kegiatans.sub_bidang_id","sub_bidangs.id")
        ->where("rencana_kegiatans.rencana_kegiatan_header_id",$id)
        ->select(
            'rencana_kegiatans.id',
            'rencana_kegiatans.pekerjaan',
            'rencana_kegiatans.pagu',
            'sumber_anggarans.kode',
            'kegiatans.kegiatan',
            'bidangs.bidang',
            'sub_bidangs.sub_bidang',
            'rencana_kegiatans.pelaksana'

        )
        ->get();

        $data['tbody']="";
        $no=1;
        foreach ($item_rk as $val) {
            
            $tr =  "<tr>"
                    ."<td scope='row'>".$no++."</td>"
                    ."<td>".$val->bidang."</td>"
                    ."<td>".$val->sub_bidang."</td>"
                    ."<td>".$val->kegiatan."</td>"
                    ."<td>".$val->pekerjaan."</td>"
                    ."<td>".$val->pelaksana."</td>"
                    ."<td>".number_format($val->pagu,2,",",".")."</td>"
                    ."<td>".$val->kode."</td>"
                    ."<td width='100px'>"

                        ."<a class='btn btn-sm btn-danger' onclick='deleteitem(".$val->id.")'>"
                        ."<i class='fa fa-trash'></i></a>"
                        
                    ."</td>"
                    ."</tr>";
            $data['tbody'] .=$tr;

         
        }
        return Response()->json($data);

    }

    
}
