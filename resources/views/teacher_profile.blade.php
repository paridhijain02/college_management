
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <h1>Hello Teacher,  
            @foreach($teacher as $i)
            @if($i->username==session('username'))
                 {{$i->name}}
            @endif
              @endforeach
              </h1>
    </div>
    @foreach($checkingSession as $i)
        @php
            $yourcourse=$i->course;
            $yourusername=$i->username;
        @endphp
    @endforeach
    <h2>Course students</h2>
    <table class="table">
        <thead>
              <tr>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Course</th>
                  <th>Update</th>
                  <th>Delete</th>
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
                        <a href="{{url('/teacherProfile/studentEdit/')}}/{{$i->id}}"> 
                            <button class="btn btn-primary">Edit</button>    
                        </a> 
                    </td>
                    <td>  
                        <form action="/teacherProfile/studentDelete/{{ $i->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger">Delete</button> 
                        </form>
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
                  <th>Update</th>
                  <th>Delete</th>
              </tr>
        </thead>
          <tbody>
            @foreach($teacher as $i)
              @if($i->course==$yourcourse ) 
                <tr>
                    <td>{{$i->name}}</td>
                    <td>{{$i->username}}</td>
                    <td>{{$i->course}}</td>
                    <td>   
                        <a href="{{url('/teacherProfile/teacherEdit/')}}/{{$i->id}}"> 
                            <button class="btn btn-primary">Edit</button>    
                        </a> 
                    </td>
                    <td>
                        @if($i->username!=$yourusername) 
                        <form action="/teacherProfile/teacherDelete/{{ $i->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger">Delete</button> 
                        </form> 
                        @endif
                    </td>  
                </tr>
              @endif
            @endforeach
          </tbody>
      </table>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <a href="{{url('/createAssignment')}}"> 
            <button class="btn btn-primary">Create Assignment</button>    
        </a>  
        <a href="{{url('/myAssignments')}}"> 
            <button class="btn btn-primary">My Assignments</button>    
        </a>  
        <a href="{{url('/teacherLogout')}}"> 
            <button class="btn btn-primary">Logout</button>    
        </a>  
        <a href="{{url('/studentAssignmentView')}}"> 
            <button class="btn btn-primary">View students assignments</button>    
        </a>  
        <a href="{{url('api/allPeopleView')}}"> 
            <button class="btn btn-primary">Everyone's view</button>    
        </a>  
</body>
</html>