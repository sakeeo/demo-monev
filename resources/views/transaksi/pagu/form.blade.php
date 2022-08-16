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
                            <select name="tahun" id="tahun_anggaran" class="form-control">
                                @for ($i = date('Y'); $i < date('Y')+5; $i++)
                                    <option value='{{ $i }}'>{{ $i }}</option>
                                @endfor
                            </select>
                            </div>

                            <div class="form-group">
                                <label for="">DESA</label>
                                <select name="desa_id" id="desa_id" class="form-control">
                                @foreach ($desa as $item)
                                    <option value='{{ $item->id }}'>{{ $item->namadesa }}</option>
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
                                                        <option value='{{ $item->id }}-{{ $item->kode }}'>{{ $item->kode }}</option>
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
                                    <tbody id="arrthb"></tbody>
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
                                                        <option value='{{ $item->id }}-{{ $item->kode }}'>{{ $item->kode }}</option>
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
                                    <tbody id="arrths"></tbody>
                                </table>
                                
                        </div>
                    </div>
                </div>

                <br/>
                <div class="text-center">
                <a href="{{ route('paguAnggaran') }}" class="btn btn-danger " >
                    BATAL
                </a>
                <button id="btn-simpanpaguanggaran" type="button" class="btn btn-primary" onclick="simpanpaguanggaran()">
                    SIMPAN
                </button>
                </div>
            
                </form>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        var thb = [];
        var ths = [];

        window.addSumberDana1=()=>{
            var id_kode = $("#sumber_dana_id1").val();
            var jumlah = $('#jumlah1').autoNumeric('get');
            var j = id_kode.split('-');
            if(jumlah==''){
                alert('jumlah tidak boleh kosong');
            }else{
                var x = {
                    'id'      : j[0],
                    'kode'    : j[1],
                    'jumlah'  : jumlah
                };
                thb.push(x);
                listthb();
            }
            
        }
        window.listthb=()=>{
            var no = 0;
            $("#listthb").val('');
            var list='';
            var list_jml='';
            $("#arrthb").empty();
            $.each(thb, function(i, v) {
                no = no+1;
                let tr = "<tr>" +
                "<td>" + no + "</td>" +
                "<td>" + v.kode + "</td>" +
                "<td>" + v.jumlah + "</td>" +
                "<td><a class='btn btn-danger btn-sm btn-circle' onClick=deletethb(" + i + ") style='color:white'><i class='fa fa-times'></i></a></td>" +
                "</tr>";
                $("#arrthb").append(tr);
            });
        }
        window.deletethb=(i)=>{
            thb.splice(i, 1);
            listthb();
        }
        window.addSumberDana2=()=>{
            var id_kode = $("#sumber_dana_id2").val();
            var kode = $("#sumber_dana_id2").text();
            var jumlah = $('#jumlah2').autoNumeric('get');
            var j = id_kode.split('-');
            if(jumlah==''){
                alert('jumlah tidak boleh kosong');
            }else{

                var x = {
                    'id'      : j[0],
                    'kode'    : j[1],
                    'jumlah'  : jumlah
                };
                ths.push(x);
                listths();
            }
        }
        window.listths=()=>{
            var no = 0;
            $("#listths").val('');
            var list='';
            var list_jml='';
            $("#arrths").empty();
            $.each(ths, function(i, v) {
                no = no+1;
                let tr = "<tr>" +
                "<td>" + no + "</td>" +
                "<td>" + v.kode + "</td>" +
                "<td>" + v.jumlah + "</td>" +
                "<td><a class='btn btn-danger btn-sm btn-circle' onClick=deleteths(" + i + ") style='color:white'><i class='fa fa-times'></i></a></td>" +
                "</tr>";
                $("#arrths").append(tr);
            });
        }
        window.deleteths=(i)=>{
            ths.splice(i, 1);
            listths();
        }
        window.simpanpaguanggaran=()=>{
            $("#btn-simpanpaguanggaran"). attr("disabled");
            var desa_id=$('#desa_id').val();
            var tahun = $('#tahun_anggaran').val();
            $.ajax({
                type:'POST',
                url: "{{ route('simpan.pagu')}}",
                dataType: 'json',
                data: {
                    desa_id:desa_id,
                    tahun:tahun,
                    thb:thb,
                    ths:ths,
                },
                success: (data) => {
                    $("#btn-simpanpaguanggaran"). attr("disabled", false);
                    alert('Berhasil meyimpan');
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
@endsection



