@extends('sidebar')

@section('sidebar_dashboard', 'active')

@section('konten')
<div class="subsection">
	<h5>Daftar Permohonan Usulan Pengadaan</h5>
	<div class="divider"></div><br>

    <div id="tableHead" class="row">
        <div class="col s1">Id</div>
        <div class="col s3">Subjek</div>            
        <div class="col s5">Status</div>
        <div class="col s3">Pemohon</div>
    </div>
  
    <ul class="collapsible" data-collapsible="accordion">
            @for($i=0; $i < count($data['allpermohonan']); $i++)
           
                 @if($data['user_sess']->role == 'Staf Fasilitas & Infrastruktur' && $data['allpermohonan'][$i]->StatusPermohonan == 0) 
                	<li>
                		<div class="collapsible-header active">

                			<div class="col s1">{{ $data['allpermohonan'][$i]->IdPermohonan }} </div>
            		        <div class="col s3" style=>{{ $data['allpermohonan'][$i]->SubjekPermohonan}}</div>           
            		        <div class="col s5" style="">
                                 @if($data['allpermohonan'][$i]->StatusPermohonan === 0)
                                    {{ 'Dalam Proses Pelengkapan Dokumen' }}                   
                                @elseif($$data['allpermohonan'][$i]->StatusPermohonan === 1)
                                    {{ 'Dalam Proses Seleksi Vendor' }}                    
                                @elseif($data['allpermohonan'][$i]->StatusPermohonan === 2)
                                    {{ 'Vendor Mengerjakan Pengajuan Barang & Jasa' }}                    
                                @elseif($data['allpermohonan'][$i]-> StatusPermohonan === 3)
                                    {{
                                        'Dalam Proses Pembayaran'
                                    }}
                                @elseif($data['allpermohonan'][$i]-> StatusPermohonan === 4)
                                    {{
                                        'Permohonan Pengadaan Selesai'
                                    }}    
                                @endif
                            </div>
            		        <div class="col s3">{{$data['allpermohonan'][$i]->Nama}}</div>
                		</div>
                		<div class="collapsible-body">
                			<div class="row">
                				<div class="col s4">
                					@if ($data['allpermohonan'][$i]->NomorSurat != null)
                                        <b>Nomor Surat:</b><br>
                                        {{ $data['allpermohonan'][$i]->NomorSurat }}
                                        @else
                                        <b>Nomor Surat:</b><br>
                                        <span class="grey-text"><i>Belum ada nomor surat</i></span>
                                    @endif
                				</div>
                				<div class="col s4">
                					<b>Waktu Permohonan:</b><br>
                					 {{ date('j F Y, H:i', strtotime($data['allpermohonan'][$i]->created_at)) }}
                				</div>
                                <div class="col s4">
                                    <b>Link Anggaran:</b><br>
                                    {{$data['allpermohonan'][$i]->LinkAnggaran}}
                                </div>
                			</div>
                			<a id="#kandidat-barang{{$i}}" href=".modal" class="modal-trigger btn waves-light waves-effect">
                                LIHAT SEMUA USULAN BARANG
                            </a>

                            <div  id="kandidat-barang{{$i}}"class="modal">
                            	<div class="modal-content">	
                                    @foreach($data['allkandidat'] as $kandidat)

                                    @if($kandidat->IdPermohonan == $data['allpermohonan'][$i]->IdPermohonan)
                                    <h4>{{$kandidat->NamaBarang}}</h4>
                                    <div class="row">
                                        <div class="col s4">
                                            <b>Jenis Barang :</b><br>
                                            {{$kandidat->JenisBarang}}
                                        </div>
                                        <div class="col s4">
                                            <b>Kategori Barang :</b><br>
                                            {{$kandidat->KategoriBarang}}
                                        </div>
                                        <div class="col s4">
                                            <b>Kondisi Barang :</b><br>
                                            {{$kandidat->KondisiBarang}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s4">
                                            <b>Penanggung Jawab :</b><br>
                                            {{$kandidat->Penanggungjawab}}
                                        </div>
                                        <div class="col s4">
                                            <b>Spesifikasi Barang :</b><br>
                                            {{$kandidat->SpesifikasiBarang}}
                                        </div>
                                        <div class="col s4">
                                            <b>Keterangan Barang :</b><br>
                                            {{$kandidat->KeteranganBarang}}
                                        </div>
                                    </div>

                                    @endif
                                    @endforeach
                            		<!-- <h4>AC</h4>
                            		 <div class="row">
                                        
                                        <div class="col s4">
                                            <b>Jenis Barang :</b><br>
                                            AC
                                        </div>
                                        <div class="col s4">
                                            <b>Kategori Barang :</b><br>
                                            Elektronik
                                        </div>
                                        <div class="col s4">
                                            <b>Kondisi Barang :</b><br>
                                            Baru
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s4">
                                            <b>Penanggung Jawab :</b><br>
                                            Zahra Zuluthfa
                                        </div>
                                        <div class="col s4">
                                        	<b>Link Anggaran :</b><br>
                                        	bit.ly/LinkAnggaran
                                        </div>
                                    </div>
                                    <div class="row">                            
                                        <div class="col s4">
                                            <b>Spesifikasi Barang : </b><br>
                                            1/2 pk, merk panasonic
                                        </div>
                                        <div class="col s4">
                                            <b>Keterangan Barang</b><br>
                                            tidak ada
                                        </div> -->
                                    <!-- </div> --><hr>
                                    
                            	</div>
                            	<div class="modal-footer">
                                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">TUTUP</a>
                                </div>
                            </div>
                            <hr>

                            <div class="row"> 
                                @if ($data['user_sess']->role == 'Manager Fasilitas & Infrastruktur' || $data['user_sess']->role == 'Staf Fasilitas & Infrastruktur')
                                
                                @if (
                                    ($data['allpermohonan'][$i]->TahapPermohonan == 1 && $data['allpermohonan'][$i]->StatusPermohonan == 0) ||
                                    ($data['allpermohonan'][$i]->TahapPermohonan == 1 && $data['allpermohonan'][$i]->StatusPermohonan == 2 && $data['user_sess']->role == 'Manager Fasilitas & Infrastruktur') 
                                )
                                <form action="{{ url('registrasibarang/ubahstatus') }}" method="POST">
                                    <div class="col s6">
                                        <b>Setujui/Tolak Permohonan</b><br>
                                        @if ($data['allpermohonan'][$i]->NomorSurat == null)
                                        Nomor Surat <br>
                                        <input type="text" name="nomorsurat" required/>
                                        @endif                        
                                    </div>
                                    <div class="col s12">                                               
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="hashPermohonan" value="{{ $data['allpermohonan'][$i]->hashPermohonan }}"><br>
                                        Catatan: <br>
                                        <textarea class="materialize-textarea" class="validate" name="catatan_txtarea" cols="30" rows="30" required>Jika tidak ada catatan tulis "Tidak ada"</textarea>
                                        <input type="submit" value="TOLAK" name="tolak" class="waves-effect waves-red btn red right"/>
                                        <input type="submit" value="SETUJU" name="setuju" class="btn waves-effect waves-light teal white-text right"/>
                                    </div>
                                </form>
                                @endif

                                @endif
                            </div>
                            
                            @if ($data['user_sess']->role != 'Manager Fasilitas & Infrastruktur' && $data['user_sess']->role != 'Staf Fasilitas & Infrastruktur')
                            <div class="row">
                                <div class="col s11">
                                    <form action="" method="POST" class="right">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="hashPermohonan" value="{{ $data['allpermohonan'][$i]->hashPermohonan }}"/>                            
                                        <button class="btn waves-effect waves-light teal white-text">
                                            UBAH
                                            <i class="material-icons right">edit</i>
                                        </button>
                                    </form> 
                                </div>
                                <div class="col s1">                        
                                    <form action="" method="POST" class="right">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="hashPermohonan" value="{{ $data['allpermohonan'][$i]->hashPermohonan }}"/>                            
                                        <button class="btn waves-effect waves-light red white-text">                                
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </form> 
                                </div>
                            </div>
                            @endif
                        </div>         
                    </li> 

                    
                
                @elseif($data['user_sess']->role == 'Manager Fasilitas & Infrastruktur' && $data['allpermohonan'][$i]->StatusPermohonan >= 1)
                    <li>
                        <div class="collapsible-header active">

                            <div class="col s1">{{ $data['allpermohonan'][$i]->IdPermohonan }} </div>
                            <div class="col s3" style="word-wrap: break-word;"><p>{{ $data['allpermohonan'][$i]->SubjekPermohonan}}</p>
                            
                            </div>            
                            <div class="col s5" style="">
                                 @if($data['allpermohonan'][$i]->StatusPermohonan === 0)
                                    {{ 'Dalam Proses Pelengkapan Dokumen' }}                   
                                @elseif($data['allpermohonan'][$i]->StatusPermohonan === 1)
                                    {{ 'Dalam ProsesSeleksi Vendor' }}                    
                                @elseif($data['allpermohonan'][$i]->StatusPermohonan === 2)
                                    {{ 'Vendor Mengerjakan Pengajuan Barang & Jasa' }}                    
                                @elseif($data['allpermohonan'][$i]-> StatusPermohonan === 3)
                                    {{
                                        'Dalam Proses Pembayaran'
                                    }}
                                @elseif($data['allpermohonan'][$i] -> StatusPermohonan === 4)
                                    {{
                                        'Permohonan Pengadaan Selesai'
                                    }}    
                                @endif
                            </div>
                            <div class="col s3">{{$data['allpermohonan'][$i]->Nama}}</div>
                        </div>
                        <div class="collapsible-body">
                            <div class="row">
                                <div class="col s4">
                                    @if ($data['allpermohonan'][$i]->NomorSurat != null)
                                        <b>Nomor Surat:</b><br>
                                        {{ $data['allpermohonan'][$i]->NomorSurat }}
                                        @else
                                        <b>Nomor Surat:</b><br>
                                        <span class="grey-text"><i>Belum ada nomor surat</i></span>
                                    @endif
                                </div>
                                <div class="col s4">
                                    <b>Waktu Permohonan:</b><br>
                                     {{ date('j F Y, H:i', strtotime($data['allpermohonan'][$i]->created_at)) }}
                                </div>
                                <div class="col s4">
                                    <b>Link Anggaran:</b><br>
                                    {{$data['allpermohonan'][$i]->LinkAnggaran}}
                                </div>
                            </div>
                            <a href="#kandidat-barang{{$i}}" class="modal-trigger btn waves-light waves-effect">
                                LIHAT SEMUA USULAN BARANG
                            </a>

                            <div id="kandidat-barang{{$i}}"class="modal">
                                <div class="modal-content"> 
                                    @foreach($data['allkandidat'] as $kandidat)

                                    @if($kandidat->IdPermohonan == $data['allpermohonan'][$i]->IdPermohonan)
                                    <h4>{{$kandidat->NamaBarang}}</h4>
                                    <div class="row">
                                        <div class="col s4">
                                            <b>Jenis Barang :</b><br>
                                            {{$kandidat->JenisBarang}}
                                        </div>
                                        <div class="col s4">
                                            <b>Kategori Barang :</b><br>
                                            {{$kandidat->KategoriBarang}}
                                        </div>
                                        <div class="col s4">
                                            <b>Kondisi Barang :</b><br>
                                            {{$kandidat->KondisiBarang}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s4">
                                            <b>Penanggung Jawab :</b><br>
                                            {{$kandidat->Penanggungjawab}}
                                        </div>
                                        <div class="col s4">
                                            <b>Spesifikasi Barang :</b><br>
                                            {{$kandidat->SpesifikasiBarang}}
                                        </div>
                                        <div class="col s4">
                                            <b>Keterangan Barang :</b><br>
                                            {{$kandidat->KeteranganBarang}}
                                        </div>
                                    </div>

                                    @endif
                                    @endforeach
                                    <!-- <h4>AC</h4>
                                     <div class="row">
                                        
                                        <div class="col s4">
                                            <b>Jenis Barang :</b><br>
                                            AC
                                        </div>
                                        <div class="col s4">
                                            <b>Kategori Barang :</b><br>
                                            Elektronik
                                        </div>
                                        <div class="col s4">
                                            <b>Kondisi Barang :</b><br>
                                            Baru
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s4">
                                            <b>Penanggung Jawab :</b><br>
                                            Zahra Zuluthfa
                                        </div>
                                        <div class="col s4">
                                            <b>Link Anggaran :</b><br>
                                            bit.ly/LinkAnggaran
                                        </div>
                                    </div>
                                    <div class="row">                            
                                        <div class="col s4">
                                            <b>Spesifikasi Barang : </b><br>
                                            1/2 pk, merk panasonic
                                        </div>
                                        <div class="col s4">
                                            <b>Keterangan Barang</b><br>
                                            tidak ada
                                        </div> -->
                                    <!-- </div> --><hr>
                                    
                                </div>
                                <div class="modal-footer">
                                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">TUTUP</a>
                                </div>
                            </div>
                            <hr>

                            <div class="row"> 
                                @if ($data['user_sess']->role == 'Manager Fasilitas & Infrastruktur' || $data['user_sess']->role == 'Staf Fasilitas & Infrastruktur')
                                
                                @if (
                                    ($data['allpermohonan'][$i]->TahapPermohonan == 1 && $data['allpermohonan'][$i]->StatusPermohonan == 0) ||
                                    ($data['allpermohonan'][$i]->TahapPermohonan == 1 && $data['allpermohonan'][$i]->StatusPermohonan == 1 && $data['user_sess']->role == 'Manager Fasilitas & Infrastruktur') 
                                )
                                <form action="{{ url('registrasibarang/ubahstatus') }}" method="POST">
                                    <div class="col s6">
                                        <b>Setujui/Tolak Permohonan</b><br>
                                        @if ($data['allpermohonan'][$i]->NomorSurat == null)
                                        Nomor Surat <br>
                                        <input type="text" name="nomorsurat" required/>
                                        @endif                        
                                    </div>
                                    <div class="col s12">                                               
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="hashPermohonan" value="{{ $data['allpermohonan'][$i]->hashPermohonan }}"><br>
                                        Catatan: <br>
                                        <textarea class="materialize-textarea" class="validate" name="catatan_txtarea" cols="30" rows="30" required>Jika tidak ada catatan tulis "Tidak ada"</textarea>
                                        <input type="submit" value="TOLAK" name="tolak" class="waves-effect waves-red btn red right"/>
                                        <input type="submit" value="SETUJU" name="setuju" class="btn waves-effect waves-light teal white-text right"/>
                                    </div>
                                </form>
                                @endif

                                @endif
                            </div>
                            
                            @if ($data['user_sess']->role != 'Manager Fasilitas & Infrastruktur' && $data['user_sess']->role != 'Staf Fasilitas & Infrastruktur')
                            <div class="row">
                                <div class="col s11">
                                    <form action="" method="POST" class="right">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="hashPermohonan" value="{{ $data['allpermohonan'][$i]->hashPermohonan }}"/>                            
                                        <button class="btn waves-effect waves-light teal white-text">
                                            UBAH
                                            <i class="material-icons right">edit</i>
                                        </button>
                                    </form> 
                                </div>
                                <div class="col s1">                        
                                    <form action="" method="POST" class="right">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="hashPermohonan" value="{{ $data['allpermohonan'][$i]->hashPermohonan }}"/>                            
                                        <button class="btn waves-effect waves-light red white-text">                                
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </form> 
                                </div>
                            </div>
                            @endif
                        </div>         
                    </li> 
                @else
                    <li>
                        <div class="collapsible-header active">

                            <div class="col s1">{{ $data['allpermohonan'][$i]->IdPermohonan }} </div>
                            <div class="col s3" style="word-wrap: break-word;">{{ $data['allpermohonan'][$i]->SubjekPermohonan}}</div>            
                            <div class="col s5" style="">
                                 @if($data['allpermohonan'][$i]->StatusPermohonan === 0)
                                    {{ 'Dalam Proses Pelengkapan Dokumen' }}                   
                                @elseif($data['allpermohonan'][$i]->StatusPermohonan === 1)
                                    {{ 'Pengadaan Melakukan Seleksi Vendor' }}                    
                                @elseif($data['allpermohonan'][$i]->StatusPermohonan === 2)
                                    {{ 'Vendor Mengerjakan Pengajuan Barang & Jasa' }}                    
                                @elseif($data['allpermohonan'][$i] -> StatusPermohonan === 3)
                                    {{
                                        'Pengadaan Dalam Proses Pembayaran'
                                    }}
                                @elseif($data['allpermohonan'][$i] -> StatusPermohonan === 4)
                                    {{
                                        'Permohonan Pengadaan Selesai'
                                    }}    
                                @endif
                            </div>
                            <div class="col s3">{{$data['allpermohonan'][$i]->Nama}}</div>
                        </div>
                        <div class="collapsible-body">
                            <div class="row">
                                <div class="col s4">
                                    @if ($data['allpermohonan'][$i]->NomorSurat != null)
                                        <b>Nomor Surat:</b><br>
                                        {{ $data['allpermohonan'][$i]->NomorSurat }}
                                        @else
                                        <b>Nomor Surat:</b><br>
                                        <span class="grey-text"><i>Belum ada nomor surat</i></span>
                                    @endif
                                </div>
                                <div class="col s4">
                                    <b>Waktu Permohonan:</b><br>
                                     {{ date('j F Y, H:i', strtotime($data['allpermohonan'][$i]->created_at)) }}
                                </div>
                                <div class="col s4">
                                    <b>Link Anggaran:</b><br>
                                    {{$data['allpermohonan'][$i]->LinkAnggaran}}
                                </div>
                            </div>
                            <a href="#kandidat-barang{{$i}}" class="modal-trigger btn waves-light waves-effect">
                                LIHAT SEMUA USULAN BARANG
                            </a>

                            <div id="kandidat-barang{{$i}}"class="modal">
                                <div class="modal-content"> 
                                    @foreach($data['allkandidat'] as $kandidat)

                                    @if($kandidat->IdPermohonan == $data['allpermohonan'][$i]->IdPermohonan)
                                    <h4>{{$kandidat->NamaBarang}}</h4>
                                    <div class="row">
                                        <div class="col s4">
                                            <b>Jenis Barang :</b><br>
                                            {{$kandidat->JenisBarang}}
                                        </div>
                                        <div class="col s4">
                                            <b>Kategori Barang :</b><br>
                                            {{$kandidat->KategoriBarang}}
                                        </div>
                                        <div class="col s4">
                                            <b>Kondisi Barang :</b><br>
                                            {{$kandidat->KondisiBarang}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s4">
                                            <b>Penanggung Jawab :</b><br>
                                            {{$kandidat->Penanggungjawab}}
                                        </div>
                                        <div class="col s4">
                                            <b>Spesifikasi Barang :</b><br>
                                            {{$kandidat->SpesifikasiBarang}}
                                        </div>
                                        <div class="col s4">
                                            <b>Keterangan Barang :</b><br>
                                            {{$kandidat->KeteranganBarang}}
                                        </div>
                                    </div>

                                    @endif
                                    @endforeach
                                    <!-- <h4>AC</h4>
                                     <div class="row">
                                        
                                        <div class="col s4">
                                            <b>Jenis Barang :</b><br>
                                            AC
                                        </div>
                                        <div class="col s4">
                                            <b>Kategori Barang :</b><br>
                                            Elektronik
                                        </div>
                                        <div class="col s4">
                                            <b>Kondisi Barang :</b><br>
                                            Baru
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s4">
                                            <b>Penanggung Jawab :</b><br>
                                            Zahra Zuluthfa
                                        </div>
                                        <div class="col s4">
                                            <b>Link Anggaran :</b><br>
                                            bit.ly/LinkAnggaran
                                        </div>
                                    </div>
                                    <div class="row">                            
                                        <div class="col s4">
                                            <b>Spesifikasi Barang : </b><br>
                                            1/2 pk, merk panasonic
                                        </div>
                                        <div class="col s4">
                                            <b>Keterangan Barang</b><br>
                                            tidak ada
                                        </div> -->
                                    <!-- </div> --><hr>
                                    
                                </div>
                                <div class="modal-footer">
                                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">TUTUP</a>
                                </div>
                            </div>
                            <hr>

                            <div class="row"> 
                                @if ($data['user_sess']->role == 'Manager Fasilitas & Infrastruktur' || $data['user_sess']->role == 'Staf Fasilitas & Infrastruktur')
                                
                                @if (
                                    ($data['allpermohonan'][$i]->TahapPermohonan == 1 && $data['allpermohonan'][$i]->StatusPermohonan == 0) ||
                                    ($data['allpermohonan'][$i]->TahapPermohonan == 1 && $data['allpermohonan'][$i]->StatusPermohonan == 2 && $data['user_sess']->role == 'Manager Fasilitas & Infrastruktur') 
                                )
                                <form action="{{ url('registrasibarang/ubahstatus') }}" method="POST">
                                    <div class="col s6">
                                        <b>Setujui/Tolak Permohonan</b><br>
                                        @if ($data['allpermohonan'][$i]->NomorSurat == null)
                                        Nomor Surat <br>
                                        <input type="text" name="nomorsurat" required/>
                                        @endif                        
                                    </div>
                                    <div class="col s12">                                               
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="hashPermohonan" value="{{ $data['allpermohonan'][$i]->hashPermohonan }}"><br>
                                        Catatan: <br>
                                        <textarea class="materialize-textarea" class="validate" name="catatan_txtarea" cols="30" rows="30" required>Jika tidak ada catatan tulis "Tidak ada"</textarea>
                                        <input type="submit" value="TOLAK" name="tolak" class="waves-effect waves-red btn red right"/>
                                        <input type="submit" value="SETUJU" name="setuju" class="btn waves-effect waves-light teal white-text right"/>
                                    </div>
                                </form>
                                @endif

                                @endif
                            </div>
                            
                            @if ($data['user_sess']->role != 'Manager Fasilitas & Infrastruktur' && $data['user_sess']->role != 'Staf Fasilitas & Infrastruktur')
                            <div class="row">
                                <div class="col s11">
                                    <form action="" method="POST" class="right">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="hashPermohonan" value="{{ $data['allpermohonan'][$i]->hashPermohonan }}"/>                            
                                        <button class="btn waves-effect waves-light teal white-text">
                                            UBAH
                                            <i class="material-icons right">edit</i>
                                        </button>
                                    </form> 
                                </div>
                                <div class="col s1">                        
                                    <form action="" method="POST" class="right">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="hashPermohonan" value="{{ $data['allpermohonan'][$i]->hashPermohonan }}"/>                            
                                        <button class="btn waves-effect waves-light red white-text">                                
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </form> 
                                </div>
                            </div>
                            @endif
                        </div>         
                    </li>  
                @endif
            @endfor
    		
    </ul>

</div>
@stop