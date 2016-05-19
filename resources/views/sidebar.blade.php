@extends('master')

@section('pinjamruang_header')
	<h6 class="collection-item menu-item"><b>PEMINJAMAN RUANGAN</b></h6>
@endsection

@section('registrasibarang_header')
	<h6 class="collection-item menu-item"><b>REGISTRASI BARANG</b></h6>
@endsection

@section('maintenancebarang_header')
	<h6 class="collection-item menu-item">MAINTENANCE BARANG</h6>
@endsection

@section('usulanpengadaan_header')
	<h6 class="collection-item menu-item"><b>USULAN PENGADAAN</b></h6>
@endsection

@section('pinjamruang')
	<a href="{{ url('pinjamruang') }}" class="collection-item menu-item grey-text @yield('sidebar_dashboard')">Dashboard</a>
@endsection

@section('pinjamruang/buat')
	<a href="{{ url('pinjamruang/buat') }}" class="collection-item menu-item grey-text @yield('sidebar_buatpinjam')">Buat Permohonan</a>
@endsection

@section('pinjamruang/ruangan')
	<a href="{{ url('pinjamruang/ruangan') }}" class="collection-item menu-item grey-text @yield('sidebar_ruangan')">Ruangan</a>
@endsection

@section('pinjamruang/ruangan/buat')
	<a href="{{ url('pinjamruang/ruangan/buat') }}" class="collection-item menu-item grey-text @yield('sidebar_buatruang')">Buat Ruangan</a>
@endsection

@section('pinjamruang/jadwal')
	<a href="{{ url('pinjamruang/jadwal') }}" class="collection-item menu-item grey-text @yield('sidebar_jadwal')">Jadwal</a>
@endsection

@section('pinjamruang/jadwal/buat')
	<a href="{{ url('pinjamruang/jadwal/buat') }}" class="collection-item menu-item grey-text @yield('sidebar_buatjadwal')">Buat Jadwal</a>
@endsection

@section('pinjamruang/gedung')
	<a href="{{ url('pinjamruang/gedung') }}" class="collection-item menu-item grey-text @yield('sidebar_gedung')">Gedung</a>
@endsection

@section('pinjamruang/gedung/buat')
	<a href="{{ url('pinjamruang/gedung/buat') }}" class="collection-item menu-item grey-text @yield('sidebar_buatgedung')">Buat Gedung</a>
@endsection

@section('registrasibarang')
	<a href="{{ url('registrasibarang') }}" class="collection-item menu-item grey-text @yield('sidebar_dashboard')">Dashboard</a>
@endsection

@section('registrasibarang/buat')
	<a href="{{ url('registrasibarang/buat') }}" class="collection-item menu-item grey-text @yield('sidebar_buatregis')">Buat Permohonan</a>
@endsection

@section('registrasibarang/barang')
	<a href="{{ url('registrasibarang/barang') }}" class="collection-item menu-item grey-text @yield('sidebar_barang')">Barang</a>	          		
@endsection

@section('registrasibarang/barang/buat')
	<a href="{{ url('registrasibarang/barang/buat') }}" class="collection-item menu-item grey-text @yield('sidebar_buatbarang')">Buat Barang</a>
@endsection

@section('maintenancebarang')
	<a href="{{ url('maintenancebarang') }}" class="collection-item menu-item grey-text @yield('sidebar_dashboard')">Dashboard</a>
@endsection

@section('maintenancebarang/buat')
	<a href="{{ url('maintenancebarang/buat') }}" class="collection-item menu-item grey-text @yield('sidebar_buatusulan')">Buat Permohonan</a>
@endsection

@section('usulanpengadaan')
	<a href="{{ url('usulanpengadaan') }}" class="collection-item menu-item grey-text @yield('sidebar_dashboard')">Dashboard</a>
@endsection

@section('usulanpengadaan/buat')
	<a href="{{ url('usulanpengadaan/buat') }}" class="collection-item menu-item grey-text @yield('sidebar_buatusulan')">Buat Permohonan</a>
@endsection

@section('sidebar_menu')
	@if ($data['isLoggedIn'])
	
	@if ($data['title'] == 'Beranda')
		<h6 class="collection-item menu-item"><b>LOGGED IN</b></h5>		

	@elseif ($data['sidebar'] == 'pinjamruang')	
		<!-- Sidebar Peminjaman Ruangan, Manager Peminjaman -->
		@yield('pinjamruang_header')

		@yield('pinjamruang')
		@yield('pinjamruang/buat')
		@yield('pinjamruang/jadwal')
		@yield('pinjamruang/jadwal/buat')

		@if ($data['user_sess']->Role == 'Staf PPAA' || $data['user_sess']->Role == 'Staf Sekretariat')

		@yield('pinjamruang/ruangan')
		@yield('pinjamruang/ruangan/buat')
		@yield('pinjamruang/gedung')
		@yield('pinjamruang/gedung/buat')

		@endif
	
	@elseif ($data['sidebar'] == 'registbarang')

		@yield('registrasibarang_header')		
		@yield('registrasibarang')

		@if (in_array($data['user_sess']->Role, ['Staf', 'HM'], true))

		@yield('registrasibarang/buat')

		@endif

		@if ($data['user_sess']->Role == 'Staf Fasilitas & Infrastruktur' || $data['user_sess']->Role == 'Manajer Fasilitas & Infrastruktur')
		
		@yield('registrasibarang/barang')
		@yield('registrasibarang/barang/buat')

		@endif
	
	@elseif ($data['sidebar'] == 'maintenancebarang')

		@yield('maintenancebarang_header')

		@yield('maintenancebarang')

		@if (in_array($data['user_sess']->Role, ['Staf', 'HM'], true))

		@yield('maintenancebarang/buat')

		@endif
	
	@elseif ($data['sidebar'] == 'usulanpengadaan')

		@yield('usulanpengadaan_header')

		@yield('usulanpengadaan')
	
		@if (in_array($data['user_sess']->Role, ['Staf', 'HM'], true))

		@yield('usulanpengadaan/buat')	

		@endif

	@endif
	<!-- end if role -->

	@endif
	<!-- end if check login -->

@endsection