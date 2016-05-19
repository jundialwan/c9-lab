@extends('sidebar')

@section('sidebar_buatbarang', 'active white-text')

@section('konten')
<div class="subsection">
	<h5>Buat Barang</h5>
    <div class="divider"></div><br>

    <div class="row">
    	<div class="col s12">
    		<form action="{{ url('registrasibarang/barang/ubah/'.$data['barang'][0]['hashBarang']) }}" method="POST">
    			<div class="row form-row">
    				<div class="col s12 input-field">
			    		Nama Barang <br>
			    		<span class="error red-text">{{ $errors->first('namabarang') }}</span><br>
						<input type="text" name="namabarang" maxlength="100" value="{{ (isset($data['barang'])) ? ($data['barang'][0]['NamaBarang']) : old('namabarang') }}">			
			    	</div>
    			</div>

    			<div class="row form-row">
    				<div class="col s12 input-field">
			    		Tanggal Beli <br>
			    		<span class="error red-text">{{ $errors->first('tanggalbeli') }}</span><br>    				
						<input type="date" name="tanggalbeli" value="{{ (isset($data['barang'])) ? ($data['barang'][0]['TanggalBeli']) : old('tanggalbeli') }}" class="datepicker">			
			    	</div>
    			</div>

    			<div class="row form-row">
    				<div class="col s12 input-field">
			    		Penanggung Jawab <br> 
			    		<span class="error red-text">{{ $errors->first('penanggungjawab') }}</span><br>   				
						<input type="text" name="penanggungjawab" maxlength="100" value="{{ (isset($data['barang'])) ? ($data['barang'][0]['Penanggungjawab']) : old('penanggungjawab') }}" class="">			
			    	</div> 
    			</div>

    			<div class="row form-row">
    				<div class="col s2 input-field">
			    		Kategori Barang <br>
			    		<span class="error red-text">{{ $errors->first('kategoribarang') }}</span><br>    				
						<select name="kategoribarang">
							<option disabled selected>Kategori Barang</option>
							<option value="Elektronik" {{ ($data['barang'][0]['KategoriBarang'] == 'Elektronik') ? 'selected' : '' }}>Elektronik</option>
							<option value="Furnitur" {{ ($data['barang'][0]['KategoriBarang'] == 'Furnitur') ? 'selected' : '' }}>Furnitur</option>
							<option value="Kategori A" {{ ($data['barang'][0]['KategoriBarang'] == 'Kategori A') ? 'selected' : '' }}>Kategori A</option>
							<option value="Kategori B" {{ ($data['barang'][0]['KategoriBarang'] == 'Kategori B') ? 'selected' : '' }}>Kategori B</option>
							<option value="Kategori C" {{ ($data['barang'][0]['KategoriBarang'] == 'Kategori C') ? 'selected' : '' }}>Kategori C</option>
							<option value="Lainnya" {{ ($data['barang'][0]['KategoriBarang'] == 'Lainnya') ? 'selected' : '' }}>Lainnya</option>
						</select>			
			    	</div>

			    	<div class="col s4 input-field">
			    		Jenis Barang <br>
			    		<span class="error red-text">{{ $errors->first('jenisbarang') }}</span><br>    				
						<input id="jenisbarang1" type="text" name="jenisbarang" value="{{ (isset($data['barang'])) ? ($data['barang'][0]['JenisBarang']) : old('jenisbarang') }}" maxlength="100" class="">			
			    	</div>    		

			    	<div class="col s6 input-field">
			    		Kondisi Barang <br>
			    		<span class="error red-text">{{ $errors->first('kondisibarang') }}</span><br>    				
						<select name="kondisibarang">
							<option disabled>Kondisi Barang</option>
							<option value="Baru" {{ ($data['barang'][0]['KondisiBarang'] == 'Baru') ? 'selected' : '' }}>Baru</option>
							<option value="Bekas" {{ ($data['barang'][0]['KondisiBarang'] == 'Bekas') ? 'selected' : '' }}>Bekas</option>
							<option value="Rusak" {{ ($data['barang'][0]['KondisiBarang'] == 'Rusak') ? 'selected' : '' }}>Rusak</option>								
						</select>
			    	</div>
    			</div>

    			<div class="row">
    				<div class="col s6 input-field">
			    		Kerusakan Barang <br>
			    		<span class="error red-text">{{ $errors->first('kerusakanbarang') }}</span><br>    				
						<textarea name="kerusakanbarang" class="materialize-textarea" cols="30" rows="10">{{ (isset($data['barang'])) ? ($data['barang'][0]['KerusakanBarang']) : old('kerusakanbarang') }}</textarea>
			    	</div>  

			    	<div class="col s6 input-field">
			    		Spesifikasi Barang <br>
			    		<span class="error red-text">{{ $errors->first('spesifikasibarang') }}</span><br>    				
						<textarea name="spesifikasibarang" class="materialize-textarea" cols="30" rows="10">{{ (isset($data['barang'])) ? ($data['barang'][0]['SpesifikasiBarang']) : old('spesifikasibarang') }}</textarea>
			    	</div>
    			</div>

    			<div class="row">
    				<div class="col s12 input-field">
			    		Keterangan Barang <br>
			    		<span class="error red-text">{{ $errors->first('keteranganbarang') }}</span><br>    				
						<textarea name="keteranganbarang" class="materialize-textarea" cols="30" rows="10">{{ (isset($data['barang'])) ? ($data['barang'][0]['KeteranganBarang']) : old('keteranganbarang') }}</textarea>
			    	</div> 
    			</div>

    			<div class="row"></div>
    			<div class="row"></div>
    			<div class="row"></div>

    			{!! csrf_field() !!}
    			<input type="hidden" name="hash" value="{{ $data['barang'][0]['hashBarang'] }}">
				<button class="btn waves-light waves-effect teal" onclick="return confirm('Anda yakin ingin mengubah detail barang ini?')">
					UPDATE BARANG
					<i class="material-icons right">send</i>
				</button>
    		</form>
    	</div>
    </div>
</div>
@stop