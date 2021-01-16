@extends('layouts.landing')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>Our Blog</h2>
                            <p>Home<span>/</span>Blog</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->


    <!--================Blog Area =================-->
    <section class="blog_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @isset($isset)
                            @foreach($contents as $blogs)
                                @foreach($blogs as $blog)
                                    <article class="blog_item">
                                        <div class="blog_item_img">
                                            <img class="card-img rounded-0" src="{{asset('storage/content/'.$blog->thumbnail)}}" alt="">
                                            <a class="blog_item_date">
                                                <h3>{{$blog->created_at->format('d')}}</h3>
                                                <p>{{$blog->created_at->format('M')}}</p>
                                            </a>
                                        </div>

                                        <div class="blog_details">
                                            <a class="d-inline-block" href="{{route('show',$blog->id)}}">
                                                <h2>{{$blog->title}}</h2>
                                            </a>
                                            <p>{!!$blog->contents!!}</p>
                                            <ul class="blog-info-link">
                                                @foreach(\App\Models\ContentTag::whereContentId($blog->id)->take(3)->get() as $tag)
                                                    <li><a href="#"><i class="far fa-user"></i>
                                                            {{$tag->tag->tag}}
                                                            @endforeach </a></li>
                                                    {{--{{dd($blog->id)}}--}}
                                                    {{--                                    {{dd(\App\Models\Comment::whereId($blog->id)->get())}}--}}
                                                    <li><a href="#"><i class="far fa-comments"></i>{{count(\App\Models\Comment::whereContentId($blog->id)->get())}} Comments</a></li>
                                            </ul>
                                            {{--                                {{count($blog->comments->whereId($blog->id))}}--}}
                                        </div>
                                    </article>
                                @endforeach
                            @endforeach
                        @endisset
                        @isset($paginate)
                        @foreach($blogs as $blog)
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="{{asset('storage/content/'.$blog->thumbnail)}}" alt="">
                                <a class="blog_item_date">
                                    <h3>{{$blog->created_at->format('d')}}</h3>
                                    <p>{{$blog->created_at->format('M')}}</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="{{route('show',$blog->id)}}">
                                    <h2>{{$blog->title}}</h2>
                                </a>
                                <p>{!!$blog->contents!!}</p>
                                <ul class="blog-info-link">
                                    @foreach(\App\Models\ContentTag::whereContentId($blog->id)->take(3)->get() as $tag)
                                    <li><a href="#"><i class="far fa-user"></i>
                                                {{$tag->tag->tag}}
                                            @endforeach </a></li>
                                    {{--{{dd($blog->id)}}--}}
{{--                                    {{dd(\App\Models\Comment::whereId($blog->id)->get())}}--}}
                                    <li><a href="#"><i class="far fa-comments"></i>{{count(\App\Models\Comment::whereContentId($blog->id)->get())}} Comments</a></li>
                                </ul>
{{--                                {{count($blog->comments->whereId($blog->id))}}--}}
                            </div>
                        </article>
                        @endforeach
                            {{ $blogs->links('vendor.pagination.custom') }}
{{--                        <nav class="blog-pagination justify-content-center d-flex">--}}
{{--                            <div class="pagination">--}}
{{--                                {{ $blogs->links() }}--}}
{{--                            </div>--}}
{{--                        </nav>--}}
                            @endisset
                    </div>
                </div>
                @include('components.site-sidebar')
{{--                </div>--}}
            </div>
        </div>
    </section>
@endsection
