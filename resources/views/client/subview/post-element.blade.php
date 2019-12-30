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
@endfor
