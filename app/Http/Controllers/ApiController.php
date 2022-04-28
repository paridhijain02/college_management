<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Students;
use App\Teachers;
use App\Studentassignments;
class ApiController extends Controller
{
    public function studentView(Request $request)
    {
        $search=$request['search']??"";
        if($search!=""){
            try{
                $students=Students::search($search);
            }
            catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
        }
        else{
            try{
                $students = Students::index();
            }          
            catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
        $filter_data = [];
                foreach($students as $row)
                {
                    array_push($filter_data, $row);
                }
                $count = count($filter_data);
                $page = $request->page;
                $perPage = 3;
                $offset = ($page-1) * $perPage;
                $students = array_slice($filter_data, $offset, $perPage);
                $students = new Paginator($students, $count, $perPage, $page, ['path' => $request->url(),'query' => $request->query(),]);
            }   
        $data=compact('students','search');
        return view('student-view')->with($data);
    }

    public function teacherView(Request $request)
    {
        $search=$request['search']??"";
        if($search!="")
        {
            try{
                $teachers=Teachers::search($search);
            }
            catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
        }
        else{
            try{
                $teachers = Teachers::index();
            }
            catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
            $filter_data = [];
            foreach($teachers as $row){
                array_push($filter_data, $row);
            }
            $count = count($filter_data);
            $page = $request->page;
            $perPage = 3;
            $offset = ($page-1) * $perPage;
            $teachers = array_slice($filter_data, $offset, $perPage);
            $teachers = new Paginator($teachers, $count, $perPage, $page, ['path' => $request->url(),'query' => $request->query(),]);
            $data=compact('teachers','search');
            return view('teacher-view')->with($data);
        }
    }

    public function allView(Request $request)
    {
        $search=$request['search']??"";
        if($search!=""){
            try{
                $allpeople=Studentassignments::search($search);
            }
            catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
        }
        else{
            try{
                $allpeople = Studentassignments::allpeople();
            }
            catch(\Exception $exception){
                return view('error')->with(
                'error',$exception->getMessage()
                );
            }
            $filter_data = [];
            foreach($allpeople as $row){
                array_push($filter_data, $row);
            }
            $count = count($filter_data);
            $page = $request->page;
            $perPage = 5;
            $offset = ($page-1) * $perPage;
            $allpeople = array_slice($filter_data, $offset, $perPage);
            $allpeople = new Paginator($allpeople, $count, $perPage, $page, ['path' => $request->url(),'query' => $request->query(),]); 
        }        
        $data=compact('allpeople','search');
        return view('all-view')->with($data);  
    }
}