<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Permohonan;
use App\Catatan;
use DB;

class PeminjamanController extends MasterController
{
    public function dashboard()
    {
		// get permohonan peminjaman ruangan data
        $peminjaman = Permohonan::getPeminjaman();

		// render peminjaman ruangan dashboard
    	return $this->render('pinjamruang.dashboard',
    		[
    			'title' => 'Dashboard Peminjaman Ruangan',
    			'allpermohonan' => $peminjaman['allpermohonan'],
    			'allcatatan' => $peminjaman['allcatatan'],
    		]
    	);	
    }

    public function getCreatePeminjaman()
    {
        return $this->render('pinjamruang.buat1',
            [
                'title' => 'Buat Permohonan Peminjaman Ruangan',
            ]
        );
    }

    public function removePeminjaman(Request $request)
    {
    	// get session peminjaman yang mau dibatalkan
        $input = $request->all();
        $hash = $input['Id'];

    	// ganti status peminjaman pada database
        Permohonan::deletePermohonan($hash);
    	
		// redirect back to peminjaman dashboard
        return back();
    }

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

    ///////////////////////////////////

    public function getBuat()
    {
        return $this->render('buat_peminjaman_ruangan',[
            'title' => 'Buat',
        ]); 
    }

    public function getRuanganAvailable(Request $request)
    {
        if($request->ajax()) {
            
            $jenisRuangan = $request->input('jenisRuangan');
            $tanggal = $request->input('tanggal');
            $waktuMulai = $request->input('waktuMulai');
            $waktuSelesai = $request->input('waktuSelesai');

            $waktuMulainya = strtotime("$tanggal.$waktuMulai");
            $timestampWaktuMulai =date(' Y\-m\-d  H:i:s', $waktuMulainya);
            
            $waktuSelesainya = strtotime("$tanggal.$waktuSelesai");
            $timestampWaktuSelesai = date(' Y\-m\-d  H:i:s', $waktuSelesainya);

            // $ruanganAvailable = DB::select(
            //     DB::raw( "SELECT * 
            //                                  FROM Ruangan a, Jadwal b 
            //                                  WHERE a.JenisRuangan='$jenisRuangan' AND a.IdRuangan=b.IdRuangan                                         "
            //                                  )
            //                                 );

            // foreach($ruanganAvailable['waktuMulai'] as $waktu ) {
            // //     foreach($allRuanganAvailable['waktuSelesai'] as $waktu2) {
            // //         // $datawaktumulai = strtotime($waktu);
            // //         // $datawaktuselesai = strtotime($waktu2);

            // //         // $date = new DateTime();

            // //         // $waktusekarang = strtotime($date);
            // //         // $ruangantersedia = array();

            // //         //Kalau waktu mulai jadwal yang udah ada lebih lama dari waktu sekarang 
            // //         // if( !($datawaktumulai  < $waktusekarang) ){
            // //         //     //diambil datanya
            // //         //     array_push($ruangantersedia, $ruanganAvailable);
            // //         // }
            // //     }
            // }

            // return json_encode($ruangantersedia);
            return json_encode($jenisRuangan);

        }

       

        


        // $allRuanganAvailable = DB::select( "SELECT * 
        //                                  FROM Ruangan a, Jadwal b 
        //                                  WHERE a.JenisRuangan='$jenisRuangan' AND a.IdRuangan=b.IdRuangan AND b.waktuMulai NOT BETWEEN '$timestampWaktuMulai' AND '$timestampWaktuSelesai' AND b.waktuSelesai NOT BETWEEN'$timestampWaktuMulai' AND '$timestampWaktuSelesai'
        //                                  "
        //                                 );
        

        // $ruangan = Ruangan::all()->where('jenisRuangan',$jenisRuangan);
        // $jadwalAvailable = Jadwal::all()
        //                         ->where('waktuMulai',$timestampWaktuMulai)
        //                         ->andWhere('waktuSelesai', $timestampWaktuSelesai)
        //                         ->andWhere('idRuangan',$ruangan->idRuangan)
        //                         ->get();

        // $allRuanganAvailable = Ruangan::all()->where('idRuangan',$jadwalAvailable->idRuangan);


        
        // $data = [ 'ruangan' => $ruangan, 'tanggal' => $tanggal, 'waktuMulai' => $waktuMulai, 'waktuSelesai' => $waktuSelesai, 'allRuanganAvailable' => $allRuanganAvailable];

        

   
        
        // return $this->render('pinjamruang.buat_peminjaman_ruangan_2',
        //     [
        //         'title' => '',
        //         'allRuanganAvailable' => $allRuanganAvailable,
        //     ]
        //     );
           
    }
}
