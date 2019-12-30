@extends('admin.master')

@section('title')
    Người đăng ký
@stop

@section('pageheader')
Subscribers's Email
@stop

@section('css')
<link href="{{url('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ url('/css/select2.min.css') }}">
@stop

@section('js')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{url('vendor/jquery/jquery.validate.min.js')}}"></script>
<script src="{{url('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "columnDefs": [{
                "targets": [0],
                "orderable": false
            }],
        });
    });
</script>
@stop

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách Email</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%">
                        <thead>
                            <th>#</th>
                            <th>Email</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < $subscribers->count(); $i++)
                            <tr>
                                <td>{{$i + 1}}</td>
                                <td>{{$subscribers[$i]->email}}</td>
                                <td></td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
