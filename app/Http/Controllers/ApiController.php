<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Students;
use App\Teachers;
class ApiController extends Controller
{
    public function studentView(Request $request)
    {
        try
        {
            $search=$request['search']??"";
            if($search!="")
            {
                $c=Students::search($search);
            }
            else
            {
            //$c=Students::paginate(3);
                $c = Students::index();
                $filter_data = [];
                foreach($c as $row)
                {
                    array_push($filter_data, $row);
                }
                $count = count($filter_data);
                $page = $request->page;
                $perPage = 3;
                $offset = ($page-1) * $perPage;
                $c = array_slice($filter_data, $offset, $perPage);
                $c = new Paginator($c, $count, $perPage, $page, ['path' => $request->url(),'query' => $request->query(),]);
            }        
            $data=compact('c','search');
            return view('student-view')->with($data);
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
    }

    public function teacherView(Request $request)
    {
        try
        {
            $search=$request['search']??"";
            if($search!="")
            {
                $t=Teachers::search($search);
            }
            else
            {
            //    $t=Teachers::paginate(3);
                $t = Teachers::index();
                $filter_data = [];
                foreach($t as $row)
                {
                    array_push($filter_data, $row);
                }
                $count = count($filter_data);
                $page = $request->page;
                $perPage = 3;
                $offset = ($page-1) * $perPage;
                $t = array_slice($filter_data, $offset, $perPage);
                $t = new Paginator($t, $count, $perPage, $page, ['path' => $request->url(),'query' => $request->query(),]);
            }        
            $data=compact('t','search');
           return view('teacher-view')->with($data);
        }
        catch(\Exception $exception)
        {
            return view('error')->with
            (
            'error',$exception->getMessage()
            );
        }
    }
}