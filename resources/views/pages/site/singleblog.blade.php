@extends('layouts.landing')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>Single Blog</h2>
                            <p>Home<span>/</span>Blog</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog_area single-post-area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid" src="img/blog/single_blog_1.png" alt="">
                        </div>
                        <div class="blog_details">
                            <h2>{{$datareal->title}}
                            </h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="#"><i class="far fa-user"></i></a></li>
                                <li><a href="#"><i class="far fa-comments"></i>{{$commentcount}} Comments</a></li>
                            </ul>
                            <p class="excert">
                                {!!$datareal->contents!!}
                            </p>
{{--                            <div class="quote-wrapper">--}}
{{--                                <div class="quotes">--}}
{{--                                    MCSE boot camps have its supporters and its detractors. Some people do not understand why you--}}
{{--                                    should have to spend money on boot camp when you can get the MCSE study materials yourself at--}}
{{--                                    a fraction of the camp price. However, who has the willpower to actually sit through a--}}
{{--                                    self-imposed MCSE training.--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <p>--}}
{{--                                MCSE boot camps have its supporters and its detractors. Some people do not understand why you--}}
{{--                                should have to spend money on boot camp when you can get the MCSE study materials yourself at a--}}
{{--                                fraction of the camp price. However, who has the willpower--}}
{{--                            </p>--}}
{{--                            <p>--}}
{{--                                MCSE boot camps have its supporters and its detractors. Some people do not understand why you--}}
{{--                                should have to spend money on boot camp when you can get the MCSE study materials yourself at a--}}
{{--                                fraction of the camp price. However, who has the willpower to actually sit through a--}}
{{--                                self-imposed MCSE training. who has the willpower to actually--}}
{{--                            </p>--}}
                        </div>
                    </div>
{{--                    <div class="navigation-top">--}}
{{--                        <div class="d-sm-flex justify-content-between text-center">--}}
{{--                            <p class="like-info"><span class="align-middle"><i class="far fa-heart"></i></span> Lily and 4--}}
{{--                                people like this</p>--}}
{{--                            <div class="col-sm-4 text-center my-2 my-sm-0">--}}
{{--                                <!-- <p class="comment-count"><span class="align-middle"><i class="far fa-comment"></i></span> 06 Comments</p> -->--}}
{{--                            </div>--}}
{{--                            <ul class="social-icons">--}}
{{--                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>--}}
{{--                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>--}}
{{--                                <li><a href="#"><i class="fab fa-dribbble"></i></a></li>--}}
{{--                                <li><a href="#"><i class="fab fa-behance"></i></a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="comments-area">
                        <h4>{{$commentcount}} Comments</h4>
                        @foreach($comments as $c)
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="{{asset('frontend/img/comment/comment_1.png')}}" alt="">
                                    </div>
                                    <div class="desc">
                                        <p class="comment">
                                            {{$c->comment}}
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h5>
{{--                                                    {{dd($c)}}--}}
                                                    <a href="#">{{$c->name}}</a>
{{--                                                    @if(\Illuminate\Support\Facades\Auth::user())--}}
                                                </h5>
                                                <p class="date">{{$c->created_at->format('F j, Y  g:i a')}}</p>
                                            </div>
{{--                                            {{dd($b->id)}}--}}
                                            @isset($c ->id_user)
                                            @if($c -> id_user==\Illuminate\Support\Facades\Auth::id())
                                            <div class="reply-btn">
                                                <form action="{{route('comment-destroy', [$c->id, $b->id]) }}" method="POST" style="display: inline">
                                                    <input type="hidden" name="_method">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button class="btn btn-danger"><i class="fa fa-16px fa-trash"></i> Hapus</button>
                                                </form>
                                            </div>
                                            @endif
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="comment-form">
                        <h4>Leave a Reply</h4>
                        <form method='post' class="form-contact comment_form"  action="{{route('comment-store',$datareal->id)}}" id="commentForm">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                              <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                                        placeholder="Write Comment" required></textarea>
                                    </div>
                                </div>
                                @if(\Illuminate\Support\Facades\Auth::id()==null)
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="button btn_1 button-contactForm">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                @include('components.site-sidebar')
            </div>
        </div>
    </section>
    <!--================Blog Area end =================-->



@endsection
