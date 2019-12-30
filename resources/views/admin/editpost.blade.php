@extends('admin.master')

@section('title')
	{{$post->title}}
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="{{ url('/css/admin/postdetail.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('/css/select2.min.css') }}">
@stop

@section('content')
<div id="content">
	<div id="noti-wrapper">
	    @if(count($errors) > 0)
	        <div class="errors">
	            <ul>
	                @foreach($errors->all() as $err)
	                    <li>{{$err}}</li><br>
	                @endforeach
	            </ul>
	        </div>
	    @endif

	    @if(session('message'))
	        <div class="notifications">
	            {{session('message')}}<br>
	        </div>
	    @endif
	</div>
	<div class="row">
		<img class="col-lg-12" src="{{url($post->img_url)}}">
	</div>
	<form class="bg-white p-4" action="{{ url('admin/posts/'.$post->id.'/store') }}" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="form-name">EDIT POST</div>
		
		<div class="row mb-4">
			<div class="col-lg-6">
				<div class="form-group">
					<label for="title">Title</label>
    				<input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label for="category">Category</label>
    				<select name="category" class="form-control" id="category">
						@foreach($categories as $category)
							@if($category->id == $post->category_id)
							<option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
							@else
							<option value="{{ $category->id }}">{{ $category->name }}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>
		</div>

		<div class="row mb-4">
			<div class="col-lg-6">
				<label for="tags">Tags</label>
				<select name="tags[]" class="select2-multi tag-select form-control" id="tags" multiple="multiple">
					@foreach($tags as $tag)
					<option value="{{ $tag->id }}">{{ $tag->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-6">
				<label for="imgfile">Banner image</label>
				<input id="imgfile" class="form-control-file" type="file" name="imgfile">
				<small for"imgfile">Thay thế banner hiện tại</small>
			</div>
		</div>

		<div class="row mb-4">
			<div class="col-lg-12">
				<label for="description">Write description</label>
				<textarea id="description" class="form-control" name="description">{{$post->description}}</textarea>
			</div>
		</div>

		<div class="row mb-4">
			<div class="col-lg-12">
				<label for="content-ckeditor">Write content</label>
				<textarea id="content-ckeditor" name="content">{{$post->content}}</textarea>
			</div>
		</div>
		<button class="save-btn">Save</button>
	</form>
</div>
@stop

@section('js')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script> 
	CKEDITOR.replace('content-ckeditor',{
		filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
	}); 
</script>
<script type="text/javascript">
	$('.select2-multi').select2();
	$('.select2-multi').select2().val({!! json_encode($post->tags()->pluck('tag.id')->toArray()) !!}).trigger('change');
</script>
@stop
