<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RealisasiAnggaran extends Model
{
    use HasFactory;

    static function getdatabyidpagu($pagu_anggaran_id)
    {
       $rs = DB::table('realisasi_anggarans')
       ->join('pagu_anggaran_details','pagu_anggaran_details.id','realisasi_anggarans.pagu_anggaran_detail_id')
       ->join('sumber_anggarans','sumber_anggarans.id','pagu_anggaran_details.sumber_anggaran_id')
       ->where('realisasi_anggarans.pagu_anggaran_id',$pagu_anggaran_id)
       ->select(
        'realisasi_anggarans.id',
        'sumber_anggarans.kode',
        'realisasi_anggarans.tanggal1',
        'realisasi_anggarans.tanggal2',
        'realisasi_anggarans.tanggal3',
        'realisasi_anggarans.jumlah1',
        'realisasi_anggarans.jumlah2',
        'realisasi_anggarans.jumlah3',
       )
       ->get();

       return $rs;
    }
}
