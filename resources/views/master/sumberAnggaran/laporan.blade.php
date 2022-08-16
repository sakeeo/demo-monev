<!DOCTYPE html>
<html>
<head>
    <title>{{$title}}</title>
</head>
<body>
    <h3 style="text-align: center">{{$title}}</h3>
    <br>
    <table class="" id="" width="100%" cellspacing="0" cellpadding='5' border="1">
        <thead>
            <tr>
                <th>NO</th>
                <th>KODE</th>
                <th>URAIAN</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @foreach ($arrSumberAnggaran as $item)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{$item->kode}}</td>
                                <td>{{$item->uraian}}</td>
                               
                            </tr>
                            @endforeach
        </tbody>
    </table>
</body>
</html>