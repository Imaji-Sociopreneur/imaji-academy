@extends('layouts.landing')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>News</h2>
                            <p>Home<span>/</span>News</p>
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
                            @foreach($contents as $berita)
                                @foreach($berita as $brt)
                                <article class="blog_item">
                                    <div class="blog_item_img">
                                        <img class="card-img rounded-0" src="{{asset('storage/content/'.$brt->thumbnail)}}" alt="">
                                        <a href="#" class="blog_item_date">
                                            <h3>{{$brt->created_at->format('d')}}</h3>
                                            <p>{{$brt->created_at->format('M')}}</p>
                                        </a>
                                    </div>

                                    <div class="blog_details">
                                        <a class="d-inline-block" href="single-blog.html">
                                            <h2>{{$brt->title}}</h2>
                                        </a>
                                        <p>{!! $brt->contents !!}</p>
                                        <ul class="blog-info-link">
                                            @foreach(\App\Models\ContentTag::whereContentId($brt->id)->take(3)->get() as $tag)
                                            <li><a href="#"><i class="far fa-user"></i>{{$tag->tag->tag}}</a></li>
                                            @endforeach
                                            <li><a href="#"><i class="far fa-comments"></i> 03 Comments</a></li>
                                        </ul>
                                    </div>
                                </article>
                                @endforeach
                            @endforeach
                        @endisset
                        @isset($paginate)
                                @foreach($berita as $brt)
                                    <article class="blog_item">
                                        <div class="blog_item_img">
                                            <img class="card-img rounded-0" src="{{asset('storage/content/'.$brt->thumbnail)}}" alt="">
                                            <a href="#" class="blog_item_date">
                                                <h3>{{$brt->created_at->format('d')}}</h3>
                                                <p>{{$brt->created_at->format('M')}}</p>
                                            </a>
                                        </div>

                                        <div class="blog_details">
                                            <a class="d-inline-block" href="single-blog.html">
                                                <h2>{{$brt->title}}</h2>
                                            </a>
                                            <p>{!! $brt->contents !!}</p>
                                            <ul class="blog-info-link">
                                                @foreach(\App\Models\ContentTag::whereContentId($brt->id)->take(3)->get() as $tag)
                                                    <li><a href="#"><i class="far fa-user"></i>{{$tag->tag->tag}}</a></li>
                                                @endforeach
                                                <li><a href="#"><i class="far fa-comments"></i> 03 Comments</a></li>
                                            </ul>
                                        </div>
                                    </article>
                                @endforeach
                            {{ $berita->links('vendor.pagination.custom') }}
                        @endisset
                    </div>
                </div>
                @include('components.site-sidebar')
            </div>
        </div>
    </section>
@endsection
