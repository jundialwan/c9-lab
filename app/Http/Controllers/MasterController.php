<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use SSO\SSO;
use DB;

/**
 * Kelas MasterController
 * 
 * Merupakan class yang HARUS di-extends oleh semua controller
 * karena memiliki method render yang harus dipanggil
 * oleh semua request view halaman
 */
class MasterController extends Controller
{
	/**
	 * Method ini HARUS SELALU digunakan jika ingin 
	 * render page. Method ini berfungsi untuk menambahkan 
	 * data user dan cek login kedalam passing data yang 
	 * akan diberikan kepada View
	 * 
	 * @param  String $view       Halaman blade yang ingin di render
	 * @param  array  $input_data passing data dari controller
	 * @return View               Halaman yang di-render
	 */
    public function render($view, $input_data = [])    
    {	        
		// ambil input data dari controller yang memanggil method render
    	$data = $input_data;

		// cek apakah view yang ingin di render adalah home dan user belum terautentikasi
    	// if ($view == 'home' && !(SSO::check())) {
        if (($view == 'home' || $view == 'login') && !(session()->has('user_sess'))) {
			// user belum terautentikasi, 			
    		$data['isLoggedIn'] = false;	// set passing data 'isLoggedIn' false			    		
    	} else {
			// cek autentikasi user dengan SSO Check, 			
	    	// if (!SSO::check() && !(session()->has('user_sess'))) SSO::authenticate();
            if (!session()->has('user_sess')) return redirect('login');
	    	
			// tambahkan passing data					
			$data['isLoggedIn'] = User::isLoggedIn();		// isLoggedIn berisi boolean cek autentikasi
			$data['user_sess'] = session()->get('user_sess');	// user_sess berisi detail data user

            $view_folder = explode('.', $view);
            $data['sidebar'] = $view_folder[0];
    	}
    	
		// kembalikan view yang sudah dirender kepada user
		return view($view, compact('data'));
    }

    /**
     * Check if user permitted to see given page
     * @param  String  $page Page the user want to check
     * @return boolean       Is user permitted to see the page given
     */
    public function isPermitted($page)
    {
    	// check user authentication
    	if(!session()->has('user_sess')) return redirect('login');

    	// permitted user rules
    	$userrule = [
    		'Manajer Fasilitas & Infrastruktur' =>
                [
                    'pinjamruang', 'buatpinjam', 'updatepinjam', 
                    'registrasibarang', 'updateregistrasi',
                    'barang', 'buatbarang', 
                    'maintenancebarang', 'updatemaintenance', 
                    'usulanpengadaan', 'updatepengadaan'
                ],

    		'Staf Fasilitas & Infrastruktur' =>
                [
                    'pinjamruang', 'buatpinjam', 'updatepinjam', 
                    'registrasibarang', 'updateregistrasi',
                    'barang', 'buatbarang', 
                    'maintenancebarang', 'updatemaintenance', 
                    'usulanpengadaan', 'updatepengadaan'
                ],

    		'Staf PPAA' =>
                [
                    'pinjamruang', 'buatpinjam', 'updatepinjam', 
                    'ruangan', 'buatruangan', 'updateruangan', 
                    'jadwal', 'buatjadwal', 'hapusjadwal', 
                    'gedung', 'buatgedung', 'updategedung'
                ],

    		'Staf Sekretariat' =>
                [
                    'pinjamruang', 'buatpinjam', 'updatepinjam', 
                    'ruangan', 'buatruangan', 'updateruangan', 
                    'jadwal', 'buatjadwal', 'hapusjadwal', 
                    'gedung', 'buatgedung', 'updategedung'
                ],

            'Wakil Dekan 2' =>
                [
                    'pinjamruang', 'buatpinjam', 'updatepinjam', 
                    'registrasibarang', 'updateregistrasi', 
                    'maintenancebarang', 'updatemaintenance',
                    'usulanpengadaan', 'updatepengadaan'
                ],

    		'Staf' =>
                [
                    'pinjamruang', 'buatpinjam', 'updatepinjam', 
                    'registrasibarang', 'buatregistrasi', 'updateregistrasi',
                    'maintenancebarang', 'updatemaintenance',
                    'usulanpengadaan', 'updatepengadaan'
                ],

            'Staf Pengadaan' =>
                [
                    'pinjamruang', 'buatpinjam', 'updatepinjam', 
                    'usulanpengadaan', 'updatepengadaan'
                ],

    		'HM' =>
                [
                    'pinjamruang', 'buatpinjam', 'updatepinjam', 'jadwal',
                    'registrasibarang', 'buatregistrasi', 'updateregistrasi' ,
                    'maintenancebarang', 'buatmaintenance', 'updatemaintenance',
                    'usulanpengadaan', 'buatpengadaan', 'updatepengadaan'
                ],

            'Kadept' => [],

            'Kaprog' => [],

            'PAF' => [],

            'Dosen' => [],

    		'Mahasiswa' =>
                [
                    'pinjamruang', 'buatpinjam', 'updatepinjam', 
                    'buatpeminjaman', 'updatepinjam'
                ],
    	];

    	// get user type
    	$usertype = session()->get('user_sess')->Role;

    	// check if user permittes
    	if (array_key_exists($usertype, $userrule)) {
    		if (in_array($page, $userrule[$usertype], true)) return true;
    		else return false;
    	} else return false;
    }
}