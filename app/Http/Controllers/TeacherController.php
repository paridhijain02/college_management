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
use App\Http\Requests\updateValidation;
use App\Http\Requests\updateTeacherValidation;
use App\Http\Requests\assignmentVal;
use App\Http\Requests\assignmentDoneVal;
class TeacherController extends Controller
{
    public function teacherLogin()
    {
        if(session()->has('username')){
            return redirect('teacherProfile'); 
        }
        else{
            return view("teacher_login");
        } 
    }
    public function teacherPosteacherLogin(validationsOfAll $r)
    {
        $r->validate();

        $username=$r->input('username');
        $password=$r->input('password');

        try{
            $teacher_user=Teachers::login($username);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if (isset($teacher_user[0])){
            if($teacher_user[0]->password==$password)
            {
                $r->session()->put('username',$username); 
                return redirect('teacherProfile'); 
            }
        }
        return redirect('notExist') ;
    }
    
    public function teacherRegistered()
    {
        return view('teacherSignup');
    }
    public function teacherStore(registerValidation $request)
    {
        $request->validate();  

        $name       =$request->input('name');
        $username   =$request->input('username');
        $course     =$request->input('course');
        $gender     =$request->input('gender');
        $password   =$request->input('password');
        try{
            Teachers::register($name,$username,$course,$gender,$password);
        } catch(\Exception $exception){
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
        return redirect("/teacherLogin");
    }
    
   
    public function teacherProfile(Request $request)
    {
        $session=session('username');
        try{
            $studentNotAllowedVariable=Students::studentNotAllowed($session);
            $adminNotAllowedVariable=Admins::adminNotAllowed($session);
            
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(!empty($adminNotAllowedVariable) || !empty($studentNotAllowedVariable)){   
            return redirect("/notLoggedIn");
        }
        try{
            $student=Students::get();
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        $search=$request['search']??"";
        if(!empty($search)){
            try{
                $teacher=Teachers::search($search);
            } catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
        }
        else{
            try{
                $teacher=Teachers::get();
            } catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
        }        
        $checkingSession=Teachers::checkingSession($session);
        $data=compact('student','teacher','checkingSession','search');
        return view('teacher_profile')->with($data);     
    }
    public function studentDelete($id)
    {
        $session=session('username');
        try{
            $studentNotAllowedVariable=Students::studentNotAllowed($session);
            $adminNotAllowedVariable=Admins::adminNotAllowed($session);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(!empty($adminNotAllowedVariable) || !empty($studentNotAllowedVariable)){  
            return redirect("/notLoggedIn");
        }
        try{
            $student=Students::find($id);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(isset($student)){
            $student->delete();
        }
        return redirect('/teacherProfile');
    }
    public function studentEdit($id)
    {
        $session=session('username');
        try{
            $studentNotAllowedVariable=Students::studentNotAllowed($session);
            $adminNotAllowedVariable=Admins::adminNotAllowed($session);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(!empty($adminNotAllowedVariable) || !empty($studentNotAllowedVariable)){  
            return redirect("/notLoggedIn");
        }
        try{
            $student=Students::find($id);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(isset($student)){
            $title="Update this student";
            $url=url('/teacherProfile/studentUpdate') ."/". $id;
            $data=compact('student','url','title');
            return view('student-update')->with($data);
        }
        return redirect('/teacherProfile');
    }

    public function studentUpdate($id,updateValidation $request)
    {
        $request->validate(); 

        $name       =$request->input('name');
        $username   =$request->input('username');
        $course     =$request->input('course');
        $gender     =$request->input('gender');
        $year       =$request->input('year');
        try{
            Teachers::studentupdate($id,$name,$username,$course,$gender,$year);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        return redirect("/teacherProfile");
    }
    public function teacherDelete($id)
    {
        $session=session('username');
        try{
            $studentNotAllowedVariable=Students::studentNotAllowed($session);
            $adminNotAllowedVariable=Admins::adminNotAllowed($session);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(!empty($adminNotAllowedVariable) || !empty($studentNotAllowedVariable)){  
            return redirect("/notLoggedIn");
        }
        try{
            $teacher=Teachers::find($id);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(isset($teacher)){
            $teacher->delete();
        }
        return redirect('/teacherProfile');
    }
    public function teacherEdit($id)
    {
            $session=session('username');
            try{
                $studentNotAllowedVariable=Students::studentNotAllowed($session);
                $adminNotAllowedVariable=Admins::adminNotAllowed($session);
            } catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
            if(!empty($adminNotAllowedVariable) || !empty($studentNotAllowedVariable)){  
                return redirect("/notLoggedIn");
            }
            try{
                $teacher=Teachers::find($id);
            } catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
            if(isset($teacher)){
                $title="Update checkingSessionrself";
                $url=url('/teacherProfile/teacherUpdate') ."/". $id;
                $data=compact('teacher','url','title');
                return view('teacher-update')->with($data);
            }
            return redirect('/teacherProfile');
    }
    public function teacherUpdate($id, updateTeacherValidation $request)
    {
        $request->validate(); 
        
        $name       =$request->input('name');
        $username   =$request->input('username');
        $course     =$request->input('course');
        $gender     =$request->input('gender');
        try{
            Teachers::teacherupdate($id,$name,$username,$course,$gender);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        return redirect("/teacherProfile");
    }
    public function createNewAssignment()
    {  
        $session=session('username');
        try{
            $studentNotAllowedVariable=Students::studentNotAllowed($session);
            $adminNotAllowedVariable=Admins::adminNotAllowed($session);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(!empty($adminNotAllowedVariable) || !empty($studentNotAllowedVariable)){  
            return redirect("/notLoggedIn");
        }
        $session=session('username');
        try{
            $checkingSession=Teachers::checkingSession($session);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        $data=compact('checkingSession');
        return view('createAssignment')->with($data);
    }
    public function createNewAssignmentPost(assignmentVal $request)
    {
        $request->validate();
        $session = session('username');
        try{
            $checkingSession=Teachers::checkingSession($session);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        $username=$session;
        $course=$request->input('course');
        $assignment=$request->input('assignment');
        try{
            Assignments::create($username,$course,$assignment);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        return redirect("/teacherProfile");
    }
    public function teacherMyAsssignment()
    {  
            $session=session('username');
            try{
                $studentNotAllowedVariable=Students::studentNotAllowed($session);
                $adminNotAllowedVariable=Admins::adminNotAllowed($session);
            } catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
            if(!empty($adminNotAllowedVariable) || !empty($studentNotAllowedVariable)){  
                return redirect("/notLoggedIn");
            }
            $session=session('username');
            try{
                $student=Assignments::get();  
                $checkingSession=Teachers::checkingSession($session);
            } catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
            $data=compact('student','checkingSession');
            return view('myAssignments')->with($data);
    }
    public function assignmentDelete($id)
    {  
        $session=session('username');
        try{
            $studentNotAllowedVariable=Students::studentNotAllowed($session);
            $adminNotAllowedVariable=Admins::adminNotAllowed($session);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(!empty($adminNotAllowedVariable) || !empty($studentNotAllowedVariable)){  
            return redirect("/notLoggedIn");
        }
        try{
            $assignment=Assignments::find($id);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(isset($assignment))
        {
            $assignment->delete();
        }
        return redirect('/myAssignments');
    }
    public function studentAssignmentToTeacher()
    {
        $session=session('username');
        try{
            $studentNotAllowedVariable=Students::studentNotAllowed($session);
            $adminNotAllowedVariable=Admins::adminNotAllowed($session);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(!empty($adminNotAllowedVariable) || !empty($studentNotAllowedVariable)){  
            return redirect("/notLoggedIn");
        }
        $session=session('username');
        try{
            $assignment=Studentassignments::get();  
            $checkingSession=Teachers::checkingSession($session);   
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        $data=compact('assignment','checkingSession');
        return view('studentAssignmentView')->with($data);
    }
    public function teacherlogout()
    {
        if(session()->has('username')){
            session()->pull('username',null);
        }
        return redirect("/teacherLogin");
    }
}
