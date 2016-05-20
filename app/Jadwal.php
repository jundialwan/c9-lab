<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Jadwal;
use DB;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    /**
     * Create jadwal record on database
     * @param  Array  $data Create data
     * @return void
     */
    public static function createJadwal($data)
    {
    	// insert jadwal data to database
    	DB::table('jadwal')->insert($data);
    }

    /**
     * Remove jadwal record from the database
     * @param  String $hashJadwal Hash Jadwal record
     * @return void
     */
    public static function removeJadwal($hashJadwal)
    {
    	// delete jadwal record from database
    	DB::table('jadwal')->where('hashJadwal', $hashJadwal)->update(['deleted' => 1]);
    }
}
