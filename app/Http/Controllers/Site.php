<?php


namespace App\Http\Controllers;


use App\Models\Comment;
use App\Models\Content;
use App\Models\ContentTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;

class Site extends Facade
{
    public static function getTags(){
        return Tag::get();
    }
//    public static function getTagsNews(){
//        return Tag::get();
//    }
    public function blogTagLink($tag){

        $ctags = ContentTag::whereTagId($tag)->pluck('content_id');

        $contents = array();

        foreach ($ctags as $c) {
            $blogee = Content::whereId($c)->whereType(1)->get();
            $contents[] = $blogee;
        }
        $isset=1;
//        $blogs = $blogs[0];
        $tags= Tag::all();
        $contenttag=ContentTag::all();
//         dd($blogs);
        return view('pages.site.blog',compact('contents','tags','contenttag','isset'));
    }
    public function newsTagLink($tag){

        $ctags = ContentTag::whereTagId($tag)->pluck('content_id');

        $contents = array();

        foreach ($ctags as $c) {
            $blogee = Content::whereId($c)->whereType(3)->get();
            $contents[] = $blogee;
        }
        $isset=1;
//        $blogs = $blogs[0];
        $tags= Tag::all();
        $contenttag=ContentTag::all();
//         dd($blogs);
        return view('pages.site.berita',compact('contents','tags','contenttag','isset'));
    }

    public static function getRecentPostBlog(){
        return Content::whereType(1)->whereStatus('accepted')->orderBy('created_at','desc')->take(4)->get();
    }

    public static function getRecentPostNews(){
        return Content::whereType(3)->whereStatus('accepted')->orderBy('created_at','desc')->take(4)->get();
    }

    public function blogSearchPost(Request $request){
        return redirect(route('blogSearch',$request->search_terms));
    }

    public function blogSearch($search){
        $blogs= Content::orderBy('created_at','desc')->whereStatus('accepted')->whereType(1)->where('title','LIKE',"%$search%")->paginate(15);
        $tags= Tag::all();
        return view('pages.site.blog',compact('blogs','tags'));
    }

    public function beritaSearchPost(Request $request){
        return redirect(route('beritaSearch',$request->search_terms));
    }

    public function beritaSearch($search){
        $berita= Content::orderBy('created_at','desc')->whereStatus('accepted')->whereType(3)->where('title','LIKE',"%$search%")->paginate(15);
        $tags= Tag::all();
        return view('pages.site.berita',compact('berita','tags'));
    }

//    Show punya News
    public function show($id){
        $news=Content::whereType(3)->whereStatus('accepted')->get();
        $comments=Comment::whereContentId($id)->get();
        $commentcount=count($comments);
        $datarealnews = [];

        foreach ($news as $b)  {
            if ($id == $b->id) {
                $datarealnews = $b;
                break;
            }
        }
        if (!$datarealnews) {
            abort(404);
        }

        return view('pages.site.singlenews', compact('datarealnews','b','comments','commentcount'));
    }
}
