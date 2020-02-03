@extends('admin.layouts.dashboard-template')
@section('title','Student View Grade')
@section('content')
<div class="row mb-2">
	<div class="col-lg-12">
		@if(\Session::has('success'))
		@include('templates.success')
		@else
		@include('templates.error')
		@endif
	</div>
</div>

<div class="card shadow mb-4 rounded-0">
	<div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-bold text-primary">Edit Student View Grade Schedule</h6>
	</div>

	<div class="card-body">
		<form method="POST" action="{{ route('view-grade.control.update', [$schedule]) }}">
			@csrf
			@method('PUT')
			<div class="form-group">
				<label for='startDate'>Start Date</label>
				<input type="date" id='startDate' name="start_date" class='form-control' value='{{ $schedule->start_date->format('Y-m-d') }}'>	
			</div>

			<div class="form-group">
				<label for='endDate'>End Date</label>
				<input type="date" id='endDate' name="end_date" class='form-control' value="{{ $schedule->end_date->format('Y-m-d') }}">
			</div>
			
			<input type="submit" value="Update" class='float-right btn btn-success'>
		</form>
	</div>
</div>

@endsection