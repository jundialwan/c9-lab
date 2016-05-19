@extends('sidebar')

@section('sidebar_dashboard', 'active white-text')

@section('konten')
<div class="subsection">
    <h5>Daftar Permohonan Maintenance Barang</h5>
    <div class="divider"></div><br>

    <div id="tableHead" class="row">
        <div class="col s1">Id</div>
        <div class="col s5">Subjek</div>            
        <div class="col s6">Status</div>
    </div>

    <ul class="collapsible" data-collapsible="accordion">
        
        @foreach($data['allpermohonan'] as $permohonan)
        <li>
            <div class="collapsible-header active">

                <div class="col s1">{{ $permohonan ->IdPermohonan}}</div>
                <div class="col s5">{{ $permohonan ->SubjekPermohonan }}</div>            
                <div class="col s6">

                    @if($permohonan -> TahapPermohonan === 1)
                                    
                        @if($permohonan -> StatusPermohonan === 0)
                            {{ 'Ditinjau ke lapangan' }}
                        @elseif($permohonan -> StatusPermohonan === 1)
                            {{'Ditolak oleh Staf Fasilitas & Infrastruktur'}} 
                        @elseif($permohonan -> StatusPermohonan === 2)
                            {{'Disetujui oleh Staf Fasilitas & Infrastruktur'}}    
                        @endif

                    @elseif($permohonan -> TahapPermohonan === 2)
                                   
                        @if($permohonan -> StatusPermohonan === 1)
                            {{'Ditolak oleh Manajer Fasilitas & Infrastruktur'}}
                        @elseif($permohonan -> StatusPermohonan === 2)
                            {{'Disetujui oleh Manajer Fasilitas & Infrastruktur'}}
                        @endif

                    @elseif($permohonan -> TahapPermohonan ===3)
                                    
                        @if($permohonan -> StatusPermohonan === 1)
                            {{'Ditolak oleh Wakil Dekan 2'}} 
                        @elseif($permohonan -> StatusPermohonan === 2)
                            {{'Disetujui oleh Wakil Dekan 2'}}    
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
                                    <div class="col s4">
                                        @if ($permohonan->NomorSurat != null)

                                        <b>Nomor Surat:</b><br>
                                        {{ $permohonan->NomorSurat }}

                                        @else

                                        <b>Nomor Surat:</b><br>
                                        <span class="grey-text"><i>Belum ada nomor surat</i></span>

                                        @endif
                                    </div>

                                    <div class="col s4">
                                        <b>Waktu Permohonan:</b><br>
                                        {{ date('j F Y, H:i', strtotime($permohonan->created_at)) }}
                                    </div>

                                    <div class="col s4">
                                        <b>Pemohon:</b><br>
                                        {{ $permohonan->Nama }}
                                    </div>
                                </div>   

                                <div class="row">
                                    <div class="col s12">
                                        <b>Subjek Permohonan</b><br>                                        
                                        {{ $permohonan->SubjekPermohonan }}
                                    </div>                                    
                                </div>

                                <div class="row">
                                    <div class="col s12">
                                        <b>Status Permohonan</b><br>                                        
                                        
                                        @if($permohonan -> TahapPermohonan === 1)
                                    
                                            @if($permohonan -> StatusPermohonan === 0)
                                                {{ 'Ditinjau ke lapangan' }}
                                            @elseif($permohonan -> StatusPermohonan === 1)
                                                {{'Ditolak oleh Staf Fasilitas & Infrastruktur'}} 
                                            @elseif($permohonan -> StatusPermohonan === 2)
                                                {{'Disetujui oleh Staf Fasilitas & Infrastruktur'}}    
                                            @endif

                                        @elseif($permohonan -> TahapPermohonan === 2)
                                                       
                                            @if($permohonan -> StatusPermohonan === 1)
                                                {{'Ditolak oleh Manajer Fasilitas & Infrastruktur'}}
                                            @elseif($permohonan -> StatusPermohonan === 2)
                                                {{'Disetujui oleh Manajer Fasilitas & Infrastruktur'}}
                                            @endif

                                        @elseif($permohonan -> TahapPermohonan ===3)
                                                        
                                            @if($permohonan -> StatusPermohonan === 1)
                                                {{'Ditolak oleh Wakil Dekan 2'}} 
                                            @elseif($permohonan -> StatusPermohonan === 2)
                                                {{'Disetujui oleh Wakil Dekan 2'}}    
                                            @endif

                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <!-- <hr> -->

                <div class="row no-row">
                    @foreach($data['allbarang'] as $barang)

                    @if($permohonan->IdBarang == $barang->IdBarang)
                    
                    <div class="col s12">
                        <div class="card">                            
                            <div class="card-content">
                                <div class="card-title">
                                    Barang yang rusak
                                </div><br>

                                <div class="row">
                                    <div class="col s12">
                                        <h5>{{$barang->NamaBarang}}</h5>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col s4">
                                        <b>Jenis Barang :</b><br>
                                        <span class="wrap-text">
                                            {{$barang->JenisBarang}}
                                        </span>
                                    </div>
                                    <div class="col s4">
                                        <b>Kategori Barang :</b><br>
                                        <span class="wrap-text">
                                            {{$barang->KategoriBarang}}
                                        </span>
                                    </div>
                                    <div class="col s4">
                                        <b>Kondisi Barang :</b><br>
                                        <span class="wrap-text">
                                            {{$barang->KondisiBarang}}
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s4">
                                        <b>Penanggung Jawab :</b><br>
                                        <span class="wrap-text">
                                            {{$barang->Penanggungjawab}}
                                        </span>
                                    </div>
                                    <div class="col s4">
                                        <b>Spesifikasi Barang :</b><br>
                                        <span class="wrap-text">
                                            {{$barang->SpesifikasiBarang}}
                                        </span>
                                    </div>
                                    <div class="col s4">
                                        <b>Keterangan Barang :</b><br>
                                        <span class="wrap-text">
                                            {{$barang->KeteranganBarang}}
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s4">
                                        <b>Keterangan :</b><br>
                                        <span class="wrap-text">
                                            {{$barang->KeteranganBarang}}
                                        </span>
                                    </div>
                                    <div class="col s4">
                                        <b>Kerusakan Barang :</b><br>
                                        {{$barang->KerusakanBarang}}

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    @endif

                    @endforeach
                </div>


                <!-- <hr> -->
                <div class="row">
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-title">
                                    Catatan
                                </div>
                                <ul class="collection">
                                    @foreach($data['allcatatan'] as $catatan)
                                        
                                    @if($catatan->IdPermohonan == $permohonan->IdPermohonan)

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

             
                @if ($data['user_sess']->Role == 'Manager Fasilitas & Infrastruktur' || $data['user_sess']->Role == 'Staf Fasilitas & Infrastruktur' || $data['user_sess']->Role == 'Wakil Dekan')
                <div class="row"> 
                    <div class="col s12">
                        <div class="card">
                            <form action="{{ url('maintenancebarang/ubahstatus') }}" method="POST">
                                {!! csrf_field() !!}
                                <input type="hidden" name="hashPermohonan" value="{{ $permohonan->hashPermohonan }}">

                                <div class="card-content">
                                    <div class="card-title">
                                        Persetujuan
                                    </div><br>
                                    
                                    <div class="row">
                                        <div class="col s12">
                                            @if (
                                                ($permohonan->TahapPermohonan == 1 && $permohonan -> StatusPermohonan== 0) ||
                                                ($permohonan->TahapPermohonan == 1 && $permohonan -> StatusPermohonan== 2) ||
                                                ($permohonan->TahapPermohonan == 2 && $permohonan -> StatusPermohonan== 2) 
                                            )
                                            
                                            @if ($permohonan->NomorSurat == null)

                                            Nomor Surat <br>
                                            <input type="text" name="nomorsurat" maxlength="100" required/><br>

                                            @endif                        

                                            Catatan: <br>
                                            <textarea class="materialize-textarea" class="validate" name="catatan_txtarea" cols="30" rows="30"placeholder="Jika tidak ada catatan tulis 'Tidak ada'" required></textarea>                                    

                                            @endif                                                                            
                                        </div>
                                    </div>                                
                                </div>    

                                <div class="card-action">
                                    <div class="row no-row">
                                        <div class="col s12">
                                            <button type="submit" value="SETUJU" name="setuju" class="btn waves-effect waves-light teal white-text right" style="margin-left: 12px">SETUJU</button>
                                            <button type="submit" value="TOLAK" name="tolak" class="waves-effect waves-red btn red right">TOLAK</button>                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @else
                            
                <div class="row">                                        
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-title">
                                    Informasi
                                </div>

                                <div class="row no-row ">
                                    <div class="col s12">

                                        <span class="grey-text wrap-text">
                                            Anda hanya bisa mengubah atau menghapus permohonan Anda sebelum permohonan ditetapkan statusnya oleh Staf. <br>
                                        </span>
                                    </div>                                    
                                </div>
                            </div>

                            <div class="card-action">
                                <div class="row no-row">
                                    <div class="col s12">
                                        
                                        @if ($data['user_sess']->Role != 'Manager Fasilitas & Infrastruktur' && $data['user_sess']->Role != 'Staf Fasilitas & Infrastruktur' && $data['user_sess']->Role != 'Wakil Dekan')
                                        
                                        @if($permohonan->StatusPermohonan == 0)

                                        <form action="{{ url('maintenancebarang/batal') }}" method="POST" class="right">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="hashPermohonan" value="{{ $permohonan->hashPermohonan }}"/>                            
                                            <a href="{{ url('maintenancebarang/ubah/'.$permohonan->hashPermohonan) }}" class="btn waves-effect waves-light teal white-text">
                                                UBAH
                                                <i class="material-icons right">edit</i>
                                            </a>
                                            <button class="btn waves-effect waves-light red white-text" onclick="return confirm('Anda yakin ingin menghapus permohonan maintenance barang ini?')">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </form> 

                                        @else
                                        
                                        <div class="right">
                                            <a class="btn disabled">
                                                UBAH
                                                <i class="material-icons right">edit</i>
                                            </a>

                                            <button class="btn disabled">
                                                <i class="material-icons">delete</i>
                                            </button>                                            
                                        </div>

                                        @endif

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
        @endforeach
    </ul>
</div>
@stop