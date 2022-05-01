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

class StudentController extends Controller
{
    public function studentLogin()
    {
        if(session()->has('username'))
        {
            return redirect('studentProfile'); 
        }
        else
        {
            return view("student_login");
        } 
    }
    public function studentPosteacherLogin(validationsOfAll $r)
    {
        $r->validate();
        $username=$r->input('username');
        $password=$r->input('password');
        try{
            $student_user=Students::login($username);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if (isset($student_user[0])){
            if($student_user[0]->password == $password) {
                $r->session()->put('username',$username); 
                return redirect('studentProfile'); 
            }
        }
        return redirect('notexist') ;
    }
    public function studentRegistered()
    {
        return view('studentSignup');
    }
    public function studentStore(registerValidationStudent $request)
    {
        $request->validate();  

        $name=$request->input('name');
        $username=$request->input('username');
        $course=$request->input('course');
        $year=$request->input('year');
        $gender=$request->input('gender');
        $password=$request->input('password');
        try{
            Students::register($name,$username,$course,$year,$gender,$password);
        } catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
        return redirect("/studentLogin");
    }
    public function studentProfile()
    {
        $session=session('username');
        try{
            $teacherNotAllowed=Teachers::teacherNotAllowed($session);
            $adminNotAllowed=Admins::adminNotAllowed($session);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if($teacherNotAllowed!="[]" || $adminNotAllowed!="[]"){
            return redirect("/notloggedin");
        }
        try{
            $student=Students::all();
            $assignment=Assignments::get();
            $teacher=Teachers::get();
            $checkingSession=Students::checkingSession($session);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        $data=compact('student','assignment','checkingSession','teacher');
        return view('student_profile')->with($data);
    }
    public function assignmentWrite($id)
    {
            $session=session('username');
            try{
                $teacherNotAllowed=Teachers::teacherNotAllowed($session);
                $adminNotAllowed=Admins::adminNotAllowed($session);
            } catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
            if($teacherNotAllowed!='[]' || $adminNotAllowed!="[]"){
                return redirect("/notloggedin");
            }
            $session=session('username');
            try{
                $checkingSession=Students::checkingSession($session); 
                $assignment=Assignments::find($id);
                $attempts=Assignments::attempts($id);
                $assignments=Assignments::particularId($id);
            } catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
            if(isset($assignment)){
                $url=url('/studentProfile/assignment_write_post') ."/". $id;
                $data=compact('url','checkingSession','assignments','$attempts');
                return view('student-assignmet-update')->with($data);
            }
            return redirect('/studentProfile');
    }
    public function assignmentWritePost($id,assignmentDoneVal $request)
    {
        $request->validate();
        $student_name=$request->input('student_name');
        $teacher_name=$request->input('teacher_name');
        $done_assignment=$request->input('done_assignment');
        $course=$request->input('course');
        $assignment=$request->input('assignment');
        try{
            Studentassignments::create($student_name,$teacher_name,$done_assignment,$course,$assignment);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        return redirect("/studentProfile");
    }
    public function studentLogout()
    {
        if(session()->has('username')){
            session()->pull('username',null);
        }
        return redirect("/studentLogin");
    }
    
}
