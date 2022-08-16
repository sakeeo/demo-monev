<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\bidang;
use App\Models\kegiatan;
use App\Models\subBidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class BidangKegiatanController extends Controller
{
    public function index()
    {
        $data['title'] = 'BIDANG KEGIATAN';
        $data['kegiatan'] = kegiatan::getData();
        return view('master.bidangKegiatan.index', $data);
    }

    public function form()
    {
        $data['title'] = 'BIDANG KEGIATAN';
        $data['bidang'] = bidang::all();
        $data['sub_bidang'] = subBidang::all();
        return view('master.bidangKegiatan.form', $data);
    }

    public function form_edit($id)
    {
        $data['title'] = 'BIDANG KEGIATAN';
        $data['bidang'] = bidang::all();
        $data['sub_bidang'] = subBidang::all();
        $data['old'] = DB::table('kegiatans')
        ->join('bidangs','bidangs.id','kegiatans.bidang_id')
        ->join('sub_bidangs','sub_bidangs.id','kegiatans.sub_bidang_id')
        ->where('kegiatans.id',$id)
        ->first();
        return view('master.bidangKegiatan.form-edit', $data);
    }

    public function print()
    {
        $data['title'] = 'DATA BIDANG KEGIATAN';
        $data['kegiatan'] = kegiatan::getData();

        $pdf = PDF::loadView('master.bidangKegiatan.laporan', $data)->setPaper('a4', 'portrait');;
        return $pdf->download('bidangkegiatan.pdf');
    }

    public function simpan(Request $request)
    {
        $input = $request->all();
        $bidang_id='';
        
        $bidang_exist = bidang::where('bidang', $input['bidang'])->exists();
        if($bidang_exist){
            $bidang = bidang::where('bidang', $input['bidang'])->get()->first();
            $bidang_id = $bidang->id;
        } else {
            $bidang = new bidang;
            $bidang->bidang = $input['bidang'];
            $bidang->save();
            $bidang_id = $bidang->id;
        }

        $sub_bidang_id='';
        $sub_bidang_exist = subBidang::where('sub_bidang', $input['sub_bidang'])
        ->where('bidang_id', $bidang_id)
        ->exists();
        if($sub_bidang_exist){
            $sub_bidang = subBidang::where('sub_bidang', $input['sub_bidang'])
            ->where('bidang_id', $bidang_id)
            ->get()->first();
            $sub_bidang_id = $sub_bidang->id;
        } else {
            $sub_bidang = new subBidang;
            $sub_bidang->sub_bidang = $input['sub_bidang'];
            $sub_bidang->bidang_id = $bidang_id;
            $sub_bidang->save();
            $sub_bidang_id = $sub_bidang->id;
        }

        $kegiatan = new kegiatan;
        $kegiatan->bidang_id    = $bidang_id;
        $kegiatan->sub_bidang_id = $sub_bidang_id;
        $kegiatan->kegiatan      = $input['kegiatan'];
 
        DB::beginTransaction();
        try {
            $kegiatan->save();
            DB::commit();
        } catch (\Throwable $th) {
            return redirect()->route('data.bidangKegiatan')->with('message', 'Error!');
            DB::rollBack();
        }
        return redirect()->route('data.bidangKegiatan')->with('message', 'Success!');
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $bidang_id='';
        
        $bidang_exist = bidang::where('bidang', $input['bidang'])->exists();
        if($bidang_exist){
            $bidang = bidang::where('bidang', $input['bidang'])->get()->first();
            $bidang_id = $bidang->id;
        } else {
            $bidang = new bidang;
            $bidang->bidang = $input['bidang'];
            $bidang->save();
            $bidang_id = $bidang->id;
        }

        $sub_bidang_id='';
        $sub_bidang_exist = subBidang::where('sub_bidang', $input['sub_bidang'])
        ->where('bidang_id', $bidang_id)
        ->exists();
        if($sub_bidang_exist){
            $sub_bidang = subBidang::where('sub_bidang', $input['sub_bidang'])
            ->where('bidang_id', $bidang_id)
            ->get()->first();
            $sub_bidang_id = $sub_bidang->id;
        } else {
            $sub_bidang = new subBidang;
            $sub_bidang->sub_bidang = $input['sub_bidang'];
            $sub_bidang->bidang_id = $bidang_id;
            $sub_bidang->save();
            $sub_bidang_id = $sub_bidang->id;
        }

        $data = [
            'bidang_id' =>  $bidang_id,
            'sub_bidang_id' => $sub_bidang_id,
            'kegiatan' => $input['kegiatan'],
        ];
        
        DB::beginTransaction();
        try {
            kegiatan::where('id',$input['id'])->update($data);
            DB::commit();
        } catch (\Throwable $th) {
            return redirect()->route('data.bidangKegiatan')->with('message', 'Error!');
            DB::rollBack();
        }
        return redirect()->route('data.bidangKegiatan')->with('message', 'Success!');
    }


    public function hapus($id)
    {
        kegiatan::where('id',$id)->delete();
        return redirect()->route('data.bidangKegiatan')->with('message', 'Success!');
    }


}
