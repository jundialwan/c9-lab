@extends('sidebar')

@section('konten')
<div class="subsection">
	<h5>Login SIFITRIA</h5>
	<div class="divider"></div><br>

	<div class="row">
		<div class="col s6 push-s3">
			<form action="{{ url('login') }}" method="POST">
				<div class="card">
					<div class="card-content">
						<div class="card-title">
							Login
						</div>

						@if (session()->get('login_error') != '' )

						<span class="red-text">{{ session()->get('login_error') }}</span>

						@endif
						
						{!! csrf_field() !!}
						<input type="text" name="user" placeholder="username" required><br>
						<input type="password" name="pass" placeholder="password" required><br>

					</div>

					<div class="card-action">
						<div class="row no-row">
							<div class="col s12">
								<button class="btn waves-light waves-effect right">
									<i class="material-icons right">send</i>
									LOGIN
								</button>							
							</div>
						</div>
					</div>
				</div>				
			</form>									
		</div>
	</div>
</div>
@stop