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
                    <div id="left-list" class="col-2 d-flex flex-column">
                        <h6><span class="badge bg-main-color text-light">Categories</span></h6>

                        @foreach ($category as $item)
                        <a href="/dashboard/category/{{$item->id}}" class="mb-2">
                            <span class="position-relative me-auto">
                                <img src="{{asset('src/tag.png')}}">
                            </span>
                            <span>{{$item->name}}</span>
                        </a>
                        @endforeach
                      

                    </div>

                    @yield('content')


                   
                    <div class="col">
                        <h6><span class="badge bg-main-color text-light">Users</span></h6>
                            @foreach($user as $idx)
                            <li class="list-group-item d-flex">
                                <div class="">
                                    <img src="{{asset('storage/'. $idx->avatar)}}" width="20" height="20" class="rounded">
                                </div>
                                <div class="ps-2 lh-1 ml-3">
                                    <div class="fw-bold"><a href="user/{{$idx->id}}/post">{{$idx->name}}</a></div>
                                    <div class="text-secondary fw-light">{{Str::limit($idx->biodata, 75)}}</div>
                                </div>
                            </li>
                            @endforeach
                            
                        </ul>
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