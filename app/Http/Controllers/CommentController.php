<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public $comments;
    public function index()
    {

        return view('pages.comment.index', [
            'comment' => Comment::class
        ]);
    }

    public function create()
    {
        //
    }


    public function store(Request $request, $id)
    {
        $this->comments['name'] = $request->name;
        $this->comments['content_id'] = (int)$id;
        $this->comments['comment'] = $request->comment;
//        dd($comments);
        Comment::create($this->comments);
        return redirect(route('show',$id));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        Comment::find($id)->delete();
    }
}
