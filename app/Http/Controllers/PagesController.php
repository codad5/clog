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

    public function getCoverImage($filename){
        $path = storage_path('app/public/cover_image/' . $filename);
        if(!file_exists($path)){
            abort(404);
        }
        $file = file_get_contents($path);
        return response($file, 200)->header('Content-Type', 'image/jpeg');
    }
}
