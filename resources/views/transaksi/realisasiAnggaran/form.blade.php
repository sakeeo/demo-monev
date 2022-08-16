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
                           
                <div class="" style='margin-top:10px'>
                   
                    
                    <div class="row">
                        <div class="col">
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
                        </div>
                        <div class="col">
                            <table class="table">
                                <tr>
                                    <td>SUMBER DANA </td>
                                    <td>
                                        <div class="form-group">
                                            <select name="sumber_anggaran_id" id="sumber_anggaran_id" class="form-control">
                                                @foreach ($sumber_dana as $item)
                                                    <option value="{{$item->sumber_anggaran_id}}">{{$item->kode}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>TAHAP </td>
                                    <td>
                                        <div class="form-group">
                                            <select name="tahap" id="tahap" class="form-control">
                                                <option value="1">Tahap 1</option>
                                                <option value="2">Tahap 2</option>
                                                <option value="3">Tahap 3</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>TANGGAL</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date" value="{{ date('Y-m-d') }}" name="tanggal" id="tanggal" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>JUMLAH</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="jumlah" id="jumlah" class="rupiah form-control">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: right">
                                        <button id="" type="button" class="btn btn-primary" onclick="update()">
                                            SIMPAN
                                        </button>
                                        <a id="" type="button" class="btn btn-danger" href="{{route('realisasiAnggaran')}}">
                                            KEMBALI
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align:'center';valign:'middle'">NO</th>
                                <th width='150px' rowspan="2">SUMBER DANA</th>
                                <th colspan="2">TAHAP I</th>
                                <th colspan="2">TAHAP II</th>
                                <th colspan="2">TAHAP III</th>
                            </tr>
                            <tr>
                                <th>TANGGAL</th>
                                <th>JUMLAH</th>
                                <th>TANGGAL</th>
                                <th>JUMLAH</th>
                                <th>TANGGAL</th>
                                <th>JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody id="tbody"></tbody>
                    </table>

                </div>

            </div>
        </div>


    </div>
</div>
<script type="text/javascript">
        $(document).ready(function() {
            
            window.loaddata=()=>{
                $.ajax({
                    type:'GET',
                    url: "{{ route('realisasiAnggaran.getdetail',$id)}}",
                    dataType: 'json',
                    success: (data) => {
                        console.log('Success');
                        console.log(data);
                        
                        $("#tbody").html(data.tbody);
                        
                    },
                    error: function(data){
                        console.log('Error');
                    }
                });
            }
            loaddata();
            window.update=()=>{
                var tahap = $("#tahap").val();
                var tanggal = $("#tanggal").val();
                var jumlah = $("#jumlah").autoNumeric("get");
                var sumber_anggaran_id = $("#sumber_anggaran_id").val();

                $.ajax({
                    type:'POST',
                    url: "{{ route('realisasiAnggaran.update')}}",
                    dataType: 'json',
                    data: {
                        pagu_anggaran_id:"{{$id}}",
                        tahap:tahap,
                        tanggal:tanggal,
                        jumlah:jumlah,
                        sumber_anggaran_id:sumber_anggaran_id
                    },
                    success: (data) => {
                        console.log('Success');
                        $("#tbody").html(data.tbody);
                        loaddata();
                        alert("berhasil meyimpan");
                    },
                    error: function(data){
                        console.log('Error');
                    }
                });
            }

            
        });
</script>
@endsection