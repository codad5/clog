<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers\UsersAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $post = Post::orderBy('created_at', 'DESC')->paginate(10);
        return view('posts.index', ['posts' => $post]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(!UsersAuthController::isLoggedIn()){
            return redirect('/posts')->with('error', 'You must be logged in to create a post');
        }
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(!UsersAuthController::isLoggedIn()){
            return redirect('/posts')->with('error', 'You must be logged in to create a post');
        }
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);
        //create post 
        $cover_image_name = 'noimage.jpg';
        if($request->hasFile('cover_image')){
            $cover_image_name = $request->file('cover_image')->getClientOriginalName();
            $fn = pathinfo($cover_image_name, PATHINFO_FILENAME);
            $cover_image_name = $fn.time().".".pathinfo($cover_image_name, PATHINFO_EXTENSION);
            $path = $request->file('cover_image')->storeAs('public/cover_image', $cover_image_name);

        }
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = Auth::user()->id;
        $post->cover_image = $cover_image_name;
        $post->save();

        return redirect('/posts')->with(['success' => 'post created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if(!isset($post)){
            return redirect('/posts')->with('error', 'Post not found');
        }
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(!UsersAuthController::isLoggedIn()){
            return redirect('/posts')->with('error', 'You must be logged in to create a post');
        }
        $post = Post::find($id);
        // var_dump($post);
        if(!isset($post)){
            return redirect('/posts')->with('error', 'Post not found');
        }
        if(auth()->user()->id != $post->user_id){
            return redirect('/posts')->with('error', "UnAuthorized ");
        }
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if(!UsersAuthController::isLoggedIn()){
            return redirect('/posts')->with('error', 'You must be logged in to create a post');
        }
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);
        //create post 
        $cover_image_name = 'noimage.jpg';
        if($request->hasFile('cover_image')){
            $cover_image_name = $request->file('cover_image')->getClientOriginalName();
            $fn = pathinfo($cover_image_name, PATHINFO_FILENAME);
            $cover_image_name = $fn.time().".".pathinfo($cover_image_name, PATHINFO_EXTENSION);
            $path = $request->file('cover_image')->storeAs('public/cover_image', $cover_image_name);

        }
        $post =  Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
         $post->cover_image = $cover_image_name;
        }
        $post->save();
        return redirect('/posts')->with(['success' => 'post updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!UsersAuthController::isLoggedIn()){
            return redirect('/posts')->with('error', 'You must be logged in to create a post');
        }
        $post = Post::find($id);
        if(auth()->user()->id != $post->user_id){
            return redirect('/posts')->with('error', "UnAuthorized");
        }
        if($post->cover_image !== 'noimage.jpg'){
            Storage::delete('public/cover_image/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with(['success' => 'post deleted']);
    }
}
