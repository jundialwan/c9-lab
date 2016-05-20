<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class KandidatBarang extends Model
{
    protected $table = 'kandidat_barang';

    public static function createKandidatBarang($data)
    {
    	// insert kandidat barang object to database given the data
    	DB::table('kandidat_barang')->insert($data);
    }

    /**
     * Update selected Kandidat Barang data
     * @param  String $hash hash string identifier selected Kandidat Barang
     * @param  Array  $data update dat
     * @return void
     */
	public static function updateKandidatBarang($hash, $data)
	{
		// input update data given to database
		DB::table('kandidat_barang')->where('hashKandidat', $hash)->update($data);
	}
}
