<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Students;
use App\Teachers;
use App\Alls;
use App\Assignments;
use App\Studentassignments;
class register_con extends Controller
{
    //private $rolee="hh";



    public function welcome(Request $r)
    {
        return view('welcome');
    }
    public function slogin()
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
    public function spost_login(Request $r)
    {
        $a_user=Students::where('username',$r->input('username'))->get();
        $st = isset($a_user[0]) ? $a_user[0] : false;
        if ($st)
        {
            if($a_user[0]->password==$r->input('password'))
            {
                $data_username=$r->input('username');
                $r->session()->put('username',$data_username); 
                return redirect('sprofilee'); 
            }
        }
        else
        {
            return redirect('notexist') ;
        }
    }
    public function tlogin()
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
    public function tpost_login(Request $r)
    {
        $a_user=Teachers::where('username',$r->input('username'))->get();
        $st = isset($a_user[0]) ? $a_user[0] : false;
        if ($st)
        {
            if($a_user[0]->password==$r->input('password'))
            {
                $data_username=$r->input('username');
                $r->session()->put('username',$data_username); 
                return redirect('tprofilee'); 
            }
        }
        else
        {
            return redirect('notexist') ;
        }
    }
    public function screate()
    {
        return view('ssignup');
    }
    public function sstore(Request $request)
    {
        $this->validate($request, 
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
        echo "<pre>";
        print_r($request->all());

        $student=new Students;
        $student->name=$request['name'];
        $student->username=$request['username'];
        $student->course=$request['course'];
        $student->year=$request['year'];
        $student->gender=$request['gender'];
        $student->password=$request['password'];
        $student->save();

        $students=new Alls;
        //$students->name=$request['name'];
        $students->username=$request['username'];
        // $students->course=$request['course'];
        // $students->year=$request['year'];
        // $students->gender=$request['gender'];
        $students->password=$request['password'];
        $students->role="student";
        $students->save();
        return redirect("/sview");
    }
    public function tcreate()
    {
        return view('tsignup');
    }
    public function tstore(Request $request)
    {
        $this->validate($request, 
            [
                'name' => 'required',
               // 'username' => 'required|email',
                'username' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation'=>'required',
                'gender' => 'required',
                'course' => 'required'
            ]
            );
        echo "<pre>";
        print_r($request->all());
        
        $teacher=new Teachers;
        $teacher->name=$request['name'];
        $teacher->username=$request['username'];
        $teacher->course=$request['course'];
        $teacher->gender=$request['gender'];
        $teacher->password=$request['password'];
        $teacher->save();

        $students=new Alls;
        //$students->name=$request['name'];
        $students->username=$request['username'];
        // $students->course=$request['course'];
        // $students->year=$request['year'];
        // $students->gender=$request['gender'];
        $students->password=$request['password'];
        $students->role="teacher";
        $students->save();
        return redirect("/tview");
    }
    public function sview(Request $request)
    {
        $search=$request['search']??"";
        if($search!="")
        {
            $c=Students::where('name','=',$search)->orwhere('username','=',$search)->orwhere('course','=',$search)->paginate(3);
        }
        else
        {
           // $c=Students::all();
           $c=Students::paginate(3);
        }        
        $data=compact('c','search');
       return view('student-view')->with($data);
    }
    public function tview(Request $request)
    {
        $search=$request['search']??"";
        if($search!="")
        {
            $t=Teachers::where('name','=',$search)->orwhere('username','=',$search)->orwhere('course','=',$search)->paginate(3);
        }
        else
        {
            $t=Teachers::paginate(3);
        }        
        $data=compact('t','search');
       return view('teacher-view')->with($data);
    }
    


    public function sprofile()
    {
        if(session()->has('username'))
        {
            $this->rolee="student";
            $c=Students::all();
            $a=Assignments::get();
            $t=Teachers::get();
            //$wh=DB::table('students')
            $you=Students::where('username',session('username'))->get();
            $data=compact('c','a','you','t');
            return view('student_profile')->with($data);
        }
        else
        {
            return redirect("/slogin");
        } 
    }
    public function tprofile()
    {
        if(session()->has('username'))
        {
            $this->rolee="teacher";
            $c=Students::get();
            //print_r (dd(session()->all()));
            $t=Teachers::all();
            $you=Teachers::where('username',session('username'))->get();
            $data=compact('c','t','you');
            return view('teacher_profile')->with($data);
        }
        else
        {
            return redirect("/tlogin");
        } 
    }
    public function notexist()
    {
       return view('notexist');
    }
    public function s_delete($id)
    {
        $c=Students::find($id);
        if(!is_null($c))
        {
            $c->delete();
        }
        return redirect('/tprofilee');
    }
    public function s_edit($id)
    {
        $c=Students::find($id);
        if(!is_null($c))
        {
            $title="Update Your student";
            $url=url('/tprofilee/s_update') ."/". $id;
            $data=compact('c','url','title');
            return view('student-update')->with($data);
        }
        //return redirect('/customers/view');
        else
        {
            return redirect('/tprofilee');
        }    
    }
    public function s_update($id, Request $request)
    {
        $customer=Students::find($id);
        $customer->name=$request['name'];
        $customer->username=$request['username'];
        $customer->course=$request['course'];
        $customer->gender=$request['gender'];
        $customer->year=$request['year'];
        $customer->save();
        //return redirect('customers');
        //customers/view
        return redirect("/tprofilee");
    }
    public function t_delete($id)
    {
        $c=Teachers::find($id);
        if(!is_null($c))
        {
            $c->delete();
        }
        return redirect('/tprofilee');
    }
    public function t_edit($id)
    {
        $c=Teachers::find($id);
        if(!is_null($c))
        {
            $title="Update Yourself";
            $url=url('/tprofilee/t_update') ."/". $id;
            $data=compact('c','url','title');
            return view('teacher-update')->with($data);
        }
        //return redirect('/customers/view');
        else
        {
            return redirect('/tprofilee');
        }    
    }
    public function t_update($id, Request $request)
    {
        $customer=Teachers::find($id);
        $customer->name=$request['name'];
        $customer->username=$request['username'];
        $customer->course=$request['course'];
        $customer->gender=$request['gender'];
        $customer->save();
        //return redirect('customers');
        //customers/view
        return redirect("/tprofilee");
    }
    public function create_assignment()
    {  
        $you=Teachers::where('username',session('username'))->get(); 
        $data=compact('you');
        return view('create_assignment')->with($data);
    }
    public function create_assignment_post(Request $request)
    {
        $this->validate($request, 
            [
                'assignment' => 'required',
               // 'username' => 'required|email',
            ]
            );
        $you=Teachers::where('username',session('username'))->get();
        print_r($you);
        $assignment=new Assignments;
        $assignment->username=$request->session()->get('username');
        
        $assignment->course=$request['course'];
        $assignment->assignment=$request['assignment'];
        $assignment->save();
        return redirect("/tprofilee");
    }
    public function my_assignments()
    {  
        $c=Assignments::get();  
        $you=Teachers::where('username',session('username'))->get();      
        $data=compact('c','you');
        return view('my_assignments')->with($data);
    }
    public function assignments_delete($id)
    {  
        $as=Assignments::find($id);
        if(!is_null($as))
        {
            $as->delete();
        }
        return redirect('/my_assignments');
    }


    public function assignment_write($id)
    {
        $you=Students::where('username',session('username'))->get(); 
        $a=Assignments::find($id);
        $as=Assignments::where('id',$id)->get(); 
        if(!is_null($a))
        {
            $url=url('/sprofilee/assignment_write_post') ."/". $id;
            $data=compact('a','url','you','as');
            return view('student-assignmet-update')->with($data);
        }
        //return redirect('/customers/view');
        else
        {
            return redirect('/tprofilee');
        }    
    }
    public function assignment_write_post($id, Request $request)
    {
        $this->validate($request, 
        [
            'done_assignment' => 'required'
        ]
        );
        //$assignment=Assignments::find($id);
        $assignment=new Studentassignments;
        $assignment->student_name=$request['student_name'];
        $assignment->teacher_name=$request['teacher_name'];
        $assignment->done_assignment=$request['done_assignment'];
        $assignment->course=$request['course'];
        $assignment->assignment=$request['assignment'];
        $assignment->save();
        echo "<pre>";
        print_r($request->all());
        return redirect("/sprofilee");
    }

    public function student_assignment_view()
    {
        $as=Studentassignments::get();  
        $you=Teachers::where('username',session('username'))->get();      
        $data=compact('as','you');
        return view('student_assignment_view')->with($data);
    }
    /*
    public function login()
    {
        if(session()->has('username'))
        {
            // if($this->rolee=="teacher")
            // {
            //     //print $this->rolee;
            //     return redirect('tprofilee'); 
            // }
            // else
            // {
            //     //print $this->rolee;
                
            //     return redirect('sprofilee'); 
            // }
            return redirect('laravel'); 
        }
        else
        {
            return view("login");
        } 
    }
    public function post_login(Request $r)
    {
        $a_user=Alls::where('username',$r->input('username'))->get();
        $st = isset($a_user[0]) ? $a_user[0] : false;
        if ($st)
        {
            //now you can use it safely.
            if($a_user[0]->password==$r->input('password'))
            {
                $data_username=$r->input('username');
                $data_course=$r->input('course');
                $r->session()->put('username',$data_username);

               //$r->session()->put('user_info', array("username"=> $data_username,"course"=> $data_course));
               

                if($a_user[0]->role=='student')
                {
                    $this->rolee="student";
                    return redirect('sprofilee'); 
                }
                else
                {
                    $this->rolee="teacher";
                    return redirect('tprofilee'); 
                }
            }
        }
        else
        {
            return redirect('notexist') ;
        }
    }*/
}