@extends('admin.layout')
@section('admincontent')
<style>

</style>
<div class="content-wrapper">
    <h3>In-Active Users</h3>
    <hr>
    @if(session('UserActivate'))
    <div
        class="alert alert-success"
        role="alert"
    >
        <p><strong>Notification </strong>User has been activated</p>
    </div>
        
    @endif
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
                             <form action="/restoreuser/{{$u->id}}" method="post" onsubmit="return confirm('Are you sure you want to restore this user?');">
                            @csrf
                            <button type="submit" class="btn btn-primary mx-1">Restore User</button>
                        </form>
                           
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