<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\category;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    //
    public function getallusers()
    {
        $users = User::whereIn('role',['user','Employee'])->where('status','active')->get();
        return view('admin.allusers',compact('users'));
    }
    public function trashuser($id)
    {
        $user = User::find($id);
        $user->status='de-active';
        $user->save();
        return redirect()->back();
    }
    public function removeuser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('Deletemsg','User has been deleted');
    }
    public function addnewuser(Request $req)
    {
        $table = new User();
        $table->name = $req->username;
        $table->email = $req->useremail;
        $table->password = $req->userpassword;
        $table->role = $req->userrole;
        $table->save();
        return redirect()->back()->with('SuccessmsgUser','Registration Successfull');
    }
    public function removedusers()
    {
        $users = User::where('status','de-active')->get();
        return view('admin.trashusers',compact('users'));
    }
    public function switchdashboards()
    {
        if(Auth::user()->role == "Admin")
       {
          $activecount = User::where('status','active')->count();
          $deactivecount = User::where('status','de-active')->count();
          return view('admin.dashboard',compact(['activecount','deactivecount']));
       }
       else if(Auth::user()->role == "Employee")
       {
        return response()->json("Employee Dashboard is Under Maintenance");
       }
       else
       {
        return redirect('/');
       }
    }
    public function restoreuser($id)
    {
        $user = User::find($id);
        $user->status = 'active';
        $user->save();
        return redirect()->back()->with('UserActivate','User has been activated');

    }
    public function addcategories()
    {
        $categories = category::get();
        return view('admin.addmoviecategory',compact('categories'));
    }
    public function uploadcategory(Request $req)
    {
       $table = new category();
       $table->categoryname = $req->categoryname;
       $table->save();
       return redirect()->back()->with('Successmsg','Category has been uploaded');
    }
    public function editcategory($id)
    {
        $category = category::find($id);
        $categoryname = $category->categoryname;
        return $categoryname;
    }
    public function updatenewcategory($id,Request $req)
    {
        $table = category::find($id);
        $table->categoryname = $req->post('CategoryName');
        $table->save();
        return response()->json(['success'=>'Category Updated']);
    }
    public function removecateory($id)
    {
        $category = category::find($id);
        $category->delete();
        return redirect()->back()->with('Deletemsg','Category Deleted');
    }
}
