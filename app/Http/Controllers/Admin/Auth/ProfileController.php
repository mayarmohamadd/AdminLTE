<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{


    public function dashboard(){
        $articleCount = Article::count();
        $categoriesCount = Category::count();
        $adminsCount = User::count();
        $topArticles = Article::latest()->take(5)->get();
        return view('admin.dashboard', compact('articleCount', 'categoriesCount', 'adminsCount',  'topArticles'));
    }


    public function logout(){
        auth()->logout();
        return redirect()->route('login')->with('success', 'You have been successfully logged out');
    }

}
