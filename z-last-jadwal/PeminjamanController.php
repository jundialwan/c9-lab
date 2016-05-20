<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Permohonan;
use App\Ruangan;
use App\Catatan;
use App\Jadwal;
use App\Master;
use DB;
use Carbon\Carbon;

class PeminjamanController extends MasterController
{
    /**
     * Get dashoard permohonan peminjaman ruangan view
     * @return dashboard page
     */
    public function dashboard()
    {
        // check if user permitted        
        // if (!($this->isPermitted('pinjamruang'))) return redirect('/');    

		// get permohonan peminjaman ruangan data
        // check the user Role
        if (session('user_sess')->Role == 'Staf PPAA' ||
            session('user_sess')->Role == 'Staf Sekretariat') 
        {
            $peminjaman = Permohonan::getPeminjaman(session('user_sess')->Role);
        } else {
            $peminjaman = Permohonan::getPeminjaman(session('user_sess')->Role, session('user_sess')->NomorInduk);
        }

		// render peminjaman ruangan dashboard
    	return $this->render('pinjamruang.dashboard',
    		[
    			'title' => 'Dashboard Peminjaman Ruangan',
    			'allpermohonan' => $peminjaman['allpermohonan'],
    			'allcatatan' => $peminjaman['allcatatan'],
    		]
    	);	
    }

    /**
     * Get create permohonan peminjaman ruangan page
     * @return buatpinjam page
     */
    public function getCreatePeminjaman()
    {
        // check if user permitted        
        // if (!($this->isPermitted('buatpinjam'))) return redirect('/');    

        return $this->render('pinjamruang.buatpeminjaman',
            [
                'title' => 'Buat Permohonan Peminjaman Ruangan',
            ]
        );
    }

