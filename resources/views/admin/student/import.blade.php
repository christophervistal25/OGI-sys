@extends('admin.layouts.dashboard-template')
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
		<h6 class="m-0 font-weight-bold text-primary">
			Before importation make sure that the format csv each row is (firstname,middlename,lastname,gender,course,school year,semester,level)
			course must be abbr e.g (BEED,BSIT)
		</h6>
	</div>
	<div class="card-body">
		<form  action="{{ route('admin.student.import.action') }}"  method="POST" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<input type="file" name="csv" id="csvFile" required />
			</div>
			<input type="submit" value="Import" class="btn btn-primary">
		</form>
	</div>
</div>


@push('page-scripts')
@endpush
@endsection