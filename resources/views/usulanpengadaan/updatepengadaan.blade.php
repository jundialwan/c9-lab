@extends('sidebar')

@section('sidebar_buatregis', 'active white-text')

@section('konten')
<div class="subsection">
    <h5>Ubah Permohonan Usulan Pengadaan</h5>
    <div class="divider"></div><br>

    <div id="multiform" class="row">
        <form action="{{ url('usulanpengadaan/ubah/'.$data['pengadaan'][0]->hashPermohonan) }}" method="POST">
            <div class="row form-row">
                <div class="col s6">
                    <b>Subjek</b><br>
                    <input type="hidden" name="hashPermohonan" value="{{ $data['pengadaan'][0]['hashPermohonan'] }}">
                    <input name="subjek" placeholder="Permohonan Usulan Pengadaan Barang" id="subject" type="text" class="validate" value="{{ (isset($data['pengadaan'])) ? ($data['pengadaan'][0]['SubjekPermohonan']) : old('subjek') }}">
                </div><br>

                 <div class="col s12">
                    <b>Catatan Pemohon</b> <br> 
                    <input type="hidden" name="hashCatatan" value="{{ $data['catatan'][0]['hashCatatan'] }}">
                    <textarea name="catatanpemohon" class="materialize-textarea" length="240">{{ (isset($data['catatan'])) ? ($data['catatan'][0]['DeskripsiCatatan']) : old('catatanpemohon') }}</textarea>
                </div>
            
            </div><br><hr>

            <div id="barang-multiform">             
                @for($i=0; $i < count($data['allkandidat']); $i++)
                <div id="barang-form[{{$i+1}}]">
                    <input type="hidden" name="hashKandidat[{{$i+1}}]" value="{{ $data['allkandidat'][$i]['hashKandidat'] }}">
                    <div class="valign-wrapper">                    
                        <span class="valign judul-add-barang">Barang</span>&nbsp;&nbsp;
                    </div>
                    
                    <div class="row form-row">
                        <div class="col s6 input-field">
                            Nama Barang <br>
                            <span class="error red-text">{{ $errors->first('namabarang.'.$i) }}</span><br>
                            <input type="text" name="namabarang[{{$i+1}}]" maxlength="100" value="{{ (isset($data['allkandidat'])) ? ($data['allkandidat'][$i]['NamaBarang']) : old('namabarang.'.$i) }}">       
                        </div>

                       <div class="col s4 input-field">
                            Kuantitas <br>
                            <span class="error red-text">{{ $errors->first('quantity.'.$i) }}</span><br>                 
                            <input id="quantity1" type="text" name="quantity[{{$i+1}}]" value="{{ (isset($data['allkandidat'])) ? ($data['allkandidat'][$i]['quantity']) : old('quantity.'.$i) }}" length="100" class="">         
                        </div> 

                    <div class="row form-row">
                        
                        <div class="col s2 input-field">
                            Kategori Barang <br>
                            <span class="error red-text">{{ $errors->first('kategoribarang.'.$i) }}</span><br>                  
                            <select name="kategoribarang[{{$i+1}}]">
                                <option disabled>Kategori Barang</option>
                                <option value="Elektronik" {{ ($data['allkandidat'][0]['KategoriBarang'] == 'Elektronik') ? 'selected' : '' }}>Elektronik</option>
                                <option value="Furnitur" {{ ($data['allkandidat'][0]['KategoriBarang'] == 'Furnitur') ? 'selected' : '' }}>Furnitur</option>
                                <option value="Kategori A" {{ ($data['allkandidat'][0]['KategoriBarang'] == 'Kategori A') ? 'selected' : '' }}>Kategori A</option>
                                <option value="Kategori B" {{ ($data['allkandidat'][0]['KategoriBarang'] == 'Kategori B') ? 'selected' : '' }}>Kategori B</option>
                                <option value="Kategori C" {{ ($data['allkandidat'][0]['KategoriBarang'] == 'Kategori C') ? 'selected' : '' }}>Kategori C</option>
                                <option value="Lainnya" {{ ($data['allkandidat'][0]['KategoriBarang'] == 'Lainnya') ? 'selected' : '' }}>Lainnya</option>
                            </select>           
                        </div>

                        <div class="col s4 input-field">
                            Jenis Barang <br>
                            <span class="error red-text">{{ $errors->first('jenisbarang.'.$i) }}</span><br>                 
                            <input type="text" name="jenisbarang[{{$i+1}}]" value="{{ (isset($data['allkandidat'])) ? ($data['allkandidat'][$i]['JenisBarang']) : old('jenisbarang.'.$i) }}" maxlength="100" class="">
                        </div> 

                     <div class="row form-row">                           
                        <div class="col s4 input-field">
                            Spesifikasi Barang <br>
                            <span class="error red-text">{{ $errors->first('spesifikasibarang.'.$i) }}</span><br>                   
                            <textarea name="spesifikasibarang[{{$i+1}}]" class="materialize-textarea" cols="30" rows="10">{{ (isset($data['allkandidat'])) ? ($data['allkandidat'][$i]['SpesifikasiBarang']) : old('spesifikasibarang.'.$i) }}</textarea>
                        </div>

                        <div class="col s4 input-field">
                            Keterangan Barang <br>
                            <span class="error red-text">{{ $errors->first('keteranganbarang.'.$i) }}</span><br>                    
                            <textarea name="keteranganbarang[{{$i+1}}]" class="materialize-textarea" cols="30" rows="10">{{ (isset($data['allkandidat'])) ? ($data['allkandidat'][$i]['KeteranganBarang']) : old('keteranganbarang.'.$i) }}</textarea>
                        </div> 

                    </div><hr>
                </div> 
                @endfor       
            </div>

            <div class="row">
                <div class="col s4 offset-s4 valign-wrapper">
                    <div class="valign">    
                        {!! csrf_field() !!}                    
                        <button class="btn waves-light waves-effect teal" onclick="return confirm('Anda yakin ingin mengubah detail permohonan ini?')">
                            UBAH USULAN PENGADAAN
                            <i class="material-icons right">send</i>
                        </button>&nbsp;&nbsp;               
                    </div>
                </div>        
            </div>
        </form>
    </div>
</div>
@stop