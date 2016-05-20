<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Jadwal;
use App\Ruangan;
use App\Master;
use App\Gedung;
use App\Permohonan;
use DB;
use Input;

class JadwalController extends MasterController
{       
    /**
     * Get Jadwal view
     * @return jadwal view
     */
    public function getJadwal()
    {
        // check if user permitted        
        if (!($this->isPermitted('jadwal'))) return redirect('/');    

        // get all gedung 
    	$allgedung = Gedung::all();

        // get all ruangan
    	$allruangan = DB::select(
            DB::raw(
                'SELECT *
                FROM ruangan r, gedung g
                WHERE r.IdGed = g.IdGedung'
            )
        );

        // return jadwal view
    	return $this->render('pinjamruang.jadwal', [
			'title' => 'Jadwal Ruangan',
			'allgedung' => $allgedung,
			'allruangan' => $allruangan,
    	]);
    }

    /**
     * [createJadwal description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createJadwal(Request $request)
    {
        // check if user permitted        
        if (!($this->isPermitted('buatjadwal'))) return redirect('pinjamruang/jadwal');

        if ($request->isMethod('POST')) {
            
            // get al input
            $input = $request->all();        

            // validate input
            $this->validate($request, [
                'ruangandipilih' => 'required',
                'pemohon' => 'required',
                'keperluan' => 'required',
                'waktumulai' => 'required',
                'waktuselesai' => 'required',
                'jenisRuangan' => 'required',
                'tanggal' => 'required'
            ]);

            $tanggal = $input['tanggal'];
            // $tanggal = str_replace(',', '', $tanggal);
            $inputmulai = substr_replace($input['waktumulai'], ':', strlen($input['waktumulai'])-2, 0);
            $inputselesai = substr_replace($input['waktuselesai'], ':', strlen($input['waktuselesai'])-2, 0);

            // normalize date
            if (strlen($inputmulai) == 4) $inputmulai = '0'.$inputmulai;
            if (strlen($inputselesai) == 4) $inputselesai = '0'.$inputselesai;

            // get timestamp
            $waktuMulai = date('Y\-m\-d H:i:s', strtotime($tanggal.$inputmulai));
            $waktuSelesai = date('Y\-m\-d H:i:s', strtotime($tanggal.$inputselesai));
            $ruangan = Ruangan::getRuangan($input['ruangandipilih']);

            $IdGedung = $ruangan[0]->IdGed;
            $IdRuangan = $ruangan[0]->IdRuangan;
            $user = $input['pemohon'];

            // get jadwal last ID
            $lastJadwalId = Master::getLastId('jadwal', 'IdJadwal', [
                ['IdGedung', '=', $IdGedung],
                ['IdRuangan', '=', $IdRuangan],
            ]);        
            $IdJadwal = $lastJadwalId + 1;

            // get permohonan last ID
            $lastPermohonanId = Master::getLastId('permohonan', 'IdPermohonan');        
            $IdPermohonan = $lastPermohonanId + 1;

            // Memasukkan data ke database tabel jadwal
            Jadwal::createJadwal([
                'IdJadwal' => $IdJadwal,
                'IdRuangan' => $IdRuangan,
                'IdGedung' => $IdGedung,
                'WaktuMulai' => $waktuMulai,
                'WaktuSelesai' => $waktuSelesai,
                'KeperluanPeminjaman' => $input['keperluan'],
                'hashJadwal' => md5($IdGedung.$IdRuangan.$IdJadwal)
            ]);

            Permohonan::createPermohonan([
                'IdPermohonan' => $IdPermohonan,             
                'SubjekPermohonan' => $input['keperluan'], 
                'JenisPermohonan' => 1, 
                'StatusPermohonan' => 2,
                'IdPemohon' => $user,
                'IdGedung' => $IdGedung,
                'IdRuangan' => $IdRuangan,
                'IdJadwal' => $IdJadwal,
                'hashPermohonan' => md5($IdPermohonan.$input['keperluan']),
            ]);

            // redirect to permohonan peminjaman ruangan page
            return redirect('pinjamruang/jadwal');

        } else {
            
            // return buatjadwal view
            return $this->render('pinjamruang.buatjadwal', [
                'title' => 'Buat Jadwal Ruangan',
            ]);

        }
        
    }
    
    /**
     * Get jadwal AJAX to feed fullCalendar object
     * @param  Request $request Request object
     * @return JSON             JSON Objetc to feed fullCalendar
     */
    public function getJadwalAJAX(Request $request)
    {
    	// check if request is AJAX, if it's not ignore
    	if ($request->ajax()) {

            // default query
            $query = 
                'SELECT * 
                FROM jadwal j, ruangan r, gedung g
                WHERE 
                    j.IdRuangan = r.IdRuangan AND
                    j.IdGedung = r.IdGed AND
                    r.IdGed = g.IdGedung AND
                    j.deleted = 0';
    		
            $params;
            $jadwalarr = array();

            // get query string parameters
            $qstring = parse_str($_SERVER['QUERY_STRING'], $params);

            // check if parameters jenis ruang is available
            if (isset($params['jenisruang'])) {
                // append query JenisRuangan to default query
                $query = $query.' AND r.JenisRuangan = "'.$params['jenisruang'].'"';
            }

            // check if parameters nomorruang is available
            if(isset($params['nomorruang'])) {
                // append query NomorRuangan to default query
                if($params['nomorruang'] != '') $query = $query.' AND r.NomorRuangan = "'.$params['nomorruang'].'"';
            }

            // get jadwal data
            $alljadwal = DB::select(DB::raw($query));

            // push all jadwal to array
            foreach ($alljadwal as $jadwal) {
                $jsonarr = [
                    'title' => $jadwal->KeperluanPeminjaman.'('.str_replace('Gedung ', '', $jadwal->NamaGedung).$jadwal->NomorRuangan.')',
                    'start' => str_replace(' ', 'T', $jadwal->WaktuMulai),
                    'end'   => str_replace(' ', 'T', $jadwal->WaktuSelesai),
                    'ruangan' => $jadwal->NomorRuangan,
                    'gedung' => str_replace('Gedung ', '', $jadwal->NamaGedung),
                    'hashJadwal' => $jadwal->hashJadwal,
                    'tooltip' => $jadwal->KeperluanPeminjaman,
                ];

                // push
                array_push($jadwalarr, $jsonarr);                
            }
            
    		// return jadwal JSON object from jadwal array
    		return json_encode($jadwalarr);
    	}    	
    }

    /**
     * [deleteJadwal description]
     * @param  String $hash Hash Jadwal
     * @return redirect to jadwal page
     */
    public function removeJadwal(Request $request)
    {
        // check if user permitted        
        if (!($this->isPermitted('hapusjadwal'))) return redirect('pinjamruang/jadwal');

        // soft delete jadwal from database
        Jadwal::removeJadwal($request->input('hashJadwal'));

        // redirect back to jadwal page
        return redirect('pinjamruang/jadwal');
    }
}