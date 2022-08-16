<!DOCTYPE html>
<html>
<head>
    <title>REALISASI ANGGARAN</title>
</head>
<body>
    <h3 style="text-align: center">REALISASI ANGGARAN GLOBAL</h3>
    <table class="table">
        <tr>
            <td>TAHUN</td>
            <td>: {{ $tahun }}</td>
        </tr>
        <tr>
            <td>NAMA DESA</td>
            <td>: {{ $namadesa }}</td>
        </tr>
        <tr>
            <td>SUMBER ANGGARAN</td>
            <td>: {{ $kode }}</td>
        </tr>
    </table>
    <br>
    <table class="" id="" width="100%" cellspacing="0" cellpadding='5' border="1">
         <thead>
            <tr>
                <th>NO</th>
                <th>BIDANG</th>
                <th>SUB BIDANG</th>
                <th>PEKERJAAN</th>
                <th>KEGIATAN</th>
                <th>KODE</th>
                <th>PAGU</th>
                <th>REALISASI</th>
                <th>SISA</th>
            </tr>
        </thead>
        <tbody id="tbody">
        
            <?php 
                $no=0;
                $total_pagu=0;
                $total_realisasi=0;
            ?>
            
           @foreach ($rs as $item)
           <?php 
             $no++;
             $sisa = $item->pagu-$item->realisasi;
            ?>
                <tr>
                <td>{{$no}}</td>
                <td>{{$item->bidang}}</td>
                <td>{{$item->sub_bidang}}</td>
                <td>{{$item->kegiatan}}</td>
                <td>{{$item->pekerjaan}}</td>
                <td>{{$item->kode}}</td>
                <td>{{number_format($item->pagu,2,",",".")}}</td>
                <td>{{number_format($item->realisasi,2,",",".")}}</td>
                <td>{{number_format($sisa,2,",",".")}}</td>
                </tr>
                <?php 
                    $total_pagu += $item->pagu;
                    $total_realisasi += $item->realisasi;
                ?>
           @endforeach
        </tbody>
        <tfoot id="tfoot">
            <?php 
                $total_sisa = $total_pagu-$total_realisasi;
            ?>
            <tr>
                <th colspan='6'>JUMLAH</th>
                <th>{{number_format($total_pagu,2,",",".")}}</th>
                <th>{{number_format($total_realisasi,2,",",".")}}</th>
                <th>{{number_format($total_sisa,2,",",".")}}</th>
            </tr>
        </tfoot>

    </table>
    
</body>
</html>