<!DOCTYPE html>
<html>
<head>
    <title>REALISASI ANGGARAN</title>
</head>
<style>
   
    .page{
        width: 100%;
        align-content: center;
        height: 100%;
    }
    
    #box-kepada{
        position: absolute;
        right: 75;
        top: 140;
    }

    #box-nomor{
        width: 250px;
        position: relative;
    }
    #box-hormat{
        margin-left:78px;
        margin-right: 50px;
        margin-bottom: 50px
    }

    #box-mengetahui{
        width: 250px;
        position: relative;
        text-align: left;
        display: inline-block;
        margin-left: 70px;
        margin-top:60px
    }
    #box-pelaksana{
        width: 250px;
        position: absolute;
        text-align: center;
        right: 50;
    }

    .box-tanggal{
        text-align: right;
        margin-right:50px;
    }

    #box-header-faktur{
        margin-left: 450px;
        margin-bottom: 50px;
    }

    p {
    line-height:23px;
    }



</style>
<body>
@php
    $tgl = tanggal_indo(date('Y-m-d'),false);
 @endphp

    <div class="page">
        <table width='100%'>
            <tr>
                <td>
                    <img src="{{ public_path("image/logo_atam.png") }}" alt="" style="width: 100px;">
                </td>
                <td style="text-align: center;size: 5px;">
                    <div>
                        <span style="font-size: 21px;font-style: bold;">PEMERINTAH KABUPATEN TAMIANG<br>
                        KECAMATAN KECAMATAN BENDAHARA</span><br>
                        <span style="font-size: 23px;font-style: bold;">DATOK PENGHULU {{ $pms->namadesa }}</span><br>
                        <span style="margin-right: 200px;font-size: 12px;">Jalan : </span>
                        <span style="margin-right: 100px;font-size: 12px;">Nomor : </span>
                        <span style="font-size: 12px;">Kode Pos :</span><br>
                        <span style="font-size: 25px;font-style: bold;">{{ $pms->namadesa }}</span>
                    </div>
                </td>
            </tr>
        </table>
        <hr/>
        <div class="box-tanggal">
            <span>{{ucwords(strtolower($pms->namadesa))}} , {{ $tgl }}</span>
        </div>

        <div id="box-nomor">
        <table>
            <tr>
                <td>Nomor</td>
                <td>: {{$pms->id}}/SPM/{{date('m')}}/{{date('Y')}}</td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>: -</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>: Pemesanan Barang</td>
            </tr>
        </table>
        </div>

        <div id="box-kepada">
        <table>
            <tr>
                <td style="padding-left: 35px">Kepada</td>
            </tr>
            <tr>
                <td>Yth. {{ $pms->nama_suplier }}</td>
            </tr>
            <tr>
                <td style="padding-left: 35px">di - <br>
                    <span style="padding-left:35px">{{ $pms->alamat_suplier}}</span>
                </td>
            </tr>
        </table>
        </div>

        <div id="box-hormat">
            <p>Dengan hormat,</p>
            <p style="text-align: justify">&nbsp;&nbsp;&nbsp;&nbsp; Dengan ini kami harapkan kepada Saudara agar dapat menyediakan barang untuk 
                {{ ucwords(strtolower($pms->pekerjaan)) }} {{ucwords(strtolower($pms->namadesa))}}
                Kecamatan Bendahara Kabupaten Aceh Tamiang, tahun anggaran 
                {{ date('Y', strtotime($pms->tgl_pemesanan)) }}, 
                dengan rincian sebagai berikut :</p>

                <table width='100%' border="1px" cellspacing='0' cellpadding='5'>
                    <tr style="text-align: center">
                        <td>QTY</td>
                        <td>SATUAN</td>
                        <td>NAMA</td>
                    </tr>
                    @foreach ($dps as $item)
                    <tr style="text-align: center">
                        <td>{{ number_format($item->qty)}}</td>
                        <td>{{ $item->satuan}}</td>
                        <td>{{ $item->nama}}</td>
                    </tr>
                    @endforeach
                </table>
                <p>Demikian untuk dimaklumi, atas kerja samanya kami ucapkan terima kasih.</p>
        </div>

            <div id="box-mengetahui">
                Mengetahui :
                <br>
                Datok Pengulu
                <br/><br/><br/><br/>
                <b><u>{{$pms->kepaladesa}}</u></b>
            </div>
            <div id="box-pelaksana">
                Pelaksana Kegiatan
                <br>
                Kampung {{ucwords(strtolower($pms->namadesa))}}
                <br/><br/><br/><br/><b><u>{{$pms->pelaksana}}</u></b>
            </div>
        
    </div>


