@extends('admin.layout')
@section('admincontent')
<div class="content-wrapper">
<h3>Add New Cinema</h3>
<hr>
<form action="" method="post">
    <input type="text" name="cinemaname" placeholder="Cinema Name" class="mb-3 form-control">
    <input type="number" name="seatingcapacity" class="form-control" placeholder="200 (e.g)">
</form>
</div>
@endsection