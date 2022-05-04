<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Students;
use App\Teachers;
use App\Admins;
use App\Assignments;
use App\Studentassignments;
use App\Http\Requests\validationsOfAll;
use App\Http\Requests\registerValidation;
use App\Http\Requests\registerValidationStudent;
use App\Http\Requests\assignmentVal;
use App\Http\Requests\assignmentDoneVal;
class ProjectController extends Controller
{
    public function welcome(Request $r)
    {
        return view('welcome');
    }  
    public function notExist()
    {
       return view('notExist');
    }
    public function notLoggedIn()
    {
       return view('notLoggedIn');
    }
    
}
