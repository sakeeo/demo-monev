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
            <td>SUMBER ANGGARAN</td>
            <td>: {{ $kode }}</td>
        </tr>
    </table>
    <br>

    <table class="" id="" width="100%" cellspacing="0" cellpadding='5' border="1">
        <thead>
            <tr>
                <th>NO</th>
                <th>DESA</th>
                <th>KODE ANGGARAN</th>
                <th>PAGU ANGGARAN</th>
                <th>REALISASI ANGGARAN</th>
                <th>PERSENTASE</th>
            </tr>
        </thead>
        <tbody id="tbody">
        
            <?php 
                $no=0;
                $totalanggaran=0;
                $totalreal=0;
            ?>
            
           @foreach ($rs as $item)
           <?php 
             $no++;
             $totalrealisasi = $item->jumlah1+$item->jumlah2+$item->jumlah3;
             $persentase = $totalrealisasi/$item->jumlah*100;
            ?>
                <tr>
                <td>{{ $no }}</td>
                <td>{{ $item->namadesa }}</td>
                <td>{{ $item->kode }}</td>
                <td>{{ number_format($item->jumlah,2,',','.') }}</td>
                <td>{{ number_format($totalrealisasi,2,',','.') }}</td>
                <td>{{ number_format($persentase,2,',','.') }} %</td>
                </tr>
                <?php 
                    $totalanggaran  += $item->jumlah;
                    $totalreal      += $totalrealisasi;
                ?>
           @endforeach
        </tbody>
        <tfoot id="tfoot">
            <?php 
                $totalpersentase = $totalreal/$totalanggaran*100;
            ?>

            <tr>
            <th colspan='3'>JUMLAH</th>
            <th>{{number_format($totalanggaran,2,",",".")}}</th>
            <th>{{number_format($totalreal,2,",",".")}}</th>
            <th>{{number_format($totalpersentase,2,",",".")}} %</th>
            </tr>
        </tfoot>

    </table>
    
</body>
</html>