@extends('admin.master')


@section('title')
Dashboard
@stop

@section('pageheader')
Dashboard
@stop

@section('css')
<link href="{{url('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@stop

@section('js')
<script src="{{url('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('js/admin/dashboard.js')}}"></script>
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

<script type="text/javascript">
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("categorychart");
var categorychart = new Chart(ctx, {
    type: 'doughnut',
        data: {
        labels: ["{{$popularCategory[0]->name}}", "{{$popularCategory[1]->name}}", "{{$popularCategory[2]->name}}"],
        datasets: [{
            data: ['{{$popularCategory[0]->repetition}}', '{{$popularCategory[1]->repetition}}', '{{$popularCategory[2]->repetition}}'],
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
    },
    legend: {
        display: false
    },
    cutoutPercentage: 80,
    },
});
</script>
@stop

@section('content')
<div class="row">
	<div class="col-xl-4 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Views Count</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalViews}}</div>
					</div>
					<div class="col-auto fa-2x text-gray-300">
						<i class="fas fa-eye"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Posts Count</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalPosts}}</div>
					</div>
					<div class="col-auto fa-2x text-gray-300">
						<i class="fas fa-book-open"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 col-md-6 mb-4">
		<div class="card border-left-info shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Subscribers</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalPosts}}</div>
					</div>
					<div class="col-auto fa-2x text-gray-300">
						<i class="fas fa-users"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xl-8 col-md-7">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Lượt xem nhiều nhất</h6>
		    </div>
		    <div class="card-body">
		        <div class="table-responsive">
		            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-order='[[2, "desc"]]'>
		                <thead>
		                    <th class="tb-col-number">#</th>
						    <th class="tb-col-title">Title</th>
						    <th class="tb-col-number">Views</th>
		                </thead>
		                <tbody>
		                	@for($i = 0; $i < count($mostInteratedPost); $i++)
							<tr>
							    <td>{{$i + 1}}</td>
							    <td>{{$mostInteratedPost[$i]->title}}</td>
							    <td>{{$mostInteratedPost[$i]->views}}</td>
							</tr>
							@endfor
		                </tbody>
		            </table>
		        </div>
		    </div>
		</div>
	</div>
	<div class="col-xl-4 col-lg-5">
		<div class="card shadow mb-4">
			<!-- Card Header  -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Chủ đề thịnh hành</h6>
		    </div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="chart-pie pt-4 pb-2">
					<canvas id="categorychart"></canvas>
				</div>
				<div class="mt-4 small">
					<div>
                        <i class="fas fa-circle text-primary"></i> {{$popularCategory[0]->name}}               
                    </div>
					<div>
                        <i class="fas fa-circle text-success"></i> {{$popularCategory[1]->name}}               
                    </div>
					<div>
                        <i class="fas fa-circle text-info"></i> {{$popularCategory[2]->name}}               
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
