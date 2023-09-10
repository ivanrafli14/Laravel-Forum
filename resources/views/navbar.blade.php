<nav class="navbar navbar-expand-md navbar-light border-bottom p-0 ps-5">
    <div class="container">
        <img src="{{asset('src/logo.png')}}" width="40" height="40">
        <a class="navbar-brand" href="/dashboard">
            <span class="text-main-color fw-bold fs-3 ml-3"><strong>Laforum</strong></span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggleExternalContent">
           

            <form action="/dashboard/search" class="d-flex">
                
                <input class="form-control me-2  search-icon"  id="navBarSearchForm" type="search" placeholder="Search" aria-label="Search" style="width: 600px" name="search">
                
            </form>

            

            <ul class="navbar-nav px-3 ">
                <li class="nav-item mt-2">
                    @auth
                        <div class="d-flex user-logged nav-item dropdown no-arrow">
                            
                                    <img src="{{asset('storage/'. Auth::user()->avatar)}}" class="user-photo  profile rounded-circle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            
                           
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                
                            <a class="dropdown-item" href="/user/{{Auth::user()->id}}">My Profile  </a>
                            <a href="#" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign Out</a>
                            <form id = "logout-form" action="{{route('logout')}}" method = "POST" style="display: none">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                            </form>
                            </div>
                        </div>
                   

                </li>
                
                <li class="nav-item">
                    
                        <p class=" mt-3">Hai, {{ Auth::user()->name }}</p>
                </li>

            </ul>

             

             
                
                <a type="button" class="btn bg-main-color text-light" href="/post/{{ Auth::user()->id }}">Add Question</a>
                @endauth
                @guest
                <a href="/login" class="btn bg-main-color text-light mb-2 ml-4 mr-2 " style="border: 5px solid #E7E5F4;
                border-radius: 50px;">Login</a>
                <a class="btn btn-border btn-google-login text-dark mb-2 ml-2" href="sign-in-google" style="border: 5px solid #E7E5F4;
                border-radius: 50px;
                ">
                    <img src="{{asset('src/ic_google.svg')}}" class="icon" alt=""> Sign In with Google
                </a>
                 @endguest
        </div>
        
    </div>
</nav>