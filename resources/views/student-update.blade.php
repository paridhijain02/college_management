
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Update student</title>
  </head>
  <body>
  <form class="row g-3" action="{{$url}}" method="post">
        {!! csrf_field() !!}
        {{method_field('PUT')}}
        <h2 class="text-center text-primary">{{$title}}</h2>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Name</label>
            <input type="" name="name" class="form-control" id="" value="{{$student->name}}">
            <span class="text-danger">
            @php
                foreach ($errors->get('name') as $message) 
                {
                    echo $message;
                }
            @endphp
            </span>
        </div>

        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Username</label>
            <input type="" name="username" class="form-control" id="" value="{{$student->username}}">
            <span class="text-danger">
                
            @foreach($errors->get('username') as $message) 
                {
                    {{$message}}
                }
            @endforeach
                
            </span>
        </div>

        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Gender</label>
            <input type="" name="gender" class="form-control" id="" value="{{$student->gender}}">
            <span class="text-danger">
            @php
                foreach ($errors->get('gender') as $message) 
                {
                    echo $message;
                }
            @endphp
            </span>
        </div>

        <div class="col-md-6">
        <label  class="form-label">Course</label>
        <input list="course" name="course" value="{{$student->course}}">
            <datalist id="course" name="course" >
                <option value="B Tech">
                <option value="B.A.">
                <option value="B.Com.">
                <option value="B.Ed.">
                <option value="MBBS">
            </datalist>
            <span class="text-danger">
                @php
                foreach ($errors->get('course') as $message) 
                {
                    echo $message;
                }
                @endphp
            </span>
        </div>

        <div class="col-md-6">
        <label  class="form-label">Year of Joining</label>
        <input list="year" name="year" value="{{$student->year}}">
            <datalist id="year" name="year" >
                <option value="2018">
                <option value="2019">
                <option value="2020">
                <option value="2021">
                <option value="2022">
            </datalist>
            <span class="text-danger">
            @php
                foreach ($errors->get('year') as $message) 
                {
                    echo $message;
                }
                @endphp
            </span>
        </div>
        
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Edit</button>
        </div>
</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  
  </body>
</html>