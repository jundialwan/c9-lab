@extends('sidebar')

@section('sidebar_buatpinjam', 'active white-text')

@section('konten')
<div class="subsection">
    <h5>Buat Permohonan Usulan Pengadaan</h5>
    <div class="divider"></div><br>

    @if (!(session()->has('jmlform')))
    
    Tentukan jumlah barang yang ingin diadakan, contoh: 3 (minimal 1 barang, maksimal 5 barang)<br><br>
    <div class="row valign-wrapper">
        <div class="col s12">           
            <form action="{{ url('usulanpengadaan/buat') }}" method="POST">         
                <div class="col s3">
                    <input type="number" name="jmlform" min="1" max="5" step="1" value="1" required>           
                </div>
                <div class="col s3">
                    {!! csrf_field() !!}
                    <button class="btn waves-light waves-effect valign buat-form">
                        BUAT FORM
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
    </div><hr>

    @else

    <div id="multiform" class="row">
        <form action="{{ url('usulanpengadaan/insert') }}" method="POST">
            <div class="row form-row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">
                                Detail Permohonan
                            </div>

                            <b>Subjek</b><br>
                            <input name="subjek" maxlength="100" placeholder="Contoh: Permohonan Pengadaan Barang BEM" id="subjek" type="text" value="" class="validate" maxlength="100" required/>

                            <b>Catatan Pemohon</b> <br>
                            <textarea name="catatanpemohon" class="materialize-textarea validate" maxlength="240" placeholder="Contoh: Tidak ada" required></textarea>

                            <b>Link Anggaran</b><br>
                            <input type="text" name="linkanggaran" class="validate" maxlength="100" value="" required/>
                        </div>
                    </div>
                </div>                
            </div>

            <div id="barang-multiform">

                <div id="barang-form">
                    <div class="row form-row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-title">
                                        Detail Barang    
                                    </div>

                                    @for($i=1; $i <= session('jmlform'); $i++)

                                    <div class="valign-wrapper">                    
                                        <span class="valign judul-add-barang">Barang ke-{{ $i }}</span>
                                    </div>

                                    <b>Nama Barang :</b><br>
                                    <input type="text" id="namabarang[{{$i}}]" name="namabarang[{{$i}}]" maxlength="100" class="validate" value="" required>                                    

                                    <b>Penanggung Jawab :</b><br> 
                                    <input type="text" name="penanggungjawab[{{$i}}]" maxlength="100" value="" class="validate" required>

                                    <b>Jenis Barang :</b><br>
                                    <input type="text" name="jenisbarang[{{$i}}]" maxlength="100" value="" class="validate" required>

                                    <b>Kategori Barang : </b><br>
                                    <select name="kategoribarang[{{$i}}]" required>
                                        <option disabled>Kategori Barang</option>
                                        <option value="Elektronik">Elektronik</option>
                                        <option value="Furnitur">Furnitur</option>
                                        <option value="Kategori A">Kategori A</option>
                                        <option value="Kategori B">Kategori B</option>
                                        <option value="Kategori C">Kategori C</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>

                                    <b>Spesifikasi Barang :</b><br>
                                    <textarea name="spesifikasibarang[{{$i}}]" class="materialize-textarea validate" class="validate" maxlength="100" cols="30" rows="10" required></textarea>

                                    <b>Keterangan Barang :</b><br>
                                    <textarea name="keteranganbarang[{{$i}}]" class="materialize-textarea validate" class="validate" maxlength="100" cols="30" rows="10" required></textarea>

                                    <hr class="styled"><br>

                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>

            </div>
            <br>
            <div class="row">
                <div class="col s4 offset-s4 valign-wrapper">
                    <div class="valign">    
                        {!! csrf_field() !!}                    
                        <button class="btn waves-light waves-effect">
                            REGISTRASI SEMUA BARANG
                            <i class="material-icons right">send</i>
                        </button>&nbsp;&nbsp;               
                    </div>
                </div>        
            </div>
        </form>
    </div>

    @endif

</div>
@stop