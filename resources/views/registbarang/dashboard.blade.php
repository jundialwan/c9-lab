@extends('sidebar')

@section('sidebar_dashboard', 'active white-text')

@section('konten')
<div class="subsection">
    <h5>Daftar Permohonan Registrasi Barang</h5>
    <div class="divider"></div><br>

    <div id="tableHead" class="row">
        <div class="col s1">Id</div>
        <div class="col s5">Subjek</div>            
        <div class="col s6">Status</div>
    </div>

    <ul class="collapsible" data-collapsible="accordion">
        @for($i=0; $i < count($data['allregistrasi']); $i++)
        
        <li>
            <div class="collapsible-header active">                                                        
                <div class="col s1">{{ $data['allregistrasi'][$i]->IdPermohonan }}</div>
                <div class="col s5" style="word-wrap: normal">{{ $data['allregistrasi'][$i]->SubjekPermohonan }}</div>                                          			
                <div class="col s6">
                	@if($data['allregistrasi'][$i]->TahapPermohonan == 1)

                		@if($data['allregistrasi'][$i]->StatusPermohonan == 0 )
                			{{'Ditinjau ke Lapangan'}}
                		@elseif($data['allregistrasi'][$i]->StatusPermohonan == 1 )
                			{{'Ditolak pada proses verifikasi'}}
                		@elseif($data['allregistrasi'][$i]->StatusPermohonan == 2 )
            				{{'Sudah diverifikasi Staf'}}
            			@endif

            		@elseif($data['allregistrasi'][$i]->TahapPermohonan == 2)

            			@if($data['allregistrasi'][$i]->StatusPermohonan == 1 )
                			{{'Ditolak'}}
                		@elseif($data['allregistrasi'][$i]->StatusPermohonan == 2 )
                			{{'Diterima'}}
            			@endif

            		@endif
                </div>
            </div>

            <div class="collapsible-body">                                        
                <div class="row no-row">
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-title">
                                    Detail Permohonan
                                </div>

                                <div class="row">
                                    <div class="col s6">
                                        @if ($data['user_sess']->Role == 'Manager Fasilitas & Infrastruktur' || $data['user_sess']->Role == 'Staf Fasilitas & Infrastruktur')

                                            @if ($data['allregistrasi'][$i]->NomorSurat != null)                            
                                            <b>Nomor Surat:</b><br>
                                            <span class="wrap-text">
                                                {{ $data['allregistrasi'][$i]->NomorSurat }}                                
                                            </span>
                                            @else
                                            <b>Nomor Surat:</b><br>
                                            <span class="grey-text"><i>Belum ada nomor surat</i></span>
                                            @endif

                                        @else

                                            @if ($data['allregistrasi'][$i]->NomorSurat != null)
                                            <b>Nomor Surat:</b><br>
                                            <span class="wrap-text">
                                                {{ $data['allregistrasi'][$i]->NomorSurat }}
                                            </span>
                                            @else
                                            <b>Nomor Surat:</b><br>
                                            <span class="grey-text"><i>Belum ada nomor surat</i></span>
                                            @endif

                                        @endif
                                    </div>
                                    <div class="col s6">
                                        <b>Waktu Permohonan :</b><br>
                                        {{ $data['allregistrasi'][$i]->created_at }}
                                    </div>                                                        
                                </div>

                                <div class="row">
                                    <div class="col s6">
                                        <b>Subjek Permohnan:</b><br>
                                        {{ $data['allregistrasi'][$i]->SubjekPermohonan }}
                                    </div>
                                    <div class="col s6">
                                        <b>Pemohon</b><br>
                                        {{ $data['allregistrasi'][$i]->Nama }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s6">
                                        <b>Status Permohonan:</b><br>
                                        @if($data['allregistrasi'][$i]->TahapPermohonan == 1)

                                            @if($data['allregistrasi'][$i]->StatusPermohonan == 0 )
                                                {{'Ditinjau ke Lapangan'}}
                                            @elseif($data['allregistrasi'][$i]->StatusPermohonan == 1 )
                                                {{'Ditolak pada proses verifikasi'}}
                                            @elseif($data['allregistrasi'][$i]->StatusPermohonan == 2 )
                                                {{'Sudah diverifikasi Staf'}}
                                            @endif

                                        @elseif($data['allregistrasi'][$i]->TahapPermohonan == 2)

                                            @if($data['allregistrasi'][$i]->StatusPermohonan == 1 )
                                                {{'Ditolak'}}
                                            @elseif($data['allregistrasi'][$i]->StatusPermohonan == 2 )
                                                {{'Diterima'}}
                                            @endif

                                        @endif
                                    </div>
                                    <div class="col s6">
                                        <b>Barang yang diregistrasikan:</b><br>
                                        <a href="#kandidat-barang{{$i}}" class="modal-trigger btn waves-light waves-effect">
                                            LIHAT SEMUA BARANG
                                        </a>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                

                <!-- Modal Structure -->
                <div id="kandidat-barang{{$i}}" class="modal">
                    <div class="modal-content">
                        <ul class="collection">
                            @foreach($data['allkandidat'] as $kandidat)

                            @if($kandidat->IdPermohonan == $data['allregistrasi'][$i]->IdPermohonan)
                            <li class="collection-item">
                                <h5>{{$kandidat->NamaBarang}}</h5>
                                <div class="row">
                                    <div class="col s4">
                                        <b>Tanggal Beli</b><br>
                                        {{date('d F Y', strtotime($kandidat->TanggalBeli))}}
                                    </div>
                                    <div class="col s4">
                                        <b>Penanggung Jawab</b><br>
                                        <span class="wrap-text">
                                            {{$kandidat->Penanggungjawab}}
                                        </span>
                                    </div>
                                    <div class="col s4">
                                        <b>Kategori Barang</b><br>
                                            {{$kandidat->KategoriBarang}}
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s4">
                                        <b>Jenis Barang</b><br>
                                            {{$kandidat->JenisBarang}}
                                        </span>
                                    </div>
                                    <div class="col s4">
                                        <b>Kondisi Barang</b><br>
                                        <span class="wrap-text">
                                            {{$kandidat->KondisiBarang}}
                                        </span>
                                    </div>

                                    <div class="col s4">
                                        <b>Keterangan Barang</b><br>
                                        <span class="wrap-text">
                                            {{$kandidat->KeteranganBarang}}
                                        </span>
                                    </div>
                                </div>

                                <div class="row">                            
                                    <div class="col s12">
                                        <b>Spesifikasi Barang</b><br>
                                        <span class="wrap-text">
                                            {{$kandidat->SpesifikasiBarang}}
                                        </span>
                                    </div>
                                </div>                                
                            </li>
                            @endif

                            @endforeach
                        </ul>
                    </div>

                    <div class="modal-footer">
                        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">TUTUP</a>
                    </div>
                </div>

                <div class="row no-row">
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-title">
                                    Catatan
                                </div>

                                <ul class="collection">

                                    @for($j=0; $j < count($data['allcatatan']); $j++)
                                    
                                    @if($data['allcatatan'][$j]->IdPermohonan == $data['allregistrasi'][$i]->IdPermohonan)                

                                    <li class="collection-item">                                        
                                        <b>Catatan {{ $data['allcatatan'][$j]->Role }}:</b><br>
                                        <i>Oleh {{ $data['allcatatan'][$j]->Nama }}</i><br>
                                        <p class="wrap-text">
                                            {{ $data['allcatatan'][$j]->DeskripsiCatatan }}
                                        </p>
                                        <input type="hidden" name="hashCatatan[{{$j+1}}]" value="{{ $data['allcatatan'][$j]->hashCatatan }}">                                        
                                    </li>

                                    @endif                    

                                    @endfor
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end foreach regiscatatan -->
                
                @if ($data['user_sess']->Role == 'Manager Fasilitas & Infrastruktur' || $data['user_sess']->Role == 'Staf Fasilitas & Infrastruktur')
                
                @if (
                    ($data['allregistrasi'][$i]->TahapPermohonan == 1 && $data['allregistrasi'][$i]->StatusPermohonan == 0) ||
                    ($data['allregistrasi'][$i]->TahapPermohonan == 1 && $data['allregistrasi'][$i]->StatusPermohonan == 2 && $data['user_sess']->Role == 'Manager Fasilitas & Infrastruktur') 
                )
                
                <div class="row no-row">
                    <div class="col s12">
                        <form action="{{ url('registrasibarang/ubahstatus') }}" method="POST">
                            {!! csrf_field() !!}
                            <input type="hidden" name="hashPermohonan" value="{{ $data['allregistrasi'][$i]->hashPermohonan }}">

                            <div class="card">
                                <div class="card-content">
                                    <div class="card-title">
                                        Persetujuan
                                    </div>

                                    <span class="wrap-text grey-text">
                                        Persetujuan tidak dapat dibatalkan. Periksalah kembali kelengkapan data sebelum memberikan persetujuan.
                                    </span><br><br>
                                    
                                    @if ($data['allregistrasi'][$i]->NomorSurat == null)
                                    Nomor Surat <br>
                                    <input type="text" name="nomorsurat" maxlength="100" required/>
                                    @endif                        

                                    Catatan: <br>
                                    <textarea class="materialize-textarea" class="validate" name="catatan_txtarea" cols="30" rows="30" placeholder="Jika tidak ada catatan tulis 'Tidak ada'" required></textarea>

                                </div>

                                <div class="card-action">
                                    <div class="row no-row">
                                        <div class="col s12">
                                            <input type="submit" value="TOLAK" name="tolak" class="waves-effect waves-red btn red right"/>
                                            <input type="submit" value="SETUJU" name="setuju" class="btn waves-effect waves-light teal white-text right"/>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>                        
                </div>

                @endif

                @endif
                
                @if ($data['user_sess']->Role != 'Manajer Fasilitas & Infrastruktur' && $data['user_sess']->Role != 'Staf Fasilitas & Infrastruktur')
                <div class="row">                    
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-title">
                                    Informasi
                                </div>
                                <span class="wrap-text grey-text">
                                    Anda dapat mengubah detail permohonan dan detail semua barang yang ingin Anda registrasikan atau menghapus permohonan selama permohonan ini belum ditentukan 
                                    persetujuannya oleh Staf Fasilitas dan Infrastruktur                                    
                                </span>
                            </div>

                            <div class="card-action">
                                <div class="row no-row">
                                    <div class="col s12">
                                        @if ($data['allregistrasi'][$i]->StatusPermohonan == 0)

                                        <form action="{{ url('registrasibarang/batal') }}" method="POST" class="right">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="hashPermohonan" value="{{ $data['allregistrasi'][$i]->hashPermohonan }}"/>                            
                                            <a href="{{ url('registrasibarang/ubah/'.$data['allregistrasi'][$i]->hashPermohonan) }}" class="btn waves-effect waves-light teal white-text">
                                                UBAH
                                                <i class="material-icons right">edit</i>
                                            </a>
                                            <button class="btn waves-effect waves-light red white-text" onclick="return confirm('Anda yakin ingin menghapus permohonan registrasi barang ini?')">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </form>

                                        @else
                                        
                                        <div class="right">
                                            <a class="btn waves-effect waves-light teal white-text disabled">
                                                UBAH
                                                <i class="material-icons right">edit</i>
                                            </a>
                                            <button class="btn waves-effect waves-light red white-text disabled" onclick="return confirm('Anda yakin ingin menghapus permohonan registrasi barang ini?')">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </div>

                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>         
        </li> 

    	@endfor
        <!-- foreach allregistrasi -->
    </ul>
</div>

@stop
<!-- stop section konten -->