@extends('admin.layouts.dashboard-template')
@section('title','View Grade control for students')
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
		<h6 class="m-0 font-weight-bold text-primary">Create View Grade Date Range</h6>
	</div>

	<div class="card-body">
		<form method="POST" action="{{ route('view-grade.control.submit') }}">
			@csrf
			<div class="form-group">
				<label for='startDate'>Start Date</label>
				<input type="date" id='startDate' name="start_date" class='form-control' value='{{ old('start_date') }}'>	
			</div>

			<div class="form-group">
				<label for='endDate'>End Date</label>
				<input type="date" id='endDate' name="end_date" class='form-control' value="{{ old('end_date') }}">
			</div>
			
			<input type="submit" value="Create" class='float-right btn btn-primary'>
		</form>
	</div>
</div>

@endsection