<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class faktur extends Model
{
    use HasFactory;
    static function getdatabyid($id)
    {
        return DB::table('rencana_kegiatans')
        ->join('pemesanans','pemesanans.rencana_kegiatan_id','rencana_kegiatans.id')
        ->join('desas','pemesanans.desa_id','desas.id')
        ->join('fakturs','pemesanans.id','fakturs.pemesanan_id')
        ->select(
            'fakturs.nomor', 
            'fakturs.tanggal', 
            'desas.namadesa', 
            'rencana_kegiatans.pekerjaan', 
            'fakturs.pemesanan_id'
        )
        ->where('fakturs.pemesanan_id',$id)
        ->first();
    }

    static function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = faktur::penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = faktur::penyebut($nilai/10)." puluh". faktur::penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . faktur::penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = faktur::penyebut($nilai/100) . " ratus" . faktur::penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . faktur::penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = faktur::penyebut($nilai/1000) . " ribu" . faktur::penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = faktur::penyebut($nilai/1000000) . " juta" . faktur::penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = faktur::penyebut($nilai/1000000000) . " milyar" . faktur::penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = faktur::penyebut($nilai/1000000000000) . " trilyun" . faktur::penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	static function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(faktur::penyebut($nilai));
		} else {
			$hasil = trim(faktur::penyebut($nilai));
		}     		
		return $hasil;
	}

    
}
