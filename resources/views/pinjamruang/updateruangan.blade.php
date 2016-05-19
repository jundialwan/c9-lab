@extends('sidebar')

@section('sidebar_buatruangan', 'active white-text')

@section('konten')
<div class="subsection">
	<h5>Update Ruangan</h5>
	<div class="divider"></div><br>

	<form action="{{ url('pinjamruang/ruangan/ubah/'.$data['ruangan'][0]['hashRuang']) }}" method="POST">	
		<div class="row form-row">
			<div class="input-field col s6">
				<b>Nomor Ruangan </b><br>
				<span class="error red-text">{{ (session()->get('error_ruangan') == '') ? $errors->first('nomorruangan') : session()->get('error_ruangan') }}</span><br>
				<input placeholder="Harus 4 karakter, contoh: 1102" value="{{ (isset($data['ruangan'])) ? ($data['ruangan'][0]['NomorRuangan']) : old('nomorruangan') }}" maxlength="4" id="subject" name="nomorruangan" type="text" class="validate" required>
			</div>
		</div>
		
		<div class="row form-row">
			<div class="input-field col s3">
				<b>Jenis Ruangan</b><br>
				<span class="error red-text">{{ $errors->first('jenisruangan') }}</span><br>
				<select name="jenisruangan" required>
					<option disabled>Pilih Jenis Ruangan</option>
	                <option value="Kelas" {{ ($data['ruangan'][0]['JenisRuangan'] == 'Kelas') ? 'selected' : ''}}>Ruang Kelas</option>
	                <option value="RuangRapatBesar" {{ ($data['ruangan'][0]['JenisRuangan'] == 'RuangRapatBesar') ? 'selected' : ''}}>Ruang Rapat Besar</option>
	                <option value="RuangRapatKecil" {{ ($data['ruangan'][0]['JenisRuangan'] == 'RuangRapatKecil') ? 'selected' : ''}}>Ruang Rapat Kecil</option>
	                <option value="Auditorium" {{ ($data['ruangan'][0]['JenisRuangan'] == 'Auditorium') ? 'selected' : ''}}>Auditorium</option>
				</select>
			</div>
			<div class="input-field col s3">
				<b>Kapasitas (orang)</b><br>
				<span class="error red-text">{{ $errors->first('kapasitasruangan') }}</span><br>
				<input placeholder="contoh : 50" name="kapasitasruangan" value="{{ (isset($data['ruangan'])) ? ($data['ruangan'][0]['KapasitasRuangan']) : old('kapasitasruangan') }}" id="subject" type="number" min="1" class="validate" required>
			</div>
		</div>
		
		<div class="row form-row">
			<div class="col s6">
		 		{!! csrf_field() !!}
		 		<input type="hidden" name="hash" value="{{$data['ruangan'][0]['hashRuang']}}">
		 		<button class="btn" onclick="return confirm('Anda yakin ingin mengubah detail ruangan ini?')">
		 			UPDATE RUANGAN
		 			<i class="material-icons right">send</i>
		 		</button>
			 </div>
		</div>
	</form>
</div>
@stop