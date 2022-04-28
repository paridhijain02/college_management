<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>My assignments</title>
  </head>
<body>
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
          @foreach($you as $i)
            @php
                $aaa=$i->username;
            @endphp
          @endforeach

              @foreach($student as $i)
              @if($i->username==$aaa) 
                <tr>
                    <td>{{$i->username}}</td>
                    <td>{{$i->assignment}}</td>
                    <td>{{$i->course}}</td>  
                    <td>
                      <a href="{{url('/assignments_delete/')}}/{{$i->id}}"> 
                          <button class="btn btn-danger">Delete</button>    
                      </a>  
                    </td>
              </tr>
              @endif
              @endforeach
          </tbody>
      </table>

      <a href="{{url('/tprofilee')}}"> 
            <button class="btn btn-primary">Back</button>    
        </a>  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>