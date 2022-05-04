
<!doctype html>
<html lang="en">
  <head>
    <title>Everyone</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <div class="container">
    <form action="" class="col-3">
        <div class="form-group">
            <label for="">Search</label>
            <input type="search" name="search" id="" class="form-control" placeholder="" value="{{$search}}">
        </div>
        <button class="btn btn-primary">Search</button>
        <a href="{{url('/api/allPeopleView')}}">
            <button class='btn btn-primary' type="button">Reset</button>
        </a>
        <br><br>

    </form>
    <table class="table">
      <thead>
              <tr>
                  <th>Student Name</th>
                  <th>Teacher Name</th>
                  <th>Assignment</th>
                  <th>Course</th>
              </tr>
          </thead>
          <tbody>
              @foreach($allpeople as $i)
              <tr>
                  <td>{{$i->student_name}}</td>
                  <td>{{$i->teacher_name}}</td>
                  <td>{{$i->assignment}}</td>
                  <td>{{$i->course}}</td>
              </tr>
              @endforeach
          </tbody>
      </table>
      <div class="row">
          {{$allpeople->links()}}
      </div>
        <a href="{{url('/teacherProfile')}}">
            <button class='btn btn-primary' type="button">Back</button>
        </a>
  </div>
        
  </body>
</html>