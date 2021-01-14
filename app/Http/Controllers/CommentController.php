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
        if (Auth::user()){
            $this->comments['name'] = Auth::user()->whereId(Auth::id())->pluck('name');
            $this->comments['name'] = $this->comments['name'][0];
            $this->comments['content_id'] = (int)$id;
            $this->comments['comment'] = $request->comment;
            $this->comments['id_user'] = Auth::id();
        }
            elseif (Auth::user()==null){
                $this->comments['name'] = $request->name;
                $this->comments['content_id'] = (int)$id;
                $this->comments['comment'] = $request->comment;
            }

//        dd($this->comments['id_user']);
//        dd($this->comments);
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


    public function destroy($id,$blog)
    {
        Comment::find($id)->delete();
        return redirect(route('show',$blog));
    }
}
