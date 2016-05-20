<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class User extends Model
{
    protected $table = 'users';

    public static function isUserExist($user, $pass)
    {
        $user = DB::table('users')->where([
            ['Username', '=', $user],
            ['Password', '=', $pass],
        ])->first();

        if (count($user) > 0) return $user;
        else return false;              
    }

    public static function isLoggedIn()
    {
        return session()->has('user_sess');
    }    
}