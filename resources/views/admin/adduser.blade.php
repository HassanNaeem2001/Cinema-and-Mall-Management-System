@extends('admin.layout')
@section('admincontent')
<div class="content-wrapper">
    <h3>Add New User</h3>
    @if(session('SuccessmsgUser'))
    <div
        class="alert alert-secondary alert-dismissible fade show"
        role="alert"
    >
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        ></button>
        <p><strong>Notification </strong>User has been added</p>

    </div>
    
    <script>
        var alertList = document.querySelectorAll(".alert");
        alertList.forEach(function (alert) {
            new bootstrap.Alert(alert);
        });
    </script>
    
    @endif
    <hr>
    <form action="/insertuser" method="post">
        @csrf
        <input type="text" name="username" placeholder="Enter Name" class="form-control mb-2">
        <input type="email" name="useremail" placeholder="Enter Email" class="form-control mb-2">
        <input type="password" name="userpassword" placeholder="Enter Password" class="form-control mb-2">
        <select name="userrole" id="" class="form-control text-light">
            <option value="User">User</option>
            <option value="Employee">Employee</option>
            <option value="Admin">Admin</option>
        </select>
        <button type="submit" class="btn btn-lg my-2 btn-dark">Register User</button>
    </form>
</div>
@endsection