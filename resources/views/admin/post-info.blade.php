@extends('admin.master')

@section('title')
Categories
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="{{ url('/css/admin/tags.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('/css/select2.min.css') }}">
<link href="{{url('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@stop

@section('js')
<script src="{{ asset('js/select2.min.js') }}"></script>
<!-- Page level plugins -->
<script src="{{url('vendor/jquery/jquery.validate.min.js')}}"></script>
<script src="{{url('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{url('js/admin/category.js')}}"></script>
@stop


@section('content')
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
<div class="card">
	<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	    <h6 class="m-0 font-weight-bold text-primary">Danh sách thể loại</h6>
	    <a href="javascript:void(0)" class="btn btn-primary btn-circle btn-sm" id="create-new">
	        <i class="fas fa-plus"></i>
	    </a> 
    </div>
    <div class="card-body">
        <div class="table-responsive"> 
            <table class="table table-bordered" id="datatable" width="100%">
                <thead>
                    <tr>
                    	<th>id</th>
                        <th>#</th>
                        <th>{{ucfirst($viewName)}}</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="ajax-modal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-body">
		        <form id="infoform" name="infoform" class="form-horizontal" method="post">
		        	<input type="hidden" name="_token" value="{{csrf_token()}}">
		           	<input type="hidden" name="id" id="id" value="-1">
		            <div class="form-group">
		                <label for="name" class="col-sm-2 control-label">Tên</label>
		                <div class="col-sm-12">
		                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="" maxlength="50" required="">
		                </div>
		            </div> 
		            <div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary" id="btn-save" value="create">
							Lưu
						</button>
		            </div>
		        </form>
		    </div>
		</div>
	</div>
</div>

@stop
