@extends('sidebar')

@section('sidebar_buatjadwal', 'active white-text')

@section('konten')	
<div class="subsection">
	<h5>Buat Jadwal</h5>
    <div class="divider"></div><br>

	<form action="{{ url('pinjamruang/jadwal/buat') }}" method="POST">
		<div class="row ajaxform">			
			<div class="row">			
				<div class="col s6">
				 	<p>
						Pilih Jenis Ruangan :
			 		</p>

			 		@if ($data['user_sess']->Role == 'Staf PPAA')
					<p>
						<input name="jenisRuangan" type="radio" id="Kelas" value="Kelas"/>
					    <label for="Kelas">Ruang Kelas</label>				 	
					</p>
					@endif

					@if ($data['user_sess']->Role == 'Staf Sekretariat')
					<p>
					    <input name="jenisRuangan" type="radio" id="Auditorium" value="Auditorium"/>
					    <label for="Auditorium">Ruang Auditorium</label>
					</p>
					<p>
					    <input name="jenisRuangan" type="radio" id="RuangRapatBesar" value="RuangRapatBesar"/>
					    <label for="RuangRapatBesar">Ruang Rapat Besar</label>
					</p>
					<p>
					    <input name="jenisRuangan" type="radio" id="RuangRapatKecil" value="RuangRapatKecil"/>
					    <label for="RuangRapatKecil">Ruang Rapat Kecil</label>
					</p>
					@endif
				</div>
			</div>

			<div class="row">
				<div class="col s6">
					Pilih Tanggal Peminjaman :
					<input name="tanggal" type="date" class="pilihtanggalpinjam" required>
				</div>
			</div>

			<div class="row">
				<div class="col s12">
					Isi Waktu Peminjaman : <br>
				</div>	

				<div class="col s2">
					<select name="waktumulai" id="waktumulai" required>
						<option value="800">08:00</option>
						<option value="830">08:30</option>
						<option value="900">09:00</option>
						<option value="930">09:30</option>
						<option value="1000">10:00</option>
						<option value="1030">10:30</option>
						<option value="1100">11:00</option>
						<option value="1130">11:30</option>
						<option value="1200">12:00</option>
						<option value="1230">12:30</option>
						<option value="1300">13:00</option>
						<option value="1330">13:30</option>
						<option value="1400">14:00</option>
						<option value="1430">14:30</option>
						<option value="1500">15:00</option>
						<option value="1530">15:30</option>
						<option value="1600">16:00</option>
						<option value="1630">16:30</option>
						<option value="1700">17:00</option>
						<option value="1730">17:30</option>
						<option value="1800">18:00</option>
						<option value="1830">18:30</option>
						<option value="1900">19:00</option>
					</select>
				</div>
				<div class="col s2">
					 <h6 style="text-align: center">s.d.</h6>
				</div>
				<div class="col s2">
					<select name="waktuselesai" id="waktuselesai" required>
						<option value="800">08:00</option>
						<option value="830">08:30</option>
						<option value="900">09:00</option>
						<option value="930">09:30</option>
						<option value="1000">10:00</option>
						<option value="1030">10:30</option>
						<option value="1100">11:00</option>
						<option value="1130">11:30</option>
						<option value="1200">12:00</option>
						<option value="1230">12:30</option>
						<option value="1300">13:00</option>
						<option value="1330">13:30</option>
						<option value="1400">14:00</option>
						<option value="1430">14:30</option>
						<option value="1500">15:00</option>
						<option value="1530">15:30</option>
						<option value="1600">16:00</option>
						<option value="1630">16:30</option>
						<option value="1700">17:00</option>
						<option value="1730">17:30</option>
						<option value="1800">18:00</option>
						<option value="1830">18:30</option>
						<option value="1900">19:00</option>
					</select>
				</div>
			</div>		

			<div class="row" id="xyz">
				<div class="col s12">
					<a class="btn waves-effect waves-light" id="jadwaljson" name="Next Page">	
						CARI RUANGAN TERSEDIA
			    		<i class="material-icons right">navigate_next</i>
	  				</a>
	  			</div>
			</div>
		</div>

		<div class="row">
			<div class="col s12">
				Ruangan Tersedia :
			</div>
		
			<div id="tableHead" class="row">
				<div class="col s4">Gedung</div>
	    		<div class="col s3">Ruangan</div>
	    		<div class="col s3">Kapasitas</div>	
	    	</div>						
			<ul id="tabelRuangan" class="collection">

			</ul>
		</div>
			
		<div class="subsection">							
			<div class="row">
				<div class="col s12">
					Keperluan Penggunaan: <br>
				</div>
				<div class="col s6">
					<input name="keperluan" type="text" id="keperluan" class="validate" required>
				</div>
			</div>	
			
			<div class="row" id="xyz">
				<div class="col s12">
					{!! csrf_field() !!}
					<input type="hidden" name="pemohon" value="{{ $data['user_sess']->NomorInduk }}">
					<button class="btn waves-effect waves-light" id="formruangan" name="Next Page">	
						SIMPAN JADWAL			    	
	  				</button>
	  				</div>
				</div>		
			</form>
		</div>		
	</form>
