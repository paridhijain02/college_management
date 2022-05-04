@include('nav')
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student signup</title>
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        select {
        margin-bottom: 10px;
        margin-top: 10px;
        font-family: cursive, sans-serif;
        outline: 0;
        background: white;
        color: black;
        border: 1px solid crimson;
        padding: 4px;
        border-radius: 9px;
      }
        .btn
        {
            position: relative;
            padding: 6px 30px;
            border: 2px solid black;
            background-color: rgb(253, 253, 151);
            color: black;
            margin: 15px;
            font-size: 1.5rem;
            border-radius: 10px;
            cursor: pointer;
        }
        .btn:hover
        {
            background-color: black;
            color: rgb(253, 253, 151);
        }
        #contact{
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 100px;
        }
        #contact .box 
        {
            justify-content: center;
            align-items: center;
            background-color: lightblue;
            border: 6px solid black;
            border-radius: 3rem;
            padding: 50px;
        }
        #contact .box input,
        #contact .box textarea
        {
            width: 100%;
            padding: 0.5rem;
            border-radius: 20px;
        }
        #contact .box label
        {
            color: black;
            font-size: 1.5rem;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
    </style>
  </head>
  <body>
  <div id="contact">
    <div class="box">
  <form class="row g-3" action="{{url('/')}}/studentSignupPost" method="post">
        {{ csrf_field() }}

        <h2 class="text-center text-primary">Student Registration Page</h2>

        <div class="col-md-6">
            <label  class="form-label">Name</label>
            <input type="" name="name" class="form-control" id="" value="{{old('name')}}">
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
            <label  class="form-label">Username</label>
            <input type="" name="username" class="form-control" id="" value="{{old('username')}}">
            <span class="text-danger">
                
            @php
                foreach ($errors->get('username') as $message) 
                {
                    echo $message;
                }
            @endphp
                
            </span>
        </div>
            
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="">
            <span class="text-danger">
                @php
                foreach ($errors->get('password') as $message) 
                {
                    echo $message;
                }
                @endphp
            </span>
        </div>
        
        <div class="col-md-6">
        <label  class="form-label">Year of Joining</label>
        <select id="year" name="year">
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
            </select>
            <span class="text-danger">
            @php
                foreach ($errors->get('year') as $message) 
                {
                    echo $message;
                }
                @endphp
            </span>
        </div>
        
        <div class="col-md-6">
        <label  class="form-label">Course</label>
            <select id="course" name="course">
                <option value="B Tech">B Tech</option>
                <option value="B.A.">B.A.</option>
                <option value="B.Com.">B.Com.</option>
                <option value="B.Ed.">B.Ed.</option>
                <option value="MBBS">MBBS</option>
            </select>
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
            <label  class="form-label">Gender</label>
            <select id="gender" name="gender">
                <option value="F">F</option>
                <option value="M">M</option>
                <option value="O">O</option>
            </select>
            <span class="text-danger">
            @php
                foreach ($errors->get('gender') as $message) 
                {
                    echo $message;
                }
            @endphp
            </span>
        </div>

        

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
</form>
</div>
    </div>
  </body>
</html>