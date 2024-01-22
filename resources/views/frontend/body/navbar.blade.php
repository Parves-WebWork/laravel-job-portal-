<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="{{url('/')}}" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
        <h1 class="m-0 text-primary">JobEntry</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{url('/')}}" class="nav-item nav-link active">Home</a>
            <a href="{{route('about')}}" class="nav-item nav-link">About</a>
            <div class="nav-item dropdown">
                <a href="{{route('job_list')}}" class="nav-link " >Jobs</a>
              
            </div>
            
            <a href="{{route('contact')}}" class="nav-item nav-link">Contact</a>

            @if(!Auth::Check())

            <div class="nav-item dropdown">
                <a href="" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Post A Job<i class="fa fa-arrow-right ms-3"></i></a>


                <div class="dropdown-menu rounded-0 m-0">
                    <a href="{{route('login')}}" class="dropdown-item">Login</a>
                    
                    @if(!Auth::Check())
                    <a href="{{route('register')}}" class="dropdown-item">JOB Seeker</a>
                    <a href="{{route('register.employer')}}" class="dropdown-item">Employer</a>
                    @endif
                    @if(Auth::Check())
                    <a href="" id="logout" class="dropdown-item">Logout</a>
                    @endif
                    @if(Auth::Check())
                    <a href="{{route('seeker.profile')}}" id="logout" class="dropdown-item">Profile</a>
                    @endif
                    {{-- <form id="form-logout" action="{{route('logout')}}" method="post">
                        @csrf
                    </form> --}}
                </div>

                @elseif(Auth::check())

                <li class="nav-item dropdown" style="margin-right: 70px;margin-top:20px" >
                    <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(auth()->user()->profile_pic)
                        <img src="{{Storage::url( auth()->user()->profile_pic)}}" width="40" class="rounded-circle">
                        @else 
                        <img src="https://placehold.co/400" class="rounded-circle" width="40">
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        @if(auth()->user()->user_type === 'seeker')
                        <li class="nav-item" style="margin:15px">
                            <a class="nav-link active" aria-current="page" href="{{route('seeker.profile')}}"> Profile</a>
                        </li>
                        <li class="nav-item" style="margin:15px">
                            <a class="nav-link active" aria-current="page" href="{{route('job.applied')}}"> Job applied</a>
                        </li>
                        <li class="nav-item" style="margin:15px">
                            <a class="nav-link" id="logout" href="{{route('logout')}}"> Logout</a>
                        </li>
                        @else 
                        <li class="nav-item">
                            <a class="nav-link" id="" href="{{route('dashboard')}}">Dashboard</a>
                        </li>
                        @endif
                    </ul>
                </li>

                @endif


              
            </div>



        </div>
        
    </div>
</nav>

<script>
    let logout = document.getElementById('logout');
    let form = document.getElementById('form-logout');
    logout.addEventListener('click', function() {
        form.submit();
    })
</script>
