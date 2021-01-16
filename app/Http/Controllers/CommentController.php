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
        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_segments = explode('/', $uri_path);
//        dd($this->comments['id_user']);
//        dd($this->comments);
        Comment::create($this->comments);
//        dd($uri_segments);
        if($uri_segments[1] == 'blog'){
            return redirect(route('show',$id));
        }
        else{
            return redirect(route('shownews',$id));
        }
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
        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_segments = explode('/', $uri_path);

        Comment::find($id)->delete();
        if($uri_segments[1] == 'blog'){
            return redirect(route('show',$blog));
        }else {
            return redirect(route('shownews',$blog));
        }


    }
}
