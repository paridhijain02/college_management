<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Write assignment</title>
    <style>
        #borwhite
        {
            border: 2px solid white;
            font-size: 40px;
        }
        #white
        {
            border: 2px solid white;
            color: white;
        }
    </style>
  </head>
  <body>
  <form class="row g-3" action="{{$url}}" method="post">
        {{ csrf_field() }}
        <h2 class="text-center text-primary">Solve the assignment {{session('username')}}</h2>
        <h1></h1>
        @foreach($assignments as $i)
        <div class="col-md-12">
        <input list="assignment" name="assignment" value="{{$i->assignment}}" id="borwhite" size="50">
        </div>
        @endforeach

        <div class="col-md-6">
            <label  class="form-label">Write answer of Assignment</label>
            <textarea name="done_assignment" class="form-control" rows="10" cols="30" value="{{old('done_assignment')}}"></textarea>
            <span class="text-danger">
            @php
                foreach ($errors->get('done_assignment') as $message) 
                {
                    echo $message;
                }
            @endphp
            </span>
        </div>

        @foreach($checkingSession as $i)
        <div class="col-md-6">
        <input list="course" name="course" value="{{$i->course}}" id="white">
        </div>
        @endforeach


        @foreach($assignments as $i)
        <div class="col-md-6">
        <input list="teacher_name" name="teacher_name" value="{{$i->username}}" id="white">
        </div>
        @endforeach

        @foreach($checkingSession as $i)
        <div class="col-md-6">
        <input list="student_name" name="student_name" value="{{$i->username}}" id="white">
        </div>
        @endforeach

      

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
</form>
<br>
        <a href="{{url('/studentProfile')}}"> 
            <button class="btn btn-primary">Back</button>    
        </a>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>