</div>

<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	$.ajaxSetup({
		headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
	});

	$('#jadwaljson').click(function(){

		var kategori = $('input[type="radio"][name="jenisRuangan"]:checked').val();
		var tanggal = $('.pilihtanggalpinjam').val();
		var waktumulai = new Number($('select[name=waktumulai] option:selected').val());
		var waktuselesai = new Number($('select[name=waktuselesai] option:selected').val());

		// form validation
		var isWaktuSelesaiLebihKecil = (((waktumulai)-(waktuselesai)) >= 0) ? true : false;
		var isKategoriUndefined = (kategori == undefined) ? true : false;
		var isTanggalEmpty = (tanggal == '') ? true : false;

		var kategori = $('input[type="radio"][name="jenisRuangan"]:checked').val();
		var tanggal = $('.pilihtanggalpinjam').val();	
		var waktumulai = $('select[name=waktumulai] option:selected').val();
		var waktuselesai = $('select[name=waktuselesai] option:selected').val();

		// if form not validated don't execute the AJAX calling
		if (!isWaktuSelesaiLebihKecil && !isKategoriUndefined && !isTanggalEmpty) {
			$.ajax({
				url: 'getruangan?jenisRuangan='+kategori+'&tanggal='+tanggal+'&waktuMulai='+waktumulai+'&waktuSelesai='+waktuselesai,
				type: 'POST',				
				processData:false,
					
				success: function(data){				
					var myElementToAppendTo = $("#tabelRuangan");
					var i = 1;	

			       	myElementToAppendTo.html('');
			       	$.each($.parseJSON(data), function(idx, obj) {	
			           	myElementToAppendTo.append("<li class='collection-item'><div class='row form-row'><div class='col s4 pilihan'><input type='radio' name='ruangandipilih' id='radio"+i+"' value='"+obj.hashRuang+"'/><label for='radio"+i+"'>"+obj.NamaGedung+"</label></div><div class='col s3'>"+obj.NomorRuangan+"</div><div class='col s3'>"+obj.KapasitasRuangan+"</div><div class='col s2'><a class='waves-light waves-effect uncheck' id='"+i+"'><i class='material-icons red-text'>cancel</i></a></div></div></div></li>");
			           	i++;
					});
				},
				error: function(xhr, status, error){
					alert(status+' '+error+'. Mohon mengulangi kembali.');
				}
			})								
		}
	});

	$(document).on('change', 'input[type=radio][name=ruangandipilih]', function(){
		$('.ajaxform').hide(400);
	});

	$(document).on('click', '.uncheck', function(){
		var id = $(this).attr('id');		
		$('#radio'+id).prop('checked', false);
		if($('input[type=radio][name=ruangandipilih]:checked').val() == undefined) $('.ajaxform').show(400);
	});
});		
//]]>
</script>


  	


@stop
