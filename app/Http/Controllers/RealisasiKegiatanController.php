<?php

namespace App\Http\Controllers;

use App\Models\bidang;
use App\Models\desa;
use App\Models\RencanaKegiatan;
use App\Models\RencanaKegiatanHeader;
use App\Models\sumberAnggaran;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class RealisasiKegiatanController extends Controller
{
    public function index()
    {
        $data['title'] = 'REALISASI KEGIATAN';
        return view('transaksi.realisasiKegiatan.index', $data);
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
                        ."<a href='".url('realKegiatan/print',$val->id)."' target='_blank' class='btn btn-sm  text-left btn-primary'>"
                        ."<i class='fa fa-print'></i></a> "
                        ."<a href='".url('realKegiatan/form/realisasi',$val->id)."' class='btn btn-sm  text-left btn-success'>"
                        ."<i class='fa fa-edit'></i></a> "
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

        $pdf = PDF::loadView('transaksi.realisasiKegiatan.laporan', $data)->setPaper('a4', 'landscape');;
        return $pdf->download('realisasikegiatan.pdf');
    }

    public function form_realisasi($id){
        $data['title'] = 'REALISASI KEGIATAN';
        $data['desa'] = desa::all();
        $data['sumberAnggaran'] = sumberAnggaran::all();
        $data['bidang'] = bidang::all();
        $data['rkheader'] = RencanaKegiatanHeader::where('id',$id)->first();

        $data['item_rk']=DB::table('rencana_kegiatans')
        ->join("sumber_anggarans","sumber_anggarans.id","rencana_kegiatans.sumber_anggaran_id")
        ->join("kegiatans","rencana_kegiatans.kegiatan_id","kegiatans.id")
        ->join("bidangs","kegiatans.bidang_id","bidangs.id")
        ->join("sub_bidangs","kegiatans.sub_bidang_id","sub_bidangs.id")
        ->where("rencana_kegiatans.rencana_kegiatan_header_id",$id)
        ->select(
            'rencana_kegiatans.pekerjaan',
            'rencana_kegiatans.pagu',
            'rencana_kegiatans.id',
            'rencana_kegiatans.realisasi',
            'rencana_kegiatans.dokumentasi',
            'bidangs.bidang',
            'sub_bidangs.sub_bidang',
            'sumber_anggarans.kode',
            'kegiatans.kegiatan',
            'rencana_kegiatans.path',
        )
        ->get();
        return view('transaksi.realisasiKegiatan.form-realisasi', $data);
    }

    public function updatedetail(Request $request)
    {
        $input = $request->all();
        $h = explode("-",$input['id']);
        $i = explode(".",$input['jml']);
        $j=str_replace(",","",$i[0]);
        
        $k=$j.",".$i[1];
        $l=

        RencanaKegiatan::where('id',$h[1])->update(['realisasi'=>(float)$k]);
        return Response()->json($input);
    }


    public function upload(Request $request)
    {   
        $input = $request->all();
        $validator = FacadesValidator::make($input, [
            'file' => 'required|pdf|max:2048',
            'theID'=> 'required',
            'rkHeader'=> 'required',
        ]);
        $name = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->store('public');
        $xpath = explode("/",$path);
        RencanaKegiatan::where('id',$request['theID'])->update(
            [
                'dokumentasi' => $name,
                'path'  => $xpath[1]
            ]

        );

        return redirect()->route('rKegiatan.form.realisasi',$input['rkHeader'])
        ->with('success', 'Upload success.');

    }

    
    public function download($filename)
    {   
        $file=Storage::disk('public')->get($filename);
		return (new Response($file, 200))
              ->header('Content-Type', 'application/pdf');
    }

    public function remove($fileName)
    {   

        $path = 'storage/app/public/'.$fileName;
        $isExists = file_exists($path);
        $idheader = RencanaKegiatan::where('path',$fileName)->select('rencana_kegiatan_header_id')->first();
        RencanaKegiatan::where('path',$fileName)->update(
            [
                'dokumentasi' => "",
                'path'  =>""
            ]);

        if($isExists){
            unlink($path);
        }
        return redirect()->route('rKegiatan.form.realisasi',$idheader->rencana_kegiatan_header_id)
        ->with('success', 'File Remove success.');
        
    }
    
}
