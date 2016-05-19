@extends('sidebar')

@section('sidebar_dashboard', 'active white-text')

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
       
        <li>
            <div class="collapsible-header active">

                <div class="col s1">{{ $data['allpermohonan'][$i]->IdPermohonan }} </div>
                <div class="col s3" style="word-wrap: normal;">{{ $data['allpermohonan'][$i]->SubjekPermohonan}}</div>           
                <div class="col s5" style="">

                    @if($data['allpermohonan'][$i] -> TahapPermohonan === 1)
                        
                        @if($data['allpermohonan'][$i] -> StatusPermohonan === 0)
                            {{ 'Dalam Proses Persetujuan' }}
                        @elseif($data['allpermohonan'][$i] -> StatusPermohonan === 1)
                            {{'Ditolak oleh Staf Fasilitas & Infrastruktur'}} 
                        @elseif($data['allpermohonan'][$i] -> StatusPermohonan === 2)
                            {{'Disetujui oleh Staf Fasilitas & Infrastruktur'}}    
                        @endif

                    @elseif($data['allpermohonan'][$i] -> TahapPermohonan === 2)
                       
                        @if($data['allpermohonan'][$i] -> StatusPermohonan === 1)
                            {{'Ditolak oleh Manajer Fasilitas & Infrastruktur'}}
                        @elseif($data['allpermohonan'][$i] -> StatusPermohonan === 2)
                            {{'Disetujui oleh Manajer Fasilitas & Infrastruktur'}}
                        @endif

                    @elseif($data['allpermohonan'][$i] -> TahapPermohonan ===3)
                        
                        
                        @if($data['allpermohonan'][$i] -> StatusPermohonan === 1)
                            {{'Ditolak oleh Wakil Dekan 2'}} 
                        @elseif($data['allpermohonan'][$i] -> StatusPermohonan === 2)
                            {{'Disetujui oleh Wakil Dekan 2'}}    
                        @endif

                    @elseif($data['allpermohonan'][$i] -> TahapPermohonan === 4)

                        @if($data['allpermohonan'][$i]->StatusPermohonan === 1)
                            {{'Dalam Proses Seleksi Vendor'}}
                        @elseif ($data['allpermohonan'][$i]->StatusPermohonan === 2 )
                            {{'Vendor Mengerjakan Pengajuan Barang & Jasa'}}
                        @elseif($data['allpermohonan'][$i]->StatusPermohonan === 3 )
                            {{'Dalam Proses Pembayaran'}}
                        @elseif($data['allpermohonan'][$i]->StatusPermohonan === 4 )
                            {{'Pengadaan Selesai'}}
                        @endif

                    @endif
                    
                </div>
                
                <div class="col s3">{{$data['allpermohonan'][$i]->Nama}}</div>
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
                                
                                <div class="row no-row">
                                    <div class="col s12">
                                        <a href="#kandidat-barang{{$i}}" class="modal-trigger btn waves-light waves-effect">
                                            LIHAT SEMUA USULAN BARANG
                                        </a>                                        
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                </div>


                <div id="kandidat-barang{{$i}}" class="modal">
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
                        <div class="row">
                            <div class="col s4">
                                <b>Kuantitas :</b><br>
                                {{$kandidat->Quantity}}
                            </div>
                            <div class="col s4">
                                <b>Keterangan :</b><br>
                                {{$kandidat->KeteranganBarang}}

                            </div>
                        </div>

                        @endif
                        @endforeach
                        <hr class="styled">
                        
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
                                    @foreach($data['allcatatan'] as $catatan)

                                    @if($catatan->IdPermohonan == $data['allpermohonan'][$i]->IdPermohonan)

                                    <li class="collection-item">
                                        <b>Catatan {{ $catatan->Role }}:</b><br>
                                        <i>Oleh {{ $catatan->Nama }}</i><br>
                                        <p>{{ $catatan->DeskripsiCatatan }}</p>                                        
                                    </li>
                                    
                                    @endif

                                    @endforeach
                                </ul>


                            </div>
                        </div>
                    </div>

                </div>     

                <div class="row"> 
                    @if ($data['user_sess']->Role === 'Manajer Fasilitas & Infrastruktur' || $data['user_sess']->Role === 'Staf Fasilitas & Infrastruktur' || $data['user_sess']->Role === 'Staf Pengadaan' || $data['user_sess']->Role === 'Wakil Dekan')
                    
                    @if (
                    ($data['allpermohonan'][$i]->TahapPermohonan == 1 && $data['allpermohonan'][$i] -> StatusPermohonan== 0) ||
                    ($data['allpermohonan'][$i]->TahapPermohonan == 1 && $data['allpermohonan'][$i] -> StatusPermohonan== 2) ||
                    ($data['allpermohonan'][$i]->TahapPermohonan == 2 && $data['allpermohonan'][$i] -> StatusPermohonan== 2) ||
                    ($data['allpermohonan'][$i]->TahapPermohonan == 3 && $data['allpermohonan'][$i] -> StatusPermohonan== 2) ||
                    ($data['allpermohonan'][$i]->TahapPermohonan == 4 && $data['allpermohonan'][$i] -> StatusPermohonan!= 4) 
                    )

                    <form action="{{ url('registrasibarang/ubahstatus') }}" method="POST">
                        <div class="col s6">
                            <b>Setujui/Tolak Permohonan</b><br>
                            @if ($data['allpermohonan'][$i]->NomorSurat == null)
                            Nomor Surat <br>
                            <input type="text" name="nomorsurat" maxlength="100" required/>
                            @endif                        
                        </div>
                        <div class="col s12">                                               
                            {!! csrf_field() !!}
                            <input type="hidden" name="hashPermohonan" value="{{ $data['allpermohonan'][$i]->hashPermohonan }}"><br>
                            Catatan: <br>
                            <textarea class="materialize-textarea" class="validate" name="catatan_txtarea" cols="30" rows="30" required>Jika tidak ada catatan tulis "Tidak ada"</textarea>
                            <input type="submit" value="TOLAK" name="tolak" class="btn waves-effect waves-red red right"/>
                            <input type="submit" value="SETUJU" name="setuju" class="btn waves-effect waves-light teal right"/>
                        </div>
                    </form>
                    @endif

                    @endif
                </div>
               
                @if ($data['user_sess']->Role != 'Manajer Fasilitas & Infrastruktur' && $data['user_sess']->Role != 'Staf Fasilitas & Infrastruktur' && $data['user_sess']->Role != 'Staf Pengadaan' && $data['user_sess']->Role != 'Wakil Dekan')

                @if($data['allpermohonan'][$i]-> StatusPermohonan===0)
                 
                <div class="row">                    
                    <div class="col s12">
                        <form action="{{ url('usulanpengadaan/batal') }}" method="POST" class="right">
                            {!! csrf_field() !!}
                            <input type="hidden" name="hashPermohonan" value="{{ $data['allpermohonan'][$i]->hashPermohonan }}"/>                            
                            <a href="{{ url('usulanpengadaan/ubah/'.$data['allpermohonan'][$i]->hashPermohonan) }}" class="btn waves-effect waves-light teal white-text">
                                UBAH
                                <i class="material-icons right">edit</i>
                            </a>
                            <button class="btn waves-effect waves-light red white-text" onclick="return confirm('Anda yakin ingin menghapus permohonan usulan pengadaan barang ini?')">
                                <i class="material-icons">delete</i>
                            </button>
                        </form> 
                    </div>
                </div>

                @endif

                @endif
            </div>         
        </li> 

        @endfor
        
    </ul>        
</div>
@stop