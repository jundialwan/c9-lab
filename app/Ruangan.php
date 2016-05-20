<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ruangan;
use DB;

class Ruangan extends Model
{
    protected $table = 'ruangan';

    /**
     * Create ruangan data and input it to database
     * @param  Array $data  create data
     * @return void
     */
    public static function createRuangan($data)
    {
        // insert ruangan object to database given the data
        DB::table('ruangan')->insert($data);
    }

    /**
     * Get all ruangan object when deleted equals to 0
     * @return Ruangan
     */
    public static function getAllRuangan()
    {
    	return DB::select(DB::raw(
			'SELECT *
			FROM ruangan r, gedung g
			WHERE 
				r.IdGed = g.IdGedung AND
				r.deleted = 0'
    	));
    }

    /**
     * Get ruangan and related gedung given the hash
     * @param  String $hash hashRuang
     * @return Ruangan, Gedung
     */
    public static function getRuangan($hash)
    {
        return Ruangan::where('hashRuang', $hash)->get();
    }

    /**
     * Update selected Ruangan data
     * @param  String $hash hash string identifier selected Ruangan
     * @param  Array  $data update dat
     * @return void
     */
    public static function updateRuangan($hash, $data)
    {
        // update selected gedung given the update data
        DB::table('ruangan')->where('hashRuang', $hash)->update($data);
    }

    /**
     * Update 'deleted' column in selected Ruangan to 1
     * @param  String  $hash hash string identifier selected Ruangan
     * @return void
     */
    public static function removeRuangan($hash)
    {
        // set selected gedung to deleted = 1
        DB::table('ruangan')->where('hashRuang', $hash)->update(['deleted' => 1]);
    }
}
