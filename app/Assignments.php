<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    protected $table="assignments";
    protected $primayKey="id";

    public static function create($username,$course,$assignment)
    {
        $assign=new Assignments;
        $assign->username=$username;
        $assign->course=$course;
        $assign->assignment=$assignment;
        $assign->save();
    }
    public static function particularId($id)
    {
        return Assignments::where('id',$id)->get(); 
    }
}
