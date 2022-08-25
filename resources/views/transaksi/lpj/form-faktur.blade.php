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
            
            <div class="card-body">
            <div class="row justify-content-md-center">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <form class="" action="{{ route('lpj.simpan.faktur') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">NOMER FAKTUR</label>
                            <input type="text" class="form-control" id="nomor" name="nomor" placeholder="Nomor Faktur" required>
                            <input type="hidden" value="{{$pemesanan_id}}" class="form-control" id="pemesanan_id" name="pemesanan_id" placeholder="Nomor Faktur" required>
                        </div>
                        <div class="form-group">
                            <label for="">TANGGAL</label>
                            <input type="date" value="{{date('Y-m-d')}}" class="form-control" name="tanggal" placeholder="" required>
                        </div>
                        <a href="{{ route('lpj') }}" class="btn btn-danger">
                            BATAL
                        </a>
                        <button type="submit" class="btn btn-primary">
                            CETAK
                        </button>
                    </form>
                </div>
            </div>
            </div>
        </div>


    </div>
</div>  
@endsection