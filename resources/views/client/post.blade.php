@extends('client.master')

@section('title')
{{$post->title}}
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('css/client/post.css')}}">
@stop

@section('js')
<script type="text/javascript">
    var BASEURL =  window.location.origin+window.location.pathname;
    $('#comment-form').ajaxForm({
        url: BASEURL + '/comment',
        type: 'post',
        success: function(data){
            $('#notify-modal').modal('show');
        },
        error: function(data){
            console.log('error');
        }
    });

    $('.reply-form').each(function(){
        var parent = $(this).attr('parent');
        $(this).ajaxForm({  
            url: BASEURL + '/comment/' + parent,
            type: 'post',
            success: function(data){    
                $('#notify-modal').modal('show');
            },
            error: function(data){
                console.log('error');
            }
        });
    });
</script>
<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=241110544128";
        fjs.parentNode.insertBefore(js, fjs);
    }
    (document, 'script', 'facebook-jssdk'));
</script> 
@stop
@section('content')
<div class="single-blog-wrapper section-padding-0-100">
    <div class="single-blog-area blog-style-2 mb-50">
        <div class="single-blog-thumbnail">
            <img src="{{url($post->img_url)}}" alt="" class="img-fluid">
            <div class="post-tag-content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="post-date">
                                <a href="#">{{$post->created_at->format('d')}} <span>{{$post->created_at->format('M')}}</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- ##### Post Content Area ##### -->
            <div class="col-12 col-lg-8">
                <!-- Single Blog Area  -->
                <div class="single-blog-area blog-style-2 mb-50">
                    <!-- Blog Content -->
                    <div class="single-blog-content">
                        <div class="line"></div>
                        <a href="{{url('/post/'.$post->title_url)}}" class="post-tag">{{$post->category->name}}</a>
                        <h4><a href="{{url('/post/'.$post->title_url)}}" class="post-headline mb-0">{{$post->title}}</a></h4>
                        <div class="post-meta">
                            <p>Tác giả <a href="#">{{$post->user->name}}</a></p>
                            <p>{{count($post->comments).' bình luận'}}</p>
                        </div>
                        <div class="fb-share-button mb-50" data-href="http://YourPageLink.com" data-layout="button_count"></div>
                        <p>{{$post->description}}</p>
                        {!!$post->content!!}
                    </div>
                </div>

                <!-- About Author -->
                <div class="blog-post-author mt-100 d-flex">
                    <div class="author-thumbnail">
                        <img src="{{url($post->user->img_url)}}" alt="">
                    </div>
                    <div class="author-info">
                        <div class="line"></div>
                        <span class="author-role">Tác giả</span>
                        <h4><a href="#" class="author-name">{{$post->user->name}}</a></h4>
                        <p>{{$post->user->description}}</p>
                    </div>
                </div>

                <!-- Comment Area Start -->
                <div class="comment_area clearfix mt-70">
                    <h5 class="title">Bình luận về bài viết</h5>
                    <ol>
                        @foreach($comments as $comment)
                        <!-- Single Comment Area -->
                        <li class="single_comment_area">
                            <!-- Comment Content -->
                            <div class="comment-content d-flex">
                                <!-- Comment Author -->
                                <div class="comment-author">
                                    <img src="{{url('assets/avt-placehoder.jpg')}}" alt="author">
                                </div>
                                <!-- Comment Meta -->
                                <div class="comment-meta">
                                    <a href="#" class="post-date">{{$comment->created_at->format('d M')}}</a>
                                    <a href="#" class="post-author">{{$comment->username}}</a>
                                    <p>{{$comment->comment}}</p>
                                    <a href="{{'#reply-form-wrap-'.$comment->id}}" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="{{'reply-form-wrap-'.$comment->id}}" class="comment-reply">{{'Trả lời'}}</a>

                                    <div class="collapse mt-4" id="{{'reply-form-wrap-'.$comment->id}}">
                                        <form class="reply-form" method="post" enctype="multipart/form-data" autocomplete="off" parent="{{$comment->id}}">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="group">
                                                        <input type="text" name="name" required>
                                                        <span class="highlight"></span>
                                                        <span class="bar"></span>
                                                        <label>Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="group">
                                                        <input type="email" name="email" required>
                                                        <span class="highlight"></span>
                                                        <span class="bar"></span>
                                                        <label>Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="group">
                                                        <input type="text" name="subject" required>
                                                        <span class="highlight"></span>
                                                        <span class="bar"></span>
                                                        <label>Subject</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="group">
                                                        <textarea name="message" required></textarea>
                                                        <span class="highlight"></span>
                                                        <span class="bar"></span>
                                                        <label>Comment</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn original-btn">Bình luận</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>  
                                </div>
                            </div>
                            <ol class="children">
                                @foreach($comment->children as $reply)
                                <li class="single_comment_area">
                                    <div class="comment-content d-flex">
                                        <div class="comment-author">
                                            <img src="{{url('assets/avt-placehoder.jpg')}}" alt="author">
                                        </div>
                                        <div class="comment-meta">
                                            <a href="#" class="post-date">{{$reply->created_at->format('d M')}}</a>
                                            <p><a href="#" class="post-author">{{$reply->username}}</a></p>
                                            <p>{{$reply->comment}}</p>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ol>  
                        </li>
                        @endforeach
                    </ol>
                </div>

                <div class="post-a-comment-area mt-70">
                    <h5>Để lại bình luận của bạn</h5>
                    <!-- Reply Form -->
                    <form id="comment-form" action="{{url('post/'.$post->title_url.'/comment')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="text" name="name" required>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="group">
                                    <input type="email" name="email" required>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group">
                                    <input type="text" name="subject" required>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group">
                                    <textarea name="message" required></textarea>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Comment</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn original-btn">Bình luận</button>
                            </div>
                        </div>
                    </form>
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
                                <input type="email" name="email" id="subscribesForm" placeholder="Nhập email...">
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
                                @foreach($post->tags as $tag)
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

<div class="modal fade" tabindex="-1" role="dialog" id="notify-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Thông báo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p>Bình luận của bạn đã được gởi đi, vui lòng chờ xét duyệt!</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">oke</button>
            </div>
        </div>
    </div>
</div>
<!-- ##### Single Blog Area End ##### -->
@stop
