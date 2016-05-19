@extends('sidebar')

@section('sidebar_gedung', 'active white-text')

@section('konten')
<div class="subsection">
	<h5>Daftar Gedung</h5>
	<div class="divider"></div><br>

	<div class="row">
		<div class="col s8 push-s2">
			<table class="bordered responsive-table">						
		        <thead>
		          	<tr>
		            	<th><b>Nama Gedung</b></th>
	            		<th><p></p></th>
	            		<th><p></p></th>
	            		<th><p></p></th>
		          	</tr>
		        </thead>

		        <tbody>
		        	@foreach ($data['allgedung'] as $gedung)

					<tr>
						<td colspan="5" class="NamaGedung">{{$gedung->NamaGedung}}</td>							
						<td>							
						</td>
						<td>
							<form action="{{ url('pinjamruang/gedung/hapus') }}" method="POST">									
								{!! csrf_field() !!}
								<input type="hidden" name="hash" value="{{$gedung->hash}}">
								<a href="{{ url('pinjamruang/gedung/ubah/'.$gedung->hash) }}" class="btn purple waves-light waves-effect">
									UBAH
									<i class="material-icons left">edit</i>
								</a>
								<button class="btn-flat grey-text" onClick="return confirm('Anda yakin ingin menghapus gedung ini? Ruangan, jadwal, dan permohonan yang berasosiasi dengan gedung ini juga akan dihapus.')">
									HAPUS
									<i class="material-icons left">delete</i>
								</button>
							</form>																					
						</td>
					</tr>

		        	@endforeach
				</tbody>
		    </table>
		</div>
	</div>
</div>

@stop