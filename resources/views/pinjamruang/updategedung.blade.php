@extends('sidebar')

@section('sidebar_buatgedung', 'active white-text')

@section('konten')
<div class="subsection">
	<h5>Update Gedung</h5>
	<div class="divider"></div><br>

	<div class="row">
		<div class="col s6 push-s3">
			<form action="{{ url('/pinjamruang/gedung/ubah/'.$data['gedung'][0]->hash) }}" method="POST">
				{!! csrf_field() !!}

				<div class="input-field">
					<b>Nama Gedung</b><br>
					<span class="error red-text">{{ (session()->get('error_gedung') == '') ? $errors->first('namagedung') : session()->get('error_gedung') }}</span><br>
					<input type="text" name="namagedung" value="{{ (isset($data['gedung'])) ? ($data['gedung'][0]['NamaGedung']) : old('namagedung') }}" placeholder="contoh: Gedung C, Gedung Seminar" maxlength="25" required/>
					<input type="hidden" name="hash" value="{{$data['gedung'][0]['hash']}}">
				</div><br>

				<div class="input-field center">
					<button class="btn teal waves-light waves-effect" onclick="return confirm('Anda yakin ingin mengubah detail gedung ini?')">
						UPDATE GEDUNG
						<i class="material-icons right">send</i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
@stop