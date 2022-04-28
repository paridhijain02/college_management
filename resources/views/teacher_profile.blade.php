
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Teacher Profile</title>
    <style>
            .center {
                justify-content: center;
                padding-top: 5px;
                margin: auto;
                width: 40%;
                color: navy;
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            }
        </style>
  </head>
<body>
    <div class="center">
        <!--
    <h1>Hello teacher, {{session('username')}}  </h1>
        -->
    <h1>Hello Teacher,  
            @foreach($teacher as $i)
            @if($i->username==session('username'))
                 {{$i->name}}
            @endif
              @endforeach
              </h1>


    </div>
        @foreach($you as $i)
            @php
                $yourcourse=$i->course;
            @endphp
        @endforeach
        <h2>Course students</h2>
<table class="table">
      <thead>
              <tr>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Course</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
              @foreach($student as $i)
              @if($i->course==$yourcourse) 
                <tr>
                    <td>{{$i->name}}</td>
                    <td>{{$i->username}}</td>
                    <td>{{$i->course}}</td>
                    <td>   
                        <a href="{{url('/tprofilee/s_delete/')}}/{{$i->id}}"> 
                            <button class="btn btn-danger">Delete</button>    
                        </a>   
                        <a href="{{url('/tprofilee/s_edit/')}}/{{$i->id}}"> 
                            <button class="btn btn-primary">Edit</button>    
                        </a>  
                    </td>
              </tr>
              @endif
              @endforeach
          </tbody>
      </table>
      

      <h2>Course Teachers</h2>
      
      <table class="table">
      <thead>
              <tr>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Course</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
            @foreach($teacher as $i)
              @if($i->course==$yourcourse) 
                <tr>
                    <td>{{$i->name}}</td>
                    <td>{{$i->username}}</td>
                    <td>{{$i->course}}</td>
                    <td>   
                        <a href="{{url('/tprofilee/t_delete/')}}/{{$i->id}}"> 
                            <button class="btn btn-danger">Delete</button>    
                        </a>   
                        <a href="{{url('/tprofilee/t_edit/')}}/{{$i->id}}"> 
                            <button class="btn btn-primary">Edit</button>    
                        </a>  
                    </td>  
                </tr>
              @endif
            @endforeach
          </tbody>
      </table>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


        <a href="{{url('/create_assignment')}}"> 
            <button class="btn btn-primary">Create Assignment</button>    
        </a>  
        <a href="{{url('/my_assignments')}}"> 
            <button class="btn btn-primary">My Assignments</button>    
        </a>  
        <a href="{{url('/tlogout')}}"> 
            <button class="btn btn-primary">Logout</button>    
        </a>  
        <a href="{{url('/student_assignment_view')}}"> 
            <button class="btn btn-primary">View students assignments</button>    
        </a>  
</body>
</html>