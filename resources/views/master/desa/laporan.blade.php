<!DOCTYPE html>
<html>
<head>
    <title>{{$title}}</title>
</head>
<body>
    <h3 style="text-align: center">{{$title}}</h3>
    <br>
    <table class="" id="" width="100%" cellspacing="0" cellpadding='5' border="1" style="font-size:10px">
        <thead>
            <tr>
                <th>NO</th>
                <th>KODE DESA</th>
                <th>NAMA DESA</th>
                <th>KEPALA DESA</th>
                <th>SEKERTARIS</th>
                <th>BAG. KEUANGAN</th>
                <th>KAUR UMUM DAN PEMERINTAHAN</th>
                <th>KASIE PEMERINTAHAN</th>
                <th>KAUR KESEJAHTRAAN</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @foreach ($arrDesa as $item)
                
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{$item->kode_desa}}</td>
                                <td>{{$item->namadesa}}</td>
                                <td>{{$item->kepaladesa}}</td>
                                <td>{{$item->sekertaris}}</td>
                                <td>{{$item->keuangan}}</td>
                                 <td>{{$item->kaur_umum}}</td>
                                <td>{{$item->kasi_pemerintahan}}</td>
                                <td>{{$item->kaur_kesejahtraan}}</td>
                </tr>

            @endforeach
        </tbody>
    </table>
</body>
</html>