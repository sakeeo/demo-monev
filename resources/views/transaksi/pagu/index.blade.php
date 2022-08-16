@extends('app')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if(session('message'))
        <p class="alert alert-success">{{ session('message') }}</p>
        @endif
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
        @endif
 
        {{-- CONTENTS HERE --}}

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title', $title)</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('form.add.pagu') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Tambah
                </a>                
                <div class="table-responsive" style='margin-top:10px'>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>TAHUN</th>
                                <th>NAMA DESA</th>
                                <th>JUMLAH PAGU</th>
                                <th>JUMLAH SILPA</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pagu as $item)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{$item['tahun']}}</td>
                                <td>{{$item['namadesa']}}</td>
                                <td>{{$item['jumlahpagu']}}</td>
                                <td>{{$item['jumlahsisa']}}</td>
                                <td width='120px'>
                                    <a href="{{ route('detail.pagu', $item['id']) }}" class="btn btn-sm text-left btn-primary">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('form.edit.pagu', $item['id']) }}" class="btn btn-sm text-left btn-success">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                
                                        <a href='{{ route('hapus.pagu',$item['id']) }}' class="btn btn-sm text-left btn-danger" onclick="return confirm('Are you sure to delete this?')"><i class="fa fa-trash"></i></a>
                                
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection