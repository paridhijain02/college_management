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
/*        $this->validate($r, 
            [
                'username' => 'required',
                'password' => 'required'
            ]
            );
*/
        $r->validate();
        $username=$r->input('username');
        $password=$r->input('password');
        $a_user=Students::login($username);
        $st = isset($a_user[0]) ? $a_user[0] : false;
        if ($st)
        {
            if($a_user[0]->password==$password)
            {
                $r->session()->put('username',$username); 
                return redirect('sprofilee'); 
            }
        }
        else
        {
            return redirect('notexist') ;
        }
    }
    public function teacherLogin()
    {
        if(session()->has('username'))
        {
            return redirect('tprofilee'); 
        }
        else
        {
            return view("teacher_login");
        } 
    }
    public function teacherPostLogin(validationsOfAll $r)
    {
     /*   $this->validate($r, 
            [
                'username' => 'required',
                'password' => 'required'
            ]
            );
        */
        $r->validate();
        $username=$r->input('username');
        $password=$r->input('password');
        $a_user=Teachers::login($username);
        $st = isset($a_user[0]) ? $a_user[0] : false;
        if ($st)
        {
            if($a_user[0]->password==$password)
            {
                $r->session()->put('username',$username); 
                return redirect('tprofilee'); 
            }
        }
        else
        {
            return redirect('notexist') ;
        }
    }
    public function adminLogin()
    {
        if(session()->has('username'))
        {
            return redirect('aprofilee'); 
        }
        else
        {
            return view("admin_login");
        } 
    }
    public function adminPostLogin(validationsOfAll $r)
    {
    /*    $this->validate($r, 
            [
                'username' => 'required',
                'password' => 'required'
            ]
            );
    */
        $r->validate();  
        $username=$r->input('username');
        $password=$r->input('password');
        $a_user=Admins::login($username);
        $st = isset($a_user[0]) ? $a_user[0] : false;
        if ($st)
        {
            if($a_user[0]->password==$password)
            {
                $r->session()->put('username',$username); 
                return redirect('aprofilee'); 
            }
        }
        else
        {
            return redirect('notexist') ;
        }
    }

    public function studentRegistered()
    {
        return view('ssignup');
    }
    public function studentStore(registerValidationStudent $request)
    {
        
       /* $this->validate($request, 
            [
                'name' => 'required',
                'username' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation'=>'required',
                'gender' => 'required',
                'course' => 'required',
                'year' => 'required'
            ]
            );
        */
        $request->validate();  
        $name=$request->input('name');
        $username=$request->input('username');
        $course=$request->input('course');
        $year=$request->input('year');
        $gender=$request->input('gender');
        $password=$request->input('password');
        Students::register($name,$username,$course,$year,$gender,$password);
        return redirect("/sview");
    }
    public function teacherRegistered()
    {
        return view('tsignup');
    }
    public function teacherStore(registerValidation $request)
    {
     /*   $this->validate($request, 
            [
                'name' => 'required',
                'username' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation'=>'required',
                'gender' => 'required',
                'course' => 'required'
            ]
            );
    */
        $request->validate();  
        $name=$request->input('name');
        $username=$request->input('username');
        $course=$request->input('course');
        $gender=$request->input('gender');
        $password=$request->input('password');
        Teachers::register($name,$username,$course,$gender,$password);
        return redirect("/tview");
    }
    public function studentView(Request $request)
    {
        $search=$request['search']??"";
        if($search!="")
        {
            $c=Students::search($search);
        }
        else
        {
           $c=Students::paginate(3);
        }        
        $data=compact('c','search');
       return view('student-view')->with($data);
    }

    public function teacherView(Request $request)
    {
        $search=$request['search']??"";
        if($search!="")
        {
            $t=Teachers::search($search);
        }
        else
        {
            $t=Teachers::paginate(3);
        }        
        $data=compact('t','search');
       return view('teacher-view')->with($data);
    }
    public function studentProfile()
    {
     //   if(session()->has('username'))
    //    {
            $session=session('username');
            //$anyteacherbychance=Students::anyteacherbychance($session);
            $anyteacherbychance=Teachers::anyteacherbychance($session);
            $anyadminbychance=Admins::anyadminbychance($session);
            if($anyteacherbychance!='[]' || $anyadminbychance!="[]")
            {
                return redirect("/notloggedin");
            }
            $c=Students::all();
            $a=Assignments::get();
            $t=Teachers::get();
            $you=Students::you($session);
            $data=compact('c','a','you','t');
           return view('student_profile')->with($data);
    /*    }
        else
        {
            return redirect("/slogin");
        } 
    */
    }
    public function teacherProfile(Request $request)
    {
        $session=session('username');
        //if(session()->has('username'))
        //{
           // $anystudentbychance=Teachers::anystudentbychance($session);
           $anystudentbychance=Students::anystudentbychance($session);
           $anyadminbychance=Admins::anyadminbychance($session);
            if($anystudentbychance!="[]" || $anyadminbychance!="[]")
            {
                return redirect("/notloggedin");
            }
            $s=Students::get();
            $search=$request['search']??"";
            if($search!="")
            {
               $t=Teachers::search($search);
            }
            else
            {
                $t=Teachers::get();
            }        
            $you=Teachers::you($session);
            $data=compact('s','t','you','search');
            return view('teacher_profile')->with($data);     
       /* }
        else
        {
            return redirect("/tlogin");
        }*/ 
    }
    public function adminProfile(Request $request)
    {
        $session=session('username');
        //if(session()->has('username'))
        //{
            $anystudentbychance=Students::anystudentbychance($session);
            $anyteacherbychance=Teachers::anyteacherbychance($session);
            if($anystudentbychance!="[]" || $anyteacherbychance!="[]")
            {
                return redirect("/notloggedin");
            }
            //$s=Students::paginate(3);
            $ssearch=$request['ssearch']??"";
            if($ssearch!="")
            {
               $s=Students::search($ssearch);
            }
            else
            {
                $s=Students::paginate(3);
            }        
            //$s=Students::paginate(3);
            $tsearch=$request['tsearch']??"";
            if($tsearch!="")
            {
               $t=Teachers::search($tsearch);
            }
            else
            {
                $t=Teachers::paginate(3);
            }        
            $you=Admins::you($session);
            $data=compact('s','t','you','tsearch','ssearch');
            return view('admin_profile')->with($data);     
        /*}
        else
        {
            return redirect("/alogin");
        } */
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
        $anystudentbychance=Students::anystudentbychance($session);
        $anyadminbychance=Admins::anyadminbychance($session);
        if($anystudentbychance!="[]" || $anyadminbychance!="[]")
        {
            return redirect("/notloggedin");
        }
        $c=Students::find($id);
        if(!is_null($c))
        {
            $c->delete();
        }
        return redirect('/tprofilee');
    }
    public function studentEdit($id)
    {
 /*       if(session()->has('username'))
        {*/
            $session=session('username');
            $anystudentbychance=Students::anystudentbychance($session);
            $anyadminbychance=Admins::anyadminbychance($session);
            if($anystudentbychance!="[]" || $anyadminbychance!="[]")
            {
                return redirect("/notloggedin");
            }
            $c=Students::find($id);
            if(!is_null($c))
            {
                $title="Update Your student";
                $url=url('/tprofilee/s_update') ."/". $id;
                $data=compact('c','url','title');
                return view('student-update')->with($data);
            }
            else
            {
                return redirect('/tprofilee');
            }   
        /*}
         else
         {
            return redirect("/tlogin");
         }*/
    }
    public function studentUpdate($id, Request $request)
    {
        $name=$request->input('name');
        $username=$request->input('username');
        $course=$request->input('course');
        $gender=$request->input('gender');
        $year=$request->input('year');
        Teachers::studentupdate($id,$name,$username,$course,$gender,$year);
        return redirect("/tprofilee");
    }
    public function teacherDelete($id)
    {
        $session=session('username');
        $anystudentbychance=Students::anystudentbychance($session);
        $anyadminbychance=Admins::anyadminbychance($session);
        if($anystudentbychance!="[]" || $anyadminbychance!="[]")
        {
            return redirect("/notloggedin");
        }
        $c=Teachers::find($id);
        if(!is_null($c))
        {
            $c->delete();
        }
        return redirect('/tprofilee');
    }
    public function teacherEdit($id)
    {
        /*if(session()->has('username'))
        {*/
            $session=session('username');
            $anystudentbychance=Students::anystudentbychance($session);
            $anyadminbychance=Admins::anyadminbychance($session);
            if($anystudentbychance!="[]" || $anyadminbychance!="[]")
            {
                return redirect("/notloggedin");
            }
            $c=Teachers::find($id);
            if(!is_null($c))
            {
                $title="Update Yourself";
                $url=url('/tprofilee/t_update') ."/". $id;
                $data=compact('c','url','title');
                return view('teacher-update')->with($data);
            }
            else
            {
                return redirect('/tprofilee');
            }  
        /*}
          else
          {
            return redirect("/tlogin");
          }*/
    }
    public function teacherUpdate($id, Request $request)
    {
        $name=$request->input('name');
        $username=$request->input('username');
        $course=$request->input('course');
        $gender=$request->input('gender');
        Teachers::teacherupdate($id,$name,$username,$course,$gender);
        return redirect("/tprofilee");
    }
    public function createNewAssignment()
    {  
      //  if(session()->has('username'))
        //{
            $session=session('username');
            $anystudentbychance=Students::anystudentbychance($session);
            $anyadminbychance=Admins::anyadminbychance($session);
            if($anystudentbychance!="[]" || $anyadminbychance!="[]")
            {
                return redirect("/notloggedin");
            }
            $session=session('username');
            $you=Teachers::you($session);
            $data=compact('you');
            return view('create_assignment')->with($data);
    /*    }
        else
          {
            return redirect("/tlogin");
          }
    */
    }
    public function createNewAssignmentPost(assignmentVal $request)
    {
        /*
        $this->validate($request, 
            [
                'assignment' => 'required',
            ]
            );
        */
        $request->validate();
        $session=session('username');
        $you=Teachers::you($session);
        $username=$session;
        $course=$request->input('course');
        $assignment=$request->input('assignment');
        Assignments::create($username,$course,$assignment);

        return redirect("/tprofilee");
    }
    public function teacherMyAsssignment()
    {  
     //   if(session()->has('username'))
     //   {
            $session=session('username');
            $anystudentbychance=Students::anystudentbychance($session);
            $anyadminbychance=Admins::anyadminbychance($session);
            if($anystudentbychance!="[]" || $anyadminbychance!="[]")
            {
                return redirect("/notloggedin");
            }
            $c=Assignments::get();  
            $session=session('username');
            $you=Teachers::you($session);
            $data=compact('c','you');
            return view('my_assignments')->with($data);
    /*    }
        else
          {
            return redirect("/tlogin");
          }
    */
    }
    public function assignmentDelete($id)
    {  
       /* if(session()->has('username'))
        {*/
            $session=session('username');
            $anystudentbychance=Students::anystudentbychance($session);
            $anyadminbychance=Admins::anyadminbychance($session);
            if($anystudentbychance!="[]" || $anyadminbychance!="[]")
            {
                return redirect("/notloggedin");
            }
            $as=Assignments::find($id);
            if(!is_null($as))
            {
                $as->delete();
            }
            return redirect('/my_assignments');
        /*}
        else
          {
            return redirect("/tlogin");
          }*/
    }
    public function assignmentWrite($id)
    {
        //if(session()->has('username'))
        //{
            $session=session('username');
            $anyteacherbychance=Teachers::anyteacherbychance($session);
            $anyadminbychance=Admins::anyadminbychance($session);
            if($anyteacherbychance!='[]' || $anyadminbychance!="[]")
            {
                return redirect("/notloggedin");
            }
            $session=session('username');
            $you=Students::you($session); 
            $a=Assignments::find($id);
            $as=Assignments::par_id($id);
            if(!is_null($a))
            {
                $url=url('/sprofilee/assignment_write_post') ."/". $id;
                $data=compact('a','url','you','as');
                return view('student-assignmet-update')->with($data);
            }
            else
            {
                return redirect('/sprofilee');
            }    
        /*}
        else
        {
            return redirect("/slogin");
        }*/
    }
    public function assignmentWritePost($id,assignmentDoneVal $request)
    {
        /*$this->validate($request, 
        [
            'done_assignment' => 'required'
        ]
        );*/
        $request->validate();
        $student_name=$request->input('student_name');
        $teacher_name=$request->input('teacher_name');
        $done_assignment=$request->input('done_assignment');
        $course=$request->input('course');
        $assignment=$request->input('assignment');
        Studentassignments::create($student_name,$teacher_name,$done_assignment,$course,$assignment);
        return redirect("/sprofilee");
    }

    public function studentAssignmentToTeacher()
    {
        //if(session()->has('username'))
        //{
            $session=session('username');
            $anystudentbychance=Students::anystudentbychance($session);
            $anyadminbychance=Admins::anyadminbychance($session);
            if($anystudentbychance!="[]" || $anyadminbychance!="[]")
            {
                return redirect("/notloggedin");
            }
            $as=Studentassignments::get();  
            $session=session('username');
            $you=Teachers::you($session);
            //$you=Teachers::where('username',session('username'))->get();      
            $data=compact('as','you');
            return view('student_assignment_view')->with($data);
        /*}
        else
        {
            return redirect("/slogin");
        }*/
    }
    

    public function studentDeletebyadmin($id)
    {
        $session=session('username');
        $anystudentbychance=Students::anystudentbychance($session);
        $anyteacherbychance=Teachers::anyteacherbychance($session);
        if($anystudentbychance!="[]" || $anyteacherbychance!="[]")
        {
            return redirect("/notloggedin");
        }
        $c=Students::find($id);
        if(!is_null($c))
        {
            $c->delete();
        }
        return redirect('/aprofilee');
    }
    public function studentEditbyadmin($id)
    {
        //if(session()->has('username'))
        //{
            $session=session('username');
            $anystudentbychance=Students::anystudentbychance($session);
            $anyteacherbychance=Teachers::anyteacherbychance($session);
            if($anystudentbychance!="[]" || $anyteacherbychance!="[]")
            {
                return redirect("/notloggedin");
            }
            $c=Students::find($id);
            if(!is_null($c))
            {
                $title="Update Your student";
                $url=url('/aprofilee/s_update') ."/". $id;
                $data=compact('c','url','title');
                return view('student-update')->with($data);
            }
            else
            {
                return redirect('/aprofilee');
            }   
        /*}
        else
        {
        return redirect("/alogin");
        }*/
    }
    public function studentUpdatebyadmin($id, Request $request)
    {
        $name=$request->input('name');
        $username=$request->input('username');
        $course=$request->input('course');
        $gender=$request->input('gender');
        $year=$request->input('year');
        Teachers::studentupdate($id,$name,$username,$course,$gender,$year);
        return redirect("/aprofilee");
    }
    public function teacherDeletebyadmin($id)
    {
        $session=session('username');
        $anystudentbychance=Students::anystudentbychance($session);
        $anyteacherbychance=Teachers::anyteacherbychance($session);
        if($anystudentbychance!="[]" || $anyteacherbychance!="[]")
        {
            return redirect("/notloggedin");
        }
        $c=Teachers::find($id);
        if(!is_null($c))
        {
            $c->delete();
        }
        return redirect('/aprofilee');
    }
