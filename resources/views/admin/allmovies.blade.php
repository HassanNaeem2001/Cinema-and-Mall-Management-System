@extends('admin.layout')
@section('admincontent')
<style>
    .page-link {
    background-color: #222;
    color: #fff;
    border-color: #444;
}

.page-item.active .page-link {
    background-color: grey;
    border-color: white;
}

.page-link:hover {
    background-color: black;
    color:white
}

</style>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<div class="content-wrapper">
    <h3>All Movies</h3>
    @if(session('Successmsg'))
    <script>
    Toastify({
  text: "This movie is now featured successfully!",
  duration: 3000,
  destination: "https://github.com/apvarun/toastify-js",
  newWindow: true,
  close: true,
  gravity: "bottom", // `top` or `bottom`
  position: "right", // `left`, `center` or `right`
  stopOnFocus: true, // Prevents dismissing of toast on hover
  style: {
    background: "linear-gradient(to right, #28e417ff, #3b5c03ff)",
  },
  onClick: function(){} // Callback after click
}).showToast();
    </script>
    @endif
   
    
    <hr>
    <div
        class="table-responsive"
    >
        <table
            class="table table-dark table-bordered text-center table-hover"
        >
            <thead>
                <tr>
                    <th scope="col" class="text-white">S.No</th>
                    <th scope="col" class="text-white">ThumbNail</th>
                    <th scope="col" class="text-white">Movie Name</th>
                    <th scope="col" class="text-white">Category</th>
                    <th scope="col" class="text-white">First Premier Date</th>
                    <th class="text-white">Now Featuring</th>
                    <th class="text-white">Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movies as $movie)
                  <tr class="">
                   <td>{{ $movies->firstItem() + $loop->index }}</td>

                    <td scope="row"><img src="thumbnails/{{$movie->thumbnail}}" alt="" width="300px"></td>
                    <td>{{$movie->moviename}}</td>
                    <td>{{$movie->categoryname}}</td>
                    <td>{{ date('d-F-Y', strtotime($movie->premierdate)) }}</td>
                    <td class="text-white">
                        @if($movie->isfeatured == "yes")
                        <span class="badge badge-success">Yes</span>
                        @else
                       <span class="badge badge-danger">No</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex">
                            <form action="">
                                <button type="submit" class="btn btn-primary mx-1">Edit</button>
                            </form>
                            <form action="/featuremovie/{{ $movies->firstItem() + $loop->index }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success mx-1">Feature This</button>
                            </form>
                            <form action="{{url('admin/deletemovie/'.$movie->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mx-1">Delete</button>
                            </form>

                        </div>
                    </td>
                  </tr>
                @endforeach
               
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $movies->links() !!}

        </div>
    </div>
    
</div>


@endsection