<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Content;
use App\Models\ContentTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class siteController extends Controller
{
    public function about()
    {
        return view('pages.site.about');
    }
     public function contact()
     {
         return view('pages.site.contact');
     }
     public function blog()
     {
         $blogs=Content::whereType(1)->whereStatus('accepted')->paginate(5);
         $tags= Tag::all();
//         $comments=Comment::whereContentId($id)->get();
//         $commentcount=count($comments);
         $contenttag=ContentTag::all();
         $paginate=1;
//         dd($blogs);
         return view('pages.site.blog',compact('blogs','tags','contenttag','paginate'));
     }
    public function berita()
    {
        $berita=Content::whereType(3)->whereStatus('accepted')->paginate(5);
        $tags=Tag::all();
        $contenttag=ContentTag::all();
        $paginate=1;
        return view('pages.site.berita',compact('berita','tags','contenttag','paginate'));
    }
    public function singleblog($id)
    {
        $blogs=Content::whereType(1)->whereStatus('accepted')->get();
        $tag=Tag::all();
        $contenttag=ContentTag::all();
        $comments=Comment::whereContentId($id)->get();
        $commentcount=count($comments);
        return view('pages.site.singleblog', compact('tag','blogs','contenttag','comments','commentcount'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blogs=Content::whereType(1)->whereStatus('accepted')->get();
        $comments=Comment::whereContentId($id)->get();
        $commentcount=count($comments);
        $datareal = [];

        foreach ($blogs as $b)  {
            if ($id == $b->id) {
                $datareal = $b;
                break;
            }
        }
        if (!$datareal) {
            abort(404);
        }

        return view('pages.site.singleblog', compact('datareal','b','comments','commentcount'));
    }
}
