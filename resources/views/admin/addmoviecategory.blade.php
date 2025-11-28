@extends('admin.layout')
@section('admincontent')
<style>
    #btnupdate{
        display:none
    }
</style>
<div class="content-wrapper">
    <h3>Add Movie Category</h3>
    <hr>
    <br>
    @if(session('Successmsg'))
    <div
        class="alert alert-success"
        role="alert"
    >
       <p> <strong>Notification </strong>Category Added</p>
    </div>
    
    @endif

    @if(session('Deletemsg'))
    <div
        class="alert alert-danger"
        role="alert"
    >
       <p> <strong>Notification </strong>Category Deleted</p>
    </div>
    @endif
    <br>
    <form action="/uploadcategory" method="post">
        @csrf
        <input type="hidden" id="catid" name="categoryid">
        <input type="text" id="catname" onkeyup="showaddbtn()" name="categoryname" placeholder="Enter Category Name" class="form-control">
        <br>
        <button id="btnadd" type="submit" class="btn btn-dark btn-lg">Add Category</button>
       
    </form>
     <button id="btnupdate" class="btn btn-dark btn-lg" onclick="updatecategory()">Update Category</button>
    <br>
    <br>
    <h3>View All Categories</h3>
    <div
        class="table-responsive"
    >
        <table
            class="table table-striped"
        >
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                  <tr class="">
                    <td>{{$cat->id}}</td>
                    <td scope="row">{{$cat->categoryname}}</td>
                    <td>
                       <div class="d-flex">
                         <button class="btn btn-primary mx-1" onclick="editcategory(this)" data-catid="{{$cat->id}}">Edit</button>
                        <form action="/removecategory/{{$cat->id}}" method="post">
                              @csrf
                              <button type="submit" class="btn btn-danger mx-1">Remove Category</button>
                        </form>
                       </div>
                    </td>
                 </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>
<script>
    function editcategory(btn)
    {
        var id = $(btn).data('catid')
        $.ajax({
            url:"/editcategory/"+id,
            type:"post",
            data:{
                "CategoryId":id,
                "_token":"{{ csrf_token() }}"
            },
            success:function(categoryname){
               
                $('#catname').val(categoryname)
                $('#btnadd').hide();
                $('#btnupdate').show();
                $('#catid').val(id)
                
            }
        })
    }
    function updatecategory()
    {
        var id = $('#catid').val()
        var categoryname = $('#catname').val()
        $.ajax({
            url:"/updatenewcategory/"+id,
            type:"post",
            data:{
             "CategoryName":categoryname,
             "_token":"{{ csrf_token() }}"
            },
            success:function(success){
                if(success)
                {
                    alert('Category has been updated')
                }
                else{
                    alert("Category could not be updated")
                }
            }
        })
    }
    function showaddbtn()
    {
        var inp = $('#catname').val()
        if(inp == "")
        {
            $('#btnadd').show();
            $('#btnupdate').hide()
        }
    }
</script>
@endsection