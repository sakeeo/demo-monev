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
                            <select name="tahun" id="tahun" class="form-control" onchange="updateHeader()">
                                @for ($i = date('Y'); $i < date('Y')+5; $i++)
                                    <option @if ($rkheader->tahun==$i) selected @endif value='{{ $i }}' >{{ $i }}</option>
                                @endfor
                            </select>
                            </div>

                            <div class="form-group">
                                <label for="">DESA</label>
                                <select name="desa_id" id="desa_id" class="form-control"  onchange="updateHeader()">
                                @foreach ($desa as $item)
                                    <option @if ($rkheader->desa_id==$item->id) selected @endif value='{{ $item->id }}'>{{ $item->namadesa }}</option>
                                @endforeach
                                </select>
                            </div>
                           
   
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                            <form action="">

                                <div class="form-group">
                                    <label for="">BIDANG</label>
                                    <select name="bidang_id" id="bidang_id" class="form-control" onchange="loadsubbidang()">
                                    @foreach ($bidang as $item)
                                        <option value='{{ $item->id }}'>
                                            {{ $item->bidang }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">SUB BIDANG</label>
                                    <select onchange="loadkegiatan()" name="sub_bidang_id" id="sub_bidang_id" class="form-control"></select>
                                </div>

                                <div class="form-group">
                                    <label for="">KEGIATAN</label>
                                    <select name="kegiatan_id" id="kegiatan_id" class="form-control"></select>
                                </div>


                                <div class="form-group">
                                    <label for="">PEkERJAAN</label>
                                    <input type="text" name="pekerjaan" id="pekerjaan" class=" form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">PAGU</label>
                                    <input type="text" name="pagu" id="pagu" class="rupiah form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">SUMBER DANA</label>
                                    <select name="sumber_anggaran_id" id="sumber_anggaran_id" class="form-control">
                                    @foreach ($sumberAnggaran as $item)
                                        <option value='{{ $item->id }}'>{{ $item->kode }}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">PELAKSANA KEGIATAN</label>
                                    <select name="pelaksana" id="pelaksana" class="form-control">
                                        
                                    </select>
                                </div>

                                <div class="form-group text-center">
                                    <button id="" type="button" class="btn btn-primary" onclick="addItem()">
                                        TAMBAH
                                    </button>
                                </div>
                                
                            </form>
                    </div>
                </div>

                <div class="row">
                  
                        <table class="table table-bordered" id="" width="100%" cellspacing="0" style="font-size: 12px;">
                            <thead>
                                <tr>
                                   <th>NO</th>
                                    <th>BIDANG</th>
                                    <th>SUB BIDANG</th>
                                    <th>KEGIATAN</th>
                                    <th>PEKERJAAN</th>
                                    <th>PELAKSANA</th>
                                    <th>PAGU</th>
                                    <th>SUMBER DANA</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody id="tbody"></tbody>
                        </table>
                </div>

             

                <br/>
                <div class="text-center">
                <a href="{{ route('rKegiatan') }}" class="btn btn-primary">
                    KEMBALI
                </a>
                </div>
            
                </form>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {

         window.loadpelaksana=()=>{
            var desa_id = $("#desa_id").val();
            $("#pelaksana").html("");
            $.ajax({
                    type:'POST',
                    url: "{{route('rKegiatan.getpelaksana')}}",
                    dataType: 'json',
                    data:{
                        desa_id:desa_id
                    },
                    success: (data) => {
                        console.log('Success');
                        console.log(data);

                        $("#pelaksana").append("<option value='"+data.kepaladesa+"' >"+data.kepaladesa+"</option>");
                        $("#pelaksana").append("<option value='"+data.sekertaris+"'>"+data.sekertaris+"</option>");
                        $("#pelaksana").append("<option value='"+data.keuangan+"'>"+data.keuangan+"</option>");
                        $("#pelaksana").append("<option value='"+data.kaur_umum+"'>"+data.kaur_umum+"</option>");
                        $("#pelaksana").append("<option value='"+data.kasi_pemerintahan+"'>"+data.kasi_pemerintahan+"</option>");
                        $("#pelaksana").append("<option value='"+data.kaur_kesejahteraan+"'>"+data.kaur_kesejahteraan+"</option>");

                    },
                    error: function(data){
                        console.log('Error');
                    }
                });
        }
        loadpelaksana();
        
        window.loadsubbidang=()=>{
            var bidang_id = $("#bidang_id").val();
            $.ajax({
                    type:'POST',
                    url: "{{route('rKegiatan.getSubbidang')}}",
                    dataType: 'json',
                    data: {
                        bidang_id:bidang_id,
                    },
                    success: (data) => {
                        console.log('Success');
                        $("#sub_bidang_id").html(data.option);
                        loadkegiatan();
                    },
                    error: function(data){
                        console.log('Error');
                    }
                });
        }
        loadsubbidang();

        window.loadkegiatan=()=>{
            var sub_bidang_id = $("#sub_bidang_id").val();
            var bidang_id = $("#bidang_id").val();
            $.ajax({
                    type:'POST',
                    url: "{{route('rKegiatan.getKegiatan')}}",
                    dataType: 'json',
                    data: {
                        sub_bidang_id:sub_bidang_id,
                        bidang_id:bidang_id,
                    },
                    success: (data) => {
                        console.log('Success');
                        $("#kegiatan_id").html(data.option);
                    },
                    error: function(data){
                        console.log('Error');
                    }
                });
        }
        loadkegiatan();

        window.updateHeader=()=>{
            var tahun = $("#tahun").val();
            var desa_id = $("#desa_id").val();
            $.ajax({
                    type:'POST',
                    url: "{{route('rKegiatan.updateHeader')}}",
                    dataType: 'json',
                    data: {
                        tahun:tahun,
                        desa_id:desa_id,
                        id:"{{$rkheader->id}}"
                    },
                    success: (data) => {
                        console.log('Success');
                        $("#kegiatan_id").html(data.option);
                        loadpelaksana();
                    },
                    error: function(data){
                        console.log('Error');
                    }
                });
        }
        updateHeader();

        window.addItem=()=>{
            var sub_bidang_id = $("#sub_bidang_id").val();
            var bidang_id = $("#bidang_id").val();
            var kegiatan_id = $("#kegiatan_id").val();
            var pekerjaan = $("#pekerjaan").val();
            var pagu = $("#pagu").autoNumeric('get');
            var sumber_anggaran_id = $("#sumber_anggaran_id").val();
            var pelaksana = $("#pelaksana").val();
            
            $.ajax({
                    type:'POST',
                    url: "{{route('rKegiatan.additem')}}",
                    dataType: 'json',
                    data: {
                        sub_bidang_id:sub_bidang_id,
                        bidang_id:bidang_id,
                        id:"{{$rkheader->id}}",
                        kegiatan_id:kegiatan_id,
                        pekerjaan:pekerjaan,
                        pagu:pagu,
                        sumber_anggaran_id:sumber_anggaran_id,
                        pelaksana:pelaksana
                    },
                    success: (data) => {
                        console.log('Success');
                        loaddataitem();
                    },
                    error: function(data){
                        console.log('Error');
                    }
                });
        }

        window.loaddataitem=()=>{
            
            $.ajax({
                    type:'POST',
                    url: "{{route('rKegiatan.loaddataitem')}}",
                    dataType: 'json',
                    data: {
                        id:"{{$rkheader->id}}",
                    },
                    success: (data) => {
                        $("#tbody").html(data.tbody);
                        console.log('Success');
                    },
                    error: function(data){
                        console.log('Error');
                    }
                });
        }
        loaddataitem();

        window.deleteitem=(r)=>{
            $.ajax({
                    type:'POST',
                    url: "{{route('rKegiatan.deleteitem')}}",
                    dataType: 'json',
                    data: {
                        id:r,
                    },
                    success: (data) => {
                        console.log('Success');
                        loaddataitem();
                    },
                    error: function(data){
                        console.log('Error');
                    }
                });
        }

    });
</script>
@endsection



