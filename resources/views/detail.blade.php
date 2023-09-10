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
                    

                    <div class="col-12">
                        
                        <div class="bg-white border-gray mb-3">
                            <div class="d-flex pt-2">
                                <div class="col d-flex">
                                    <img class="post-profile rounded-circle " src="{{asset('storage/'. $post->user->avatar)}}">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold fs-6">{{$post->user->name}}</span>
                                        <span class="text-gray-darker fs-6">{{ $post->user->job}}</span>
                                    </div>
                                </div>
                                
                                {{-- @if(($post->user->id == Auth::user()->id))
                                <div class="p-2 text-gray-darker">
                                    <a href="post/{{$comment->id}}/edit" class="btn bg-warning text-light">Edit</a>
                                </div>
                                <div class="p-2 text-gray-darker">
                                    <form action="post/{{$post->id}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type='submit' class="btn text-light" style="background-color:#DC3545">Delete</button>
                                    </form>
                                    
                                </div>
                                @endif --}}
                
                                
                            </div>
                            <div class="post-body pt-2 ps-3 ml-4">
                                <div class="post-title fw-bold">
                                    <h3 class="text-decoration-none text-black">
                                        {{$post->title}}
                                    </h3>    
                                </div>
                                <div class="post-text pt-1">
                                        {{$post->description}} 
                                </div>
                            </div>
                            <div class="post-image pt-2">
                                <img class="img-fluid" src="{{asset('storage/'. $post->image)}}">
                
                            </div>
                            {{-- <button class="btn btn-primary m-3" style="border-radius: 20px">{{$comment->post->categories->name}}</button> --}}
                            <div class="post-footer p-2">
                                <div class="text-center" role="group" aria-label="Basic example">
                                    <button type="button" href='#' class="btn bg-main-color text-light text-right" id="comment-btn">Add Comment</button>
                                </div>
                            </div>
                        </div>

                        
                
                   
                        <div class="card-body p-4" id="comment-text" style="background-color: #f8f9fa; display:none">
                            <div class="d-flex flex-start">
                                <img class="rounded-circle shadow-1-strong me-3 mr-2"
                                src="{{asset('storage/'. Auth::user()->avatar)}}" alt="avatar" width="60"
                                height="60" />

                              <form action="/dashboard/{{$post->id}}" class="form-outline w-100" method="POST">
                                @csrf
                                <textarea class="form-control" id="textAreaExample" rows="4"
                                  style="background: #fff;" placeholder="comment" name="comment"></textarea>
                                  <div class="text-right mt-2 pt-1">
                                    <button type="submit" class="btn btn-primary btn-sm">Post comment</button>
                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="cancel()">Cancel</button>
                                  </div>
                              </form>

                            </div>
                            
                          </div>
                        </div>             
                    
            </div>

            <div class="row">
              <div class="col-md-12">
        
                <div class="card">
                                
                                    <div class="card-body mt-2">
                                        <h4 class="card-title">Recent Comments</h4>
                                        <h6 class="card-subtitle">Latest Comments section by users</h6> </div>
        
                                    <div class="comment-widgets m-b-20">
                                      @forelse ($comment as $el)
                                        
                                          
                                        <div class="d-flex flex-row comment-row" style="border-bottom: 2px solid black; padding:5px">
                                            


                                            <div class="p-2"><span class="round"><img src="{{asset('storage/'. $el->user->avatar)}}" class="rounded-circle shadow-1-strong me-3 mr-2" alt="user" width="50"></span></div>
                                            <div class="comment-text w-100" data-comment-id={{$el->id}}>
                                                <h5>{{$el->user->name}}</h5>
                                                <div class="d-flex align-items-center mb-3">
                                                  <p class="mb-0">
                                                    {{ $el->created_at->diffForHumans() }}
                                                    
                                                  </p>
                                                  <a href="#!" class="link-muted"><i class="fas fa-pencil-alt ms-2"></i></a>
                                                  <a href="#!" class="link-muted"><i class="fas fa-redo-alt ms-2"></i></a>
                                                  <a href="#!" class="link-muted"><i class="fas fa-heart ms-2"></i></a>
                                                </div>
                                                
                                                <p  class="m-b-5 m-t-10">{{$el->comment}}</p>
                                                <div id="form-display-{{$el->id}}">

                                                </div>
                                                

                                              

                                                

                                                @if($el->user->id == Auth::user()->id)
                                                
                                                
                                                <form action="/dashboard/{{$el->id}}" method="post">
                                                  @csrf
                                                  @method('delete')
                                                  <div class="text-right">
                                                    <button id="editFormButton" class="btn btn-warning">Edit</button>
                                                    {{-- <a href="/dashboard/{{$el->id}}/" class="btn btn-primary mr-2 ">Edit</a> --}}
                                                  <button type="submit" class="btn btn-danger show-confirm">Delete</button>
                                                  </div>
                                                </form>

                                                
