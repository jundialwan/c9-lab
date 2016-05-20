<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Catatan extends Model
{
    protected $table = 'catatan';

    public static function getCatatanTerakhir() {
    	return DB::table('catatan')	->where('IdPermohonan', 1)->orderBy('TahapCatatan', 'desc')->first();
    }

    public static function getIncrementedTahapCatatan() {
    	$catatan_terakhir = Catatan::getCatatanTerakhir();
        
        if ($catatan_terakhir == null) 
        	return 1;
        else 
        	return $catatan_terakhir->TahapCatatan + 1;        
    }

    /**
     * [createCatatan description]
     * @param  [type] $id            [description]
     * @param  [type] $tahap_catatan [description]
     * @param  [type] $catatan       [description]
     * @param  [type] $user_id       [description]
     * @param  [type] $hashCatatan   [description]
     * @return [type]                [description]
     */
    public static function createCatatan($id, $tahap_catatan, $catatan, $user_id, $hashCatatan) {    	
        DB::table('catatan')->insert([
            'IdPermohonan' => $id,
            'TahapCatatan' => $tahap_catatan,
            'DeskripsiCatatan' => $catatan,
            'NomorIndukPenulis' => $user_id,
            'hashCatatan' => $hashCatatan,
        ]);        
    }

    /**
     * [updateCatatan description]
     * @param  [type] $hashCatatan      [description]
     * @param  [type] $DeskripsiCatatan [description]
     * @return [type]                   [description]
     */
    public static function updateCatatan($hashCatatan, $DeskripsiCatatan)
    {
        DB::table('catatan')->where('hashCatatan', $hashCatatan)->update([
            'DeskripsiCatatan' => $DeskripsiCatatan
        ]);
    }
}
