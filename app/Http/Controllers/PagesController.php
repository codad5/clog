<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PagesController extends Controller
{
    //
    public function index(){

        $post = Post::orderBy('created_at', 'DESC')->paginate(10);
        return view('pages.index', ['posts' => $post]);
    }

    public function about(){
        return view('pages.about');
    }

    public function services(){
        return view('pages.services');
    }
}
