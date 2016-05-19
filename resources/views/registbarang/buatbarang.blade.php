@extends('sidebar')

@section('sidebar_buatbarang', 'active white-text')

@section('konten')
<div class="subsection">
	<h5>Buat Barang</h5>
    <div class="divider"></div><br>
	
	@if (!(session()->has('jmlform')))
	
	Tentukan jumlah barang yang ingin di registrasi, contoh: 3 (minimal 1 barang, maksimal 5 barang)<br><br>
    <div class="row valign-wrapper">
    	<div class="col s12">    		
	    	<form action="{{ url('registrasibarang/barang/buat') }}" method="POST">    		
		    	<div class="col s3">
			    	<input type="number" name="jmlbarang" min="1" max="5" step="1" value="1" required>    		
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
	    <form action="{{ url('registrasibarang/barang/insert') }}" method="POST">	    	
		    <div id="barang-multiform">			    
		    	@for ($i=1; $i <= session('jmlform'); $i++)  		   
			    <div id="barang-form[{{$i}}]">
			    	<div class="valign-wrapper">		    		
			    		<span class="valign judul-add-barang">Barang</span>&nbsp;&nbsp;
			    	</div>
				    <div class="row form-row">
				    	<div class="col s6 input-field">
				    		Nama Barang <br>
				    		<span class="error red-text">{{ $errors->first('namabarang.'.$i) }}</span><br>
							<input type="text" name="namabarang[{{$i}}]" maxlength="100" value="{{ old('namabarang.'.$i) }}">							
				    	</div>

						<div class="col s2 input-field">
				    		Tanggal Beli <br>
				    		<span class="error red-text">{{ $errors->first('tanggalbeli.'.$i) }}</span><br>    				
							<input type="date" name="tanggalbeli[{{$i}}]" value="{{ old('tanggalbeli.'.$i) }}" class="tanggalbeli">			
				    	</div>

				    	<div class="col s4 input-field">
				    		Penanggung Jawab <br> 
				    		<span class="error red-text">{{ $errors->first('penanggungjawab.'.$i) }}</span><br>   				
							<input type="text" name="penanggungjawab[{{$i}}]" maxlength="100" value="{{ old('penanggungjawab.'.$i) }}" class="">			
				    	</div>    	
				    </div>   

				    <div class="row form-row">
				    	<div class="col s2 input-field">
				    		Kategori Barang <br>
				    		<span class="error red-text">{{ $errors->first('kategoribarang.'.$i) }}</span><br>    				
							<select name="kategoribarang[{{$i}}]">
								<option disabled selected>Kategori Barang</option>
								<option value="Elektronik">Elektronik</option>
								<option value="Furnitur">Furnitur</option>
								<option value="Kategori A">Kategori A</option>
								<option value="Kategori B">Kategori B</option>
								<option value="Kategori C">Kategori C</option>
								<option value="Lainnya">Lainnya</option>
							</select>			
				    	</div>

				    	<div class="col s4 input-field">
				    		Jenis Barang <br>
				    		<span class="error red-text">{{ $errors->first('jenisbarang.'.$i) }}</span><br>    				
							<input id="jenisbarang1" type="text" name="jenisbarang[{{$i}}]" value="{{ old('jenisbarang.'.$i) }}" maxlength="100" class="">			
				    	</div>    		

				    	<div class="col s6 input-field">
				    		Kondisi Barang <br>
				    		<span class="error red-text">{{ $errors->first('kondisibarang.'.$i) }}</span><br>    				
							<select name="kondisibarang[{{$i}}]">
								<option disabled selected>Kondisi Barang</option>
								<option value="Baru">Baru</option>
								<option value="Bekas">Bekas</option>
								<option value="Rusak">Rusak</option>								
							</select>
				    	</div>
				    </div>

				    <div class="row form-row">   
				    	<div class="col s4 input-field">
				    		Kerusakan Barang <br>
				    		<span class="error red-text">{{ $errors->first('kerusakanbarang.'.$i) }}</span><br>    				
							<textarea name="kerusakanbarang[{{$i}}]" value="{{ old('kerusakanbarang.'.$i) }}" class="materialize-textarea" cols="30" rows="10"></textarea>
				    	</div>  

				    	<div class="col s4 input-field">
				    		Spesifikasi Barang <br>
				    		<span class="error red-text">{{ $errors->first('spesifikasibarang.'.$i) }}</span><br>    				
							<textarea name="spesifikasibarang[{{$i}}]" value="{{ old('spesifikasibarang.'.$i) }}" class="materialize-textarea" cols="30" rows="10"></textarea>
				    	</div>

				    	<div class="col s4 input-field">
				    		Keterangan Barang <br>
				    		<span class="error red-text">{{ $errors->first('keteranganbarang.'.$i) }}</span><br>    				
							<textarea name="keteranganbarang[{{$i}}]" value="{{ old('keteranganbarang.'.$i) }}" class="materialize-textarea" cols="30" rows="10"></textarea>
				    	</div>    
				    </div><hr>
			    </div>		
				@endfor

			</div>

			<div class="row">
				<div class="col s4 offset-s4 valign-wrapper">
					<div class="valign">			
						{!! csrf_field() !!}									
						<button class="btn waves-light waves-effect teal">
							BUAT SEMUA BARANG
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