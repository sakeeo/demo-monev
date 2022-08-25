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
            <a href="{{ route('lpj.form') }}" class="btn btn-primary btn-sm">TAMBAH</a>
                <table class="table table-borderd" style="font-size:12px">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>TANGGAL</th>
                            <th>DESA</th>
                            <th>PEKERJAAN</th>
                            <th>PELAKSANA</th>
                            <th>SUPLIER</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemesanan as $item)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $item->tgl_pemesanan }}</td>
                            <td>{{ $item->namadesa }}</td>
                            <td>{{ $item->pekerjaan }}</td>
                            <td>{{ $item->pelaksana }}</td>
                            <td>{{ $item->nama_suplier }}</td>
                            <td>
                                
                                    <div class="btn-group" role="group">
                                      <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        ACTION
                                      </button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" target='_blank' href="{{ route("lpj.print.pemesanan",$item->id) }}">CETAK PEMESANAN</a>
                                        {{-- <a class="dropdown-item" target='_blank' href="{{ route("lpj.print.faktur",$item->id) }}">CETAK FAKTUR</a>
                                        <a class="dropdown-item" target='_blank' href="{{ route("lpj.print.st",$item->id) }}">CETAK SERAH TERIMA</a> --}}
                                        <a class="dropdown-item" target='_blank' href="{{ route("lpj.print.spk",$item->id) }}">CETAK SPK</a>
                                      </div>
                                    </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>    


            </div>
            {{-- end of card body --}}
        </div>
    </div>
</div> 

@endsection