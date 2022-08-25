<!DOCTYPE html>
<html>
<head>
    <title>REALISASI ANGGARAN</title>
</head>
<style>
   
    .header{
        width: 100%;
        text-align: center;
    }

    p {
    line-height:30px;
    }

    body {
        margin-left:50px;
        margin-right: 50px;
    }


</style>
<body>
    <div class="header">
        <h3 style="margin-bottom:0px"><u>SURAT PERJANJIAN</u></h3>
        <span>NOMOR : {{$pms->id}}/SPK/{{date('m')}}/{{date('Y')}}</span>
 

      
        <table width='100%'>
            <tr>
                <td>
                    <p>
                        Pada hari ini {{getNamaHari(date('Y-m-d'))}} Tanggal {{terbilang(date('d'))}} Bulan {{getNamaBulan(date('m'))}} Tahun {{terbilang(date('Y'))}} bertempat di Kantor Datok Peenghulu {{ucwords(strtolower($pms->namadesa))}}, kami yang bertanda tangan di bawah ini :
                    </p>
                </td>
            </tr>
        </table>
        
        <table width="100%" >
            <tr>
                <td style="vertical-align: top">1</td>
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
                            <td>Jabatan</td>
                            <td>: Ketua TPK</td>
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
                            <td colspan="2">Selanjutnya disebut sebagai <b>Pihak Kedua<b></td>
                        </tr>
                    </table>
                </td>
            </tr>
            
        </table>
        
        <table width='100%' cellpadding='5'>
            <tr style="text-align: justify">
                <td>
                    <p>Bahwa Pihak Pertama memberikan Pekerjaan kepada Pihak Kedua dan Pihak Kedua menerima Pekerjaan dari Pihak Pertama dan menyatakan bersedia, setuju dan sanggup untuk melaksanakan pekerjaan dengan ketentuan sebagai berikut :</p>
                </td>
            </tr>
            <tr style="text-align: center">
                <td><b>Pasal 1<br>
                    RUANG LINGKUP PEKERJAAN<b></td>
            </tr>
            <tr style="text-align: justify">
                <td><p>
                    Ruang Lingkup Pekerjaan dalam Perjanjian ini adalah :<br>
                    1. Jenis Pekerjaan : {{ $pms->pekerjaan }}<br>
                    2. Lokasi Pekerjaan : Kampung {{ ucwords(strtolower($pms->namadesa)) }}
                </p>
                </td>
            </tr>
            <tr style="text-align: center">
                <td><b>Pasal 2<br>
                    NILAI PEKERJAAN<b></td>
            </tr>

            <tr style="text-align: justify">
                <td><p>
                    Nilai Pekerjaan yang disepakati untuk penyelesaian pekerjaan dalam perjanjian ini 
                    adalah sebesar Rp. {{number_format($total)}} belum termasuk pajak dan bea materai, dengan rincian sebagai berikut :
                </p>
                </td>
            </tr>
            <tr style="text-align: center">
                <td>
                    <table width='100%' border="1px" cellspacing='0' cellpadding='5'>
                        <tr style="text-align: center">
                            <td >BANYAKNYA</td>
                            <td>NAMA BARANG</td>
                            <td>@<br>(RP)</td>
                            <td>JUMLAH<br>(RP)</td>
                        </tr>
                        @foreach ($dps as $item)
                        <tr>
                            <td style="text-align: center">{{ number_format($item->qty)}} {{ $item->satuan}}</td>
                            <td>{{ $item->nama}}</td>
                            <td style="text-align: right">{{ number_format($item->harga)}}</td>
                            <td style="text-align: right">{{ number_format($item->harga*$item->qty) }}</td>
                        </tr>
                        @endforeach
                        <tr style="text-align: right">
                            <td colspan="3">JUMLAH</td>
                            <td>{{number_format($total)}}</td>
                        </tr>
                    </table>
                    
                </td>
            </tr>

            <tr style="text-align: center">
                <td><b>Pasal 3<br>
                    JANGKA WAKTU PELAKSANAAN PEKERJAAN<b></td>
            </tr>
            
            @php
                $tgl1 = strtotime($pms->tgl_mulai); 
                $tgl2 = strtotime($pms->tgl_selesai); 
                $jarak = $tgl2 - $tgl1;
                $jmlhari = $jarak / 60 / 60 / 24;
            @endphp

            <tr style="text-align: justify">
                <td><p>
                    Jangka waktu pelaksanaan pekerjaan sebagaimana dimaksud dalam pasal 2 Surat Perjanjian 
                    ini adalah selama {{$jmlhari}} {{terbilang($jmlhari)}} hari kalender sejak tanggal {{tanggal_indo($pms->tgl_mulai)}} dan seluruh 
                    pekerjaan sudah harus diselesaikan dan diserahkan oleh PIHAK KEDUA dan diterima PIHAK PERTAMA 
                    paling lambat tanggal {{tanggal_indo($pms->tgl_selesai)}}</p></td>
            </tr>

            <tr style="text-align: center">
                <td><b>Pasal 4<br>
                    SERAH TERIMA PEKERJAAN<b></td>
            </tr>
            <tr style="text-align: justify">
                <td>
                    <p>(1) PIHAK KEDUA menyerahkan hasil pekerjaan secara tertulis kepada PIHAK PERTAMA setelah pekerjaan selesai 100% (seratus persen)</p>
                <td>
            </tr>
            <tr style="text-align: justify">
                <td>
                    <p>(2) PIHAK PERTAMA menerima penyerahan hasil pekerjaan dari PIHAK KEDUA setelah dilakukan penelitian oleh Panitia Penerima Hasil Pekerjaan.</p>
                <td>
            </tr>
            <tr style="text-align: justify">
                <td>
                    <p>(3) Dalam hal terdapat ketidaksesuaian hasil pekerjaan, berdasarkan penelitian Panitia Penerima Hasil Pekerjaan, PIHAK KEDUA wajib memperbaiki/menyesuaikan sesuai dengan perjanjian.</p>
                <td>
            </tr>


            <tr style="text-align: center">
                <td><b>Pasal 5<br>
                    CARA PEMBAYARAN<b></td>
            </tr>
            <tr style="text-align: justify">
                <td>
                    <p>(1) Pembayaran dilakukan PIHAK PERTAMA kepada PIHAK KEDUA setelah menyelesaikan seluruh pekerjaan 100% (seratus persen) dibuktikan dengan Berita Acara Penelitian hasil pekerjaan.</p>
                <td>
            </tr>
            <tr style="text-align: justify">
                <td>
                    <p>Pembayaran dilakukan dengan cara pembayaran tunai sebesar Rp. {{number_format($total)}} ({{terbilang($total)}} Rupiah) selanjutnya dikurangi pajak sesuai dengan ketentuan perundang-undangan.</p>
                <td>
            </tr>

            <tr style="text-align: center">
                <td><b>Pasal 6<br>
                    HAK DAN KEWAJIBAN<b></td>
            </tr>

            <tr style="text-align: justify">
                <td>
                    <p>(1) PIHAK PERTAMA berhak mengawasi pekerjaan yang dilaksanakan PIHAK KEDUA, memberikan instruksi kepada PIHAK KEDUA, menangguhkan pembayaran dan mengenakan denda keterlambatan dan berkewajiban untuk membayar biaya penyelesaian pekerjaan.</p>
                <td>
            </tr>

            <tr style="text-align: justify">
                <td>
                    <p>(2) PIHAK KEDUA berhak menerima pembayaran atas penyelesaian pekerjaam, dan berkewajiban untuk melaksanakan dan menyelesaikan pekerjaan sesuai jadwal pelaksanaan pekerjaan dan menyerahkan hasil pekerjaan tepat waktu sesuai perjanjian.</p>
                <td>
            </tr>

            <tr style="text-align: center">
                <td><b>Pasal 7<br>
                    FORCE MAJEURE<b></td>
            </tr>

            <tr style="text-align: justify">
                <td>
                    <p>(1) Yang dimaksud dengan force majeure adalah suatu keadaan yang terjadi di luar kemampuan PARA PIHAK yang tidak dapat diperhitungkan sebelumnya.</p>
                <td>
            </tr>

            <tr style="text-align: justify">
                <td>
                    <p>(2) Apabila terjadi keadaan force majeure sebagaimana dimaksud ayat (1) Pasal ini, maka PARA PIHAK terbebas dari kewajiban yang harus dilaksanakan.</p>
                <td>
            </tr>
            <tr style="text-align: center">
                <td><b>Pasal 8<br>
                    SANKSI<b></td>
            </tr>

            <tr style="text-align: justify">
                <td>
                    <p>Apabila penyelesaian pekerjaan melebihi batas waktu yang disepakati maka PIHAK KEDUA harus membayar denda keterlambatan sebesar 1/1000 (satu perseribu) dari nilai perjanjian untuk setiap hari keterlambatan.</p>
                <td>
            </tr>

            <tr style="text-align: center">
                <td><b>Pasal 9<br>
                    PENGHENTIAN DAN PEMUTUSAN PERJANJIAN<b></td>
            </tr>
            <tr style="text-align: justify">
                <td>
                    <p>(1) Penghentian Perjanjian dapat dilakukan karena pekerjaan sudah selesai.</p>
                <td>
            </tr>
            <tr style="text-align: justify">
                <td>
                    <p>(2) Penghentian Perjanjian dilakukan karena terjadinya keadaan kahar(force majeure) dan dalam hal ini PIHAK PERTAMA wajib membayar perlaksanaan pekerjaan kepada PIHAK KEDUA sesuai dengan kemajuan perlaksanaan pekerjaan yang telah tercapai.</p>
                <td>
            </tr>
            <tr style="text-align: justify">
                <td>
                    <p>(3) Pemutusan perjanjian dilakukan apabila PIHAK KEDUA cidera janji atau tidak memenuhi kewajiban dan tanggung jawabnya (wanprestasi) dan PIHAK KEDUA sikenakan sanksi sesuai dengan ketentuan peraturan yang berlaku.</p>
                <td>
            </tr>
            <tr style="text-align: justify">
                <td>
                    <p>(4) Pemutusan perjanjian dilakukan bilamana para pihak terbukti melakukan kolusi, kecurangan atau tindakan korupsi baik dalam proses penunjukan maupun pelaksanaan pekerjaan.</p>
                <td>
            </tr>


            <tr style="text-align: center">
                <td><b>Pasal 10<br>
                    PENYELESAIAN PERSELISIHAN<b></td>
            </tr>
            <tr style="text-align: justify">
                <td>
                    <p>(1) Apabila terjadi perselisihan antara kedua pihak, maka penyelesaiannya dilakukan melalui musyawarah untuk mufakat.</p>
                <td>
            </tr>
            <tr style="text-align: justify">
                <td>
                    <p>(2) Jika musyawarah tidak ditemukan mufakat, maka kedua pihak sepakat untuk menyelesaikannya di Pengadilan Negeri.</p>
                <td>
            </tr>


            <tr style="text-align: center">
                <td><b>Pasal 11<br>
                    PENUTUP<b></td>
            </tr>
            <tr style="text-align: justify">
                <td>
                    <p>Perjanjian ini dibuat rangkap 3 (tiga) masing-masing bermaterai cukup dan mempunyai kekuatan hukum yang sama ditandatangani pada hari, tanggal dan tempat sebagaimana tersebut diatas untuk dipergunakan seperlunya.</p>
                <td>
            </tr>
        </table>

        
           <table width='100%'>
                <tr style="text-align: center">
                    <td>PIHAK KE 1</td>
                    <td>PIHAK KE 2</td>
                </tr>
                <tr style="text-align: center">
                    <td><br/><br/><br/><br/><b><u>{{$pms->pelaksana}}</u></b></td>
                    <td><br/><br/><br/><br/><b><u>{{$pms->nama_suplier}}</u></b></td>
                </tr>
            </table>
            <br>
            <table width='100%'>
                <tr style="text-align: center">
                    <td>Mengetahui :</td>
                </tr>
                <tr style="text-align: center">
                    <td>Datok Penghulu {{ucwords(strtolower($pms->namadesa))}}</td>
                </tr>
                <tr style="text-align: center">
                    <td><br/><br/><br/><br/><b><u>{{$pms->kepaladesa}}</u></b></td>
                </tr>
            </table>
        </div>

    </div>
</body>
</html>