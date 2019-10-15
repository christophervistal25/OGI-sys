@extends('instructor.layouts.dashboard-template')
@section('title','List of your subjects')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.css">

@endprepend
<div class="card shadow mb-4 rounded-0">
	<div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-bold text-primary">Subjects</h6>
	</div>

	<div class="card-body">
		<table class="table table-bordered table-hover" id="subjects-table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th class="text-center">Block</th>
					<th class="text-center">Semester</th>
					<th class="text-center">Credits</th>
					<th class="text-center">Level</th>
					<th class="text-center">No. of students</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($instructor->subjects as $subject)
				<tr>
					<td>{{ $subject->name }}</td>
					<td>{{ $subject->description }}</td>
					<td class="text-center">{{ $subject->pivot->block }}</td>
					<td class="text-center">{{ $subject->semester }}</td>
					<td class="text-center">{{ $subject->credits }}</td>
					<td class="text-center">{{ $subject->level }}</td>
					<td class="text-center">{{ $subject->students->count() }}</td>
					<td class="text-center">
						<div class="dropdown show">
						  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    Actions
						  </a>

						  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
						    {{-- <a class="dropdown-item" href="{{ route('instructor.subject.create') }}">Add Student</a> --}}
						    <a class="dropdown-item" href="{{ route('subject.students.show', [$subject->id]) }}">View Students</a>
						    {{-- <a class="dropdown-item" href="#">Another action</a>
						    <a class="dropdown-item" href="#">Something else here</a> --}}
						  </div>
						</div>

					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>


@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>
@endpush
@endsection