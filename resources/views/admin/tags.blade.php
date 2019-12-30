extends('admin.master')

@section('title')
Tags
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="{{ url('/css/admin/tags.css') }}">
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

	<div id="tag-wrapper">
		<div class="table-posts">
			<div class="table-name">Tags List</div>
			<table>
				<tr class="table-header">
				    <th class="tb-col-number">#</th>
				    <th class="tb-col-title">Tag name</th>
				    <th class="tb-col-btn"></th>
				    <th class="tb-col-btn"></th>
				</tr>
				@if(isset($tags))
					@for($i = 0; $i < $tags->count(); $i++)
					<tr>
					    <td>{{ $i + 1 }}</td>
					    <td>{{ $tags[$i]->name }}</td>
					    <td><a href="{{url('admin/tags/'.$tags[$i]->id.'/edit')}}" class="row-btn"><i class="far fa-edit"></i></a></td>
					    <td><a href="{{url('admin/tags/'.$tags[$i]->id.'/delete')}}" class="row-btn"><i class="fas fa-trash"></i></a></td>
					</tr>
					@endfor
				@endif
			</table>
		</div>

		<div>
			<div class="table-posts" style="height: 200px; margin-bottom: 10px;">
				<form action="{{ url('admin/tags/search') }}" method="POST" enctype="multipart/form-data" autocomplete="off" role="search">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="table-name">Search</div>
					<input type="search" name="searchkey" placeholder="enter tag name...">
					<button>Search</button>
				</form>
			</div>

			<div class="table-posts" style="height: 200px;">
				<form action="{{ url('admin/tags/store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="table-name">Add new tag</div>
					<input type="text" name="tagname" placeholder="enter tag name...">
					<button>Save</button>
				</form>
			</div>
		</div>
	</div>
</div>
@stop

@section('js')
<script src="{{ asset('js/select2.min.js') }}"></script>
@stop
