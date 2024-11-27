<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth; // check if the user is logged in

class AdminController extends Controller
{
    public function post_page(){
        return view('admin.post_page');
    }
    public function add_post(Request $request){
        $user = Auth()->user();
        $userid = $user->id; // id from db
        $name = $user->name; // name from db
        $usertype = $user->usertype; // usertype from db

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        
        $post->post_status = 'active';
        $post->user_id = $userid; // user_id is from the post table and userid from user table
        $post->name = $name;
        $post->usertype = $usertype;


        ///// responsible for keeping the image in the public folder
        $image = $request->image;

        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('postimage',$imagename);
            $post->image = $imagename; /// storing the image in the db

        }
       


        $post->save();
        return redirect()->back()->with('message','Post Added Successfully');
    }
}
