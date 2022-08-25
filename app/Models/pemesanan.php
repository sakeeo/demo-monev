<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pemesanan extends Model
{
    use HasFactory;
    public $fields=[
        'pemesanans.tgl_mulai', 
        'pemesanans.tgl_selesai', 
        'pemesanans.nama_suplier', 
        'pemesanans.alamat_suplier', 
        'pemesanans.lokasi', 
        'desas.namadesa', 
        'desas.kepaladesa', 
        'desas.sekertaris', 
        'desas.keuangan', 
        'desas.kode_desa', 
        'desas.kaur_umum', 
        'desas.kasi_pemerintahan', 
        'desas.kaur_kesejahteraan', 
        'rencana_kegiatans.pekerjaan', 
        'rencana_kegiatans.pelaksana'
    ];

    static function getkegiatan($desa_id)
    {
        return DB::table('rencana_kegiatans')
        ->join('rencana_kegiatan_header','rencana_kegiatans.rencana_kegiatan_header_id','rencana_kegiatan_header.id')
        ->where('rencana_kegiatan_header.desa_id',$desa_id)
        ->select(
            'rencana_kegiatans.kegiatan_id',
            'rencana_kegiatans.id', 
            'rencana_kegiatan_header.desa_id', 
            'rencana_kegiatans.pekerjaan', 
            'rencana_kegiatans.pelaksana'
        )
        ->get();
    }

    static function getDetailPemesananByid($id){
        return DB::table('pemesanans')
        ->select(
            'pemesanans.id',
            'pemesanans.tgl_pemesanan',
            'pemesanans.tgl_mulai', 
            'pemesanans.tgl_selesai', 
            'pemesanans.nama_suplier', 
            'pemesanans.alamat_suplier', 
            'pemesanans.lokasi', 
            'desas.namadesa', 
            'desas.kepaladesa', 
            'desas.sekertaris', 
            'desas.keuangan', 
            'desas.kode_desa', 
            'desas.kaur_umum', 
            'desas.kasi_pemerintahan', 
            'desas.kaur_kesejahteraan', 
            'rencana_kegiatans.pekerjaan', 
            'rencana_kegiatans.pelaksana'
        )
        ->join('desas','pemesanans.desa_id','desas.id')
        ->join('rencana_kegiatans','pemesanans.rencana_kegiatan_id','rencana_kegiatans.id')
        ->where('pemesanans.id',$id)
        ->first();
    }

    static function getPemesanan(){
        return DB::table('pemesanans')
        ->select(
            'pemesanans.id',
            'pemesanans.tgl_pemesanan',
            'pemesanans.tgl_mulai', 
            'pemesanans.tgl_selesai', 
            'pemesanans.nama_suplier', 
            'pemesanans.alamat_suplier', 
            'pemesanans.lokasi', 
            'desas.namadesa', 
            'desas.kepaladesa', 
            'desas.sekertaris', 
            'desas.keuangan', 
            'desas.kode_desa', 
            'desas.kaur_umum', 
            'desas.kasi_pemerintahan', 
            'desas.kaur_kesejahteraan', 
            'rencana_kegiatans.pekerjaan', 
            'rencana_kegiatans.pelaksana'
        )
        ->join('desas','pemesanans.desa_id','desas.id')
        ->join('rencana_kegiatans','pemesanans.rencana_kegiatan_id','rencana_kegiatans.id')
        ->get();
    }
}
