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
            
            <div class="row">
                
                <div class="col">
                    <table class="table" >
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="">TAHUN</label>
                                    <select name="tahun" id="tahun" class="form-control" onchange="loaddata()">
                                        @for ($i = date('Y'); $i < date('Y')+5; $i++)
                                            <option value='{{ $i }}'>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="">SUMBER ANGGARAN</label>
                                    <select name="sumber_anggaran_id" id="sumber_anggaran_id" class="form-control" onchange="loaddata()">
                                        <option value="SEMUA">SEMUA</option>
                                    @foreach ($sumberAnggaran as $item)
                                        <option value='{{ $item->id }}'>{{ $item->kode }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <form action="{{ route('rag.print') }}" method="post" target="_blank">
                                        @csrf
                                        @method('post')
                                        <input type="hidden" id="print-tahun" name="print-tahun">
                                        <input type="hidden" id="print-id" name="print-id">
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-print"></i> PRINT</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </table> 
                </div>
                <div class="col"></div>
            </div>

            <div class="row">

            </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>DESA</th>
                            <th>KODE ANGGARAN</th>
                            <th>PAGU ANGGARAN</th>
                            <th>REALISASI ANGGARAN</th>
                            <th>PERSENTASE</th>
                        </tr>
                    </thead>
                    <tbody id="tbody"></tbody>
                    <tfoot id="tfoot"></tfoot>

                </table>
            </div>
        </div>
    </div>
</div> 

<script type="text/javascript">
    $(document).ready(function() {
        
        window.loaddata=()=>{
            var tahun = $("#tahun").val();
            var sumber_anggaran_id = $("#sumber_anggaran_id").val();
            $("#print-tahun").val(tahun);
            $("#print-id").val(sumber_anggaran_id);
            $.ajax({
                type:'POST',
                url: "{{ route('rag.getdata')}}",
                dataType: 'json',
                data:{
                    tahun:tahun,
                    sumber_anggaran_id:sumber_anggaran_id
                },
                success: (data) => {
                    console.log('Success');
                    console.log(data);
                    $("#tbody").html(data.tbody);
                    $("#tfoot").html(data.tfoot);
                },
                error: function(data){
                    console.log('Error');
                }
            });
        }
        loaddata();
       

        
    });
</script>
@endsection