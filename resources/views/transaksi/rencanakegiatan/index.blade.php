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
                <a href="{{ route('rKegiatan.form') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Tambah
                </a>  
                <div class="table-responsive" style='margin-top:10px'>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>TAHUN</th>
                                <th>NAMA DESA</th>
                                <th>AKSI</th>
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
                    url: "{{route('rKegiatan.loaddata')}}",
                    dataType: 'json',
                    success: (data) => {
                        console.log('Success');
                        $("#tbody").html(data.tbody);
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