@extends('admin.layout')
@section('admincontent')
<style>

</style>
<div class="content-wrapper">
    <h3>In-Active Users</h3>
    <hr>
    <div
        class="table-responsive"
    >
        <table
            class="table table-striped"
        >
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">UserRole</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr class="">
                    <td scope="row">{{$u->name}}</td>
                    <td>{{$u->email}}</td>
                    <td>{{$u->role}}</td>
                    <td>
                        <div class="d-flex">
                            <button class="btn btn-primary mx-1">Restore</button>
                        <form action="/removeuser/{{$u->id}}" method="post" onsubmit="return confirm('Are you sure you want to remove this user?');">
                            @csrf
                            <button type="submit" class="btn btn-danger mx-1">Delete User</button>
                        </form>
                        </div>
                    </td>
                </tr>
                @endforeach
               
            </tbody>
        </table>
    </div>
    
</div>
@endsection