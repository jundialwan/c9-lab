@extends('sidebar')

@section('sidebar_dashboard', 'active white-text')

@section('konten')
<div class="subsection">
    <h5>Daftar Permohonan Usulan Pengadaan</h5>
    <div class="divider"></div><br>

    <div id="tableHead" class="row">
        <div class="col s1">Id</div>
        <div class="col s5">Subjek</div>            
        <div class="col s6">Status</div>
    </div>
  
    <ul class="collapsible" data-collapsible="accordion">
        @for($i=0; $i < count($data['allpermohonan']); $i++)
       
        <li>
            <div class="collapsible-header active">

                <div class="col s1">{{ $data['allpermohonan'][$i]->IdPermohonan }} </div>
                <div class="col s5">{{ $data['allpermohonan'][$i]->SubjekPermohonan}}</div>           
                <div class="col s6">

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
                            {{'Dalam Proses Melengkapi Dokumen'}}
                        @elseif ($data['allpermohonan'][$i]->StatusPermohonan === 2 )
                            {{'Dalam Proses Seleksi Vendor'}}
                        @elseif ($data['allpermohonan'][$i]->StatusPermohonan === 3 )
                            {{'Vendor Mengerjakan Pengajuan Barang & Jasa'}}
                        @elseif ($data['allpermohonan'][$i]->StatusPermohonan === 4 )
                            {{'Dalam Proses Pembayaran'}}
                        @elseif ($data['allpermohonan'][$i]->StatusPermohonan === 5 )
                            {{'Pengadaan Selesai'}}
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
                                        @if ($data['allpermohonan'][$i]->NomorSurat != null)
                                            <b>Nomor Surat:</b><br>
                                            {{ $data['allpermohonan'][$i]->NomorSurat }}
                                            @else
                                            <b>Nomor Surat:</b><br>
                                            <span class="grey-text"><i>Belum ada nomor surat</i></span>
                                        @endif
                                    </div>

                                    <div class="col s6">
                                        <b>Waktu Permohonan:</b><br>
                                         {{ date('j F Y, H:i', strtotime($data['allpermohonan'][$i]->created_at)) }}
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col s6">
                                        <b>Link Anggaran:</b><br>
                                        {{$data['allpermohonan'][$i]->LinkAnggaran}}
                                    </div>

                                    <div class="col s6">
                                        <b>Pemohon</b><br>
                                        {{$data['allpermohonan'][$i]->Nama}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s6">
                                        <b>Subjek Permohonan</b><br>
                                        {{$data['allpermohonan'][$i]->SubjekPermohonan}}
                                    </div>
                                    <div class="col s6">
                                        <b>Status Permohonan</b><br>

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
                                                {{'Dalam Proses Melengkapi Dokumen'}}
                                            @elseif ($data['allpermohonan'][$i]->StatusPermohonan === 2 )
                                                {{'Dalam Proses Seleksi Vendor'}}
                                            @elseif ($data['allpermohonan'][$i]->StatusPermohonan === 3 )
                                                {{'Vendor Mengerjakan Pengajuan Barang & Jasa'}}
                                            @elseif ($data['allpermohonan'][$i]->StatusPermohonan === 4 )
                                                {{'Dalam Proses Pembayaran'}}
                                            @elseif ($data['allpermohonan'][$i]->StatusPermohonan === 5 )
                                                {{'Pengadaan Selesai'}}
                                            @endif

                                        @endif
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
                                <span class="wrap-text grey-text">
                                {{$kandidat->JenisBarang}}
                                    
                                </span>
                            </div>
                            <div class="col s4">
                                <b>Kategori Barang :</b><br>
                                <span class="wrap-text grey-text">
                                    
                                {{$kandidat->KategoriBarang}}
                                </span>
                            </div>
                            <div class="col s4">
                                <b>Kondisi Barang :</b><br>
                                <span class="wrap-text grey-text">
                                    
                                {{$kandidat->KondisiBarang}}
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s4">
                                <b>Penanggung Jawab :</b><br>
                                <span class="wrap-text grey-text">
                                    
                                {{$kandidat->Penanggungjawab}}
                                </span>
                            </div>
                            <div class="col s4">
                                <b>Spesifikasi Barang :</b><br>
                                <span class="wrap-text grey-text">
                                    
                                {{$kandidat->SpesifikasiBarang}}
                                </span>
                            </div>
                            <div class="col s4">
                                <b>Keterangan Barang :</b><br>
                                <span class="wrap-text grey-text">
                                    
                                {{$kandidat->KeteranganBarang}}
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s4">
                                <b>Kuantitas :</b><br>
                                <span class="wrap-text grey-text">
                                    
                                {{$kandidat->Quantity}}
                                </span>
                            </div>
                            <div class="col s4">
                                <b>Keterangan :</b><br>
                                <span class="wrap-text grey-text">
                                    
                                {{$kandidat->KeteranganBarang}}
                                </span>

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
                                        <p class="wrap-text">{{ $catatan->DeskripsiCatatan }}</p>                                        
                                    </li>
                                    
                                    @endif

                                    @endforeach
                                </ul>


                            </div>
                        </div>
                    </div>

                </div>     

                @if ($data['user_sess']->Role === 'Manajer Fasilitas & Infrastruktur' || $data['user_sess']->Role === 'Staf Fasilitas & Infrastruktur' || $data['user_sess']->Role === 'Staf Pengadaan' || $data['user_sess']->Role === 'Wakil Dekan 2')

                @if (
                ($data['allpermohonan'][$i]->TahapPermohonan == 1 && $data['allpermohonan'][$i] -> StatusPermohonan== 0) ||
                ($data['allpermohonan'][$i]->TahapPermohonan == 1 && $data['allpermohonan'][$i] -> StatusPermohonan== 2) ||
                ($data['allpermohonan'][$i]->TahapPermohonan == 2 && $data['allpermohonan'][$i] -> StatusPermohonan== 2) ||
                ($data['allpermohonan'][$i]->TahapPermohonan == 3 && $data['allpermohonan'][$i] -> StatusPermohonan== 2) ||
                ($data['allpermohonan'][$i]->TahapPermohonan == 4 && $data['allpermohonan'][$i] -> StatusPermohonan!= 4) 
                )

                <div class="row no-row">
                    <div class="col s12">
                        <form action="{{ url('usulanpengadaan/ubahstatus') }}" method="POST">
                            {!! csrf_field() !!}
                            <input type="hidden" name="hashPermohonan" value="{{ $data['allpermohonan'][$i]->hashPermohonan }}"><br>

                            <div class="card">
                                <div class="card-content">
                                    <div class="card-title">
                                        Persetujuan
                                    </div>

                                    <span class="wrap-text grey-text">
                                        Persetujuan tidak dapat diubah ketika sudah diputuskan.
                                    </span><br><br>

                                    @if ($data['allpermohonan'][$i]->NomorSurat == null)
                                    <b>Nomor Surat </b><br>
                                    <input type="text" name="nomorsurat" maxlength="100" required/>
                                    @endif  

                                    @if ($data['user_sess']->Role === 'Staf Pengadaan')

                                    <b>Status Pengadaan:</b><br>
                                    <select name="updatepengadaan" required>
                                        <option value="1">Permohonan dalam proses melengkapi dokumen</option>
                                        <option value="2">Pengadaan melakukan seleksi vendor</option>
                                        <option value="3">Vendor mengerjakan pengajuan barang / jasa</option>
                                        <option value="4">Pengadaan dalam proses pembayaran</option>                                        
                                        <option value="5">Permohonan pengadaan selesai</option>
                                    </select>

                                    @endif                      

                                    <b>Catatan: </b><br>
                                    <textarea class="materialize-textarea" class="validate" name="catatan_txtarea" cols="30" rows="30" placeholder="Jika tidak ada catatan tulis 'Tidak ada'" required></textarea>

                                </div>

                                <div class="card-action">
                                    <div class="row no-row">
                                        <div class="col s12">
                                            @if ($data['user_sess']->Role === 'Staf Pengadaan')
                                                                                    
                                            <input type="submit" value="UPDATE STATUS" name="update" class="btn waves-effect waves-light teal right"/>                                                

                                            @else

                                            <input type="submit" value="TOLAK" name="tolak" class="btn waves-effect waves-red red right"/>
                                            <input type="submit" value="SETUJU" name="setuju" class="btn waves-effect waves-light teal right"/>                                         

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>                                     
                </div>

                @endif

                @endif

               
                @if ($data['user_sess']->Role != 'Manajer Fasilitas & Infrastruktur' && $data['user_sess']->Role != 'Staf Fasilitas & Infrastruktur' && $data['user_sess']->Role != 'Staf Pengadaan' && $data['user_sess']->Role != 'Wakil Dekan')

                @if($data['allpermohonan'][$i]-> StatusPermohonan===0)
                 
                <div class="row">                    
                    <div class="col s12">
                        <form action="{{ url('usulanpengadaan/batal') }}" method="POST" class="right">
                            {!! csrf_field() !!}
                            <input type="hidden" name="hashPermohonan" value="{{ $data['allpermohonan'][$i]->hashPermohonan }}"/>                            

                            <div class="card">
                                <div class="card-content">
                                    <div class="card-title">
                                        Informasi Pelayanan
                                    </div>
                                    <span class="wrap-text grey-text">
                                        Permohonan dapat Anda ubah atau hapus sebelum staf memutuskan persetujuan.
                                        Setelah permohonan usulan selesai disetujui oleh Wakil Dekan Anda perlu untuk mencetak surat disposisi untuk diserahkan ke bagian keuangan.
                                    </span>
                                </div>

                                <div class="card-action">
                                    <div class="row no-row">
                                        <div class="col s12">
                                            <button class="btn waves-effect waves-light red white-text right" onclick="return confirm('Anda yakin ingin menghapus permohonan usulan pengadaan barang ini?')">
                                                <i class="material-icons">delete</i>
                                            </button>                                        
                                            <a href="{{ url('usulanpengadaan/ubah/'.$data['allpermohonan'][$i]->hashPermohonan) }}" class="btn waves-effect waves-light teal white-text right">
                                                UBAH
                                                <i class="material-icons right">edit</i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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