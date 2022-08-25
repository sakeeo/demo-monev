<?php

use App\Http\Controllers\DasboardController;
use App\Http\Controllers\LpjController;
use App\Http\Controllers\Master\BidangKegiatanController;
use App\Http\Controllers\Master\DesaController;
use App\Http\Controllers\Master\SumberAnggaranController;
use App\Http\Controllers\paguAnggaranController;
use App\Http\Controllers\RagController;
use App\Http\Controllers\RrkController;
use App\Http\Controllers\RealisasiAnggaranController;
use App\Http\Controllers\RealisasiKegiatanController;
use App\Http\Controllers\RencanaKegiatanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home', ['title' => 'Home']);
// })->name('home');

Route::controller(DasboardController::class)->group(function(){
    Route::get('/','index')->name('home');
    Route::get('/chart','chart')->name('chart');
});

Route::controller(UserController::class)->group(function(){
    Route::get('register','register')->name('register');
    Route::post('register','register_action')->name('register.action');
    Route::post('register','update_action')->name('update.action');
    Route::get('login','login')->name('login');
    Route::post('login','login_action')->name('login.action');
    Route::get('password','password')->name('password');
    Route::post('password','password_action')->name('password.action');
    Route::get('logout','logout')->name('logout');
    Route::get('users','users')->name('data.user');
    Route::get('users/form/edit/{id}','form_edit')->name('form.edit.user');
    Route::get('users/hapus/{id}','hapus')->name('hapus.user');
});
Route::controller(DesaController::class)->group(function(){
    Route::get('/master/desa','index')->name('data.desa');
    Route::get('/master/desa/form','form')->name('form.add.desa');
    Route::get('/master/desa/print','print')->name('print.desa');
    Route::post('/master/desa/simpan','simpan')->name('simpan.desa');
    Route::post('/master/desa/update','update')->name('update.desa');
    Route::get('/master/desa/hapus/{id}','hapus')->name('hapus.desa');
    Route::get('/master/desa/form/edit/{id}','form_edit')->name('form.edit.desa');
});
Route::controller(BidangKegiatanController::class)->group(function(){
    Route::get('/master/bidangKegiatan','index')->name('data.bidangKegiatan');
    Route::get('/master/bidangKegiatan/form','form')->name('form.add.bidangKegiatan');
    Route::get('/master/bidangKegiatan/print','print')->name('print.bidangKegiatan');
    Route::post('/master/bidangKegiatan/simpan','simpan')->name('simpan.bidangKegiatan');
    Route::post('/master/bidangKegiatan/update','update')->name('update.bidangKegiatan');
    Route::get('/master/bidangKegiatan/hapus/{id}','hapus')->name('hapus.bidangKegiatan');
    Route::get('/master/bidangKegiatan/form/edit/{id}','form_edit')->name('form.edit.bidangKegiatan');
});
Route::controller(SumberAnggaranController::class)->group(function(){
    Route::get('/master/sumberAnggaran','index')->name('data.sumberAnggaran');
    Route::get('/master/sumberAnggaran/form','form')->name('form.add.sumberAnggaran');
    Route::get('/master/sumberAnggaran/print','print')->name('print.sumberAnggaran');
    Route::post('/master/sumberAnggaran/simpan','simpan')->name('simpan.sumberAnggaran');
    Route::post('/master/sumberAnggaran/update','update')->name('update.sumberAnggaran');
    Route::get('/master/sumberAnggaran/hapus/{id}','hapus')->name('hapus.sumberAnggaran');
    Route::get('/master/sumberAnggaran/form/edit/{id}','form_edit')->name('form.edit.sumberAnggaran');
});
Route::controller(paguAnggaranController::class)->group(function(){
    Route::get('/paguAnggaran','index')->name('paguAnggaran');
    Route::get('/paguAnggaran/form','form')->name('form.add.pagu');
    Route::get('/paguAnggaran/detail/{id}','detail')->name('detail.pagu');
    Route::post('/paguAnggaran/update','update')->name('update.pagu');
    Route::get('/paguAnggaran/hapus/{id}','hapus')->name('hapus.pagu');
    Route::get('/paguAnggaran/hapus/item/{id}/{pagu_id}','hapus_item')->name('hapus.item.pagu');
    Route::post('/paguAnggaran/addNewItem','addNewItem')->name('addnew.item.pagu');
    Route::get('/paguAnggaran/form/edit/{id}','form_edit')->name('form.edit.pagu');
    Route::post('/paguAnggaran/simpan','simpan')->name('simpan.pagu');
    Route::post('/paguAnggaran/simpan/perubahan','simpan_perubahan')->name('simpan.perubahan.pagu');
});
Route::controller(RealisasiAnggaranController::class)->group(function(){
    Route::get('/realisasiAnggaran','index')->name('realisasiAnggaran');
    Route::get('/realisasiAnggaran/detail/{id}','detail')->name('realisasiAnggaran.detail');
    Route::get('/realisasiAnggaran/getdetail/{id}','getdetail')->name('realisasiAnggaran.getdetail');
    Route::post('/realisasiAnggaran/update','update')->name('realisasiAnggaran.update');
    Route::get('/realisasiAnggaran/print/{id}','print')->name('realisasiAnggaran.print');
});

