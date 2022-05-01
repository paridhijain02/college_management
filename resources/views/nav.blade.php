
<!doctype html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
    *{
        padding: 0;
        margin: 0;
    }

.center {
    justify-content: center;
    padding-top: 5px;
    margin: auto;
    width: 30%;
    color: navy;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
  }
    .wrapper .sidebar
    {
        background: rgb(253, 253, 151);
        position: fixed;
        top: 0;
        left: 0;
        width: 175px;
        height: 100%;
        padding: 20px 0;
        transition: all 0.5s ease;
        border-right: 2px solid rebeccapurple;
    }
    .wrapper .sidebar ul li a
    {
        display: block;
        padding: 13px 30px;
        border-bottom: 1px solid black;
        color: black;
        font-size: 16px;
        position: relative;
        text-decoration: none;
    }

    .wrapper .sidebar ul li a:hover,
    .wrapper .sidebar ul li a.active
    {
        color: rebeccapurple;
        background:lightgrey;
        text-decoration: none;
    }   


  </style>
  </head>
  <body>
  
<div class="wrapper">
        <div class="sidebar">
            <ul>
                <li>
                    <a href="{{route('register.welcome')}}">
                        <span class="item">Welcome</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('register.studentLogin')}}" >
                        <span class="item">Student Login</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('register.teacherLogin')}}"> <!-- class="active"-->
                        <span class="item">Teacher Login</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('register.adminLogin')}}">
                        <span class="item">Admin Login</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('sregister.signup')}}">
                        <span class="item">Student Register</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('tregister.signup')}}">
                        <span class="item">Teacher Register</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="{{route('student.view')}}">
                        <span class="item">Student View</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('teacher.view')}}">
                        <span class="item">Teacher View</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('all.view')}}">
                        <span class="item">All View</span>
                    </a>
                </li> -->
            </ul>
        </div>
    </div>	

  </body>
</html>