<!-- The actual modal -->
<div id="editFormModal" style="display: none;">
    <form id="myForm" action="/dashboard/{{$el->id}}" method="POST">
        @csrf
        @method('PUT')
        <!-- Your form fields here -->
        <label for="name">Comment:</label>
        <input type="text" name="comment" id="name" value="{{$el->comment}}" required>
        <!-- Add more form fields as needed -->

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<!-- Include SweetAlert and the script to handle the form edit -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('editFormButton').addEventListener('click', function (event) {
    event.preventDefault(); // Prevent default link behavior

    Swal.fire({
        html: document.getElementById('editFormModal').innerHTML,
        showCancelButton: true,
        showConfirmButton: false,
    });
});
</script>

                                                {{-- <div class="text-right">
                                                  <button onclick="editComment({{$el->id}})" class="btn btn-primary mr-2 ">Edit</button>
                                               
                                                </div> --}}
                                                
                                               
                                              @endif

                                            </div>

                                            
                                        </div>

                                        @empty
                                              <h3 class="text-center pb-2">No Comment </h3>

                                        @endforelse
        
                                        
                                    </div>
                                </div>
        
              </div>
          </div>
        </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>

        function cancel() {
            const blockToDisplay = document.getElementById('comment-text');
                blockToDisplay.style.display = 'none';
            
        }

//         function editcancel(commentId) {
//           let commentElement = document.querySelector(`[data-comment-id="${commentId}"]`);

// // Get the existing comment content
//           console.log('hai')
//             let commentTextElement = commentElement.querySelectorAll('p')[1];
//             console.log(commentTextElement)
//             commentTextElement.style.display = 'block';

//             let form = document.getElementById('form-display-'+ commentId);
//             form.innerHTML = `
//             <h2>Apapa</h2>
//             `;
            
            
//         }

//         function editComment(commentId) {
//             // Get the comment element by its data-comment-id attribute
//             let commentElement = document.querySelector(`[data-comment-id="${commentId}"]`);

//             // Get the existing comment content
//             let commentTextElement = commentElement.querySelectorAll('p')[1];
//             console.log(commentTextElement)
//             commentTextElement.style.display = 'none';

//             let form = document.getElementById('form-display-'+ commentId);
//             form.innerHTML = `
//             

//             // Prompt the user to edit the comment
//             // const editedComment = prompt("Edit the comment:", existingComment);

//             // // Update the comment content if the user provided new text
//             // if (editedComment !== null && editedComment !== "") {
//             //     commentTextElement.innerText = editedComment;
//             // }
//         }
        const displayButton = document.getElementById('comment-btn');
        const blockToDisplay = document.getElementById('comment-text');

        displayButton.addEventListener('click', () => {
            if (blockToDisplay.style.display === 'none') {
            blockToDisplay.style.display = 'block';
            } else {
            blockToDisplay.style.display = 'none';
            }
        });

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

    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
  </body>
</html>
