<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class paguAnggaran extends Model
{
    use HasFactory;

    static function getdata()
    {
        return DB::table('pagu_anggarans')
        ->join('desas','desas.id','pagu_anggarans.desa_id')
        ->select(
            'pagu_anggarans.id',
            'pagu_anggarans.tahun',
            'desas.namadesa'
        )
        ->get();

    }

    static function getdetail($id)
    {
        return DB::table('pagu_anggarans')
        ->join('desas','desas.id','pagu_anggarans.desa_id')
        ->where('pagu_anggarans.id',$id)
        ->first();

    }



    static function paguBerjalan($id)
    {
        return DB::table('pagu_anggaran_details')
        ->join('sumber_anggarans','sumber_anggarans.id','pagu_anggaran_details.sumber_anggaran_id')
        ->where('pagu_anggaran_details.pagu_anggaran_id',$id)
        ->where('pagu_anggaran_details.periode','tahun berjalan')
        ->select(
            'pagu_anggaran_details.pagu_anggaran_id',
            'pagu_anggaran_details.sumber_anggaran_id',
            'pagu_anggaran_details.jumlah',
            'pagu_anggaran_details.id',
            'sumber_anggarans.kode',
            'sumber_anggarans.uraian'
        )
        ->get();
    }
    static function paguSisa($id)
    {
        return DB::table('pagu_anggaran_details')
        ->join('sumber_anggarans','sumber_anggarans.id','pagu_anggaran_details.sumber_anggaran_id')
        ->where('pagu_anggaran_details.pagu_anggaran_id',$id)
        ->where('pagu_anggaran_details.periode','sisa tahun sebelumnya')
        ->select(
            'pagu_anggaran_details.pagu_anggaran_id',
             'pagu_anggaran_details.sumber_anggaran_id',
             'pagu_anggaran_details.jumlah',
             'pagu_anggaran_details.id',
             'sumber_anggarans.kode',
             'sumber_anggarans.uraian'
         )
        ->get();
    }
}
