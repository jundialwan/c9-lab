@extends('sidebar')

@section('sidebar_buatruangan', 'active white-text')

@section('konten')
<div class="subsection">
	<h5>Buat Ruangan</h5>
	<div class="divider"></div><br>

	<form action="{{ url('pinjamruang/ruangan/buat') }}" method="POST">	
		<div class="row form-row">
			<div class="input-field col s6">
				<b>Nomor Ruangan </b><br>
				<span class="error red-text">{{ (session()->get('error_ruangan') == '') ? $errors->first('nomorruangan') : session()->get('error_ruangan') }}</span><br>
				<input placeholder="Harus 4 karakter, contoh: 1102" maxlength="4" id="subject" name="nomorruangan" type="text" class="validate" required>
			</div>
		</div>
		<div class="row form-row">
			<div class="input-field col s6">
				<b>Gedung</b><br>
				<span class="error red-text">{{ $errors->first('gedungruangan') }}</span><br>
			    <select id="gedungruangan" name="gedungruangan" required>
			    	<option disabled selected>Pilih Gedung Ruangan</option>
					@foreach ($data['allgedung'] as $gedung)				   
				   	<option value="{{$gedung->hash}}">{{ $gedung->NamaGedung }}</option>   	
			    	@endforeach	
			    </select>
			</div>
		</div>
		<div class="row form-row">
			<div class="input-field col s3">
				<b>Jenis Ruangan</b><br>
				<span class="error red-text">{{ $errors->first('jenisruangan') }}</span><br>
				<select name="jenisruangan" required>
					<option disabled selected>Pilih Jenis Ruangan</option>
	                <option value="Kelas">Ruang Kelas</option>
	                <option value="RuangRapatBesar">Ruang Rapat Besar</option>
	                <option value="RuangRapatKecil">Ruang Rapat Kecil</option>
	                <option value="Auditorium">Auditorium</option>
				</select>
			</div>
			<div class="input-field col s3">
				<b>Kapasitas (orang)</b><br>
				<span class="error red-text">{{ $errors->first('kapasitasruangan') }}</span><br>
				<input placeholder="contoh : 50" name="kapasitasruangan" id="subject" type="number" min="1" class="validate" required>
			</div>
		</div>
		<div class="row form-row">
			<div class="col s6">
		 		{!! csrf_field() !!}
		 		<button class="btn">
		 			BUAT RUANGAN
		 			<i class="material-icons right">send</i>
		 		</button>
			 </div>
		</div>
	</form>
</div>
@stop