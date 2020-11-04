<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('admin')->except('index', 'posts', 'search');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::paginate(5);
        $categories = Category::all();

        return view('front.home' ,compact('posts', 'categories'));
    }

    public function posts($slug){

        $post = Post::findBySlugOrFail($slug);

        $categories = Category::all();

        $comments = $post->comments()->whereIsActive(1)->get();

        return view('post', compact('post', 'comments', 'categories'));
    }
    public function search(Request $request)
    {
        $searchResults = (new Search())
            ->registerModel(Post::class, 'title')
            ->perform($request->input('query'));

        return view('search', compact('searchResults'));
    }

}
