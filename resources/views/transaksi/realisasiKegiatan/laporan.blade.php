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
            <td>: {{ $rk->namadesa }}</td>
        </tr>
        <tr>
            <td>TAHUN</td>
            <td>: {{ $rk->tahun }}</td>
        </tr>
    </table>
    <br>
    <table class="" id="" width="100%" cellspacing="0" cellpadding='5' border="1">
        <thead>
            <tr>
                <th>NO</th>
                <th>BIDANG</th>
                <th>SUB BIDANG</th>
                <th>KEGIATAN</th>
                <th>PEKERJAAN</th>
                <th>PAGU</th>
                <th>SUMBER DANA</th>
                <th>REALISASI</th>
            </tr>
            
        </thead>
        <tbody id="tbody">
            @foreach ($item_rk as $item)
                
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{$item->bidang}}</td>
                    <td>{{$item->sub_bidang}}</td>
                    <td>{{$item->kegiatan}}</td>
                    <td>{{$item->pekerjaan}}</td>
                    <td>{{number_format($item->pagu,2,",",".")}}</td>
                    <td>{{$item->kode}}</td>
                    <td>{{number_format($item->realisasi,2,",",".")}}</td>
                </tr>

            @endforeach
        </tbody>
    </table>
</body>
</html>