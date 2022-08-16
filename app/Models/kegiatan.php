<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class kegiatan extends Model
{
    use HasFactory;
    static function getData()
    {
       $result = DB::table('kegiatans')
        ->join('bidangs','bidangs.id','kegiatans.bidang_id')
        ->join('sub_bidangs','sub_bidangs.id','kegiatans.sub_bidang_id')
        ->select(
            'kegiatans.kegiatan',
            'kegiatans.bidang_id',
            'kegiatans.id',
            'kegiatans.sub_bidang_id',
            'bidangs.bidang',
            'sub_bidangs.sub_bidang'
        )
        ->get();

        return $result;
    }
}
