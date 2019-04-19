<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class ApiController extends Controller
{
    public function getPostOne($id){
        $post=Post::with('user')->whereId($id)->first();
        if($post){
        return response()->json($post);
        }else{
            return response()->json(["message"=>"ေရြးထားေသာပိုစ္ကိုျဖတ္လိုက္ပါျပီ"]);
        }
    }
    public function getPosts(){
        $post=Post::with('user')->paginate('10  ');  //or get();
            return response()->json($post);
    }
    public function getDeletePost($id){
        $post=Post::whereId($id)->first();
        if($post) {
            $post->delete();
            return response()->json(["message"=>"ေရြးထားေသာပိုစ္ ကိုဖ်က္လိုက္ပါျပီ"]);
        }else{
            return response()->json(["message"=>"ေရြးထားေသာပိုစ္မွာရွာမေတြ  ့ပါ"]);
        }
    }
    public function  getSearchPost($q){
        $post=Post::where('id', 'LIKE', "%$q%")->orwhere('title', 'LIKE', "%$q%")
        ->orWhere('content', 'LIKE', "%$q%")
        ->paginate("10");
        if(count($post) > 0) {
            return response()->json(["posts" => $post]);
        }else{
            return response()->json(["error"=>"The selected post is not found"]);
        }
    }
    public function postUpdatePosts(Request $request){
        $id=$request['id'];
        $title=$request['title'];
        $content=$request['content'];
        $post=Post::where('id',$id)->first();
        if($post){
            $post->title=$title;
            $post->content=$content;
            $post->update();
            return response()->json(['message',"The select post have been updated"]);
        }else{
            return response()->json(['error',"The select post have not found"]);
        }
    }

    public function postNew(Request $request){
        $this->validate($request,[
            'title'=>'required',
        'content'=>'required'
        ]);
        $post=new Post();
        $post->title=$request['title'];
        $post->content=$request['content'];
        $post->user_id=$request['user_id'];
        $post->save();
        return response()->json(['message'=>"The new post have been save"]);

    }
}
