<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentassignments extends Model
{
    protected $table="studentassignments";
    protected $primayKey="id";

    public static function search($search)
    {
        return Studentassignments::where('student_name','LIKE','%'.$search .'%')->orwhere('teacher_name','LIKE','%'.$search .'%')->orwhere('course','LIKE','%'.$search .'%')->paginate(5);
    }

    public static function create($student_name,$teacher_name,$done_assignment,$course,$assignment)
    {
        $assign     =new Studentassignments;
        $assign     ->student_name=$student_name;
        $assign     ->teacher_name=$teacher_name;
        $assign     ->course=$course;
        $assign     ->done_assignment=$done_assignment;
        $assign     ->assignment=$assignment;
        $assign     ->save();
    }

    public static function allpeople()
    {   
        return Studentassignments::get();
    }
}