<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Permohonan;
use App\Barang;
use App\Master;
use App\Catatan;

class MaintenanceController extends MasterController
{
	/**
	 * GET
     * Lihat dashboard permohonan maintenance barang
	 * @return [type] [description]
	 */
    public function getMaintenance()
    {
        // check if user permitted        
        if (!($this->isPermitted('maintenancebarang'))) return redirect('/');

    	$maintenance = Permohonan::getMaintenance(session()->get('user_sess')->Role, session()->get('user_sess')->NomorInduk);

        return $this->render('maintenancebarang.dashboard',
            [
                'title' => 'Dashboard Usulan Pengadaan',
                'allpermohonan' => $maintenance['allpermohonan'],
                'allcatatan' => $maintenance['allcatatan'],
                'allbarang' => $maintenance['allbarang']
            ]
        );
    }

    /**
     * GET
     * Get buat registrasi page
     * @param  Request $request Request object
     * @return buatregistrasi.blade.php
     */
    public function getCreateMaintenance(Request $request)
    {
        // check if user permitted        
        if (!($this->isPermitted('buatmaintenance'))) return redirect('maintenancebarang');
        
        $data = [
            'title' => 'Buat Permohonan Maintenance Barang',
            'barang' => '',
        ];

        if ($request->isMethod('POST')) {
            $barang = Barang::where([['NomorBarcode', $request->input('barcode')]])->first();
            
            // jika barang tidak ada, barcode barang salah
            if (count($barang) == 0) {
                $request->session()->flash('error_get_barang', 'Barang dengan barcode'.$request->input('barcode').' tidak ditemukan');
                return redirect('maintenancebarang/buat');
            }            
            
            $data['barang'] = $barang;
        }

        return $this->render('maintenancebarang.buatmaintenance', $data);    
    }

    /**
     * POST
     * Buat permohonan maintenance barang
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createMaintenance(Request $request)
    {
        // check if user permitted        
        if (!($this->isPermitted('buatmaintenance'))) return redirect('maintenancebarang');

    	// Memvalidasi isian form registrasi barang
        $this->validate ($request, [
            'subjek'=> 'required|max:100',
            'catatanpemohon' => 'required',            
            'kerusakanbarang' => 'required',
        ]);

        $input = $request->all();

        // Auto Increment IdPermohonan
        $lastId = Master::getLastId('permohonan', 'IdPermohonan');
        $IdPermohonan = $lastId + 1;        

        $barang = Barang::where('hashBarang', $input['hashBarang'])->first();

        // Memasukkan data dari form registrasi barang ke table permohonan
        Permohonan::createPermohonan([
            'IdPermohonan' => $IdPermohonan,             
            'SubjekPermohonan' => $input['subjek'], 
            'JenisPermohonan' => 4, 
            'IdPemohon' => $request->session()->get('user_sess')->NomorInduk,
            'IdBarang' => $barang->IdBarang,
            'hashPermohonan' => md5($IdPermohonan.$input['subjek']),
        ]);

        // update IdPermohonan pada barang
        Barang::updateBarang($input['hashBarang'], [
            'KerusakanBarang' => $input['kerusakanbarang'],
        ]);

        // create catatan record for this permohonan
        Catatan::createCatatan(
            $IdPermohonan, // Id Permohonan terkait 
            0, // tahap catatan
            $input['catatanpemohon'], // deskripsi catatan dari pemohon
            $request->session()->get('user_sess')->NomorInduk, // nomor induk pemohon
            md5($IdPermohonan.'0'.$request->session()->get('user_sess')->NomorInduk) // hash catatan
        );

        // Mengembalikan ke halaman list daftar maintenance barang             
        return redirect('maintenancebarang');
    }

    /**
     * GET, POST
     * Update permohonan maintenance barang
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateMaintenance(Request $request, $hash = '')
    {        
    	// check if user permitted        
        if (!($this->isPermitted('updatemaintenance'))) return redirect('maintenancebarang');
        
        // redirect to dashboard if hash is null
        if ($hash == '') return redirect('maintenancebarang');

        // redirect to dashboard if permohonan is deleted
        $permohonan = Permohonan::where('hashPermohonan', $hash)->first();
        if ($permohonan->deleted == 1) return redirect('maintenancebarang');

        // check request method
        if ($request->isMethod('POST')) {
            // request method is post
            
            // Memvalidasi isian form registrasi barang
            $this->validate ($request, [
                'subjek'=> 'required|max:100',
                'catatanpemohon' => 'required',                                            
                'kerusakanbarang' => 'required',
            ]);

            $input = $request->all();

            // update data dari form registrasi barang ke table permohonan
            Permohonan::updatePermohonan($hash, ['SubjekPermohonan' => $input['subjek']]);
            
            // update barang
            Barang::updateBarang($input['hashBarang'], ['KerusakanBarang' => $input['kerusakanbarang']]);

            // update catatan
            Catatan::updateCatatan($input['hashCatatan'], $input['catatanpemohon']);

            // Mengembalikan ke halaman list daftar registrasi barang             
            return redirect('maintenancebarang');

        } else {
            // request method is get
            
            // check if user permitted        
            if (!($this->isPermitted('updatemaintenance'))) return redirect('maintenancebarang');

            // get maintenance selected
            $maintenance = Permohonan::where('hashPermohonan', $hash)->first();

            // check if user permitted to change 
            if($request->session()->get('user_sess')->NomorInduk != $maintenance->IdPemohon || $maintenance->StatusPermohonan != 0 )
                return redirect('maintenancebarang');

            if (count($maintenance) == 0) return redirect('maintenancebarang');
            
            $barang = Barang::where('IdBarang', $maintenance->IdBarang)->first();

            $catatan = Catatan::where([
                ['IdPermohonan', '=', $maintenance['IdPermohonan']],
                ['TahapCatatan', '=', 0]
            ])->first();

            // return update maintenance page
            return $this->render('maintenancebarang.updateMaintenance', 
                [
                    'title' => 'Update Permohonan Maintenance Barang',
                    'permohonan' => $maintenance,
                    'barang' => $barang,
                    'catatan' => $catatan,
                ]
            );
        }   
    }

    /**
     * POST
     * Update status permohonan maintenance barang
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateStatusMaintenance(Request $request)
    {
        // check if user permitted        
        if (!($this->isPermitted('updatemaintenance'))) return redirect('maintenancebarang');

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
            $request->session()->get('user_sess')->NomorInduk,
            md5($permohonan->IdPermohonan.$tahapCatatan.$request->session()->get('user_sess')->NomorInduk)
        );

        // redirect to registrasi barang page
        return redirect('maintenancebarang');
    }

    /**
     * POST
     * Remove permohonan maintenance barang
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function removeMaintenance(Request $request)
    {
        // check if user permitted        
        if (!($this->isPermitted('updatemaintenance'))) return redirect('maintenancebarang');
        
    	// ganti status peminjaman pada database        
        Permohonan::removePermohonan($request->input('hashPermohonan'));
        
        // redirect to registrasi barang dashboard
        return redirect('maintenancebarang');
    }
}
