<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(){
        return view('pages.testimonial.index', [
            'testimonial' => Testimonial::class
        ]);
    }

    public function create(){
        return view('pages.testimonial.create');
    }

    public function edit(){
        return view('pages.testimonial.edit');
    }
}
