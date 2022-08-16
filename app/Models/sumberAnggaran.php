<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class sumberAnggaran extends Model
{
    use HasFactory;
    static function getid($kode){
        return DB::table('sumber_anggarans')->select('id')->where('kode',$kode)->first();
    }
}
