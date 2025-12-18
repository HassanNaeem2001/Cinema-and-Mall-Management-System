@extends('admin.layout')
@section('admincontent')
<div class="content-wrapper">
<h3>Add New Cinema</h3>
<hr>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

@if(session('Successmsg'))
<script>
     Toastify({
  text: "Cinema has been uploaded",
  duration: 3000,
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
<form action="/uploadcinema" method="post">
    @csrf
    <label for="cinemaname">Cinema Name:</label>
    <input type="text" name="cinemaname" id="cinemaname" placeholder="Cinema Name" class="mb-3 form-control">
    <label for="seatingcapacity">Seating Capacity:</label>
    <input type="number" name="seatingcapacity" id="seatingcapacity" class="form-control" placeholder="200 (e.g)">
    <button type="submit" class="btn btn-dark w-25 p-3 my-4">Add Cinema</button>
</form>
</div>
@endsection