<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{asset('main.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    
    <title>Hello, world!</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    @include('navbar')

    <div class="bg-light pt-4">
        <div class="container mb-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                      <div class="card-body text-center">
                        <img src="{{asset('storage/'. $user->avatar)}}" alt="avatar"
                          class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3">{{$user->name}}</h5>
                        <p class="text-muted mb-1">{{$user->job}}</p>
                        <p class="text-muted mb-4">{{$user->address}}</p>
                        
                      </div>
                    </div> 
                </div>  
                <div class="col-lg-8">
                    <div class="card mb-4">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0">Full Name</p>
                          </div>
                          <div class="col-sm-9">
                            <p class="text-muted mb-0">{{$user->name}}</p>
                          </div>
                        </div>
                        <hr>

                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0">Age</p>
                          </div>
                          <div class="col-sm-9">
                            <p class="text-muted mb-0">{{$user->age}} Old</p>
                          </div>
                        </div>
                        <hr>

                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                          </div>
                          <div class="col-sm-9">
                            <p class="text-muted mb-0">{{$user->email}}</p>
                          </div>
                        </div>
                        <hr>
                        
                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0">Biodata</p>
                          </div>
                          <div class="col-sm-9">
                            <p class="text-muted mb-0">{{$user->biodata}}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>

                
                <div class="col">
                    
                    @forelse ($post as $el)
                    <div class="bg-white border-gray mb-3">
                        <div class="d-flex pt-2">
                            <div class="col d-flex">
                                <img class="post-profile rounded-circle " src="{{asset('storage/'. $el->user->avatar)}}">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold fs-6">{{$el->user->name}}</span>
                                    <span class="text-gray-darker fs-6">{{$el->user->job}}</span>
                                </div>
                            </div>
                            @auth
                            @if(($el->user->id == Auth::user()->id))
                            <div class="p-2 text-gray-darker">
                                <a href="post/{{$el->id}}/edit" class="btn bg-warning text-light">Edit</a>
                            </div>
                            <div class="p-2 text-gray-darker">
                                <form action="post/{{$el->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type='submit'  class="btn text-light show-confirm" style="background-color:#DC3545">Delete</button>
                                </form>
                                
                            </div>
                            @endif
                            @endauth
            
                            
                        </div>
                        <div class="post-body pt-2 ps-3 ml-4">
                            
                            <div class="post-title fw-bold">
                                <h3 class="text-decoration-none text-black">
                                    {{$el->title}}
                                </h3>    
                            </div>
                            <div class="post-text pt-1">
                                    {{Str::limit($el->description, 200)}} 
                            </div>
                        </div>
                        <div class="post-image pt-2">
                            <img class="img-fluid" src="{{asset('storage/'. $el->image)}}">
                        </div>
                        <button class="btn btn-primary mt-2 ml-2" style="border-radius: 20px">{{$el->categories->name}}</button>
                        <div class="post-footer p-2">
                            <div class="text-center" role="group" aria-label="Basic example">
                                <a type="button" href='/dashboard/{{$el->id}}' class="btn bg-main-color text-light text-right">Detail</a>
                            </div>
                            
                           
                        </div>
                    </div>

                    @empty
                        <h3 class="text-center">No Post Yet</h3>
            
                @endforelse
                
                @if (Session::has('success'))
                @push('script')
                <script>
                    swal('message', "Data is {{Session::get('success')}}", 'success', {
                        button:true,
                        button:"OK",
                        timer:3000,
                        dangerMode:true,
                    });
                </script>
                @endpush
                
            
                        
                
            @endif
                                
                                    
                                    
            
            
                </div>


                   
                    
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script text="text/javascript">
         $('.show-confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
    </script>

    @stack('script')
    
  </body>
</html>