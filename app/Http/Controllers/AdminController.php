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
use App\Http\Requests\updateValidation;
use App\Http\Requests\updateTeacherValidation;
use App\Http\Requests\registerValidation;
use App\Http\Requests\registerValidationStudent;
use App\Http\Requests\assignmentVal;
use App\Http\Requests\assignmentDoneVal;
class AdminController extends Controller
{
    public function adminLogin()
    {
        if(session()->has('username')){
            return redirect('adminProfile'); 
        }
        return view("admin_login");
    }
    public function adminPosteacherLogin(validationsOfAll $r)
    {
        $r->validate();  

        $username=$r->input('username');
        $password=$r->input('password');
        try{
            $admin_user=Admins::login($username);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if (isset($admin_user[0])){
            if($admin_user[0]->password==$password){
                $r->session()->put('username',$username); 
                return redirect('adminProfile'); 
            }
        }
        return redirect('notExist') ;  
    }

    public function adminProfile(Request $request)
    {
        $session=session('username');
        try{
            $studentNotAllowedVariable=Students::studentNotAllowed($session);
            $teacherNotAllowedVariable=Teachers::teacherNotAllowed($session);
        } catch(\Exception $exception)
        {
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(!empty($teacherNotAllowedVariable) || !empty($studentNotAllowedVariable)){  
            return redirect("/notLoggedIn");
        }
        $ssearch=$request['ssearch']??"";
        if(!empty($ssearch)){
            try{
                $student=Students::search($ssearch);
            } catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
        }
        else{
            try{
                $student=Students::paginate(3);
            } catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
        }        
        $tsearch=$request['tsearch']??"";
        if(!empty($tsearch)){
            $teacher=Teachers::search($tsearch);
        }
        else{
            $teacher=Teachers::paginate(3);
        }        
        $checkingSession=Admins::checkingSession($session);
        $data=compact('student','teacher','checkingSession','tsearch','ssearch');
        return view('admin_profile')->with($data);     
    }
    
    public function studentDeletebyadmin($id)
    {
        $session=session('username');
        try{
            $studentNotAllowedVariable=Students::studentNotAllowed($session);
            $teacherNotAllowedVariable=Teachers::teacherNotAllowed($session);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(!empty($teacherNotAllowedVariable) || !empty($studentNotAllowedVariable)){  
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
        return redirect('/adminProfile');
    }
    public function studentEditbyadmin($id)
    {
        $session=session('username');
        try{
            $studentNotAllowedVariable=Students::studentNotAllowed($session);
            $teacherNotAllowedVariable=Teachers::teacherNotAllowed($session);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(!empty($teacherNotAllowedVariable) || !empty($studentNotAllowedVariable)){  
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
            $title="Update checkingSessionr student";
            $url=url('/adminProfile/studentUpdate') ."/". $id;
            $data=compact('student','url','title');
            return view('student-update')->with($data);
        }
            return redirect('/adminProfile');  
    }
    public function studentUpdatebyadmin($id, updateValidation $request)
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
        return redirect("/adminProfile");
    }
    public function teacherDeletebyadmin($id)
    {
        $session=session('username');
        try{
            $studentNotAllowedVariable=Students::studentNotAllowed($session);
            $teacherNotAllowedVariable=Teachers::teacherNotAllowed($session);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(!empty($teacherNotAllowedVariable) || !empty($studentNotAllowedVariable)){  
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
        return redirect('/adminProfile');
    }

    public function teacherEditbyadmin($id)
    {
        $session=session('username');
        try{
            $studentNotAllowedVariable=Students::studentNotAllowed($session);
            $teacherNotAllowedVariable=Teachers::teacherNotAllowed($session);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(!empty($teacherNotAllowedVariable) || !empty($studentNotAllowedVariable)){  
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
            $title="Update teacher";
            $url=url('/adminProfile/teacherUpdate') ."/". $id;
            $data=compact('teacher','url','title');
            return view('teacher-update')->with($data);
        }
        return redirect('/adminProfile');
    }


    public function teacherUpdatebyadmin($id,updateTeacherValidation $request)
    {
        $request->validate();

        $name=$request->input('name');
        $username=$request->input('username');
        $course=$request->input('course');
        $gender=$request->input('gender');
        try{
            Teachers::teacherupdate($id,$name,$username,$course,$gender);
        } catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        return redirect("/adminProfile");
    }
    public function adminlogout()
    {
        if(session()->has('username')){
            session()->flush('username', null);
        }
        return redirect("/adminLogin");
    }

    
}
