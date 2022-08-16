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
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered" id="" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th colspan="3">
                                        TAHUN BERJALAN
                                    </th>
                                </tr>
                                <tr>
                                    <th>NO</th>
                                    <th>SUMBER DANA</th>
                                    <th>JUMLAH</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pagu_berjalan as $item)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{$item->kode}}</td>
                                    <td>{{number_format($item->jumlah,2,",",".")}}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col">
                        
                        <table class="table table-bordered" id="" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th colspan="3">
                                        SISA TAHUN SEBELUMNYA
                                    </th>
                                </tr>
                                <tr>
                                    <th>NO</th>
                                    <th>SUMBER DANA</th>
                                    <th>JUMLAH</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pagu_sisa as $item)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{$item->kode}}</td>
                                     <td>{{number_format($item->jumlah,2,",",".")}}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                       
                    </div>
                </div>
                   
                <div class="text-center">
                    <a href="{{ route('paguAnggaran') }}" class="btn btn-danger " >
                        KEMBALI
                    </a>
                </div>
            </div>
        </div>


    </div>
</div>  
@endsection