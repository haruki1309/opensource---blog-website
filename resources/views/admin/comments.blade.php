@extends('admin.master')

@section('title')
    Bình luận
@stop

@section('pageheader')
    Duyệt bình luận
@stop

@section('css')
<link href="{{url('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ url('/css/select2.min.css') }}">
@stop

@section('js')
<!-- Page level plugins -->
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{url('vendor/jquery/jquery.validate.min.js')}}"></script>
<script src="{{url('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{url('js/admin/comment.js')}}"></script>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách bình luận chưa duyệt</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable1" width="100%">
                        <thead>
                            <th>id</th>
                            <th>#</th>
                            <th>Bài viết</th>
                            <th>Tên hiển thị</th>
                            <th>Bình luận</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách bình luận đã duyệt</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable2" width="100%">
                        <thead>
                            <th>id</th>
                            <th>#</th>
                            <th>Bài viết</th>
                            <th>Tên hiển thị</th>
                            <th>Bình luận</th>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
