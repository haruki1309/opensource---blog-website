@extends('admin.master')

@section('title')
Post Manage
@stop

@section('css')
<link href="{{url('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@stop

@section('js')
<!-- Page level plugins -->
<script src="{{url('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
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
<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách bài viết</h6>
        <a href="{{url('admin/createpost')}}" class="btn btn-primary btn-circle btn-sm" id="create-new">
            <i class="fas fa-plus"></i>
        </a> 
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-order='[[ 1, "asc" ]]'>
                <thead>
                    <th class="tb-col-number">#</th>
				    <th class="tb-col-title">Title</th>
				    <th class="tb-col-number">Views</th>
				    <th class="tb-col-date">Last Update</th>
				    <th>Category</th>
				    <th>Tags</th>
				    <th class="tb-col-btn"></th>
				    <th class="tb-col-btn"></th>
                </thead>
                <tbody>
                	@for($i = 0; $i < $posts->count(); $i++)
					<tr>
					    <td>{{$i + 1}}</td>
					    <td>{{$posts[$i]->title}}</td>
					    <td>{{$posts[$i]->views}}</td>
					    <td>{{date('d/m/Y', strtotime($posts[$i]->updated_at))}}</td>
					    <td>{{$posts[$i]->category->name}}</td>
					    <td>
					    	@if($posts[$i]->tags->count() > 0)
						    	@for($j = 0; $j < $posts[$i]->tags->count() - 1; $j++)
						    	{{$posts[$i]->tags[$j]->name.", "}}
						    	@endfor
						    	{{$posts[$i]->tags[$posts[$i]->tags->count() - 1]->name}}
					    	@endif
					    </td>
					    <td><a href="{{ url('admin/posts/'.$posts[$i]->id.'/edit') }}" class="row-btn"><i class="far fa-edit"></i></a></td>
					    <td><a href="#" class="row-btn"><i class="fas fa-trash"></i></a></td>
					</tr>
					@endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
