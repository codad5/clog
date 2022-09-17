<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Post;

class UsersAuthController extends Controller
{
    //
    public function index(){
        if($this->isLoggedIn()){
            return redirect('/dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard')->with('success', 'You are now logged in');
        }
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    


    public static function isLoggedIn(){
        if(Auth::check()){
            return true;
        }
        return false;
    }
    public function registration(){
        if($this->isLoggedIn()){
            return redirect('/posts');
        }
        return view('auth.registration');
    }

    public function postRegistration(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();

        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    public function dashboard(){
            // $post = Post::find();
            $user_id = auth()->user('id');
            $user = User::find($user_id->id);
            // echo '<pre>';
            // print_r($user->posts);
            // echo '</pre>';
        
            return back()->with('posts', $user->posts);
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
