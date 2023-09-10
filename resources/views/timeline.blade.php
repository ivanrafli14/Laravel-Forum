@extends('coba')

@section('content')
    <div class="col-7">
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
                    <a type="button" href='dashboard/{{$el->id}}' class="btn bg-main-color text-light text-right">Detail</a>
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
    
@endsection
