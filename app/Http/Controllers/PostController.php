<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Http\Requests\PostRequest;
// use Config\App;

class PostController extends Controller
{
    public function index(){
        //select * from Post
        $allPosts = Post::all();
        return view('posts.index',['posts' => $allPosts,'user_id'=>request()->user_id]);
    }
    // Convention over configration 
    // route model binding
    public function show($user_id,Post $post){
        //select * from Post where id =$postId
        //$singlePostFromDb = Post::find($postID); model object
        //$singlePostFromDb = Post::findOrFail($postID); model object
        //$singlePostFromDb = Post::where($postID); eloquent builder object
        // $singlePostFromDb = Post::where($postID)-> first(); model object
        // $singlePostFromDb = Post::where($postID)-> get(); collection object 
        $commentsOfThePost = Comment::where('post_id',$post->id)->get();
        return view('posts.show',['post' => $post, 'comments'=>$commentsOfThePost,'user_id'=>$user_id]);
    }
    public function create($user_id){
        //select * from users
        // $users = User::all();
        return view('posts.create',['user_id' => $user_id]);
    }
    public function store(PostRequest $request){
        // 1- get the post data
        // $data = request() -> all();
        // $title = $_POST["title"]; php native 

        $title = request() -> title;
        $description = request() -> description;
        $postCreator = request() -> user_id;
        // code to validate data 
        // $rules = [
        //     'title' => ['required','min:3'],
        //     'description' => ['required','min:5'],
        //     // 'post_creator' => ['required','exists:users,id']
        // ];
        // $messages = [
        //     'title.required' => 'The title field is required.',
        //     'description.required' => 'We need the description!',
        //     'title.min' => 'The title must be at least 3 characters.',
        // ];
        // request()-> validate($rules,$messages); 
        // 2- store the post data in database
        
        // $post = new Post;
        // $post-> title = $title;
        // $post-> description = $description;
        // $post::save();

        //or mass assignment 
        Post::create([
            'title'=> $title,
            'description'=> $description,
            'user_id' => $postCreator
        ]);
        // 3- redirection to posts.index
        return to_route('posts.index',$postCreator)->with('success','new post created successfully..');
    }
    public function edit($user_id,Post $post){
        // $users = User::all();
        return view('posts.edit',['post' => $post,'user_id'=>$user_id]);
    }
    public function ajax_edit($user_id,Post $post){
        // $users = User::all();
        return view('posts.ajax-edit',['post' => $post,'user_id'=>$user_id]);
    }
    public function update($user_id,$post_id,PostRequest $requset){
        $title = request() -> title;
        $description = request() -> description;
        // $postCreator = request() -> post_creator ;
        // code to validate data 
        // request()-> validate([
        //     'title' => ['required','min:3'],
        //     'description' => ['required','min:5'],
        //     // 'post_creator' => ['required','exists:users,id']
        // ]); 
        //2- store the edited post data in database 
            //select or find the post
            //update the post data 
        $singlePostFromDb = Post::find($post_id);
        $singlePostFromDb-> update([
            'title'=> $title,
            'description'=> $description,
            // 'user_id' => $postCreator
        ]);
        //or 
        //$singlePostFromDb ->title = $title;
        //$singlePostFromDb ->description = $description;
        //$singlePostFromDb ->save();

        //3- redirection to posts.index
            return to_route('posts.index',$user_id);
    }
    public function ajax_update($user_id,$post_id,PostRequest $requset){
        $title = request() -> title;
        $description = request() -> description;
        $singlePostFromDb = Post::find($post_id);
        $singlePostFromDb-> update([
            'title'=> $title,
            'description'=> $description,
            // 'user_id' => $postCreator
        ]);
        return response()->json([
            'status'=> true,
            'msg'=> 'the item edited successfully...'
        ]);
    }
    public function destroy($user_id,$postId){
        //1- select or find the post
        $post = Post::find($postId);
        $commentsOfThePost=Comment::where('post_id',$postId)->delete();
        //2- delete the post from database 
        $post -> delete();
        // or delete model event too
        // Post::where('id',$postId) -> delete();
        // dd($postId);
        //3- redirection to posts.index
        return to_route('posts.index',$user_id);
    }
    public function ajax_destroy(){
        //1- select or find the post
        $post = Post::find(request()->post_id);
        // dd(request());
        if(!$post){
            return response()->json([
                'status'=>false,
                'msg'=>'the item has not been deleted successfully'
            ]);
        }
        $commentsOfThePost=Comment::where('post_id',request()->post_id)->delete();
        //2- delete the post from database 
        $post -> delete();
        // or delete model event too
        // Post::where('id',$postId) -> delete();
        // dd($postId);
        //3- redirection to posts.index
        return response()->json([
            'status'=>true,
            'msg'=>'the item has been deleted successfully',
            'id'=>request()->post_id
        ]);
    }
    public function signIn()
    {
        return view('login.signIn');
    }
    public function check()
    {
        //  $username = request()->username;
        // $password = request()->password;
        // $user = User::find($username);
        // dd(request()->validate(['username'=>['exists:users,name']]));
        request()->validate([
            'username'=> ['required','exists:users,name'],
            'password'=> ['required']
        ]);
        request()->validate([
            'password'=> ['exists:users,password']
        ]);
        $user = User::where('name',request()->username)->first();
        return to_route('posts.index',$user->id);
    }
}
