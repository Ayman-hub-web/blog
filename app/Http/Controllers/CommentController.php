<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::all();
        return view('backEnd.comments.index', compact('comments'));
    }

    public function destroy($id){
        Comment::where('id', $id)->delete();
        return redirect()->route('admin.comment')->with('success', 'Comment successfully deleted!');
    }
}
