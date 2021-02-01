<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('backEnd.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backEnd.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        $post->user_id = 0;
        $post->save();
        return redirect()->route('post.index')->with('success', 'Post added successflly!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post  = Post::find($id);
        $categories = Category::all();
        return view('backEnd.posts.edit', compact('post', 'categories'));
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
            $reFullImage=$request->post_image;
        }
        //Thumb image upload
        if($request->hasFile('post_thumb')){
            $image2=$request->file('post_thumb');
            $reThumbImage=time().'.'.$image2->getClientOriginalExtension();
            $dest2=public_path('/imgs/thumb');
            $image2->move($dest2,$reThumbImage);
        }else{
            $reThumbImage=$request->post_thumb;
        }
        //store Category
        $post = Post::find($id);
        $post->title = $request->title;
        $post->detail = $request->detail;
        $post->tags = $request->tags;
        $post->thumb = $reThumbImage;
        $post->full_image = $reFullImage;
        $post->cat_id = $request->category;
        $post->user_id = 0;
        $post->save();
        return redirect()->route('post.index')->with('success', 'Post updated successflly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =Post::find($id);
        $post->delete();
        return redirect()->route('post.index')->with('success', 'Post successfully deleted!');
    }
}
