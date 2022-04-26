@foreach($you as $i)
            @if($i->course=='B.A.')
                @php
                    $aaa=$i->course;
                @endphp
            @elseif($i->course=='B.Com.')
                @php
                    $aaa=$i->course;
                @endphp
            @elseif($i->course=='MBBS')
                @php
                    $aaa=$i->course;
                @endphp
            @elseif($i->course=='B Tech')
                @php
                    $aaa=$i->course;
                @endphp
            @else
                <h1>bye</h1>
            @endif
          @endforeach

        @php
            $aaa=$i->course;
        @endphp



          <h1>{{$i->course}}</h1>




    <form action="" class="col-3">
    <div class="form-group">
            <label for="">Search</label>
            <input type="search" name="ssearch" id="" class="form-control" placeholder="" value="{{$ssearch}}">
    </div>
        <button class="btn btn-primary">Search</button>
        <a href="{{url('/aprofilee')}}">
            <button class='btn btn-primary' type="button">Reset</button>
            </a>
    </form>






    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('register.welcome')}}">STM</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="{{route('register.welcome')}}">Welcome</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="{{route('register.slogin')}}">Student Login</a>
        </li>

        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="{{route('register.tlogin')}}">Teacher Login</a>
        </li>

        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="{{route('register.alogin')}}">Admin Login</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('sregister.signup')}}">Student Register</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('tregister.signup')}}">Teacher Register</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('student.view')}}">Student View</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="{{route('teacher.view')}}">Teacher View</a>
        </li>
      </ul>
    </div>
  </div>
</nav>




<div class="col-md-6">
            <label for="inputPassword4" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="">
            <span class="text-danger">
                @php
                foreach ($errors->get('password_confirmation') as $message) 
                {
                    echo $message;
                }
                @endphp
            </span>
        </div>



// 'password_confirmation'=>'required|confirmed',







public function index()
    {
      try
      {
        return view('signup');
      }
      catch(\Exception $exception)
      {
        return view('error')->with
        (
        'error',$exception->getMessage()
        );
      }
    }