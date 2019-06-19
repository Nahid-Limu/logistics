<style>
	#sum_box .db:hover{
		color: red;
	}
</style>
@extends('layouts.master')
@section('title', 'Dashboard')
<script>
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer1", {
		animationEnabled: true,
		theme: "light2",
		title:{
			text: "Last 30 Days Delivered Order"
		},
		axisY:{
			includeZero: false
		},
		data: [{        
			type: "line",       
			dataPoints: [
			
			<?php
			foreach ($chartData as $chart) {
				
				echo '{ y: '.$chart->sum.',label: "'.$chart->order_date.'" },';
			}
	
			?>	
			
			]
		}]
	});
	chart.render();

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Last 30 Days Order Statistics"
	},
	data: [{
		type: "pie",
		startAngle: 240,
		yValueFormatString: "##0",
		indexLabel: "{label} {y}",
		dataPoints: [
			<?php
			foreach ($piePending as $pending) {
				
				echo '{ y: '.$pending->p_Status.',label: "Pending Order", color: "crimson"  },';
			}
			foreach ($pieApprove as $approve) {
				
				echo '{ y: '.$approve->a_Status.',label: "Approved Order", color: "chartreuse"  },';
			}
			foreach ($pieDelivered as $delivered) {
				
				echo '{ y: '.$delivered->d_Status.',label: "Delivered Order", color: "#FFC300"  },';
			}
	
			?>
		]
	}]
});
chart.render();

}
</script>
@section('content')
		{{--@if(checkPermission(['super']) || checkPermission(['admin']))--}}
		<!--BEGIN TITLE & BREADCRUMB PAGE-->
		<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
			<div class="page-header pull-left">
				<div class="page-title"><b>Dashboard</b></div>
			</div>
			<ol class="breadcrumb page-breadcrumb pull-right">
				<li><i class="fa fa-home"></i>&nbsp;<a href="{{URL('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
				<li class="hidden"><a href="#">dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
				<li class="active">Dashboard</li>
			</ol>
			<div class="clearfix"></div>
		</div>
		<!--END TITLE & BREADCRUMB PAGE-->
	{{--@endif--}}
	<div class="page-content">
			<div id="sum_box" class="row mbl">
				@if(checkPermission(['admin']) || checkPermission(['super']))
				<a href="{{route('vendor_list')}}">
					<div class="col-sm-6 col-md-4">
						<div class="panel visit db mbm">
							<div class="panel-body"><p class="icon"><i class="icon fa fa-users"></i></p><h4 class="value"><span>{{sprintf('%03d',$vendor)}}</span></h4>

								<p class="description">Total Vendor</p>

							</div>
						</div>
					</div>
				</a>
				<a href="{{url('employee')}}">
					<div class="col-sm-6 col-md-4">
						<div class="panel visit db mbm">
							<div class="panel-body"><p class="icon"><i class="icon fa fa-users"></i></p><h4 class="value"><span>{{sprintf('%03d',$total)}}</span></h4>

								<p class="description">Total Employee</p>

							</div>
						</div>
					</div>
				</a>

				<a href="{{url('driver')}}">
						<div class="col-sm-6 col-md-4">
							<div class="panel visit db mbm">
								<div class="panel-body"><p class="icon"><i class="icon fa fa-car"></i></p><h4 class="value"><span>{{sprintf('%03d',$driver)}}</span></h4>

									<p class="description">Total Driver</p>

								</div>
							</div>
						</div>
				</a>
				<a href="{{url('pending/order_list')}}">
					<div class="col-sm-6 col-md-4">
						<div class="panel visit db mbm">
							<div class="panel-body"><p class="icon"><i class="icon fa fa-clock-o"></i></p><h4 class="value"><span>{{sprintf('%03d',$total_pending_order)}}</span></h4>

								<p class="description">Total Pending Order</p>

							</div>
						</div>
					</div>
				</a>
				<a href="{{url('approve/order/list')}}">
					<div class="col-sm-6 col-md-4">
						<div class="panel visit db mbm">
							<div class="panel-body"><p class="icon"><i class="icon fa fa-check-circle"></i></p><h4 class="value"><span>{{sprintf('%03d',$total_approved_order)}}</span></h4>

								<p class="description">Total Approved Order</p>

							</div>
						</div>
					</div>
				</a>
				<a href="{{url('rejected/order/lists')}}">
					<div class="col-sm-6 col-md-4">
						<div class="panel visit db mbm">
							<div class="panel-body"><p class="icon"><i class="icon fa fa-ban"></i></p><h4 class="value"><span>{{sprintf('%03d',$total_rejected_order)}}</span></h4>

								<p class="description">Total Rejected Order</p>

							</div>
						</div>
					</div>
				</a>
				<a href="{{route('area.index')}}">
					<div class="col-sm-6 col-md-4">
						<div class="panel visit db mbm">
							<div class="panel-body"><p class="icon"><i class="icon fa fa-globe"></i></p><h4 class="value"><span>{{sprintf('%03d',$area)}}</span></h4>

								<p class="description">Total Area</p>

							</div>
						</div>
					</div>
				</a>

				<a href="{{route('zone.index')}}">
				<div class="col-sm-6 col-md-4">
					<div class="panel visit db mbm">
						<div class="panel-body"><p class="icon"><i class="icon fa fa-support"></i></p><h4 class="value"><span>{{sprintf('%03d',$zone)}}</span></h4>

							<p class="description">Total Zone</p>

						</div>
					</div>
				</div>
				</a>

				<a href="{{route('location.index')}}">
					<div class="col-sm-6 col-md-4">
						<div class="panel visit db mbm">
							<div class="panel-body"><p class="icon"><i class="icon fa fa-map-marker"></i></p><h4 class="value"><span>{{sprintf('%03d',$location)}}</span></h4>

								<p class="description">Total Location</p>
								
							</div>
						</div>
					</div>
				</a>

					<div class="col-md-6">
						<div id="v-cal">
							<div class="vcal-header">
								<button class="vcal-btn" data-calendar-toggle="previous">
									<svg height="24" version="1.1" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
										<path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"></path>
									</svg>
								</button>

								<div class="vcal-header__label" data-calendar-label="month">
									March 2017
								</div>


								<button class="vcal-btn" data-calendar-toggle="next">
									<svg height="24" version="1.1" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
										<path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
									</svg>
								</button>
							</div>
							<div class="vcal-week">
								<span>Mon</span>
								<span>Tue</span>
								<span>Wed</span>
								<span>Thu</span>
								<span>Fri</span>
								<span>Sat</span>
								<span>Sun</span>
							</div>
							<div class="vcal-body" data-calendar-area="month"></div>
						</div>
					</div>
					<div class="col-md-6" >
						<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
					</div>
					<div class="col-md-12" >
						<hr>
						<div id="chartContainer1" style="height: 370px; width: 100%; margin: 0px auto;"></div>
					</div>
			@endif
			@if(checkPermission(['vendor']))
				<div class="col-md-12">
								<div style="" class="col-sm-6 col-md-6 col-md-offset-3">
									<div class="panel visit  mbm">
										<div class="panel-body"><p class="icon">
												@foreach($average_rating as $average)
													@for($i=0;$i<round($average->Average,0);$i++)
														<i class="icon fa fa-star" style="color: orange; font-size: 30px;"></i>
												    @endfor
												@endforeach
										</p><h4 class="value"><span>@foreach($average_rating as $average) {{round($average->Average,0)}} @endforeach</span></h4>
									<p class="description">Average Rating</p>
								</div>
							</div>
						</div>
				 </div>
				<div class="col-md-6">
					<div id="v-cal">
						<div class="vcal-header">
							<button class="vcal-btn" data-calendar-toggle="previous">
								<svg height="24" version="1.1" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
									<path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"></path>
								</svg>
							</button>

							<div class="vcal-header__label" data-calendar-label="month">
								March 2017
							</div>


							<button class="vcal-btn" data-calendar-toggle="next">
								<svg height="24" version="1.1" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
									<path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
								</svg>
							</button>
						</div>
						<div class="vcal-week">
							<span>Mon</span>
							<span>Tue</span>
							<span>Wed</span>
							<span>Thu</span>
							<span>Fri</span>
							<span>Sat</span>
							<span>Sun</span>
						</div>
						<div class="vcal-body" data-calendar-area="month"></div>
					</div>
				</div>
				<div class="col-md-6" >
					<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
				</div>
				<div class="col-md-12" >
					<hr>
					<div id="chartContainer1" style="height: 370px; width: 100%; margin: 0px auto;"></div>
				</div>

			</div>
		
			@endif
		 </div>

	</div>
@endsection
@section('extra_css')
	<style>
		#v-cal .vcal-body {
			background-color: rgba(var(--vcal-selected-bg-color), 0.3);
			display: flex;
			flex-wrap: wrap;
			height: 286px;
		}
		.canvasjs-chart-credit{
			display: none !important;
		}
		a.canvasjs-chart-credit{
		    color:#fff!important;
		}
	</style>
@endsection
@section('extra_js')
	<script>
        window.addEventListener('load', function () {
            vanillaCalendar.init({
                disablePastDays: true
            });
        })
	</script>
{{ Html::script('assets/js/canvasjs.min.js') }}
@endsection