/*    public function teacherEditbyadmin($id)
    {
        $session=session('username');
        $anystudentbychance=Students::anystudentbychance($session);
        $anyteacherbychance=Teachers::anyteacherbychance($session);
        if($anystudentbychance!="[]" || $anyteacherbychance!="[]")
        {
            return redirect("/notloggedin");
        }
        if(session()->has('username'))
        {
            $c=Teachers::find($id);
            if(!is_null($c))
            {
                $title="Update Yourself";
                $url=url('/aprofilee/t_update') ."/". $id;
                $data=compact('c','url','title');
                return view('teacher-update')->with($data);
            }
            else
            {
                return redirect('/aprofilee');
            }  
        }
          else
          {
            return redirect("/alogin");
          }
    }
*/
    public function teacherEditbyadmin($id)
    {
    //    if(session()->has('username'))
    //    {
            $session=session('username');
            $anystudentbychance=Students::anystudentbychance($session);
            $anyteacherbychance=Teachers::anyteacherbychance($session);
            if($anystudentbychance!="[]" || $anyteacherbychance!="[]")
            {
                return redirect("/notloggedin");
            }
            $c=Teachers::find($id);
            if(!is_null($c))
            {
                $title="Update Yourself";
                $url=url('/aprofilee/t_update') ."/". $id;
                $data=compact('c','url','title');
                return view('teacher-update')->with($data);
            }
            else
            {
                return redirect('/aprofilee');
            }  
   /*     }
        else
        {
        return redirect("/alogin");
        }
    */
    }


    public function teacherUpdatebyadmin($id, Request $request)
    {
        $name=$request->input('name');
        $username=$request->input('username');
        $course=$request->input('course');
        $gender=$request->input('gender');
        Teachers::teacherupdate($id,$name,$username,$course,$gender);
        return redirect("/aprofilee");
    }

    public function studentlogout()
    {
        if(session()->has('username'))
        {
            session()->pull('username',null);
        }
        return redirect("/slogin");
    }

    public function teacherlogout()
    {
        if(session()->has('username'))
        {
            session()->pull('username',null);
        }
        return redirect("/tlogin");
    }

    public function adminlogout()
    {
        if(session()->has('username'))
        {
            session()->pull('username',null);
        }
        return redirect("/alogin");
    }

}
