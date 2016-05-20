<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Permohonan;
use App\Master;
use App\Catatan;
use App\KandidatBarang;


class PengadaanController extends MasterController
{
	/**
	 * [getPengadaan description]
	 * @return [type] [description]
	 */
    public function getPengadaan()
    {
        // check if user permitted        
        if (!($this->isPermitted('usulanpengadaan'))) return redirect('usulanpengadaan');

    	$pengadaan = Permohonan::getPengadaan(session('user_sess')->Role, session('user_sess')->NomorInduk);

        return $this->render('usulanpengadaan.dashboard',
            [
                'title' => 'Dashboard Usulan Pengadaan',
                'allpermohonan' => $pengadaan['allpermohonan'],
                'allcatatan' => $pengadaan['allcatatan'],
                'allkandidat' => $pengadaan['allkandidat']
            ]
        ); 
    }

    /**
     * [createPengadaan description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getCreatePengadaan(Request $request)
    {
        // check if user permitted        
        if (!($this->isPermitted('buatpengadaan'))) return redirect('usulanpengadaan');        

        // reset the session
        session()->forget('jmlform');

        if ($request->isMethod('POST')) {

            $this->validate($request, [
                'jmlform' => 'required|numeric|max:5|min:1',
            ]);
            
            session()->flash('jmlform', $request->input('jmlform'));
        }

        return $this->render('usulanpengadaan.buatusulan',
            [
                'title' => 'Buat Permohonan Registrasi Barang',
            ]
        );
    }

    /**
     * [createPengadaan description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createPengadaan(Request $request)
    {
        // check if user permitted        
        if (!($this->isPermitted('buatpengadaan'))) return redirect('usulanpengadaan');

    	$nform = count($request->input('namabarang')); 

        // set session for jmlform
        session()->flash('jmlform', $nform);

        // Memvalidasi isian form registrasi barang
        $this->validate ($request, [
            'subjek'=> 'required|max:100',
            'catatanpemohon' => 'required',
            'namabarang.*' => 'required|max:100',                
            'penanggungjawab.*' => 'required|max:100',
            'kategoribarang.*' => 'required|max:100',
            'jenisbarang.*' => 'required|max:100',
            'spesifikasibarang.*' => 'required',
            'keteranganbarang.*' => 'required',                                
            //'kerusakanbarang.*' => 'required',
        ]);

        $input = $request->all();

        // Auto Increment IdPermohonan
        $lastId = Master::getLastId('permohonan', 'IdPermohonan');
        $IdPermohonan = $lastId + 1;        

        // Memasukkan data dari form registrasi barang ke table permohonan
        Permohonan::createPermohonan([
            'IdPermohonan' => $IdPermohonan,             
            'SubjekPermohonan' => $input['subjek'], 
            'JenisPermohonan' => 3, 
            'IdPemohon' => session('user_sess')->NomorInduk,
            'LinkAnggaran' => $input['linkanggaran'],
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
                'PenanggungJawab' => $input['penanggungjawab'][$i],
                //'TanggalBeli' => date('Y-m-d H:i:s', strtotime($input['tanggalbeli']//[$i])),
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
            session('user_sess')->NomorInduk, // nomor induk pemohon
            md5($IdPermohonan.'0'.session('user_sess')->NomorInduk) // hash catatan
        );

        // destroy jmlform session
        session()->forget('jmlform');

        // Mengembalikan ke halaman list daftar registrasi barang             
        return redirect('usulanpengadaan');
    }

    /**
     * [updatePengadaan description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updatePengadaan(Request $request, $hashPermohonan = '')
    {
    	// check if user permitted        
        if (!($this->isPermitted('updatepengadaan'))) return redirect('usulanpengadaan');  
        
        // check if hash parameter is empty
        if($hashPermohonan == '') return redirect('usulanpengadaan');

        // check the request method
        if ($request->isMethod('POST')) {
            // request method is post

            // form validation
            $this->validate($request, [
                'subjek' => 'required|max:100',
                'catatanpemohon' => 'required',
                'namabarang.*' => 'required|max:100',
                'jenisbarang.*' => 'required|max:100',
                'kategoribarang.*' => 'required|max:100',
                'spesifikasibarang.*' => 'required',
                'keteranganbarang.*' => 'required',
                'quantity.*'=>'required|numeric',
            ]);     
            
            $input = $request->all(); 
            
            // input data to database
            Permohonan::updatePengadaan($hashPermohonan, [         
                'SubjekPermohonan' => $request->input('subjek'),
            ]);

            for ($i=1; $i <= count($input['namabarang']); $i++) { 
                KandidatBarang::updateKandidatBarang($input['hashKandidat'][$i], [
                    'NamaBarang' => $input['namabarang'][$i],
                    'JenisBarang' => $input['jenisbarang'][$i],
                    'KategoriBarang' => $input['kategoribarang'][$i],
                    'KeteranganBarang' => $input['keteranganbarang'][$i],
                    'SpesifikasiBarang' => $input['spesifikasibarang'][$i],
                    'Quantity' => $input['quantity'][$i],
                ]);  
            }

            Catatan::updateCatatan($input['hashCatatan'], $input['catatanpemohon']);

            // redirect to daftar gedung
            return redirect('usulanpengadaan');

        } else {
            // request method is get  
            
            // check if user permitted to access
            if (!($this->isPermitted('updatepengadaan'))) return redirect('usulanpengadaan');                                                     

            $pengadaan = Permohonan::where('hashPermohonan', $hashPermohonan)->first();

            // check if user permitted to change 
            if($request->session()->get('user_sess')->NomorInduk != $pengadaan->IdPemohon || $pengadaan->StatusPermohonan != 0 )
                return redirect('usulanpengadaan');

            $allkandidat = KandidatBarang::where('IdPermohonan', $pengadaan['IdPermohonan'])->get();

            $catatan = Catatan::where([
                ['IdPermohonan', '=', $pengadaan['IdPermohonan']],
                ['TahapCatatan', '=', 0]
            ])->get();
            
            // render the update page form
            return $this->render('usulanpengadaan.updatepengadaan', [
                'title' => 'Update Usulan Pengadaan',
                'pengadaan' => $pengadaan,
                'catatan'=>$catatan,
                'allkandidat' =>$allkandidat,
            ]);
        }
    }

    public function updateStatusPengadaan(Request $request)
    {
        // check if user permitted        
        if (!($this->isPermitted('updatepengadaan'))) return redirect('usulanpengadaan'); 

        // validate request
        $newStatus = 0;        
        $newTahap = 1;

        $validation_array = [
            'catatan_txtarea' => 'required',
        ];

        // update permohonan
        $updatePermohonanArray = [];

        $input = $request->all();

        if(session('user_sess')->Role == 'Staf Fasilitas & Infrastruktur'){
            $validation_array['nomorsurat'] = 'required';
            $updatePermohonanArray['nomorsurat'] = $input['nomorsurat'];
        } 
        else if (session('user_sess')->Role == 'Staf Pengadaan')
        {
            $validation_array['updatepengadaan'] = 'required';
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
        else if (array_key_exists('update', $input))
            $newStatus = $input['updatepengadaan'];

        // increment new tahap
        if($lastStatus == 2 && $lastTahap != 4) 
            $newTahap = $lastTahap + 1;
        else 
            $newTahap = $lastTahap;  

        // update permohonan
        $updatePermohonanArray['StatusPermohonan'] = $newStatus;

        // if tahap change, push TahapPermohonan to updatePermohonanArray
        if ($lastTahap != $newTahap) 
            $updatePermohonanArray['TahapPermohonan'] = $newTahap;

        // update permohonan registrasi barang
        Permohonan::updatePermohonan($input['hashPermohonan'], $updatePermohonanArray);
      
        $permohonan = Permohonan::where('hashPermohonan', $input['hashPermohonan'])->first();
        
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
            session('user_sess')->NomorInduk,
            md5($permohonan->IdPermohonan.$tahapCatatan.session('user_sess')->NomorInduk)
        );

        // redirect to usulan pengadaan page
        return redirect('usulanpengadaan');
    }

    /**
     * [removePengadaan description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function removePengadaan(Request $request)
    {
        // check if user permitted        
        if (!($this->isPermitted('updatepengadaan'))) return redirect('usulanpengadaan'); 

        // ganti status peminjaman pada database        
         Permohonan::removePermohonan($request->input('hashPermohonan'));
        
        // redirect to registrasi barang dashboard
        return redirect('usulanpengadaan');
    }
}