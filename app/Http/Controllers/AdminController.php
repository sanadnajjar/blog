<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Photo;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        $usersCount = User::count();
        $postsCount = Post::count();
        $categoriesCount = Category::count();
        $commentsCount = Comment::count();
        $mediaCount = Photo::count();


        return view('admin/index', compact('usersCount', 'postsCount', 'categoriesCount', 'commentsCount', 'mediaCount'));
    }
}
