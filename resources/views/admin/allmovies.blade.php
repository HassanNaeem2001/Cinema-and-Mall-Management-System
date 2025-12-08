@extends('admin.layout')
@section('admincontent')
<div class="content-wrapper">
    <h3>All Movies</h3>
    <hr>
    <div
        class="table-responsive"
    >
        <table
            class="table table-striped"
        >
            <thead>
                <tr>
                    <th scope="col" class="text-white">S.No</th>
                    <th scope="col" class="text-white">ThumbNail</th>
                    <th scope="col" class="text-white">Movie Name</th>
                    <th scope="col" class="text-white">Category</th>
                    <th scope="col" class="text-white">First Premier Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movies as $movie)
                  <tr class="">
                    <td>{{$movie->id}}</td>
                    <td scope="row"><img src="thumbnails/{{$movie->thumbnail}}" alt="" width="300px"></td>
                    <td>{{$movie->moviename}}</td>
                    <td>{{$movie->categoryname}}</td>
                    <td>{{$movie->premierdate}}</td>
                  </tr>
                @endforeach
               
            </tbody>
        </table>
    </div>
    
</div>
@endsection