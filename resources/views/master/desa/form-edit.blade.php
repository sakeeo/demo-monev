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
                    <form class="" action="{{ route('update.desa') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">KODE DESA</label>
                            <input type="text" class="form-control" name="kode_desa" placeholder="Kode desa" required  value="{{ $desa->kode_desa }}">
                        </div>

                        <div class="form-group">
                        <label for="">NAMA DESA</label>
                        <input type="text" value="{{ $desa->namadesa }}" class="form-control" name="namadesa" placeholder="Nama desa" required>
                        <input type="hidden" value="{{ $desa->id }}" class="form-control" name="id" placeholder="Nama desa" required readonly>
                        </div>

                        <div class="form-group">
                            <label for="">KEPALA DESA</label>
                            <input type="text"  value="{{ $desa->kepaladesa }}" class="form-control" name="kepaladesa" placeholder="Kepala desa" required>
                        </div>

                        <div class="form-group">
                            <label for="">SEKERTARIS DESA</label>
                            <input type="text" value="{{ $desa->sekertaris }}" class="form-control" name="sekertaris" placeholder="Sekertaris desa" required>
                        </div>

                        <div class="form-group">
                            <label for="">BAG. KEUANGAN</label>
                            <input type="text" value="{{ $desa->keuangan }}" class="form-control" name="keuangan" placeholder="Bag. Keuangan" required>
                        </div>

                         <div class="form-group">
                            <label for="">KAUR UMUM DAN PEMERINTAHAN</label>
                            <input type="text" class="form-control" name="kaur_umum" value="{{$desa->kaur_umum}}" placeholder="kaur umum" required>
                        </div>

                         <div class="form-group">
                            <label for="">KASIE PEMERINTAHAN</label>
                            <input type="text" class="form-control" name="kasi_pemerintahan"  value="{{$desa->kasi_pemerintahan}}" placeholder="kasie keseahtraan" required>
                        </div>

                          <div class="form-group">
                            <label for="">KAUR KESEJATERAAN</label>
                            <input type="text" class="form-control" name="kaur_kesejahteraan"  value="{{$desa->kaur_kesejahteraan}}" placeholder="kaur kesejahteraan" required>
                        </div>

                        <a href="{{ route('data.desa') }}" class="btn btn-danger">
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