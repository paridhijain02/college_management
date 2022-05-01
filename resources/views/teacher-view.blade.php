@include('nav')
<!doctype html>
<html lang="en">
  <head>
    <title>Teachers</title>
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
            <a href="{{url('/api/teacherView')}}">
                <button class='btn btn-primary' type="button">Reset</button>
            </a>
        </form>
        <table class="table">

      <thead>
              <tr>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Course</th>
                  <th>Gender</th>
              </tr>
          </thead>
          <tbody>
              @foreach($teachers as $i)
              <tr>
                  <td>{{$i->name}}</td>
                  <td>{{$i->username}}</td>
                  <td>{{$i->course}}</td>
                  <td>
                        @if($i->gender=="F")
                        Female
                        @elseif($i->gender=="M")
                           Male             
                        @else
                        Others 
                        @endif
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
      <div class="row">
          {{$teachers->links()}}
      </div>
  </div>
  </body>
</html>