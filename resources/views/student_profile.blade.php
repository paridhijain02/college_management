
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Student profile</title>
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
        @foreach($you as $i)
            @php
                $yourname=$i->name;
            @endphp
        @endforeach
    <div class="center">
    <!--
    <h1>Hello Student,  {{session('username')}}</h1>
        -->
    <h1>Hello Student,  
            @foreach($c as $i)
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
        <!--<pre>
        {{print_r($c)}}
        </pre>    -->
      <thead>
              <tr>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Course</th>
              </tr>
          </thead>
          <tbody>
              @foreach($c as $i)
              @if($i->course==$yourcourse) 
              <tr>
                  <td>{{$i->name}}</td>
                  <td>{{$i->username}}</td>
                  <td>{{$i->course}}</td>
              </tr>
              @endif
              @endforeach
          </tbody>
      </table>

      <h2>Course Assignments</h2>
      <table class="table">
      <thead>
              <tr>
                  <th>Teacher's name</th>
                  <th>Assignment</th>
                  <th>Course</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
              @foreach($a as $i)
              @if($i->course==$yourcourse) 
                <tr>
                    <td>{{$i->username}}</td>
                    <td>{{$i->assignment}}</td>
                    <td>{{$i->course}}</td>  
                    <td>   
                        <a href="{{url('/sprofilee/assignment_write/')}}/{{$i->id}}"> 
                            <button class="btn btn-primary">Solve</button>    
                        </a>  
                    </td>
              </tr>
              @endif
              @endforeach
          </tbody>
      </table>
      
      <h2>Course teachers</h2>
      <table class="table">
      <thead>
              <tr>
                <th>Teacher's name</th>
                <th>Teacher's username</th>  
                <th>Course</th>
              </tr>
          </thead>
          <tbody>
              @foreach($t as $i)
              @if($i->course==$yourcourse) 
                <tr>
                    <td>{{$i->name}}</td>
                    <td>{{$i->username}}</td>
                    <td>{{$i->course}}</td>  
              </tr>
              @endif
              @endforeach
          </tbody>
      </table>
 
     

      <a href="{{url('/slogout')}}"> 
            <button class="btn btn-primary">Logout</button>    
        </a>  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>