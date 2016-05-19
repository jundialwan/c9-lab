@extends('sidebar')

@section('sidebar_buatpinjam', 'active white-text')

@section('konten')
<div class="subsection">
	<h5>Buat Permohonan Maintenance Barang</h5>
    <div class="divider"></div><br>

    @if ( $data['barang'] == '' )
    
    Masukkan barcode barang yang ingin di registrasi, barcode tertera pada stiker yg tertempel pada barang<br><br>
    <div class="row valign-wrapper">
        <div class="col s12">           
            <form action="{{ url('maintenancebarang/buat') }}" method="POST">         
                <div class="col s3">
                    <input type="text" name="barcode" required>
                </div>

                <div class="col s3">
                    {!! csrf_field() !!}
                    <button class="btn waves-light waves-effect valign buat-form">
                        BUAT FORM
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
    </div><hr>

    @else

    <div id="multiform" class="row">
    	<form action="{{ url('maintenancebarang/insert') }}" method="POST">
    		<div class="row form-row">
                <div class="col s6">
                    <b>Subjek</b><br>
                    <input name="subjek" maxlength="100" placeholder="Contoh: Permohonan Registrasi Barang BEM" id="subject" type="text" class="validate" value="">
                </div><br>

                <div class="col s12">
                    <b>Catatan Pemohon</b> <br>
                    <textarea name="catatanpemohon" class="materialize-textarea" length="240" placeholder="Contoh: Tidak ada" ></textarea>
                </div>
            </div><br><hr>

            <div class="row form-row">
            	<div class="col s6">
            		Nama Barang :<br>
            		{{ $data['barang']->NamaBarang }}
            	</div>

            </div>
          			<div class="row form-row">
                    	<div class="col s4 input-field">
                    		Jenis Barang :<br>
                    		{{ $data['barang']->JenisBarang }}
                    	</div>
                    	<div class="col s4 input-field">
                    		Kategori Barang : <br>
                    		{{ $data['barang']->KategoriBarang }}    
                    	</div>
                    	<div class="col s4 input-field">
                    		Kondisi Barang :<br>
                    		{{ $data['barang']->KondisiBarang }}
                    	</div>
                    </div>
            <div class="row form-row">
            	<div class="col s12 input-field">
            		Keterangan Kerusakaan :<br>
            		<span class="error red-text"></span><br>                 
                    <textarea name="kerusakanbarang" class="materialize-textarea" cols="30" rows="10"></textarea>
            	</div>
            </div>
            <div class="row">
                <div class="col s4 offset-s4 valign-wrapper">
                    <div class="valign">    
                        {!! csrf_field() !!}
                        <input type="hidden" name="hashBarang" value="{{ $data['barang']->hashBarang}}">
                        <button class="btn waves-light waves-effect teal">
                            Submit Permohonan
                            <i class="material-icons right">send</i>
                        </button>&nbsp;&nbsp;               
                    </div>
                </div>        
            </div>
    	</form>
    </div>
    
    @endif

</div>
@stop