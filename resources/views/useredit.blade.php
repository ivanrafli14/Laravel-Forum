<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{asset('main.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    
    
   @include('navbar')
    
    <div class="container mt-3">
        <form action="/user/{{$user->id}}" method="POST" enctype="multipart/form-data">
           @method('PUT')
            @csrf
            <div class="form-group">
              <label for="exampleFormControlInput1">Name</label>
              <input type="text" class="form-control border-bottom" id="exampleFormControlInput1" name="name" value="{{$user->name}}">
            </div>

            <div class="form-group">
              <label for="exampleFormControlInput1">Age</label>
              <input type="number" class="form-control border-bottom" id="exampleFormControlInput1" name="age" value="{{$user->age}}">
            </div>

            <div class="form-group">
                <label for="exampleFormControlInput1">Job/Occupation</label>
                <input type="text" class="form-control border-bottom" id="exampleFormControlInput1" name="job" value="{{$user->job}}">
              </div>

              <div class="form-group">
                <label for="exampleFormControlInput1">Address</label>
                <input type="text" class="form-control border-bottom" id="exampleFormControlInput1" name="address" value="{{$user->address}}">
              </div>

              
            
            <p>Image</p>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="customFile" name = 'avatar'>
              <label class="custom-file-label" for="customFile">{{$user->avatar}}</label>
            </div>

            <div class="form-group mt-3">
              <label for="exampleFormControlTextarea1">Biodata</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"  name="biodata">{{$user->biodata}}</textarea>
            </div>

            <div class="text-right"><button type="submit" class="btn bg-main-color text-light text-right">Edit</button></div>
            
          </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Get the file input element
        const fileInput = document.getElementById("customFile");
    
        // Get the label element associated with the file input
        const label = document.querySelector(".custom-file-label");
    
        // Add an event listener to the file input to update the label text
        fileInput.addEventListener("change", function () {
          // Check if a file has been selected
          if (fileInput.files.length > 0) {
            // Display the name of the selected file
            label.textContent = fileInput.files[0].name;
          } else {
            // If no file is selected, revert to the default label text
            label.textContent = "Choose file";
          }
        });
      });
    </script>
    
   
</body>
</html>