@extends('sidebar')

@section('sidebar_dashboard', 'active white-text')

@section('konten')
<div class="subsection">
    <h5>Daftar Permohonan Peminjaman Ruangan</h5>
    <div class="divider"></div><br>
    
    <div id="tableHead" class="row">
        <div class="col s1">Id</div>
        <div class="col s5">Keperluan Peminjaman</div>        
        <div class="col s6">Status</div>        
    </div>

    <ul class="collapsible" data-collapsible="accordion">        
        @foreach($data['allpermohonan'] as $peminjaman)                
        <li>            
            <div class="collapsible-header active">                              
                <div class="col s1"> {{ $peminjaman->IdPermohonan }} </div>
                <div class="col s5"> {{ $peminjaman->KeperluanPeminjaman }} </div>
                <div class="col s6">                         
                    @if($peminjaman->StatusPermohonan === 0)
                        {{ 'Sedang Menunggu Persetujuan Staf' }}
                    @elseif($peminjaman->StatusPermohonan === 1)
                        {{ 'Ditolak Staf' }}                    
                    @elseif($peminjaman->StatusPermohonan === 2)
                        {{ 'Disetujui Staf' }}                    
                    @endif
                </div>            
            </div>

            <div class="collapsible-body">
                
                <div class = "row no-row">
                    <div class="col s12">                        
                        <div class="card">
                            <div class="card-content">
                                <div class="card-title">
                                    Detail Permohonan
                                </div>

                                <div class="row">
                                    <div class="col s6">
                                        
                                        @if ($data['user_sess']->Role == 'Staf PPAA' || $data['user_sess']->Role == 'Staf Sekretariat')

                                            @if ($peminjaman->NomorSurat != null)                            
                                            <b>Nomor Surat:</b><br>
                                            <span class="wrap-text">
                                                {{ $peminjaman->NomorSurat }}
                                            </span>
                                            @else
                                            <b>Nomor Surat:</b><br>
                                            <span class="grey-text"><i>Belum ada nomor surat</i></span>
                                            @endif

                                        @else

                                            @if ($peminjaman->NomorSurat != null)
                                            <b>Nomor Surat:</b><br>
                                            <span class="wrap-text">
                                                {{ $peminjaman->NomorSurat }}
                                            </span> 
                                            @else
                                            <b>Nomor Surat:</b><br>
                                            <span class="grey-text"><i>Belum ada nomor surat</i></span>
                                            @endif

                                        @endif
                                    </div>
                                    <div class="col s6">
                                        <b>Waktu Permohonan:</b><br>
                                        <span class="wrap-text">
                                            {{ date('j F Y, H:i', strtotime($peminjaman->created_at)) }}
                                        </span> 
                                    </div>                                                    
                                </div>
                                <div class="row">
                                    <div class="col s6">
                                        <b>Subjek Permohonan:</b><br>
                                        <span class="wrap-text">
                                            {{ $peminjaman->SubjekPermohonan }}
                                        </span> 
                                    </div>

                                    <div class="col s6">
                                        <b>Keperluan Peminjaman:</b><br>
                                        <span class="wrap-text">
                                            {{ $peminjaman->KeperluanPeminjaman }}
                                        </span>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col s12">
                                        <b>Status Permohonan:</b><br>
                                        <span class="wrap-text">
                                            @if($peminjaman->StatusPermohonan === 0)
                                                {{ 'Sedang Menunggu Persetujuan Staf' }}
                                            @elseif($peminjaman->StatusPermohonan === 1)
                                                {{ 'Ditolak Staf' }}                    
                                            @elseif($peminjaman->StatusPermohonan === 2)
                                                {{ 'Disetujui Staf' }}                    
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row no-row">
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-title">
                                    Detail Jadwal
                                </div>

                                <div class="row">
                                    <div class="col s6">
                                        <b>Tanggal Pinjam:</b><br>
                                        {{ date('j F Y', strtotime($peminjaman->WaktuMulai)) }}
                                    </div>
                                    <div class="col s6">
                                        <b>Waktu Pinjam:</b><br>
                                        {{ date('H:i', strtotime($peminjaman->WaktuMulai)) }} - {{ date('H:i', strtotime($peminjaman->WaktuSelesai)) }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s6">
                                        <b>Gedung:</b><br>
                                        {{ $peminjaman->NamaGedung }}
                                    </div>
                                    <div class="col s6">
                                        <b>Ruangan:</b><br>
                                        {{ $peminjaman->NomorRuangan }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s6">
                                        <b>Jenis Ruangan:</b><br>
                                        {{ $peminjaman->JenisRuangan }}
                                    </div>
                                </div>
                                
                            </div>
                        </div>
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

                                    @if($catatan->IdPermohonan == $peminjaman->IdPermohonan)

                                    <li class="collection-item">
                                        <b>Catatan {{ $catatan->Role }}:</b><br>
                                        <i>Oleh {{ $catatan->Nama }}</i><br>
                                        <p class="wrap-text">
                                            {{ $catatan->DeskripsiCatatan }}
                                        </p>
                                    </li>

                                    @endif

                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>     
                
                @if ($data['user_sess']->Role == 'Staf PPAA' || $data['user_sess']->Role == 'Staf Sekretariat')
                
                <form action="{{ url('pinjamruang/ubah') }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="hashPermohonan" value="{{ $peminjaman->hashPermohonan }}">

                    <div class="row no-row"> 
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-title">
                                        Persetujuan
                                    </div>
                                    
                                    <span class="wrap-text grey-text">
                                        @if ($peminjaman->NomorSurat == null)
                                        Nomor surat perlu diberikan terlebih dahulu oleh staf sebelum dapat disetujui. <br>
                                        Berikan catatan yang sesuai dan deskriptif. <br>
                                        @endif

                                        Persetujuan tidak dapat dibatalkan.
                                    </span><br><br>

                                    @if ($peminjaman->NomorSurat == null)
                                    <b>Nomor Surat </b><br>
                                    <input type="text" class="vaidate" name="nomorsurat" maxlength="100" required/>
                                    @endif
                                                                        
                                    @if ($peminjaman->StatusPermohonan == 0)
                                    <b>Catatan:</b> <br>
                                    <textarea class="materialize-textarea validate" name="catatan_txtarea" cols="30" rows="30" placeholder="Jika tidak ada catatan tulis 'Tidak ada'" required></textarea>                                    
                                    @endif

                                </div>

                                <div class="card-action">
                                    <div class="row no-row">
                                        <div class="col s12">
                                            @if ($peminjaman->StatusPermohonan == 0)
                                            <input type="submit" value="TOLAK" name="tolak" class="waves-effect waves-red btn red right"/>
                                            <input type="submit" value="SETUJU" name="setuju" class="btn waves-effect waves-light teal white-text right"/>
                                            @else
                                            <a name="tolak" class="waves-effect waves-red btn red right disabled">TOLAK</a>
                                            <a name="setuju" class="btn waves-effect waves-light teal white-text right disabled">SETUJU</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </form>                

                @endif

                @if (!($data['user_sess']->Role == 'Staf PPAA') && !($data['user_sess']->Role == 'Staf Sekretariat'))

                <div class="row no-row">
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-title">
                                    Informasi
                                </div>
                                <div class="row no-row">
                                    <div class="col s12">
                                        <span class="grey-text wrap-text">
                                            Anda hanya bisa menghapus permohonan Anda sebelum permohonan ditetapkan statusnya oleh Staf. <br>
                                            Anda tidak bisa mengubah permohonan peminjaman ruangan. <br>
                                            Jika ada kesalahan dalam pembuatan permohonan, silakan menghapus dan buat kembali permohonan Anda.
                                        </span>
                                    </div>                                    
                                </div>
                            </div>

                            <div class="card-action">
                                <div class="row no-row">                                    
                                    <div class="col s12">

                                        @if($peminjaman->StatusPermohonan == 0)
                                        
                                        <form name="userbatal" action="{{ url('pinjamruang/batal') }}" method="POST" class="">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="hashPermohonan" value="{{ $peminjaman->hashPermohonan }}"/>                            
                                            <button class="btn waves-effect waves-light right red white-text" onclick="return confirm('Anda yakin ingin menghapus permohonan peminjaman ruangan ini?')">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </form> 
                                        @else

                                        <button class="btn right disabled">
                                            <i class="material-icons">delete</i>
                                        </button>

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