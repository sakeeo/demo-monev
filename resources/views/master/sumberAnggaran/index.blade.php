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
                <a href="{{ route('form.add.sumberAnggaran') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Tambah
                </a>
                <a href="{{ route('print.sumberAnggaran') }}" class="btn btn-sm btn-danger" target="_blank">
                    <i class="fa fa-print"></i> Cetak
                </a>
                
                <div class="table-responsive" style='margin-top:10px'>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>KODE</th>
                                <th>URAIAN</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($arrSumberAnggaran as $item)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{$item->kode}}</td>
                                <td>{{$item->uraian}}</td>
                                <td>
                                    <a href="{{ route('form.edit.sumberAnggaran', $item->id) }}" class="btn btn-sm btn-success">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                  
                                     
                                        <a href="{{ route('hapus.sumberAnggaran', $item->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this?')"><i class="fa fa-trash"></i></a>
                                    
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