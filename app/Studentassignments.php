<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentassignments extends Model
{
    protected $table="studentassignments";
    protected $primayKey="id";

    public static function create($student_name,$teacher_name,$done_assignment,$course,$assignment)
    {
        $assign=new Studentassignments;
        $assign->student_name=$student_name;
        $assign->teacher_name=$teacher_name;
        $assign->course=$course;
        $assign->done_assignment=$done_assignment;
        $assign->assignment=$assignment;
        $assign->save();
    }
}
