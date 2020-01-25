@extends('instructor.layouts.dashboard-template')
@section('title','Import Student')
@section('content')
@prepend('page-css')
@endprepend
<div class="mb-2">
	 @if(\Session::has('success'))
	    @include('templates.success')
	 @else
	    @include('templates.error')
	 @endif
</div>

<div class="card shadow mb-4 rounded-0">
	<div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-bold text-primary">Import student for {{ $subject->name }} - {{ $subject->description }}</h6>
		<span class='text-danger'>*Please make sure that the format of the CSV content must be like this(STUDENT_ID_NUMBER, GRADE)</span>
	</div>
	<div class="card-body">
		<form action="/instructor/subject/{{$subject->id}}/edit" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="form-group">
				<input type="file" name="csv" id="csvFile"  required />
			</div>
				<input type="submit" value="Import" class="btn btn-primary">
		</form>
	</div>
</div>


@push('page-scripts')
@endpush
@endsection