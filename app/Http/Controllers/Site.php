<?php


namespace App\Http\Controllers;


use App\Models\Content;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;

class Site extends Facade
{
    public static function getTags(){
        return Tag::get();
    }
    public static function getRecentPost(){
        return Content::whereStatus('accepted')->orderBy('created_at','desc')->take(4)->get();
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
}
