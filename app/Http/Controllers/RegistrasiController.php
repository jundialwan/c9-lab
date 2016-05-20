<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Permohonan;
use App\KandidatBarang;
use App\Barang;
use App\catatan;
use App\Master;
use validator;


class RegistrasiController extends MasterController
{
    /**
     * Get all permohonan registrasi and display it
     * @return dashboard.blade.php
     */
    public function dashboard(Request $request)
    {   
        // check if user permitted        
        if (!($this->isPermitted('registrasibarang'))) return redirect('/');    
    
		// get permohonan registrasi barang data                
        $registrasi = Permohonan::getRegistrasi($request->session()->get('user_sess')->Role, $request->session()->get('user_sess')->NomorInduk);                

		// render registrasi barang dashboard
		return $this->render('registbarang.dashboard', [
			'title' => 'Dashboard Registrasi Barang',
			'allregistrasi' => $registrasi['allregistrasi'],
            'allkandidat' => $registrasi['allkandidat'],
			'allcatatan' => $registrasi['allcatatan'],
		]);                  
    }

    /**
     * Get buat registrasi page
     * @param  Request $request Request object
     * @return buatregistrasi.blade.php
     */
    public function getCreateRegistrasi(Request $request)
    {
        // check if user permitted        
        if (!($this->isPermitted('buatregistrasi'))) return redirect('registrasibarang'); 

        // reset the session
        session()->forget('jmlform');

        if ($request->isMethod('POST')) {
            // validate
            $this->validate($request, [
                'jmlform' => 'required|numeric|min:1|max:5'
            ]);

            session()->flash('jmlform', $request->input('jmlform'));
        }

    	return $this->render('registbarang.buatregistrasi', [
    		'title' => 'Buat Permohonan Registrasi Barang',
    	]);
    }

    /**
     * Create registrasi object and input it to database
     * @param  Request $regbarang Request object
     * @return redirect to dashboard.blade.php
     */
    public function createRegistrasi(Request $regbarang)
    {
        // check if user permitted        
        if (!($this->isPermitted('buatregistrasi'))) return redirect('/');

        // get number of form submitted
        $nform = count($regbarang->input('namabarang')); 

        // set session for jmlform
        session()->flash('jmlform', $nform);

        // Memvalidasi isian form registrasi barang
        $this->validate ($regbarang, [
            'subjek'=> 'required|max:100',
            'catatanpemohon' => 'required',
            'namabarang.*' => 'required|max:100',                
            'tanggalbeli.*' => 'required',
            'penanggungjawab.*' => 'required|max:100',
            'kategoribarang.*' => 'required|max:100',
            'jenisbarang.*' => 'required|max:100',
            'kondisibarang.*' => 'required|max:100',
            'spesifikasibarang.*' => 'required',
            'keteranganbarang.*' => 'required',                                
            'kerusakanbarang.*' => 'required',
        ]);

        $input = $regbarang->all();

        // Auto Increment IdPermohonan
        $lastId = Master::getLastId('permohonan', 'IdPermohonan');
        $IdPermohonan = $lastId + 1;        

        // Memasukkan data dari form registrasi barang ke table permohonan
        Permohonan::createPermohonan([
            'IdPermohonan' => $IdPermohonan,             
            'SubjekPermohonan' => $input['subjek'], 
            'JenisPermohonan' => 2, 
            'IdPemohon' => $regbarang->session()->get('user_sess')->NomorInduk,
            'hashPermohonan' => md5($IdPermohonan.$input['subjek']),
        ]);           
        
        // get last object Barang           
        $lastKandidatId = Master::getLastId('kandidat_barang', 'IdKandidatBarang');

        // Memasukkan data dari form registrasi barang ke table kandidat_barang        
        for ($i=1; $i <= $nform; $i++, $lastKandidatId++) { 

            $IdBarang = $lastKandidatId + 1;            
            $namabarang = $input['namabarang'][$i];
            $jenisbarang = $input['jenisbarang'][$i];
            $kategoribarang = $input['kategoribarang'][$i];

            // insert to database
            KandidatBarang::createKandidatBarang([
                'IdKandidatBarang' => $IdBarang,
                'NamaBarang' => $namabarang,
                'JenisBarang' => $jenisbarang,
                'KategoriBarang' => $kategoribarang,
                'KeteranganBarang' => $input['keteranganbarang'][$i],
                'KondisiBarang' => $input['kondisibarang'][$i],
                'PenanggungJawab' => $input['penanggungjawab'][$i],
                'TanggalBeli' => date('Y-m-d H:i:s', strtotime($input['tanggalbeli'][$i])),
                'SpesifikasiBarang' => $input['spesifikasibarang'][$i],
                'IdPermohonan' => $IdPermohonan,
                'hashKandidat' => md5($IdBarang.$namabarang.$jenisbarang.$kategoribarang),
            ]);            
        }

        // create catatan record for this permohonan
        Catatan::createCatatan(
            $IdPermohonan, // Id Permohonan terkait 
            0, // tahap catatan
            $input['catatanpemohon'], // deskripsi catatan dari pemohon
            $regbarang->session()->get('user_sess')->NomorInduk, // nomor induk pemohon
            md5($IdPermohonan.'0'.$regbarang->session()->get('user_sess')->NomorInduk) // hash catatan
        );

        // destroy jmlform session
        session()->forget('jmlform');

        // Mengembalikan ke halaman list daftar registrasi barang             
        return redirect('registrasibarang');
    }

