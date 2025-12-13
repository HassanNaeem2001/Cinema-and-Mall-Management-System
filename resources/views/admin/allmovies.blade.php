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
<div class="content-wrapper">
    <h3>All Movies</h3>
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
                    <td>{{$loop->iteration}}</td>
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
                            <form action="">
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