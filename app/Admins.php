<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{
    protected $table="admins";
    protected $primayKey="id";

    public static function login($username)
    {
        return Admins::where('username',$username)->get();
    }
    public static function checkingSession($session)
    {
        return Admins::where('username',$session)->get(); 
    }
    public static function adminNotAllowed($session)
    {
        return Admins::where('username',$session)->first(); 
    }
}
