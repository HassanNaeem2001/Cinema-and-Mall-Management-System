@extends('admin.layout')
@section('admincontent')
<div class="content-wrapper">
    <h3>Upload a Movie</h3>
    <hr>
    <form action="/addamovie" method="post" enctype="multipart/form-data">
        @csrf
        <label for="moviename">Movie Name</label>
        <input type="text" class="form-control mb-3" name="moviename" placeholder="Enter Movie Name">
        <label for="moviecategory">Select Category</label>
        <select name="moviecategory" id="" class="form-control text-light mb-3">
           @foreach($cat as $c)
            <option value="{{$c->id}}">{{$c->categoryname}}</option>
           @endforeach
        </select>
        <label for="moviethumbnail">Upload Thumbnail</label>
        <input type="file" name="moviethumbnail" class="form-control mb-3">
        <label for="moviedescription">Movie Description</label>
        <textarea name="moviedescription" class="form-control mb-3" id="" placeholder="Description goes here"></textarea>
        <label for="movietrailer">Movie Trailer</label>
        <input type="url" name="movietrailer" class="form-control mb-3" placeholder="Enter Movie Trailer URL">
        <label for="premierdate">Premier Date</label>
        <input name="premierdate" type="date" class="form-control">
        <br>
        <button type="submit" class="btn btn-dark btn-lg">Upload Movie</button>
    </form>
</div>
@endsection