    /**
     * [updateBarang description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateRegistrasi(Request $request, $hash = '')
    {
        // check if user permitted        
        if (!($this->isPermitted('updateregistrasi'))) return redirect('registrasibarang');
        
        // redirect to dashboard if hash is null
        if ($hash == '') return redirect('registrasibarang');

        if ($request->isMethod('POST')) {
            // request method is post
            
            // Memvalidasi isian form registrasi barang
            $this->validate ($request, [
                'subjek'=> 'required|max:100',
                'catatanpemohon' => 'required',
                'namabarang.*' => 'required|max:100',                
                'tanggalbeli.*' => 'required',
                'penanggungjawab.*' => 'required|max:100',
                'kategoribarang.*' => 'required|max:100',
                'jenisbarang.*' => 'required|max:100',
                'kondisibarang.*' => 'required|max:100',
                'spesifikasibarang.*' => 'required',
                'keteranganbarang.*' => 'required',                                
                'kerusakanbarang.*' => 'required',
            ]);

            $input = $request->all();

            // update data dari form registrasi barang ke table permohonan
            Permohonan::updatePermohonan($input['hashPermohonan'], [
                'SubjekPermohonan' => $input['subjek'],
            ]);

            // update kandidat barang
            for ($i=1; $i <= count($input['namabarang']); $i++) { 
                KandidatBarang::updateKandidatBarang($input['hashKandidat'][$i], [
                    'NamaBarang' => $input['namabarang'][$i],
                    'JenisBarang' => $input['jenisbarang'][$i],
                    'KategoriBarang' => $input['kategoribarang'][$i],
                    'KeteranganBarang' => $input['keteranganbarang'][$i],
                    'KondisiBarang' => $input['kondisibarang'][$i],
                    'Penanggungjawab' => $input['penanggungjawab'][$i],
                    'TanggalBeli' => date('Y-m-d H:i:s', strtotime($input['tanggalbeli'][$i])),
                    'SpesifikasiBarang' => $input['spesifikasibarang'][$i],
                ]);            
            }

            // update catatan
            Catatan::updateCatatan($input['hashCatatan'], $input['catatanpemohon']);

            // Mengembalikan ke halaman list daftar registrasi barang             
            return redirect('registrasibarang');

        } else {
            // request method is get
            
            // check if user permitted        
            if (!($this->isPermitted('updateregistrasi'))) return redirect('registrasibarang');

            // get registrasi selected
            $registrasi = Permohonan::where([
                ['hashPermohonan', $hash],
                ['deleted', 0]
            ])->first();

            // check if user permitted to change 
            if( $request->session()->get('user_sess')->NomorInduk != $registrasi->IdPemohon || $registrasi->StatusPermohonan != 0 )
                return redirect('registrasibarang');

            $allkandidat = KandidatBarang::where([
                ['IdPermohonan', $registrasi->IdPermohonan]
            ])->get();

            $catatan = Catatan::where([
                ['IdPermohonan', '=', $registrasi->IdPermohonan],
                ['TahapCatatan', '=', 0]
            ])->first();

            // return update registrasi page
            return $this->render('registbarang.updateregistrasi', 
                [
                    'title' => 'Update Permohonan Regsitrasi Barang',
                    'registrasi' => $registrasi,
                    'allkandidat' => $allkandidat,
                    'catatan' => $catatan,
                ]
            );
        }            
    }

    /**
     * Update status permohonan registrasi barang
     * @param  Request $request
     * @return Redirect, Render
     */
    public function updateStatusRegistrasi(Request $request)
    {
        // check if user permitted        
        if (!($this->isPermitted('updateregistrasi'))) return redirect('registrasibarang');

        $newStatus = 0;        
        $newTahap = 1;

        $validation_array = [
            'catatan_txtarea' => 'required',
        ];

        $updatePermohonanArray = [];

        // validate request

        $input = $request->all();

        if(session('user_sess')->Role == 'Staf Fasilitas & Infrastruktur'){
            $validation_array['nomorsurat'] = 'required';
            $updatePermohonanArray['nomorsurat'] = $input['nomorsurat'];
        }         

        $this->validate($request, $validation_array);

        $lastTahap = Master::getLastId('permohonan', 'TahapPermohonan', [
            ['hashPermohonan', '=', $input['hashPermohonan']]
        ]);        

        $lastStatus = Master::getLastId('permohonan', 'StatusPermohonan', [
            ['hashPermohonan', '=', $input['hashPermohonan']]
        ]);


        // check update, TOLAK / SETUJU
        if (array_key_exists('setuju', $input))
            $newStatus = 2;
        else if (array_key_exists('tolak', $input))          
            $newStatus = 1;

        // increment new tahap
        if($lastStatus == 2) 
            $newTahap = $lastTahap + 1;        

        // update permohonan array
        $updatePermohonanArray['StatusPermohonan'] = $newStatus;

        // dd($lastTahap.' '.$lastStatus.' | '.$newTahap.' '.$newStatus);

        // if tahap change, push TahapPermohonan to updatePermohonanArray
        if ($lastTahap != $newTahap) 
            $updatePermohonanArray['TahapPermohonan'] = $newTahap;
        
        // update permohonan registrasi barang
        Permohonan::updatePermohonan($input['hashPermohonan'], $updatePermohonanArray);
             
        // get permohonan object
        $permohonan = Permohonan::where('hashPermohonan', $input['hashPermohonan'])->first();

        // if tahap 2 and status 2, insert kandidat_barang to barang
        if ($newTahap == 2 && $newStatus == 2) {

            // get all kandidat barang related to permohonan
            $allkandidat = KandidatBarang::where('IdPermohonan', $permohonan->IdPermohonan)->get();
            
            // get last id barang
            $lastBarangId = Master::getLastId('barang', 'IdBarang');
            $IdBarang = $lastBarangId + 1;

            foreach ($allkandidat as $kandidat) {                
                $namabarang = $kandidat->NamaBarang;
                $jenisbarang = $kandidat->JenisBarang;
                $kategoribarang = $kandidat->KategoriBarang;

                // insert to database
                Barang::createBarang([
                    'IdBarang' => $IdBarang,
                    'NamaBarang' => $namabarang,
                    'JenisBarang' => $jenisbarang,
                    'SpesifikasiBarang' => $kandidat->SpesifikasiBarang,
                    'TanggalBeli' => $kandidat->TanggalBeli,
                    'PenanggungJawab' => $kandidat->Penanggungjawab,
                    'KategoriBarang' => $kategoribarang,
                    'KondisiBarang' => $kandidat->KondisiBarang,
                    'KeteranganBarang' => $kandidat->KeteranganBarang,
                    'WaktuRegistrasi' => date('Y-m-d H:i:s', time()),
                    'NomorBarcode' => $IdBarang,
                    'hashBarang' => md5($IdBarang.$namabarang.$jenisbarang.$kategoribarang),
                ]);

                $IdBarang++;
            }
        }

        // last tahap catatan 
        $lastTahapCatatan = Master::getLastId('catatan', 'TahapCatatan', [
            ['IdPermohonan', '=', $permohonan->IdPermohonan],
        ]);

        // new tahap catatan
        $tahapCatatan = $lastTahapCatatan + 1;

        // create catatan
        Catatan::createCatatan(
            $permohonan->IdPermohonan, 
            $tahapCatatan,
            $input['catatan_txtarea'],
            $request->session()->get('user_sess')->NomorInduk,
            md5($permohonan->IdPermohonan.$tahapCatatan.$request->session()->get('user_sess')->NomorInduk)
        );

        // redirect to registrasi barang page
        return redirect('registrasibarang');
    }

    /**
     * Soft-remove permohonan registrasi in database
     * @param  Request $request Request object
     * @return redirect to dashboard.blade.php
     */
    public function removeRegistrasi(Request $request)
    {
        // check if user permitted        
        if (!($this->isPermitted('updateregistrasi'))) return redirect('registrasibarang');
        
        // ganti status peminjaman pada database        
        Permohonan::removePermohonan($request->input('hashPermohonan'));
        
        // redirect to registrasi barang dashboard
        return redirect('registrasibarang');
    }
}