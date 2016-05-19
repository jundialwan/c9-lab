@extends('sidebar')

@section('sidebar_buatregis', 'active white-text')

@section('konten')
<div class="subsection">
    <h5>Buat Permohonan Registrasi Barang</h5>
    <div class="divider"></div><br>

    @if (!(session()->has('jmlform')))
        
    <div class="row no-row">
        <div class="col s6 push-s3">           
            <form action="{{ url('registrasibarang/buat') }}" method="POST">         
                {!! csrf_field() !!}
                <div class="card">
                    <div class="card-content">
                        <div class="card-title">
                            Jumlah Barang
                        </div>
                        <span class="wrap-text grey-text">
                            Tentukan jumlah barang yang ingin di registrasi, contoh: 3. Minimal 1 barang dan maksimal 5 barang.
                        </span><br><br>
                        <input type="number" name="jmlform" min="1" max="5" step="1" value="1" required>
                    </div>
                    
                    <div class="card-action">
                        <div class="row no-row">
                            <div class="col s12">
                                <button class="btn waves-light waves-effect right">
                                    BUAT FORM
                                    <i class="material-icons right">send</i>
                                </button>                                
                            </div>
                        </div>
                    </div>
                </div>                
            </form>
        </div>
    </div>

    @else

    <div id="multiform" class="row">
        <form action="{{ url('registrasibarang/insert') }}" method="POST">

            <div class="row no-row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">
                                Permohonan
                            </div>

                            <b>Subjek</b>
                            <input required name="subjek" maxlength="100" placeholder="Permohonan Registrasi Barang BEM" id="subject" type="text" class="validate" value="{{ old('subjek') }}">

                            <b>Catatan Pemohon</b>
                            <textarea name="catatanpemohon" class="materialize-textarea validate" length="240" required>{{ old('catatanpemohon') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div id="row no-row">             
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">
                                Barang
                            </div>

                            <ul class="collection">
                                @for ($i=1; $i <= session('jmlform'); $i++)            
                                <li class="collection-item">                                    
                                    <div id="barang-form[{{$i}}]">                                        
                                        <div class="row no-row">
                                            <div class="col s6 input-field">
                                                <b>Nama Barang </b>
                                                <!-- <span class="error red-text">{{ $errors->first('namabarang.'.$i) }}</span><br> -->
                                                <input required type="text" name="namabarang[{{$i}}]" maxlength="100" value="{{ old('namabarang.'.$i) }}" class="validate">                          
                                            </div>

                                            <div class="col s6 input-field">
                                                <b>Tanggal Beli </b>
                                                <!-- <span class="error red-text">{{ $errors->first('tanggalbeli.'.$i) }}</span><br>                  -->
                                                <input required type="date" name="tanggalbeli[{{$i}}]" value="{{ old('tanggalbeli.'.$i) }}" class="tanggalbeli validate">
                                            </div>

                                        </div>   

                                        <div class="row no-row">
                                            <div class="col s6 input-field">
                                                <b>Penanggung Jawab</b>
                                                <!-- <span class="error red-text">{{ $errors->first('penanggungjawab.'.$i) }}</span><br>                  -->
                                                <input required type="text" name="penanggungjawab[{{$i}}]" maxlength="100" value="{{ old('penanggungjawab.'.$i) }}" class="validate">           
                                            </div> 

                                            <div class="col s6 input-field">
                                                <b>Kategori Barang </b>
                                                <!-- <span class="error red-text">{{ $errors->first('kategoribarang.'.$i) }}</span><br> -->
                                                <select required name="kategoribarang[{{$i}}]">
                                                    <option disabled selected>Kategori Barang</option>
                                                    <option value="Elektronik">Elektronik</option>
                                                    <option value="Furnitur">Furnitur</option>
                                                    <option value="Kategori A">Kategori A</option>
                                                    <option value="Kategori B">Kategori B</option>
                                                    <option value="Kategori C">Kategori C</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>           
                                            </div>

                                        </div>

                                        <div class="row no-row">
                                            <div class="col s6 input-field">
                                                <b>Jenis Barang </b>
                                                <!-- <span class="error red-text">{{ $errors->first('jenisbarang.'.$i) }}</span><br>                  -->
                                                <input required type="text" name="jenisbarang[{{$i}}]" value="{{ old('jenisbarang.'.$i) }}" maxlength="100" class="validate">
                                            </div>          

                                            <div class="col s6 input-field">
                                                <b>Kondisi Barang </b>
                                                <!-- <span class="error red-text">{{ $errors->first('kondisibarang.'.$i) }}</span><br>                    -->
                                                <select required name="kondisibarang[{{$i}}]">
                                                    <option disabled selected>Kondisi Barang</option>
                                                    <option value="Baru">Baru</option>
                                                    <option value="Bekas">Bekas</option>
                                                    <option value="Rusak">Rusak</option>                                
                                                </select>
                                            </div>                                            
                                        </div>

                                        <div class="row no-row">                      
                                            <div class="col s6 input-field">
                                                <b>Spesifikasi Barang</b>
                                                <!-- <span class="error red-text">{{ $errors->first('spesifikasibarang.'.$i) }}</span><br>                    -->
                                                <textarea name="spesifikasibarang[{{$i}}]" class="materialize-textarea validate" cols="30" rows="10" required>{{ old('spesifikasibarang.'.$i) }}</textarea>
                                            </div>

                                            <div class="col s6 input-field">
                                                <b>Keterangan Barang </b>
                                                <!-- <span class="error red-text">{{ $errors->first('keteranganbarang.'.$i) }}</span><br>                     -->
                                                <textarea name="keteranganbarang[{{$i}}]" class="materialize-textarea" cols="30" rows="10">{{ old('keteranganbarang.'.$i) }}</textarea>
                                            </div>    
                                        </div>
                                    </div><br><br>
                                </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row no-row">                
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">
                                Informasi Pelayanan
                            </div>

                            <span class="wrap-text grey-text">
                                Anda dapat meregistrasi beberapa barang sekaligus, maksimal lima barang. <br>
                                Jika Anda meregistrasi lebih dari satu barang, jika salah satu barang tidak lolos verifikasi maka Anda perlu mengulang tahapan registrasi untuk
                                semua barang dari awal dengan membuat permohonan baru.
                            </span>

                        </div>
                        <div class="card-action">
                            <div class="row no-row">
                                <div class="col s12">
                                    <form action="{{ url('registrasibarang/buat') }}" method="POST" > 
                                        {!! csrf_field() !!}                    
                                        <button class="btn waves-light waves-effect right">
                                            REGISTRASI SEMUA BARANG
                                            <i class="material-icons right">send</i>
                                        </button>&nbsp;&nbsp;               
                                    </form>                                                     
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>        
            </div>
        </form>
    </div>

    @endif
   
</div>
@stop