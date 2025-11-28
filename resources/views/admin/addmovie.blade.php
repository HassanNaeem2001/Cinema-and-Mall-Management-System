@extends('admin.layout')
@section('admincontent')
<div class="content-wrapper">
    <h3>Upload a Movie</h3>
    <hr>
    <form action="" method="post">
        @csrf
        <input type="text" class="form-control mb-3" name="moviename" placeholder="Enter Movie Name">
        <label for="moviecategory">Select Category</label>
        <select name="moviecategory" id="" class="form-control text-light mb-3">
           @foreach($cat as $c)
            <option value="">{{$c->categoryname}}</option>
           @endforeach
        </select>
        <textarea name="moviedescription" class="form-control mb-3" id="" placeholder="Description goes here"></textarea>
        <label for="premierdate">Premier Date</label>
        <input name="premierdate" type="date" class="form-control">
        <br>
        <button type="submit" class="btn btn-dark btn-lg">Upload Movie</button>
    </form>
</div>
@endsection