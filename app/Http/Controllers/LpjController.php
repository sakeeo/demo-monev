<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\desa;
use App\Models\faktur;
use App\Models\pemesanan;
use App\Models\RencanaKegiatan;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class LpjController extends Controller
{
    public function index()
    {
    
        $data['title'] = 'LAPORAN PERTANGGUNG JAWABAN';
        $data['pemesanan'] = pemesanan::getPemesanan();
        //dd($data);
        return view('transaksi.lpj.index', $data);
    
    }

    public function form()
    {
        $data['title'] = 'FORM INPUT LPJ';
        $data['desa'] = desa::all();
        
        return view('transaksi.lpj.form', $data);
    }

    public function getpekerjaan(Request $request)
    {
        $input = $request->all();
        $kegiatan = pemesanan::getkegiatan($input['desa_id']);

        $data="";
        foreach ($kegiatan as $item) {
            $data .= "<option value=".$item->id.">".$item->pekerjaan."</option>";
        }
        return Response()->json($data);
    }
    public function getpelaksana(Request $request){
       $input = $request->all();
       $namapelaksana='';
       if(isset($input['id'])){
        $pelaksana = RencanaKegiatan::where('id',$input['id'])->select('pelaksana')->first();
       $namapelaksana = $pelaksana->pelaksana;
       }
       return Response()->json($namapelaksana);
    }

    public function submit(Request $request)
    {
        $input = $request->all();
        $pemesanan = new pemesanan();
        foreach ($input as $key => $val) {
            if($key != 'items'){
                $pemesanan->$key = $val;
            } 
        }
        $pemesanan->tgl_pemesanan = date('Y-m-d');
        $pemesanan->save();
        
        foreach ($input['items'] as $k ) {
           
            $item = new barang();
            foreach ($k as $f => $g) {
                if($f != 'total'){
                    $item->$f = $g;
                }
                $item->pemesanan_id = $pemesanan->id;
            }
            $item->save();
        }
        return Response()->json($input);

    }

    public function print_pemesanan($id){
        $data['title'] = 'Surat Pemesanan';
        $data['pms'] = pemesanan::getDetailPemesananByid($id);
        $data['dps'] = barang::where('pemesanan_id',$id)->get();

        $ada = faktur::where('pemesanan_id',$id)->exists();
         if(!$ada){
            return redirect()->route('lpj.form.faktur',$id)->with('message', 'Masukkan Nomor faktur terlebih dahulu!');
        } 
        $data['faktur'] = faktur::getdatabyid($id);
        $data['detailFaktur'] = barang::where('pemesanan_id',$id)->get();

        $pdf = PDF::loadView('transaksi.lpj.surat-pemesanan', $data)->setPaper('a4', 'portrait');;
        return $pdf->download('Surat Pemesanan.pdf');

        //return view('transaksi.lpj.surat-pemesanan', $data);
    }

    // public function print_faktur($id)
    // {   
        
    //     if(!$ada){
    //         return redirect()->route('lpj.form.faktur',$id)->with('message', 'Masukkan Nomor faktur terlebih dahulu!');
    //     } else {
    //         $data['title'] = "faktur";
    //         $data['faktur'] = faktur::getdatabyid($id);
    //         $data['detailFaktur'] = barang::where('pemesanan_id',$id)->get();
    //         $pdf = PDF::loadView('transaksi.lpj.faktur', $data)->setPaper('a4', 'portrait');;
    //         return $pdf->download('Faktur.pdf');
    //     }
    // }

    public function form_faktur($id)
    {
        $data['title'] = 'FORM INPUT NOMOR FAKTUR';
        $data['pemesanan_id'] = $id;
        return view('transaksi.lpj.form-faktur', $data);
    }

    public function simpan_faktur(Request $request)
    {
        $input = $request->all();
        $faktur = new faktur();
        $faktur->nomor = $input['nomor'];
        $faktur->tanggal = $input['tanggal'];
        $faktur->pemesanan_id = $input['pemesanan_id'];
        $faktur->save();

        return redirect()->route('lpj.print.faktur',$faktur->id);
    }

    // public function print_st($id)
    // {   
        
           
    //         $data['title'] = "SERAH TERIMA";
    //         $data['pms'] = pemesanan::getDetailPemesananByid($id);
    //         $data['dps'] = barang::where('pemesanan_id',$id)->get();
    //         $pdf = PDF::loadView('transaksi.lpj.serahterima', $data)->setPaper('a4', 'portrait');;
    //         return $pdf->download('SerahTerima.pdf');
        
    // }

    public function print_spk($id)
    {   
        
            $data['title'] = "SPK";
            $data['pms'] = pemesanan::getDetailPemesananByid($id);
            $data['dps'] = barang::where('pemesanan_id',$id)->get();

            $data['total']=0;
            foreach ($data['dps'] as $item ) {
                $data['total'] += ($item->harga*$item->qty);
            }
            $data['terbilang'] = faktur::terbilang($data['total']);


            $pdf = PDF::loadView('transaksi.lpj.spk', $data)->setPaper('a4', 'portrait');;
            return $pdf->download('spk.pdf');

            //return view('transaksi.lpj.spk', $data);
        
    }


    
    
}
