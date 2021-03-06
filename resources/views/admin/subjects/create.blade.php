@extends('admin.layouts.dashboard-template')
@section('title','Add subject')
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
<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4 rounded-0">
			<div class="card-header py-3 rounded-0">
				<h6 class="m-0 font-weight-bold text-primary">Add subject</h6>
			</div>
			<div class="card-body" >
				<form action="{{ route('subject.store') }}" method="POST">
					@csrf
					<div class="row">
						<div class="col-lg-12 form-group">
							<label for="name">Course No.</label>
							<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
						</div>
						<div class="col-lg-6 form-group">
							<label for="description">Description</label>
							<input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}">
						</div>

						<div class="col-lg-6 form-group">
							<label for="department">Department</label>
							<select name="department_id" class="form-control" id="department" required>
								<option value="" selected disabled hidden>Select Department</option>
								@foreach($departments as $department)
								<option value="{{ $department->id }}">{{ $department->name }}</option>
								@endforeach
							</select>
						</div>

						<div class="col-lg-3 form-group">
							<label for="level">Year Level</label>
							<input type="number" class="form-control" id="level" name="level" value="{{ old('level') }}">
						</div>
						<div class="col-lg-3 form-group">
							<label for="semester">Units</label>
							<input type="number" class="form-control" id="credits" name="credits" value="{{ old('credits') }}">
						</div>
						<div class="col-lg-3 form-group">
							<label for="semester">Semester</label>
							<input type="number" class="form-control" id="semester" name="semester" value="{{ old('semester') }}">
						</div>
						<div class="col-lg-3 form-group">
							<label for="school_year">School Year</label>
							<input type="text" class="form-control" id="school_year" name="school_year" value="{{ old('school_year') }}">
						</div>
					</div>
					<div class="float-right">
						<input type="submit" class="btn btn-primary mt-1 font-weight-bold" value="Add Subject">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@push('page-scripts')
@endpush
@endsection