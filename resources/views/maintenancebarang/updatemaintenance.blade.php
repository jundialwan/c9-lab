@extends('sidebar')

@section('sidebar_buatpinjam', 'active white-text')

@section('konten')
<div class="subsection">
	<h5>Buat Permohonan Maintenance Barang</h5>
    <div class="divider"></div><br>    

    <div id="multiform" class="row">
    	<form action="{{ url('maintenancebarang/ubah/'.$data['permohonan']->hashPermohonan) }}" method="POST">
    		<div class="row form-row">
                <div class="col s6">
                    <b>Subjek</b><br>
                    <input name="subjek" placeholder="Contoh: Permohonan Registrasi Barang BEM" id="subject" type="text" class="validate" value="{{ $data['permohonan']->SubjekPermohonan }}">
                </div><br>

                <div class="col s12">
                    <b>Catatan Pemohon</b> <br>
                    <textarea name="catatanpemohon" class="materialize-textarea" length="240" placeholder="Contoh: Tidak ada" >{{ $data['catatan']->DeskripsiCatatan }}</textarea>
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
                    <textarea name="kerusakanbarang" class="materialize-textarea" cols="30" rows="10">{{ $data['barang']->KerusakanBarang }}</textarea>
            	</div>
            </div>

            <div class="row">
                <div class="col s4 offset-s4 valign-wrapper">
                    <div class="valign">    
                        {!! csrf_field() !!}
                        <input type="hidden" name="hashBarang" value="{{ $data['barang']->hashBarang }}">
                        <input type="hidden" name="hashCatatan" value="{{ $data['catatan']->hashCatatan }}">
                        <button class="btn waves-light waves-effect teal" onclick="return confirm('Anda yakin ingin mengubah detail permohonan ini?')">
                            UPDATE PERMOHONAN
                            <i class="material-icons right">send</i>
                        </button>&nbsp;&nbsp;               
                    </div>
                </div>        
            </div>
    	</form>
    </div>

</div>
@stop