<!-- FAKTUR  -->
<div class="page">
    <div id="box-header-faktur">
        <span>{{ucwords(strtolower($pms->namadesa))}}, {{ $tgl }}</span><br><br>
        <span>Kepada Yth :</span><br>
        <span><b><u>Pelaksanan Kegiatan</u></b></span><br>
        <span><b><u>{{ucwords(strtolower($faktur->pekerjaan))}}</u></b></span><br>
        <span>di-</span><br><br>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b><u>{{ucwords(strtolower($pms->namadesa))}}</u></b></span>
    </div>

    <div>
        <span><b>BON FAKTUR NO. {{ $faktur->nomor}}</b></span>
        <br><br>
        <table width='100%' border="1px" cellspacing='0' cellpadding='5'>
            <tr style="text-align: center">
                <td >BANYAKNYA</td>
                <td>NAMA BARANG</td>
                <td>@<br>(Rp.)</td>
                <td>JUMLAH<br>HARGA<br>(Rp.)</td>
            </tr>
            @php
                $gt = 0 ; 
            @endphp
            @foreach ($detailFaktur as $item)
            <tr>
                <td style="text-align: center">{{ number_format($item->qty)}} {{ $item->satuan}}</td>
                <td style="text-align: left">{{ $item->nama}}</td>
                <td style="text-align: right">{{ number_format($item->harga)}}</td>
                <td style="text-align: right">{{ number_format($item->harga*$item->qty) }}</td>
            </tr>
            @php
                $gt += ($item->harga*$item->qty);
            @endphp
            @endforeach
            <tr>
                <td style="text-align: center"><b>TANDA TERIMA</b></td>
                <td style="text-align: center">
                    <div style="padding:2px;border:1px solid black">
                    <span>Catatan : Barang-barang yang sudah dibeli<br>
                        Tidak dapat dikembalikan</span>
                    </div>
                </td>
                <td>JUMLAH</td>
                <td style="text-align: right">{{number_format($gt)}}</td>
            </tr>
           </table>

    </div>
       
</div>
<!-- END OF FAKTUR  -->


<!-- serah terima -->
<div class="page">
    <div style="text-align: center">
        <h4>BERITA ACARA<br>
            <u>SERAH TERIMA BARANG/PEKERJAAN</u><br>
        </h4>
    </div>

        <div style="margin-left:50px;margin-right:50px">
        <table width='100%'>
            <tr>
                <td>
                    <p>
                        Pada hari ini {{ getNamaHari(date('Y-m-d'))}} Tanggal {{terbilang(date('d'))}} Bulan {{getNamaBulan(date('m'))}} Tahun {{terbilang(date('Y'))}}, kami yang bertanda tangan di bawah ini :
                    </p>
                </td>
            </tr>
        </table>
        
        <table width="100%" >
            <tr>
                <td style="vertical-align: top">1</td>
                <td>
                    <table  width="100%">
                        <tr>
                            <td width="100px">Nama</td>
                            <td>: {{ucwords(strtolower($pms->nama_suplier))}}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: {{ucwords(strtolower($pms->alamat_suplier))}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Selanjutnya disebut sebagai <b>Pihak Pertama<b></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top">2</td>
                <td>
                    <table  width="100%">>
                        <tr>
                            <td width="100px">Nama</td>
                            <td>: {{ucwords(strtolower($pms->pelaksana))}}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: {{ucwords(strtolower($pms->namadesa))}} Kec. Bendahara Kab. Tamiang</td>
                        </tr>
                        <tr>
                            <td colspan="2">Selanjutnya disebut sebagai <b>Pihak Kedua<b></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        
        <table width='100%'>
            <tr>
                <td>
                    <p>Pihak Pertama telah menyrahkan kepada Pihak Kedua dan Pihak Kedua telah menerima dari Pihak Pertama sesuai Surat Pesanan 
                        Nomor {{$pms->id}}/SPM/{{date('m')}}/{{date('Y')}}
                        pada tanggal {{tanggal_indo(date('Y-m-d'))}} dalam keadaan baik tanpa cacat.</p>
                   
                    <p>Demikian Berita Acara Serah Terima Barang/Pekerjaan ini dibuat dengan sebenar-benarnya untuk digunakan seperlunya</p>
                </td>
            </tr>
        </table>
    </div>
        
       <table width='100%'>
            <tr style="text-align: center">
                <td>PIHAK KE 2</td>
                <td>PIHAK KE 1</td>
            </tr>
            <tr style="text-align: center">
                <td><br/><br/><br/><br/><b><u>{{$pms->pelaksana}}</u></b></td>
                <td><br/><br/><br/><br/><b><u>{{$pms->nama_suplier}}</u></b></td>
            </tr>
        </table>
        <br><br><br>
        <table width='100%'>
            <tr style="text-align: center">
                <td>Mengetahui</td>
            </tr>
            <tr style="text-align: center">
                <td>Datok Penghulu</td>
            </tr>
            <tr style="text-align: center">
                <td><br/><br/><br/><br/><b><u>{{$pms->kepaladesa}}</u></b></td>
            </tr>
        </table>
</div>
<!-- end of serah terima -->
</body>
</html>