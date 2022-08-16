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
                        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                    </div>
                    <div class="col">
                        <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>
                    </div>
                </div>
                
            </div>
        </div>


    </div>
</div>  

<script>

$(document).ready(function() {
        
        window.loaddata=()=>{
            $.ajax({
                type:'GET',
                url: "{{ route('chart')}}",
                dataType: 'json',
                success: (data) => {
                    console.log('Success');

                    var xValues = data.kode;
                    var yValues = data.jumlah;
                    var yValues2 = data.realisasi;

                    console.log(yValues2);

                    new Chart("myChart", {
                    type: "bar",
                    data: {
                        labels: xValues,
                        datasets: [{
                        data: yValues
                        }]
                    },
                    options: {
                        legend: {display: false},
                        title: {
                        display: true,
                        text: "PAGU ANGGARAN 2022"
                        }
                    }
                    });

                    new Chart("myChart2", {
                    type: "bar",
                    data: {
                        labels: xValues,
                        datasets: [{
                        data: yValues2
                        }]
                    },
                    options: {
                        legend: {display: false},
                        title: {
                        display: true,
                        text: "REALISASI ANGGARAN 2022"
                        }
                    }
                    });

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