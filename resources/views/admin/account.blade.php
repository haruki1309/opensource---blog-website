@extends('admin.master')

@section('title')
Account Setting
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('css/admin/account.css')}}">
@stop

@section('js')
<script src="{{url('vendor/jquery/jquery.validate.min.js')}}"></script>
<script src="{{url('vendor/jquery/additional-methods.min.js')}}"></script>
<script type="text/javascript">
	var BASEURL =  window.location.origin+window.location.pathname;
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	$('#changePasswordBtn').click(function(){
		$('#changepasswordModal').modal('show');
	});

	$('#form-password').ajaxForm({
        url: BASEURL + "/changepassword",
        type: 'post',
        success: function(data){
            if(data === 'success'){
                $('#form-password').modal('hide');  
                console.log(data);
            }
            else{
                console.log(data);
            }
        },
        error: function(data){
            console.log('error');
        }
    });
</script>
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

    @if(session('error'))
    <div class="errors">
        <ul>
            <li>{{session('error')}}</li><br>
        </ul>
    </div>
    @endif

    @if(session('message'))
        <div class="notifications">
            {{session('message')}}<br>
        </div>
    @endif
</div>

<div class="bg-white">
	<form class="p-4" autocomplete="off" action="{{url('admin/account')}}" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-sm-4"><img class="avt" src="{{url($user->img_url)}}"></div>
			<div class="col-sm-8">
				<div class="form-group">
					<label for="username">Username</label>
					<input id="username" class="form-control" type="text" name="username" value="{{$user->username}}">
				</div>

				<div class="form-group">
					<label for="displayname">Tên hiển thị</label>
					<input id="displayname" class="form-control" type="text" name="displayname" value="{{$user->name}}">
				</div>

                <div class="form-group">
                    <label for="imgfile">Thay đổi ảnh đại diện</label>
                    <input type="file" class="form-control-file" id="imgfile" name="imgfile">
                </div>

				<div class="form-group">
					<label for="description">Mô tả bản thân</label>
					<textarea id="description" class="form-control" type="text" name="description">{{$user->description}}</textarea>
				</div>
				<button type="submit" class="btn btn-primary float-right">Save</button>
				<a href="javascript:void(0);" id="changePasswordBtn" class="btn btn-secondary float-right mr-2">Thay đổi mật khẩu</a>
			</div>
		</div>	
		
	</form>
</div>

<!-- change password modal -->
<div class="modal fade" id="changepasswordModal" tabindex="-1" role="dialog" aria-labelledby="changepasswordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form id="form-password" method="post" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
	            <div class="modal-header">
	                <h5 class="modal-title" id="changepasswordLabel">Thay đổi mật khẩu</h5>
	            </div>
	            <div class="modal-body">
	            	<div class="form-group">
	        			<label for="oldpassword">Mật khẩu hiện tại</label>
						<input id="oldpassword" class="form-control" type="password" name="oldpassword" required>
	        		</div>
	        		<div class="form-group">
	        			<label for="newpassword">Mật khẩu mới</label>
						<input id="newpassword" class="form-control" type="password" name="newpassword" required>
	        		</div>
	        		<div class="form-group">
	        			<label for="confirmpassword">Nhập lại mật khẩu mới</label>
						<input id="confirmpassword" class="form-control" type="password" name="confirmpassword" required>
	        		</div>
	            </div>
	            <div class="modal-footer">
	                <a class="btn btn-secondary" href="" data-dismiss="modal">Cancel</a>
	                <button type="submit" id="changePasswordBtnSave" class="btn btn-primary">Save</button>
	            </div>
            </form>
        </div>
    </div>
</div>
@stop
