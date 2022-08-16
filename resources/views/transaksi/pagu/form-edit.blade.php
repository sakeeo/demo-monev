@extends('app')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
        @endif
        
        <div id="loaddetailpagu"></div>
        {{-- CONTENTS HERE --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title', $title)</h6>
            </div>
            {{-- <form class="" action="{{ route('simpan.pagu') }}" method="post"> --}}
            <form action="">
            <div class="card-body">
                <div class="row">
                   
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        
                            @csrf
                            <div class="form-group">
                            <label for="">TAHUN</label>
                            <select name="tahun" id="tahun_anggaran" class="form-control">
                                @for ($i = date('Y'); $i < date('Y')+5; $i++)
                                    <option value='{{ $i }}' @if ($pagu->tahun==$i) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                            </div>

                            <div class="form-group">
                                <label for="">DESA</label>
                                <select name="desa_id" id="desa_id" class="form-control">
                                @foreach ($desa as $item)
                                    <option value='{{ $item->id }}' @if ($pagu->desa_id==$item->id) selected @endif >{{ $item->namadesa }}</option>
                                @endforeach
                                </select>
                            </div>
                    </div>
                </div>

                <div class="col-md-12 mt-3" >
                    <div class="card border-left-primary">
                        <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="3">TAHUN BERJALAN</th>
                                        </tr>
                                        <tr>
                                            <th>NO</th>
                                            <th>SUMBER DANA</th>
                                            <th>JUMLAH</th>
                                            <th>#</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th>
                                                <div class="form-group">
                                                    <select name="sumber_dana_id1" id="sumber_dana_id1" class="form-control">
                                                    @foreach ($sumberAnggaran as $item)
                                                        <option value='{{ $item->id }}'>{{ $item->kode }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="form-group">
                                                <input type="text" name="jumlah1" id="jumlah1" class="rupiah form-control">
                                                </div>
                                            </th>
                                            <th>
                                                <div class="form-group" onclick="addSumberDana1()">
                                                    <a class="btn btn-success btn-circle btn-sm">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        @foreach ($pagu_berjalan as $item)
                                       
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{$item->kode}}</td>
                                            <td>{{$item->jumlah}}</td>
                                            <td>
                                                <a href="{{ route('hapus.item.pagu',[
                                                    'id'     =>$item->id,
                                                    'pagu_id'=>$item->pagu_anggaran_id
                                                ]) }}" class="btn btn-circle btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                        </div>
                    </div>
                </div>


                <div class="col-md-12 mt-3" >
                    <div class="card border-left-primary">
                        <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="3">SISA TAHUN SEBELUMNYA</th>
                                        </tr>
                                        <tr>
                                            <th>NO</th>
                                            <th>SUMBER DANA</th>
                                            <th>JUMLAH</th>
                                            <th>#</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th>
                                                <div class="form-group">
                                                    <select name="sumber_dana_id2" id="sumber_dana_id2" class="form-control">
                                                    @foreach ($sumberAnggaran as $item)
                                                        <option value='{{ $item->id }}'>{{ $item->kode }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="form-group">
                                                <input type="text" name="jumlah2" id="jumlah2" class="rupiah form-control">
                                                </div>
                                            </th>
                                            <th>
                                                <div class="form-group" onclick="addSumberDana2()">
                                                    <a class="btn btn-success btn-circle btn-sm">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        @foreach ($pagu_sisa as $item)
                                            <tr>
                                                <td scope="row">{{ $loop->iteration }}</td>
                                                <td>{{$item->kode}}</td>
                                                <td>{{$item->jumlah}}</td>
                                                <td>
                                                    <a href="{{ route('hapus.item.pagu',[
                                                        'id'     =>$item->id,
                                                        'pagu_id'=>$item->pagu_anggaran_id
                                                    ]) }}" class="btn btn-circle btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                                
                        </div>
                    </div>
                </div>

                <br/>
                <div class="text-center">
                <a href="{{ route('paguAnggaran') }}" class="btn btn-danger " >
                    KEMBALI
                </a>
                <button id="btn-simpanpaguanggaran" type="button" class="btn btn-primary" onclick="simpanperubahan()">
                    SIMPAN
                </button>
                </div>
            
                </form>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {

            window.addSumberDana1=()=>{

                var sumber_anggaran_id = $("#sumber_dana_id1").val();
                var jumlah = $('#jumlah1').autoNumeric('get');
                var pagu_anggaran_id = {{$pagu_id}};
                var periode = 'tahun berjalan';

                $.ajax({
                type:'POST',
                url: "{{ route('addnew.item.pagu')}}",
                dataType: 'json',
                data: {
                    sumber_anggaran_id:sumber_anggaran_id,
                    jumlah:jumlah,
                    pagu_anggaran_id:pagu_anggaran_id,
                    periode:periode,
                },
                success: (data) => {
                    window.location.replace("{{ route('form.edit.pagu',$pagu_id) }}");
                },
                error: function(data){
                    console.log(data);
                    alert('Gagal menyimpan');
                }
            });
            }

            window.addSumberDana2=()=>{

                    var sumber_anggaran_id = $("#sumber_dana_id2").val();
                    var jumlah = $('#jumlah2').autoNumeric('get');
                    var pagu_anggaran_id = {{$pagu_id}};
                    var periode = 'sisa tahun sebelumnya';

                    $.ajax({
                    type:'POST',
                    url: "{{ route('addnew.item.pagu')}}",
                    dataType: 'json',
                    data: {
                        sumber_anggaran_id:sumber_anggaran_id,
                        jumlah:jumlah,
                        pagu_anggaran_id:pagu_anggaran_id,
                        periode:periode,
                    },
                    success: (data) => {
                        window.location.replace("{{ route('form.edit.pagu',$pagu_id) }}");
                    },
                    error: function(data){
                        console.log(data);
                        alert('Gagal menyimpan');
                    }
                });
            }

        window.simpanperubahan=()=>{

            var desa_id = $("#desa_id").val();
            var tahun = $('#tahun_anggaran').val();
            var pagu_anggaran_id = {{$pagu_id}};
                $.ajax({
                    type:'POST',
                    url: "{{ route('simpan.perubahan.pagu')}}",
                    dataType: 'json',
                    data: {
                        desa_id:desa_id,
                        tahun:tahun,
                        pagu_anggaran_id:pagu_anggaran_id,
                    },
                    success: (data) => {
                        window.location.replace("{{ route('paguAnggaran') }}");
                    },
                    error: function(data){
                        console.log(data);
                        alert('Gagal menyimpan');
                    }
                });
            }


        });
        </script>

    </div>
</div>
@endsection



