<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;

class HomeController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except('index', 'detail');
    }
    
    public function index(Request $request){
        if($request->has('q')){
            $posts = Post::where('title', 'like', '%'.$request->q.'%')->orderBy('id', 'desc')->paginate(2);
        }else{
            $posts = Post::orderBy('id', 'desc')->paginate(2);
        }
        
        return view('frontEnd.home', compact('posts'));
    }

    public function detail($slug, $id){
        $detail = Post::find($id);
        $detail->increment('views');
        return view('frontEnd.detail', compact('detail'));
    }

    public function save_comment(Request $request, $slug, $id){
        $request->validate([
            'comment' => 'required',
        ]);
        $comment = new Comment();
        $comment->user_id = $request->user()->id;
        $comment->post_id = $id;
        $comment->comment = $request->comment;
        $comment->save();
        return redirect()->back()->with('success', 'you have commented successfully');
    }

    public function showCategories(){
        $categories = Category::orderBy('id', 'desc')->paginate(2);
        return view('frontEnd.showCategories', compact('categories'));
    }

    public function getCategoryPosts($cat_id){
        $categoryPosts = Post::where('cat_id', $cat_id)->orderBy('id', 'desc')->paginate(2);
        return view('frontEnd.showCategoryPosts', compact('categoryPosts'));
    }

    public function savePostForm(){
        $categories = Category::all();
        return view('frontEnd.posts.createPost', compact('categories'));
    }

    public function savePostData(Request $request){
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'detail' => 'required',
        ]);

        //Full image upload
        if($request->hasFile('post_image')){
            $image1=$request->file('post_image');
            $reFullImage=time().'.'.$image1->getClientOriginalExtension();
            $dest1=public_path('/imgs/full');
            $image1->move($dest1,$reFullImage);
        }else{
            $reFullImage='na';
            return redirect()->back()->with('error', 'No File found!');
        }
        //Thumb image upload
        if($request->hasFile('post_thumb')){
            $image2=$request->file('post_thumb');
            $reThumbImage=time().'.'.$image2->getClientOriginalExtension();
            $dest2=public_path('/imgs/thumb');
            $image2->move($dest2,$reThumbImage);
        }else{
            $reThumbmage='na';
            return redirect()->route('posts.create')->with('error', 'No File found!');
        }
        //store Category
        $post = new Post();
        $post->title = $request->title;
        $post->detail = $request->detail;
        $post->tags = $request->tags;
        $post->thumb = $reThumbImage;
        $post->full_image = $reFullImage;
        $post->cat_id = $request->category;
        $post->user_id = auth()->user()->id;
        $post->views = 0;
        $post->status = 1;
        $post->save();
        return redirect()->route('savePostForm')->with('success', 'Post added successflly!');
    }
}