    /**
     * [createPeminjaman description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createPeminjaman(Request $request)
    {
        // check if user permitted        
        // if (!($this->isPermitted('buatpinjam'))) return redirect('/');

        // get al input
        $input = $request->all();        

        // validate input
        $this->validate($request, [
            'ruangandipilih' => 'required',
            'pemohon' => 'required',
            'subjek' => 'required',
            'keperluan' => 'required',
            'waktumulai' => 'required',
            'waktuselesai' => 'required',
            'catatan' => 'required',
            'jenisRuangan' => 'required',
            'tanggal' => 'required'
        ]);

        $tanggal = $input['tanggal'];
        $inputmulai = substr_replace($input['waktumulai'], ':', strlen($input['waktumulai'])-2, 0);
        $inputselesai = substr_replace($input['waktuselesai'], ':', strlen($input['waktuselesai'])-2, 0);

        // normalize date
        if (strlen($inputmulai) == 4) $inputmulai = '0'.$inputmulai;
        if (strlen($inputselesai) == 4) $inputselesai = '0'.$inputselesai;

        // get timestamp
        $waktuMulai = date('Y\-m\-d  H:i:s', strtotime($tanggal.$inputmulai));
        $waktuSelesai = date('Y\-m\-d  H:i:s', strtotime($tanggal.$inputselesai));
        $ruangan = Ruangan::getRuangan($input['ruangandipilih']);

        $IdGedung = $ruangan[0]->IdGed;
        $IdRuangan = $ruangan[0]->IdRuangan;
        $user = $input['pemohon'];

        // get permohonan last ID
        $lastPermohonanId = Master::getLastId('permohonan', 'IdPermohonan');        
        $IdPermohonan = $lastPermohonanId + 1;

        // get jadwal last ID
        $lastJadwalId = Master::getLastId('jadwal', 'IdJadwal', [
            ['IdGedung', '=', $IdGedung],
            ['IdRuangan', '=', $IdRuangan],
        ]);        
        $IdJadwal = $lastJadwalId + 1;

        // Memasukkan data ke database tabel jadwal
        Jadwal::createJadwal([
            'IdJadwal' => $IdJadwal,
            'IdRuangan' => $IdRuangan,
            'IdGedung' => $IdGedung,
            'WaktuMulai' => $waktuMulai,
            'WaktuSelesai' => $waktuSelesai,
            'KeperluanPeminjaman' => $input['keperluan'],
            'hashJadwal' => $IdGedung.$IdRuangan.$IdJadwal
        ]);

        // Memasukkan data dari form peminjaman ruangan ke table permohonan
        Permohonan::createPermohonan([
            'IdPermohonan' => $IdPermohonan,             
            'SubjekPermohonan' => $input['subjek'], 
            'JenisPermohonan' => 1, 
            'IdPemohon' => $user,
            'IdGedung' => $IdGedung,
            'IdRuangan' => $IdRuangan,
            'IdJadwal' => $IdJadwal,
            'hashPermohonan' => md5($IdPermohonan.$input['subjek']),
        ]);

        // Memasukkan data catatan ke database table catatan
        Catatan::createCatatan(
            $IdPermohonan, 
            0, 
            $input['catatan'], 
            $user, 
            md5($IdPermohonan.'0'.$user) // hash catatan
        );       

        // redirect to permohonan peminjaman ruangan page
        return redirect('pinjamruang');
    }

    /**
     * Get ruangan available through AJAX request
     * @param  Request $request Request object
     * @return JSON
     */
    public function getRuanganAvailableAJAX(Request $request)
    {
        $params;

        // get all query string variable passed
        $qstring = parse_str($_SERVER['QUERY_STRING'], $params);

        $jenisRuangan= $params['jenisRuangan'];
        $tanggal = $params['tanggal'];
        $inputmulai = substr_replace($params['waktuMulai'], ':', strlen($params['waktuMulai'])-2, 0);
        $inputselesai = substr_replace($params['waktuSelesai'], ':', strlen($params['waktuSelesai'])-2, 0);

        // normalize date
        if (strlen($inputmulai) == 4) $inputmulai = '0'.$inputmulai.':00';
        if (strlen($inputselesai) == 4) $inputselesai = '0'.$inputselesai;

        $waktuMulai =strtotime($tanggal.$inputmulai);
        $waktuSelesai = strtotime($tanggal.$inputselesai);

        $allruangan = DB::select(DB::raw(
            'SELECT * 
            FROM Ruangan r, Gedung g
            WHERE 
                r.JenisRuangan="'.$jenisRuangan.'" AND 
                r.IdGed=g.IdGedung AND
                r.deleted=0'
        ));

        
        $ruangantersedia = array();

        foreach($allruangan as $ruangan) {  

             $IdGedung = $ruangan->IdGedung;
             $IdRuangan = $ruangan->IdRuangan;

        

          $jadwalRuangan = DB::select(DB::raw(
                "SELECT *                                         
                FROM jadwal j, permohonan p
                WHERE 
                j.IdGedung = '$IdGedung' AND
                j.IdRuangan = '$IdRuangan' AND 
                j.IdJadwal = p.IdJadwal AND 
                j.IdGedung = p.IdGedung AND 
                j.IdRuangan = p.IdRuangan AND 
                j.deleted = 0 AND p.StatusPermohonan = 2"
            ));


        if (count($jadwalRuangan) == 0) {
            array_push($ruangantersedia, $ruangan);

         } else {


                     foreach($jadwalRuangan as $jadwal){
                      
                        $arr = array();
                        $datatanggalmulai = $jadwal->WaktuMulai;
                        $arr = explode(' ', $datatanggalmulai);

                        $datawaktumulai = strtotime($jadwal->WaktuMulai);
                        $datawaktuselesai = strtotime($jadwal->WaktuSelesai);

                         // array_push($ruangantersedia, $jadwal);

                        if($arr[0]==$tanggal){
                             
                            if( (($waktuMulai >= $datawaktuselesai || $waktuMulai < $datawaktumulai) && 
                              ($waktuSelesai > $datawaktuselesai || $waktuSelesai < $datawaktumulai)) )
                               array_push($ruangantersedia, $ruangan); 
                        }
        //             $datawaktumulai = strtotime($jadwal->WaktuMulai);
        //             $datawaktuselesai = strtotime($jadwal->WaktuSelesai);
        //             $waktusekarang = time();
                    
        //             $tes = date('Y-m-d H:i:s', strtotime($jadwal->WaktuSelesai));
        //             $tes1 = date('Y-m-d  H:i:s', $waktuMulainya);
        //             $tes2= date('Y-m-d  H:i:s', $waktusekarang);

        //             //Kalau waktu mulai jadwal yang udah ada lebih lama dari waktu sekarang 
        //             if( !($datawaktumulai < $waktusekarang && $datawaktuselesai < $waktusekarang) )
        //             {
                        
        //                 if( (($waktuMulainya >= $datawaktuselesai || $waktuMulainya < $datawaktumulai) && 
        //                      ($waktuSelesainya > $datawaktuselesai || $waktuSelesainya < $datawaktumulai)) )
        //                        array_push($ruangantersedia, $ruangan);                
        //             }  
        //         }                        
           }                    
        }

       
    }

        return json_encode($ruangantersedia);
    }
    /**
     * [setuju description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function setuju(Request $request)
    {
        // get session peminjaman yang mau dibatalkan
        $input = $request->all();

        // get all data
        $id = $input['Id'];
        $catatan = $input['catatan_txtarea'];
        $user_id = $input['UserId'];
        $persetujuan = $input['persetujuan'];

        // incrementing Id
        $tahap_catatan = Catatan::getIncrementedTahapCatatan();

        // insert new record to database
        Catatan::createCatatan($id, $tahap_catatan, $catatan, $user_id);

        // update record's status
        Permohonan::updateStatus($id, $persetujuan);
        
        return back();
    }

    /**
     * Update status peminjaman selected
     * @param  Request $request Request object
     * @return void
     */
    public function updateStatusPeminjaman(Request $request)
    {
        // check if user permitted        
        // if (!($this->isPermitted('buatpinjam'))) return redirect('/');
        
        // validate request
        $this->validate($request, [
            'nomorsurat' => 'required',
            'catatan_txtarea' => 'required',
        ]);

        $input = $request->all();
        $status = 0;

        // check update, TOLAK / SETUJU
        if (array_key_exists('setuju', $input))
            $status = 2;
        else if (array_key_exists('tolak', $input))          
            $status = 1;

        // update permohonan
        Permohonan::updatePermohonan($input['hashPermohonan'], [
            'NomorSurat' => $input['nomorsurat'],
            'StatusPermohonan' => $status,
        ]);

        // get permohonan object
        $permohonan = Permohonan::where('hashPermohonan', $input['hashPermohonan'])->get();

        // last tahap catatan 
        $lastTahapCatatan = Master::getLastId('catatan', 'TahapCatatan', [
            ['IdPermohonan', '=', $permohonan[0]->IdPermohonan],
        ]);

        // new tahap catatan
        $tahapCatatan = $lastTahapCatatan + 1;

        // create catatan
        Catatan::createCatatan(
            $permohonan[0]->IdPermohonan, 
            $tahapCatatan,
            $input['catatan_txtarea'],
            session('user_sess')->NomorInduk,
            md5($permohonan[0]->IdPermohonan.$tahapCatatan.session('user_sess')->NomorInduk)
        );

        // return to pinjamruang dashboard
        return redirect('pinjamruang');
    }  

    /**
     * Soft-delete permohonan peminjaman ruangan
     * set 'deleted' column to
     * @param  Request $request Request object
     * @return redirect to pinjamruang
     */
    public function removePeminjaman(Request $request)
    {
        // ganti value delete peminjaman pada database
        Permohonan::deletePermohonan($request->input('hashPermohonan'));
        
        // redirect back to peminjaman dashboard
        return redirect('pinjamruang');
    }
}