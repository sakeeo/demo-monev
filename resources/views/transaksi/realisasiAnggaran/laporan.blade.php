<!DOCTYPE html>
<html>
<head>
    <title>REALISASI ANGGARAN</title>
</head>
<body>
    <h3 style="text-align: center">REALISASI ANGGARAN</h3>
    <table class="table">
        <tr>
            <td>DESA</td>
            <td>: {{ $pagu->namadesa }}</td>
        </tr>
        <tr>
            <td>TAHUN</td>
            <td>: {{ $pagu->tahun }}</td>
        </tr>
    </table>
    <br>
    <table class="" id="" width="100%" cellspacing="0" cellpadding='5' border="1">
        <thead>
            <tr>
                <th rowspan="2" style="text-align:'center';valign:'middle'">NO</th>
                <th width='150px' rowspan="2">SUMBER DANA</th>
                <th colspan="2">TAHAP I</th>
                <th colspan="2">TAHAP II</th>
                <th colspan="2">TAHAP III</th>
            </tr>
            <tr>
                <th>TANGGAL</th>
                <th>JUMLAH</th>
                <th>TANGGAL</th>
                <th>JUMLAH</th>
                <th>TANGGAL</th>
                <th>JUMLAH</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @foreach ($realisasi as $item)
                
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{$item->kode}}</td>

                    <td>{{$item->tanggal1}}</td>
                    <td>{{number_format($item->jumlah1,2,",",".")}}</td>
                    
                    <td>{{$item->tanggal2}}</td>
                    <td>{{number_format($item->jumlah2,2,",",".")}}</td>

                    <td>{{$item->tanggal3}}</td>
                    <td>{{number_format($item->jumlah3,2,",",".")}}</td>
                </tr>

            @endforeach
        </tbody>
    </table>
</body>
</html>