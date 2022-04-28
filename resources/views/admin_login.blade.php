@include('nav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
            <form action="/alogin" method="POST">
            {{ csrf_field() }}
            <h1>Admin Login</h1>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" placeholder="Enter username" class="form-control" name="username" value="{{old('username')}}">
                    <span class="text-danger">
                        @php
                            foreach ($errors->get('username') as $message) 
                            {
                                echo $message;
                            }
                        @endphp
                    </span>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" placeholder="Enter password" class="form-control" name="password" value="{{old('password')}}">
                    <span class="text-danger">
                        @php
                            foreach ($errors->get('password') as $message) 
                            {
                                echo $message;
                            }
                        @endphp
                    </span>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>   
            </form>
        </div>
    </div>
</body>
</html>