@include('nav')
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student signup</title>
    <style>
        *{
            padding: 0;
            margin: 0;
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
            /*border: 2px solid black;*/
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
  <form class="row g-3" action="{{url('/')}}/ssignups" method="post">
   <!--<form class="row g-3" action="{{url('/')}}/customers" method="post">
    <form class="row g-3" action="{{url('/')}}/costumers" method="post">-->
        {{ csrf_field() }}
    <!--    <pre>
            @php
                print_r($errors->all());
            @endphp
        </pre>
    -->
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
        <label  class="form-label">Course</label>
        <input list="course" name="course" value="{{old('course')}}">
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
        <input list="year" name="year" value="{{old('year')}}">
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
            <label  class="form-label">Gender</label>

            <input type="radio" id="f" name="gender" value="F">
            <label for="f">Female</label>
            <input type="radio" id="m" name="gender" value="M">
            <label for="m">Male</label>
            <input type="radio" id="o" name="gender" value="O">
            <label for="o">Others</label>
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