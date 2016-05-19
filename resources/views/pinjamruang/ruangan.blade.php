@extends('sidebar')

@section('sidebar_ruangan', 'active white-text')

@section('table_head')
<div id="tableHead" class="row">
    <div class="col s2">No. Ruangan</div>
    <div class="col s2">Gedung</div>
    <div class="col s2">Jenis Ruangan</div>
    <div class="col s2">Kapasitas</div>
</div>
@endsection

@section('konten')
<div class="subsection">
    <h5>Daftar Ruangan</h5>
    <div class="divider"></div><br>

    <div class="row">
        <div class="col s12">
            <ul class="tabs">
                @foreach ($data['allgedung'] as $gedung)
                <li class="tab col s2"><a class="active" href="#{{str_replace(' ', '',$gedung->NamaGedung)}}">{{$gedung->NamaGedung}}</a></li>                
                @endforeach
            </ul>
        </div>

        @foreach ($data['allgedung'] as $gedung)
        <div id="{{str_replace(' ', '',$gedung->NamaGedung)}}" class="col s12">      
            <br>

            <div class="col s8 push-s2">
                <table class="bordered responsive-table">                       
                    <thead>
                        <tr>
                            <th><b>Nomor</b></th>
                            <th><b>Jenis</b></th>
                            <th><b>Kapasitas</b></th>
                            <th><p></p></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data['allruangan'] as $ruangan)
                        
                        @if ($ruangan->IdGed == $gedung->IdGedung)
                        <tr>
                            <td>{{$ruangan->NomorRuangan}}</td>
                            <td>{{$ruangan->JenisRuangan}}</td>
                            <td>{{$ruangan->KapasitasRuangan}}</td>                                                    
                            <td>
                                <form action="{{ url('pinjamruang/ruangan/hapus') }}" method="POST">                                 
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="hash" value="{{$ruangan->hashRuang}}">
                                    <a href="{{ url('pinjamruang/ruangan/ubah/'.$ruangan->hashRuang) }}" class="btn purple">                                        
                                        UBAH
                                        <i class="material-icons left">edit</i>
                                    </a>
                                    <button class="btn-flat waves-light waves-effect grey-text tooltipped" data-position="right" data-delay="10" data-tooltip="HAPUS" onclick="return confirm('Anda yakin ingin menghapus ruangan ini? Jadwal dan permohonan yang berasosiasi dengan ruangan ini juga akan dihapus.')">
                                        HAPUS
                                        <i class="material-icons grey-text left">delete</i>
                                    </button>
                                </form>                                                                                 
                            </td>
                        </tr>
                        @endif

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>    
</div>
                    
@stop  
<!-- stop section  -->                       