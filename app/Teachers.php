<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    protected $table="teachers";
    protected $primayKey="id";

    public static function register($name,$username,$course,$gender,$password)
    {
        $teacher    =new Teachers;
        $teacher    ->name=$name;
        $teacher    ->username=$username;
        $teacher    ->course=$course;
        $teacher    ->gender=$gender;
        $teacher    ->password=$password;
        $teacher    ->save();
    }
    public static function search($search)
    {
        return Teachers::where('name','LIKE','%'.$search .'%')->orwhere('username','LIKE','%'.$search .'%')->orwhere('course','LIKE','%'.$search .'%')->paginate(3);
    }
    public static function index()
    {
        return Teachers::get();
    }

    public static function login($username)
    {
        return Teachers::where('username',$username)->get();
    }
    public static function teacherNotAllowed($session)
    { 
        return Teachers::where('username',$session)->first(); 
    }
    public static function checkingSession($session)
    {                                  
        return Teachers::where('username',$session)->get(); 
    }
    public static function studentupdate($id,$name,$username,$course,$gender,$year)
    {
        $student    =Students::find($id);
        $student    ->name=$name;
        $student    ->username=$username;
        $student    ->course=$course;
        $student    ->year=$year;
        $student    ->gender=$gender;
        $student    ->save();
    }
    public static function teacherupdate($id,$name,$username,$course,$gender)
    {
        $teacher    =Teachers::find($id);
        $teacher    ->name=$name;
        $teacher    ->username=$username;
        $teacher    ->course=$course;
        $teacher    ->gender=$gender;
        $teacher    ->save();
    }    
}
