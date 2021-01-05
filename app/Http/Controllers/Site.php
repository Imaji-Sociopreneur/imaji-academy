<?php


namespace App\Http\Controllers;


use App\Models\Content;
use App\Models\Tag;
use Illuminate\Support\Facades\Facade;

class Site extends Facade
{
    public static function getTags(){
        return Tag::get();
    }
    public static function getRecentPost(){
        return Content::whereStatus('accepted')->orderBy('created_at','desc')->take(4)->get();
    }
    public static function get
}
