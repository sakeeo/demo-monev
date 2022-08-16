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
                    <form class="" action="{{ route('simpan.bidangKegiatan') }}" method="post">
                        @csrf


                        <div class="form-group">
                            <label for="" class="form-label">Bidang :</label>
                            <input class="form-control" list="bidangs" name="bidang" id="bidang" required>
                            <datalist id="bidangs">
                                    @foreach ($bidang as $item)
                                        <option value="{{$item->bidang}}">{{$item->bidang}}</option>
                                    @endforeach
                            </datalist>
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Sub Bidang :</label>
                            <input class="form-control" list="sub_bidangs" name="sub_bidang" id="sub_bidang" required autocomplete="false">
                            <datalist id="sub_bidangs">
                                    @foreach ($sub_bidang as $subitem)
                                        <option value="{{$subitem->sub_bidang}}">{{$subitem->sub_bidang}}</option>
                                    @endforeach
                            </datalist>
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Kegiatan :</label>
                            <input class="form-control"  name="kegiatan" id="kegiatan" required>
        
                        </div>

                        

                        <a href="{{ route('data.bidangKegiatan') }}" class="btn btn-danger">
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