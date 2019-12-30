@extends('client.master')

@section('title')
{{$resultname}}
@stop

@section('css')

@stop

@section('content')
<div class="blog-wrapper section-padding-100 clearfix">
	<div class="container">
		<div class="row mb-50"><h4>{{$resultname}}</h4></div>
	</div>
	<div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
            	@foreach($posts as $post)
                <!-- Single Blog Area  -->
                <div class="single-blog-area blog-style-2 mb-50 wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1000ms">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <div class="single-blog-thumbnail">
                                <img src="{{url($post->img_url)}}" alt="">
                                <div class="post-date">
                                    <a href="#">
                                    	{{$post->created_at->format('d')}} <span>{{$post->created_at->format('M')}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <!-- Blog Content -->
                            <div class="single-blog-content">
                                <div class="line"></div>
                                <a href="{{url('/category/'.$post->category->name_url)}}" class="post-tag">{{$post->category->name}}</a>
                                <h4><a href="{{url('/post/'.$post->title_url)}}" class="post-headline">{{$post->title}}</a></h4>
                                <p>{{$post->description}}</p>
                                <div class="post-meta">
                                    <p>Tác giả <a href="#">{{$post->user->name}}</a></p>
                                    <p>{{count($post->comments).' bình luận'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Load More -->
                <div class="load-more-btn mt-100 wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1000ms">
                    <a href="#" class="btn original-btn">Xem thêm</a>
                </div>
            </div>

            <!-- ##### Sidebar Area ##### -->
            <div class="col-12 col-md-4 col-lg-4">
                <div class="post-sidebar-area">
                    <!-- Widget Area -->
                    <div class="sidebar-widget-area">
                        <h5 class="title subscribe-title">Đăng ký nhận bài viết mới</h5>
                        <div class="widget-content">
                            <form action="#" class="newsletterForm" method="post" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="email" name="email" id="subscribesForm" placeholder="Nhập email" required>
                                <button type="submit" class="btn original-btn">Đăng ký</button>
                            </form>
                        </div>
                    </div>

                    <!-- Widget Area -->
                    <div class="sidebar-widget-area">
                        <h5 class="title">Bài viết mới nhất</h5>

                        <div class="widget-content">
                            @foreach($recents as $recent)
                            <!-- Single Blog Post -->
                            <div class="single-blog-post d-flex align-items-center widget-post">
                                <!-- Post Thumbnail -->
                                <div class="post-thumbnail">
                                    <img src="{{url($recent->img_url)}}" alt="">
                                </div>
                                <!-- Post Content -->
                                <div class="post-content">
                                    <a href="{{url('/post/'.$recent->title_url)}}" class="post-tag">{{$recent->category->name}}</a>
                                    <h4><a href="{{url('/post/'.$recent->title_url)}}" class="post-headline">{{$recent->title}}</a></h4>
                                    <div class="post-meta">
                                        <p><a href="#">{{$recent->created_at->format('d M')}}</a></p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Widget Area -->
                    <div class="sidebar-widget-area">
                        <h5 class="title">Tags</h5>
                        <div class="widget-content">
                            <ul class="tags">
                                @foreach($tags as $tag)
                                <li><a href="{{url('tag/'.$tag->name_url)}}">{{$tag->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