Route::controller(RealisasiKegiatanController::class)->group(function(){
    Route::get('/realisasiKegiatan','index')->name('realisasiKegiatan');
    Route::get('/realKegiatan/loaddata','loaddata')->name('realKegiatan.loaddata');
    Route::get('/realKegiatan/print/{id}','print')->name('rKegiatan.print');
    Route::get('/realKegiatan/form/realisasi/{id}','form_realisasi')->name('rKegiatan.form.realisasi');
    Route::post('/realKegiatan/loaddataitem','loaddataitem')->name('realKegiatan.loaddataitem');
    Route::post('/realKegiatan/updatedetail','updatedetail')->name('realKegiatan.updatedetail');
    Route::post('/realKegiatan/upload','upload')->name('realKegiatan.upload');
    Route::get('/realKegiatan/download/{id}','download')->name('rKegiatan.download');
    Route::get('/realKegiatan/remove/{id}','remove')->name('rKegiatan.remove');

});

Route::controller(RencanaKegiatanController::class)->group(function(){
    Route::get('/rKegiatan','index')->name('rKegiatan');
    Route::get('/rKegiatan/form','form')->name('rKegiatan.form');
    Route::post('/rKegiatan/getSubbidang','getSubbidang')->name('rKegiatan.getSubbidang');
    Route::post('/rKegiatan/getKegiatan','getKegiatan')->name('rKegiatan.getKegiatan');
    Route::post('/rKegiatan/updateHeader','updateHeader')->name('rKegiatan.updateHeader');
    Route::post('/rKegiatan/additem','additem')->name('rKegiatan.additem');
    Route::get('/rKegiatan/loaddata','loaddata')->name('rKegiatan.loaddata');
    Route::get('/rKegiatan/print/{id}','print')->name('rKegiatan.print');
    Route::get('/rKegiatan/form/edit/{id}','form_edit')->name('rKegiatan.form.edit');
    Route::post('/rKegiatan/loaddataitem','loaddataitem')->name('rKegiatan.loaddataitem');
    Route::post('/rKegiatan/deleteitem','deleteitem')->name('rKegiatan.deleteitem');
    Route::get('/rKegiatan/delete/{id}','delete')->name('rKegiatan.delete');

    Route::post('/rKegiatan/getpelaksana','getpelaksana')->name('rKegiatan.getpelaksana');

    
});

Route::controller(RagController::class)->group(function(){
    Route::get('/rag','index')->name('rag');
    Route::post('/rag/getdata','getdata')->name('rag.getdata');
    Route::post('/rag/print','print')->name('rag.print');
});

Route::controller(RrkController::class)->group(function(){
    Route::get('/rrk','index')->name('rrk');
    Route::post('/rrk/getdata','getdata')->name('rrk.getdata');
    Route::post('/rrk/print','print')->name('rrk.print');
});


Route::controller(LpjController::class)->group(function(){
    Route::get('/lpj','index')->name('lpj');
    Route::get('/lpj/form','form')->name('lpj.form');
    Route::post('/lpj/getpekerjaan','getpekerjaan')->name('lpj.getpekerjaan');
    Route::post('/lpj/getpelaksana','getpelaksana')->name('lpj.getpelaksana');
    Route::post('/lpj/submit','submit')->name('lpj.submit');
    Route::post('/lpj/simpan/faktur','simpan_faktur')->name('lpj.simpan.faktur');
    Route::get('/lpj/print/pemesanan/{id}','print_pemesanan')->name('lpj.print.pemesanan');
    Route::get('/lpj/print/faktur/{id}','print_faktur')->name('lpj.print.faktur');
    Route::get('/lpj/print/st/{id}','print_st')->name('lpj.print.st');
    Route::get('/lpj/print/spk/{id}','print_spk')->name('lpj.print.spk');
    Route::get('/lpj/form/faktur/{id}','form_faktur')->name('lpj.form.faktur');
});