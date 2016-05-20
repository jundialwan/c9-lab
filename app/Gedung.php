<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Gedung;
use DB;

class Gedung extends Model
{
    protected $table = 'gedung';

    /**
     * Create gedung data and input it to database
     * @param  Array $data  create data
     * @return void
     */
    public static function createGedung($data)
    {
    	// insert Gedung object to database given the data
    	DB::table('gedung')->insert($data);
    }

    /**
     * Get all gedung object when deleted equals to 0
     * @return Gedung
     */
    public static function getAllGedung()
    {
    	// get all gedung where deleted = 0
    	return Gedung::where('deleted', '=', 0)->get();
    }    

    /**
     * Update selected Gedung data
     * @param  String $hash hash string identifier selected Gedung
     * @param  Array  $data update dat
     * @return void
     */
    public static function updateGedung($hash, $data)
    {
    	// update selected gedung given the update data
    	DB::table('gedung')->where('hash', $hash)->update($data);
    }

    /**
     * Update 'deleted' column in selected Gedung to 1
     * @param  String  $hash hash string identifier selected Gedung
     * @return void
     */
    public static function removeGedung($hash)
    {
    	// set selected gedung to deleted = 1
    	DB::table('gedung')->where('hash', $hash)->update(['deleted' => 1]);
    }
}