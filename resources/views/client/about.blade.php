@extends('client.master')

@section('title')
About me
@stop

@section('css')

@stop

@section('content')
<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img" style="background-image: url(assets/aboutme.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcumb-content text-center">
                    <h2>about me</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Blog Wrapper Start ##### -->
<div class="blog-wrapper section-padding-100-0 clearfix">
    <div class="container">
        <div class="row align-items-start">
            <!-- Single Blog Area -->
            <div class="col-12 col-lg-4">
                <div class="single-blog-area clearfix mb-100">
                    <!-- Blog Content -->
                    <div class="single-blog-content">
                        <h4><a href="#" class="post-headline">Về blog này</a></h4>
                        <p class="mb-3">Chào các bạn, tôi là Bùi Trung Tín, tác giả của blog BugEverywhere. Vốn sinh ra trong một gia đình nho giáo lâu đời, có truyền thống code dạo, cài win dạo nên tôi đặt tên blog là “BugEverywhere” (Đùa đấy). Đây là một blog về IT mà cũng ko phải về IT. Nội dung blog một nửa là về kĩ thuật lập trình, một nửa còn lại là những kinh nghiệm tôi học được: Cách deal lương, sắp xếp thời gian, kĩ năng mềm, ngôn ngữ nên học, con đường phát triển nghề nghiệp… Đó là những điều quan trọng ko thua gì kĩ năng lập trình.</p>
                    </div>
                </div>
            </div>
            <!-- Single Blog Area -->
            <div class="col-12 col-lg-4">
                <div class="single-blog-area clearfix mb-100">
                    <!-- Blog Content -->
                    <div class="single-blog-content">
                        <h4><a href="#" class="post-headline">Về bản thân</a></h4>
                        <p class="mb-3">Tôi là sinh viên khóa 11, trường Đại Học Công nghệ thông tin, ĐHQG TPHCM. Một cuốn sách tôi đã từng viết (Chỉ in 30 bản, xuất bản nội bộ trong Đại Học FPT, tổng lợi nhuận tổng cộng 120k, được chút tiền còm uống cà phê). Nếu tò mò, các bạn có thể xem tôi đã viết sách như thế nào.</p>
                    </div>
                </div>
            </div>
            <!-- Single Blog Area -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-catagory-area clearfix mb-100">
                    <img src="assets/aboutme-1.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Blog Wrapper End ##### -->

<!-- ##### Cool Facts Area Start ##### -->
<div class="cool-facts-area section-padding-100-0 bg-img background-overlay" style="background-image: url(assets/bg-img/b4.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="single-blog-area blog-style-2 text-center mb-100">
                    <!-- Blog Content -->
                    <div class="single-blog-content">
                        <div class="line"></div>
                        <a href="" class="post-tag">Sharing and Learing</a>
                        <h4><a href="#" class="post-headline">Welcome to my blog</a></h4>
                        <p>Blog này là nơi mình chia sẻ những kiến thức, kinh nghiệm mà mình đạt được trong quá trình làm việc và trải nghiệm. Mong rằng nó sẽ giải đáp phần nào những khúc mắc, trăn trở cho những bạn sinh viên như mình ngày xưa. Phương châm của blog là: Developer cần biết nhiều điều hơn ngoài code, blog sẽ vừa dạy bạn code, vừa dạy bạn những điều còn lại. Tôi viết blog này với mục đích nâng cao khả năng diễn dạt, trình bày vấn đề, cũng như chia sẻ kinh nghiệm và kiến thức cho mọi người. Mọi comment góp ý hay ném đá, miễn là ko mang tính xúc phạm, đều được hoan nghênh.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Single Cool Facts Area -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-cool-facts-area text-center mb-100">
                    <h2><span class="counter">{{$postsCount}}</span></h2>
                    <p>Bài viết</p>
                </div>
            </div>
            <!-- Single Cool Facts Area -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-cool-facts-area text-center mb-100">
                    <h2><span class="counter">{{$categoriesCount}}</span></h2>
                    <p>Chủ đề</p>
                </div>
            </div>
            <!-- Single Cool Facts Area -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-cool-facts-area text-center mb-100">
                    <h2><span class="counter">{{$userCount}}</span></h2>
                    <p>Tác giả</p>  
                </div>
            </div>
            <!-- Single Cool Facts Area -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-cool-facts-area text-center mb-100">
                    <h2><span class="counter">{{$viewsCount}}</span></h2>
                    <p>Lượt xem</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Cool Facts Area End ##### -->
@stop
