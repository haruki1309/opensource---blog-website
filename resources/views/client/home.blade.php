@extends('client.master')

@section('title')
Homepage
@stop

@section('css')
@stop
@section('js')
<script type="text/javascript">
    var end = {{$posts[count($posts) - 1]->id}};

    var BASEURL =  window.location.origin+window.location.pathname;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#btn-loadmore').click(function(){
        if(end > 1){
            $.ajax({
                url: BASEURL + "/loadmore",
                type: 'post',
                data: {endID: end},
                success: function(data){
                    end = data.end;
                    $('.post-area').append(data.view);
                },
                error: function(data){
                    console.log('error');
                }
            });
        }
        
    });
</script>
@stop
@section('content')
<!-- ##### Hero Area Start ##### -->
<div class="hero-area">
    <!-- Hero Slides Area -->
    <div class="hero-slides owl-carousel">
        @foreach($recents as $post)
        <!-- Single Slide -->
        <div class="single-hero-slide bg-img" style="background-image: url({{$post->img_url}});">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="slide-content text-center">
                            <div class="post-tag">
                                <a href="{{'category/'.$post->category->name_url}}" data-animation="fadeInUp">{{$post->category->name}}</a>
                            </div>
                            <h2 data-animation="fadeInUp" data-delay="250ms"><a href="{{url('post/'.$post->title_url)}}">{{$post->title}}</a></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- ##### Hero Area End ##### -->

<!-- ##### Blog Wrapper Start ##### -->
<div class="blog-wrapper section-padding-100 clearfix">
    @if(count($posts) > 3)
    <div class="container">
        <div class="row">
            @for($i = 0; $i < 3; $i++)
            <!-- Single Blog Area  -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-blog-area blog-style-2 mb-100">
                    <div class="single-blog-thumbnail">
                        <img src="{{url($posts[$i]->img_url)}}" alt="" style="height: 200px;">
                        <div class="post-date">
                            <a href="">
                                {{$posts[$i]->created_at->format('d')}} <span>{{$posts[$i]->created_at->format('M')}}</span>
                            </a>
                        </div>
                    </div>
                    <!-- Blog Content -->
                    <div class="single-blog-content">
                        <div class="line"></div>
                        <a href="{{url('/category/'.$posts[$i]->category->name_url)}}" class="post-tag">{{$posts[$i]->category->name}}</a>
                        <h4><a href="{{url('/post/'.$posts[$i]->title_url)}}" class="post-headline">{{$posts[$i]->title}}</a></h4>
                        <div class="post-meta">
                            <p>Tác giả <a href="">{{$posts[$i]->user->name}}</a></p>
                            <p>{{count($posts[$i]->comments).' bình luận'}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="post-area">
                @for($i = 3; $i < count($posts); $i++)
                @if($i == 4)
                <!-- Single Blog Area  -->
                <div class="single-blog-area blog-style-2 mb-50 wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1000ms">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="single-blog-thumbnail">
                                <img src="{{url($posts[$i]->img_url)}}" alt="">
                                <div class="post-date">
                                    <a href="">
                                        {{$posts[$i]->created_at->format('d')}} <span>{{$posts[$i]->created_at->format('M')}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- Blog Content -->
                            <div class="single-blog-content">
                                <div class="line"></div>
                                <a href="{{url('/category/'.$posts[$i]->category->name_url)}}" class="post-tag">{{$post->category->name}}</a>
                                <h4><a href="{{url('/post/'.$posts[$i]->title_url)}}" class="post-headline">{{$posts[$i]->title}}</a></h4>
                                <p>{{$posts[$i]->description}}</p>
                                <div class="post-meta">
                                    <p>Tác giả <a href="">{{$posts[$i]->user->name}}</a></p>
                                    <p>{{count($posts[$i]->comments).' bình luận'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <!-- Single Blog Area  -->
                <div class="single-blog-area blog-style-2 mb-50 wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1000ms">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <div class="single-blog-thumbnail">
                                <img src="{{url($posts[$i]->img_url)}}" alt="">
                                <div class="post-date">
                                    <a href="">
                                        {{$posts[$i]->created_at->format('d')}} <span>{{$posts[$i]->created_at->format('M')}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <!-- Blog Content -->
                            <div class="single-blog-content">
                                <div class="line"></div>
                                <a href="{{url('/category/'.$posts[$i]->category->name_url)}}" class="post-tag">{{$posts[$i]->category->name}}</a>
                                <h4><a href="{{url('/post/'.$posts[$i]->title_url)}}" class="post-headline">{{$posts[$i]->title}}</a></h4>
                                <p>{{$posts[$i]->description}}</p>
                                <div class="post-meta">
                                    <p>Tác giả <a href="">{{$posts[$i]->user->name}}</a></p>
                                    <p>{{count($posts[$i]->comments).' bình luận'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endfor
                </div>
                <!-- Load More -->
                <div class="load-more-btn mt-100 wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1000ms">
                    <button class="btn original-btn" id="btn-loadmore">Xem thêm</button>
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
                                        <p><a href="#">{{$post->created_at->format('d M')}}</a></p>
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
    @else <!-- post count <= 3 -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="post-area">
            	@for($i = 0; $i < count($posts); $i++)
                <!-- Single Blog Area  -->
                <div class="single-blog-area blog-style-2 mb-50 wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1000ms">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <div class="single-blog-thumbnail">
                                <img src="{{url($posts[$i]->img_url)}}" alt="">
                                <div class="post-date">
                                    <a href="">
                                    	{{$posts[$i]->created_at->format('d')}} <span>{{$posts[$i]->created_at->format('M')}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <!-- Blog Content -->
                            <div class="single-blog-content">
                                <div class="line"></div>
                                <a href="{{url('/category/'.$posts[$i]->category->name_url)}}" class="post-tag">{{$post->category->name}}</a>
                                <h4><a href="{{url('/post/'.$posts[$i]->title_url)}}" class="post-headline">{{$posts[$i]->title}}</a></h4>
                                <p>{{$posts[$i]->description}}</p>
                                <div class="post-meta">
                                    <p>Tác giả <a href="">{{$posts[$i]->user->name}}</a></p>
                                    <p>{{count($posts[$i]->comments).' bình luận'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
                </div>
                <!-- Load More -->
                <div class="load-more-btn mt-100 wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1000ms">
                    <button class="btn original-btn" id="btn-loadmore">Xem thêm</button>
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
                                        <p><a href="#">{{$post->created_at->format('d M')}}</a></p>
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
    @endif
</div>
<!-- ##### Blog Wrapper End ##### -->
@stop
