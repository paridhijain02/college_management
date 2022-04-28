<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table="students";
    protected $primayKey="id";

    public static function register($name,$username,$course,$year,$gender,$password)
    {
        $student=new Students;
        $student->name=$name;
        $student->username=$username;
        $student->course=$course;
        $student->year=$year;
        $student->gender=$gender;
        $student->password=$password;
        $student->save();
    }
    public static function search($search)
    {
        return Students::where('name','=',$search)->orwhere('username','=',$search)->orwhere('course','=',$search)->paginate(3);
    }
    public static function login($username)
    {
        return Students::where('username',$username)->get();
    }
    public static function index()
    {
        return Students::get();
    }

    public static function anyStudentByChance($session)
    {
        return Students::where('username',$session)->get(); 
    }
    public static function you($session)
    {
        return Students::where('username',$session)->get(); 
    }
}
