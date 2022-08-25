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
            {{-- begin card body --}}
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="">DESA</label>
                                <select name="desa_id" id="desa_id" class="form-control" onchange="getpekerjaan()" required>
                                @foreach ($desa as $item)
                                    <option value='{{ $item->id }}'>{{ $item->namadesa }}</option>
                                @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="">TANGGAL MULAI</label>
                                <input value="{{ date('Y-m-d') }}" type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" required>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="">NAMA KEGIATAN</label>
                                <select name="rencana_kegiatan_id" id="rencana_kegiatan_id" class="form-control" onchange="getpelaksana()" required>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="">TANGGAL SELESAI</label>
                                <input value="{{ date('Y-m-d') }}" type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="">NAMA PELAKSANA</label>
                                <input type="text" name="pelaksana" id="pelaksana" class="form-control" readonly>
                            </div>
                        </td>
                       <td>
                            <div class="form-group">
                                <label for="">LOKASI</label>
                                <input type="text" name="lokasi" id="lokasi" class="form-control" onkeyup="tombolaktif()" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="">SUPLIER</label>
                                <input type="text" name="nama_suplier" id="nama_suplier" class="form-control"  onkeyup="tombolaktif()" required>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="">ALAMAT SUPLIER</label>
                                <input type="text" name="alamat_suplier" id="alamat_suplier" class="form-control" onkeyup="tombolaktif()" required>
                            </div>
                        </td> 
                    </tr>
                </table>

                <table class="table table-bordered">
                    <tr>
                        <td>No</td>  
                        <td>NAMA BARANG</td>
                        <td width='150px'>SATUAN</td>
                        <td width='150px' >QTY</td>
                        <td width='150px' >HARGA SATUAN</td>
                        <td>TOTAL</td>
                        <td>#</td>
                    </tr>
                    <tbody id="listItem"></tbody>
                    <tr>
                        <td></td>
                        <td>
                            <input type="text" name="d-barang" id="d-barang" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="d-barang" id="d-satuan" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="d-qty" id="d-qty" class="rupiah form-control">
                        </td>
                        <td>
                            <input type="text" name="d-harga" id="d-harga" class="rupiah form-control">
                        </td>
                        <td></td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick="addItem()">
                            <i class="fa fa-plus"></i>
                            </button>
                        </td>
                    </tr>
                </table>
                <div class="text-center">
                    <button id='btnsubmit' class="btn btn-sm btn-primary" onclick="submit()">SIMPAN</button>
                    <button class="btn btn-sm btn-danger">BATAL</button>
                </div>
                    
    
            </div>
            {{-- end of card body --}}
        </div>
    </div>
</div> 

<script type="text/javascript">
    $(document).ready(function() {
        
        var arrItem = [];
        window.getpekerjaan=()=>{
            var desa_id = $("#desa_id").val();
            $.ajax({
                type:'POST',
                url: "{{ route('lpj.getpekerjaan')}}",
                dataType: 'json',
                data:{
                    desa_id:desa_id,
                },
                success: (data) => {
                    console.log('Success');
                    $("#rencana_kegiatan_id").html(data);
                    getpelaksana();
                    tombolaktif();

                },
                error: function(data){
                    console.log('Error');
                }
            });
        }
        getpekerjaan();

        window.getpelaksana=()=>{
            var id = $("#rencana_kegiatan_id").val();
          
            $.ajax({
                type:'POST',
                url: "{{ route('lpj.getpelaksana')}}",
                dataType: 'json',
                data:{
                    id:id,
                },
                success: (data) => {
                    console.log('Success');
                    $("#pelaksana").val(data);
                },
                error: function(data){
                    console.log('Error');
                }
            });
        }

        window.addItem=()=>{
            var nama  = $("#d-barang").val();
            var satuan  = $("#d-satuan").val();
            var qty     = $("#d-qty").autoNumeric('get');
            var harga   = $("#d-harga").autoNumeric('get');
            var total   = qty*harga;
            var newItem = {
                'nama':nama,
                'satuan':satuan,
                'qty':qty,
                'harga':harga,
                'total':total,
            };
            arrItem.push(newItem);
            loadItem();
            $("#d-barang").focus();
            tombolaktif();
        }
       

        window.loadItem=()=>{
            var no = 0;
            $("#listItem").empty();
            $.each(arrItem, function(i, v) {
                no = no+1;
                let tr = "<tr>" +
                "<td>" + no + "</td>" +
                "<td>" + v.nama + "</td>" +
                "<td>" + v.satuan + "</td>" +
                "<td>" + v.qty + "</td>" +
                "<td>" + v.harga + "</td>" +
                "<td>" + v.total + "</td>" +
                "<td><a class='btn btn-danger btn-sm btn-circle' onClick=deleteItem(" + i + ") style='color:white'><i class='fa fa-times'></i></a></td>" +
                "</tr>";
                $("#listItem").append(tr);
            });

            $("#d-barang").val('');
            $("#d-satuan").val('');
            $("#d-qty").val('');
            $("#d-harga").val('');
            tombolaktif();
        }
        window.deleteItem=(i)=>{
            arrItem.splice(i, 1);
            loadItem();
        }

        $("#d-harga").on('keypress',function(e){
            if(e.which == 13) {
                addItem();
            }
        });

        window.submit=()=>{
            var data={
                'desa_id'               : $("#desa_id").val(),
                'rencana_kegiatan_id'   : $("#rencana_kegiatan_id").val(),
                'tgl_selesai'           : $("#tgl_selesai").val(),
                'tgl_mulai'             : $("#tgl_mulai").val(),
                'lokasi'                : $("#lokasi").val(),
                'nama_suplier'          : $("#nama_suplier").val(),
                'alamat_suplier'        : $("#alamat_suplier").val(),
                'items'                 : arrItem
            };
               
            $.ajax({
                type:'POST',
                url: "{{ route('lpj.submit')}}",
                dataType: 'json',
                data:data,
                success: (r) => {
                    console.log(r);
                    window.location.replace("{{ route('lpj') }}");
                    
                },
                error: function(r){
                    console.log(r);
                    alert('Gagal menyimpan');
                }
            });
        }

        window.tombolaktif=()=>{
            var input = [
                'desa_id',
                'rencana_kegiatan_id',
                'tgl_selesai',
                'tgl_mulai',
                'lokasi',
                'nama_suplier',
                'alamat_suplier',
            ];
            var aktif = true;
            $.each(input, function(i,v) {
                if($("#"+v).val() ==''){
                    aktif = false;
                }
            });

            if(arrItem.length == 0){
                aktif = false;
            }

            if(aktif==true){
                $("#btnsubmit").removeAttr("disabled");
            } else{
                $("#btnsubmit").attr("disabled","true");
            }
        }
        tombolaktif();

       
        
       

        
    });
</script>
@endsection