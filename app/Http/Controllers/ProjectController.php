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
    public function studentLogin()
    {
        if(session()->has('username'))
        {
            return redirect('sprofilee'); 
        }
        else
        {
            return view("student_login");
        } 
    }
    public function studentPostLogin(validationsOfAll $r)
    {
        $r->validate();
        $username=$r->input('username');
        $password=$r->input('password');
        try{
            $student_user=Students::login($username);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        $student = isset($student_user[0]) ? $student_user[0] : false;
        if ($student){
            if($student_user[0]->password==$password){
                $r->session()->put('username',$username); 
                return redirect('sprofilee'); 
            }
        }
        return redirect('notexist') ;
    }
    public function teacherLogin()
    {
        if(session()->has('username')){
            return redirect('tprofilee'); 
        }
        else{
            return view("teacher_login");
        } 
    }
    public function teacherPostLogin(validationsOfAll $r)
    {
            $r->validate();
            $username=$r->input('username');
            $password=$r->input('password');
            try{
                $teacher_user=Teachers::login($username);
            }
            catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
            $teacher = isset($teacher_user[0]) ? $teacher_user[0] : false;
            if ($teacher){
                if($teacher_user[0]->password==$password)
                {
                    $r->session()->put('username',$username); 
                    return redirect('tprofilee'); 
                }
            }
            return redirect('notexist') ;
    }
    public function adminLogin()
    {
        if(session()->has('username')){
            return redirect('aprofilee'); 
        }
        else{
            return view("admin_login");
        } 
    }
    public function adminPostLogin(validationsOfAll $r)
    {
        $r->validate();  
        $username=$r->input('username');
        $password=$r->input('password');
        try{
            $admin_user=Admins::login($username);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        $admin = isset($admin_user[0]) ? $admin_user[0] : false;
        if ($admin){
            if($admin_user[0]->password==$password){
                $r->session()->put('username',$username); 
                return redirect('aprofilee'); 
            }
        }
        return redirect('notexist') ;  
    }

    public function studentRegistered()
    {
        return view('ssignup');
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
        try
        {
            Students::register($name,$username,$course,$year,$gender,$password);
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
        return redirect("/sview");
    }
    public function teacherRegistered()
    {
        return view('tsignup');
    }
    public function teacherStore(registerValidation $request)
    {
        $request->validate();  

        $name=$request->input('name');
        $username=$request->input('username');
        $course=$request->input('course');
        $gender=$request->input('gender');
        $password=$request->input('password');
        try
        {
            Teachers::register($name,$username,$course,$gender,$password);
        }
        catch(\Exception $exception){
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
        return redirect("/tview");
    }
    
    public function studentProfile()
    {
        $session=session('username');
        try{
            $anyTeacherByChance=Teachers::anyTeacherByChance($session);
            $anyAdminByChance=Admins::anyAdminByChance($session);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if($anyTeacherByChance!="[]" || $anyAdminByChance!="[]"){
            return redirect("/notloggedin");
        }
        try{
            $student=Students::all();
            $assignment=Assignments::get();
            $teacher=Teachers::get();
            $you=Students::you($session);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        $data=compact('student','assignment','you','teacher');
        return view('student_profile')->with($data);
    }
    public function teacherProfile(Request $request)
    {
        $session=session('username');
        try{
            $anyStudentByChance=Students::anyStudentByChance($session);
            $anyAdminByChance=Admins::anyAdminByChance($session);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if($anyStudentByChance!="[]" || $anyAdminByChance!="[]"){
            return redirect("/notloggedin");
        }
        try{
            $student=Students::get();
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        $search=$request['search']??"";
        if($search!=""){
            try{
                $teacher=Teachers::search($search);
            }
            catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
        }
        else{
            try{
                $teacher=Teachers::get();
            }
            catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
        }        
        $you=Teachers::you($session);
        $data=compact('student','teacher','you','search');
        return view('teacher_profile')->with($data);     
    }
    public function adminProfile(Request $request)
    {
        $session=session('username');
        try{
            $anyStudentByChance=Students::anyStudentByChance($session);
            $anyTeacherByChance=Teachers::anyTeacherByChance($session);
        }
        catch(\Exception $exception)
        {
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if($anyStudentByChance!="[]" || $anyTeacherByChance!="[]"){
            return redirect("/notloggedin");
        }
        $ssearch=$request['ssearch']??"";
        if($ssearch!=""){
            try{
                $student=Students::search($ssearch);
            }
            catch(\Exception $exception)
            {
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
        }
        else{
            try{
                $student=Students::paginate(3);
            }
            catch(\Exception $exception)
            {
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
        }        
        $tsearch=$request['tsearch']??"";
        if($tsearch!=""){
            $teacher=Teachers::search($tsearch);
        }
        else{
            $teacher=Teachers::paginate(3);
        }        
        $you=Admins::you($session);
        $data=compact('student','teacher','you','tsearch','ssearch');
        return view('admin_profile')->with($data);     
    }
    public function notExist()
    {
       return view('notexist');
    }
    public function notLoggedIn()
    {
       return view('notloggedin');
    }
    public function studentDelete($id)
    {
        $session=session('username');
        try{
            $anyStudentByChance=Students::anyStudentByChance($session);
            $anyAdminByChance=Admins::anyAdminByChance($session);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if($anyStudentByChance!="[]" || $anyAdminByChance!="[]"){
            return redirect("/notloggedin");
        }
        try{
            $student=Students::find($id);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(isset($student)){
            $student->delete();
        }
        return redirect('/tprofilee');
    }
    public function studentEdit($id)
    {
        $session=session('username');
        try{
            $anyStudentByChance=Students::anyStudentByChance($session);
            $anyAdminByChance=Admins::anyAdminByChance($session);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if($anyStudentByChance!="[]" || $anyAdminByChance!="[]"){
            return redirect("/notloggedin");
        }
        try{
            $student=Students::find($id);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(isset($student)){
            $title="Update Your student";
            $url=url('/tprofilee/s_update') ."/". $id;
            $data=compact('student','url','title');
            return view('student-update')->with($data);
        }
        return redirect('/tprofilee');
    }
    public function studentUpdate($id, Request $request)
    {
        $name=$request->input('name');
        $username=$request->input('username');
        $course=$request->input('course');
        $gender=$request->input('gender');
        $year=$request->input('year');
        try{
            Teachers::studentupdate($id,$name,$username,$course,$gender,$year);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        return redirect("/tprofilee");
    }
    public function teacherDelete($id)
    {
        $session=session('username');
        try{
            $anyStudentByChance=Students::anyStudentByChance($session);
            $anyAdminByChance=Admins::anyAdminByChance($session);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if($anyStudentByChance!="[]" || $anyAdminByChance!="[]"){
            return redirect("/notloggedin");
        }
        try{
            $teacher=Teachers::find($id);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(isset($teacher)){
            $teacher->delete();
        }
        return redirect('/tprofilee');
    }
    public function teacherEdit($id)
    {
            $session=session('username');
            try{
                $anyStudentByChance=Students::anyStudentByChance($session);
                $anyAdminByChance=Admins::anyAdminByChance($session);
            }
            catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
            if($anyStudentByChance!="[]" || $anyAdminByChance!="[]"){
                return redirect("/notloggedin");
            }
            try{
                $teacher=Teachers::find($id);
            }
            catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
            if(isset($teacher)){
                $title="Update Yourself";
                $url=url('/tprofilee/t_update') ."/". $id;
                $data=compact('teacher','url','title');
                return view('teacher-update')->with($data);
            }
            return redirect('/tprofilee');
    }
    public function teacherUpdate($id, Request $request)
    {
        $name=$request->input('name');
        $username=$request->input('username');
        $course=$request->input('course');
        $gender=$request->input('gender');
        try{
            Teachers::teacherupdate($id,$name,$username,$course,$gender);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        return redirect("/tprofilee");
    }
    public function createNewAssignment()
    {  
        $session=session('username');
        try{
            $anyStudentByChance=Students::anyStudentByChance($session);
            $anyAdminByChance=Admins::anyAdminByChance($session);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if($anyStudentByChance!="[]" || $anyAdminByChance!="[]"){
            return redirect("/notloggedin");
        }
        $session=session('username');
        try{
            $you=Teachers::you($session);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        $data=compact('you');
        return view('create_assignment')->with($data);
    }
    public function createNewAssignmentPost(assignmentVal $request)
    {
        $request->validate();
        $session=session('username');
        try{
            $you=Teachers::you($session);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        $username=$session;
        $course=$request->input('course');
        $assignment=$request->input('assignment');
        try{
            Assignments::create($username,$course,$assignment);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        return redirect("/tprofilee");
    }
    public function teacherMyAsssignment()
    {  
            $session=session('username');
            try{
                $anyStudentByChance=Students::anyStudentByChance($session);
                $anyAdminByChance=Admins::anyAdminByChance($session);
            }
            catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
            if($anyStudentByChance!="[]" || $anyAdminByChance!="[]"){
                return redirect("/notloggedin");
            }
            $session=session('username');
            try{
                $student=Assignments::get();  
                $you=Teachers::you($session);
            }
            catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
            $data=compact('student','you');
            return view('my_assignments')->with($data);
    }
    public function assignmentDelete($id)
    {  
        $session=session('username');
        try{
            $anyStudentByChance=Students::anyStudentByChance($session);
            $anyAdminByChance=Admins::anyAdminByChance($session);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if($anyStudentByChance!="[]" || $anyAdminByChance!="[]"){
            return redirect("/notloggedin");
        }
        try{
            $assignment=Assignments::find($id);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(isset($assignment))
        {
            $assignment->delete();
        }
        return redirect('/my_assignments');
    }
    public function assignmentWrite($id)
    {
            $session=session('username');
            try{
                $anyTeacherByChance=Teachers::anyTeacherByChance($session);
                $anyAdminByChance=Admins::anyAdminByChance($session);
            }
            catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
            if($anyTeacherByChance!='[]' || $anyAdminByChance!="[]"){
                return redirect("/notloggedin");
            }
            $session=session('username');
            try{
                $you=Students::you($session); 
                $assignment=Assignments::find($id);
                $assignments=Assignments::particularId($id);
            }
            catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
            if(isset($assignment)){
                $url=url('/sprofilee/assignment_write_post') ."/". $id;
                $data=compact('url','you','assignments');
                return view('student-assignmet-update')->with($data);
            }
            return redirect('/sprofilee');
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
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        return redirect("/sprofilee");
    }

    public function studentAssignmentToTeacher()
    {
        $session=session('username');
        try{
            $anyStudentByChance=Students::anyStudentByChance($session);
            $anyAdminByChance=Admins::anyAdminByChance($session);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if($anyStudentByChance!="[]" || $anyAdminByChance!="[]"){
            return redirect("/notloggedin");
        }
        $session=session('username');
        try{
            $assignment=Studentassignments::get();  
            $you=Teachers::you($session);   
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        $data=compact('assignment','you');
        return view('student_assignment_view')->with($data);
    }
    
    public function studentDeletebyadmin($id)
    {
        $session=session('username');
        try{
            $anyStudentByChance=Students::anyStudentByChance($session);
            $anyTeacherByChance=Teachers::anyTeacherByChance($session);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if($anyStudentByChance!="[]" || $anyTeacherByChance!="[]"){
            return redirect("/notloggedin");
        }
        try{
            $student=Students::find($id);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(isset($student)){
            $student->delete();
        }
        return redirect('/aprofilee');
    }
    public function studentEditbyadmin($id)
    {
        $session=session('username');
        try{
            $anyStudentByChance=Students::anyStudentByChance($session);
            $anyTeacherByChance=Teachers::anyTeacherByChance($session);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if($anyStudentByChance!="[]" || $anyTeacherByChance!="[]"){
            return redirect("/notloggedin");
        }
        try{
            $student=Students::find($id);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(isset($student)){
            $title="Update Your student";
            $url=url('/aprofilee/s_update') ."/". $id;
            $data=compact('student','url','title');
            return view('student-update')->with($data);
        }
            return redirect('/aprofilee');  
    }
    public function studentUpdatebyadmin($id, Request $request)
    {
        $name=$request->input('name');
        $username=$request->input('username');
        $course=$request->input('course');
        $gender=$request->input('gender');
        $year=$request->input('year');
        try{
            Teachers::studentupdate($id,$name,$username,$course,$gender,$year);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        return redirect("/aprofilee");
    }
    public function teacherDeletebyadmin($id)
    {
        $session=session('username');
        try{
            $anyStudentByChance=Students::anyStudentByChance($session);
            $anyTeacherByChance=Teachers::anyTeacherByChance($session);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if($anyStudentByChance!="[]" || $anyTeacherByChance!="[]"){
            return redirect("/notloggedin");
        }
        try{
            $teacher=Teachers::find($id);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(isset($teacher)){
            $teacher->delete();
        }
        return redirect('/aprofilee');
    }

    public function teacherEditbyadmin($id)
    {
        $session=session('username');
        try{
            $anyStudentByChance=Students::anyStudentByChance($session);
            $anyTeacherByChance=Teachers::anyTeacherByChance($session);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if($anyStudentByChance!="[]" || $anyTeacherByChance!="[]"){
            return redirect("/notloggedin");
        }
        try{
            $teacher=Teachers::find($id);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        if(isset($teacher)){
            $title="Update Yourself";
            $url=url('/aprofilee/t_update') ."/". $id;
            $data=compact('teacher','url','title');
            return view('teacher-update')->with($data);
        }
        return redirect('/aprofilee');
    }


    public function teacherUpdatebyadmin($id, Request $request)
    {
        $name=$request->input('name');
        $username=$request->input('username');
        $course=$request->input('course');
        $gender=$request->input('gender');
        try{
            Teachers::teacherupdate($id,$name,$username,$course,$gender);
        }
        catch(\Exception $exception){
            return view('error')->with(
            'error',$exception->getMessage()
            );
        }
        return redirect("/aprofilee");
    }

    public function studentlogout()
    {
        if(session()->has('username')){
            session()->pull('username',null);
        }
        return redirect("/slogin");
    }

    public function teacherlogout()
    {
        if(session()->has('username')){
            session()->pull('username',null);
        }
        return redirect("/tlogin");
    }

    public function adminlogout()
    {
        if(session()->has('username')){
            session()->pull('username',null);
        }
        return redirect("/alogin");
    }

}
