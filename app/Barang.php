<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Barang extends Model
{
	protected $table = 'barang';

	/**
     * Create barang data and input it to database
     * @param  Array $data  create data
     * @return void
     */
    public static function createBarang($data)
    {
    	// insert barang object to database given the data
    	DB::table('barang')->insert($data);
    }

    /**
     * Update selected Barang data
     * @param  String $hash hash string identifier selected Barang
     * @param  Array  $data update dat
     * @return void
     */
	public static function updateBarang($hash, $data)
	{
		// input update data given to database
		DB::table('barang')->where('hashBarang', $hash)->update($data);
	}
}
