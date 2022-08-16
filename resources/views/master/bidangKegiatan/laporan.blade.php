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
                                <th>BIDANG</th>
                                <th>SUBBIDANG</th>
                                <th>KEGIATAN</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @foreach ($kegiatan as $item)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{$item->bidang_id}}.{{$item->sub_bidang_id}}.{{$item->id}}</td>
                                <td>{{$item->bidang}}</td>
                                <td>{{$item->sub_bidang}}</td>
                                <td>{{$item->kegiatan}}</td>
                               
                            </tr>
                            @endforeach
        </tbody>
    </table>
</body>
</html>