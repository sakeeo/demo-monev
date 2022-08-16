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
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 mb-3 mb-sm-0">

                        <table class="table">
                            <tr>
                                <td>TAHUN</td>
                                <td>: {{ $rkheader->tahun }}</td>
                            </tr>
                            <tr>
                                <td>DESA</td>
                                <td>: {{ $rkheader->desa_id }}</td>
                            </tr>
                        </table>
                           
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0"></div>
                </div>

                <div class="row table-responsive">
                  
                    <table class="table" id="" width="100%" cellspacing="0" cellpadding='5'>
                        <thead>
                            <tr>
                                <th>NO</th>
                                {{-- <th>BIDANG</th>
                                <th>SUB BIDANG</th>
                                <th>KEGIATAN</th> --}}
                                <th>PEKERJAAN</th>
                                <th>PAGU</th>
                                <th>SUMBER DANA</th>
                                <th>TOTAL REALISASI</th>
                                <th>DOCUMENTASI</th>
                            </tr>
                            
                        </thead>
                        <tbody id="tbody">
                            @foreach ($item_rk as $item)
                                
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>
                                        {{$item->bidang}}<br/>
                                        {{$item->sub_bidang}}<br/>
                                        {{$item->kegiatan}}<br/>
                                        {{$item->pekerjaan}}
                                    </td>
                                    <td>{{number_format($item->pagu,2,",",".")}}</td>
                                    <td>{{$item->kode}}</td>
                                    <td>
                                            <input type="hidden" name="idreal-{{ $item->id }}" id="idreal-{{ $item->id }}" value="{{ $item->id }}">
                                            <input type="text" name="jumlahreal-{{ $item->id }}" id="jumlahreal-{{ $item->id }}" value="{{ $item->realisasi }}" class="rupiah form-control" onblur="simpanJumlahRealisasi($(this))">
                                    </td>
                                    <td>
                                        @if ($item->dokumentasi=='')
                                        <form id="form-{{$item->id}}" action="{{route('realKegiatan.upload')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            
                                            <div class="form-group">
                                                <input type="hidden" name="theID" value="{{ $item->id }}">
                                                <input type="hidden" name="rkHeader" value="{{ $rkheader->id }}">
                                                <input type="file" onchange="submit('{{$item->id}}')" name="file" placeholder="Choose file" id="file" class="from-control">
                                                  @error('file')
                                                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                  @enderror
                                
                                            </div>

                                        </form>
                                        @else
                                            <a href="{{ route('rKegiatan.download',$item->path) }}" target="_blank" class="btn btn-sm btn-primary">
                                            <i class="fa fa-download"></i>
                                            </a>
                                            <a href="{{ route('rKegiatan.remove',$item->path) }}" target="" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        @endif
                                        

                                    </td>
                                </tr>
                
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <br/>
                <div class="text-center">
                <a href="{{ route('realisasiKegiatan') }}" class="btn btn-danger">
                    KEMBALI
                </a>
                <a href="{{ route('realisasiKegiatan') }}" class="btn btn-primary">
                    SIMPAN
                </a>
                </div>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
              
        window.simpanJumlahRealisasi=(r)=>{
            var id = r.attr('id');
            var jml = $("#"+id).val();

            $.ajax({
                type:'POST',
                url: "{{ route('realKegiatan.updatedetail')}}",
                dataType: 'json',
                data: {
                    id:id,
                    jml:jml,
                },
                success: (data) => {
                    console.log(data);
                },
                error: function(data){
                    console.log('Error');
                }
            });
       }

       window.submit=(r)=>{
            // $("#myForm").submit(); 
            alert("form-"+r);
       }
      

    });
</script>
@endsection



