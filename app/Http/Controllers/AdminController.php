<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
}
