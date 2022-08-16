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
                    <form class="" action="{{ route('simpan.sumberAnggaran') }}" method="post">
                        @csrf
                        <div class="form-group">
                        <label for="">KODE</label>
                        <input type="text" class="form-control" name="kode" placeholder="kode" required>
                        </div>

                        <div class="form-group">
                            <label for="">URAIAN</label>
                            <input type="text" class="form-control" name="uraian" placeholder="Uraian" required>
                        </div>

                        <a href="{{ route('data.sumberAnggaran') }}" class="btn btn-danger">
                            BATAL
                        </a>
                        <button type="submit" class="btn btn-primary">
                            SIMPAN
                        </button>
                    
                    </form>
                </div>
            </div>
            </div>
        </div>


    </div>
</div>  
@endsection