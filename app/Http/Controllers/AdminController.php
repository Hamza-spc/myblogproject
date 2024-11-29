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

    public function show_post(){
        $post = Post::all();
        return view('admin.show_post',compact('post'));
    }

    public function delete_post($id){
        $post = Post::find($id);
        $post->delete();
        return redirect()->back()->with('message','Post Deleted Successfully');
    }

    public function edit_page($id){
        $post = Post::find($id);
        return view('admin.edit_page',compact('post'));
    }

    public function update_post(Request $request, $id){
        $data = Post::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $image = $request->image;
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('postimage',$imagename);
            $data->image = $imagename; /// storing the image in the db
        }
        $data->save();
        return redirect()->back()->with('message','Post Update Successfully');


    }

    public function accept_post($id){
        $data = Post::find($id);
        $data->post_status = 'active';
        $data->save();
        return redirect()->back()->with('message','Post Accepted Successfully');
    }

    public function reject_post($id){
        $data = Post::find($id);
        $data->post_status = 'rejected';
        $data->save();
        return redirect()->back()->with('message','Post Rejected');
    }
}
