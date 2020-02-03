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
					<th>Course No.</th>
					<th>Description</th>
					<th class="text-center">Semester</th>
					<th class="text-center">Credits</th>
					<th class="text-center">Year level</th>
					<th class="text-center">No. of students</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($instructor->subjects as $subject)
				<tr>
					
					<td><a href="/instructor/subject/{{ $subject->id }}/students"><u>{{ $subject->name }}</u></a></td>
					<td>{{ $subject->description }}</td>
					<td class="text-center">{{ $subject->semester }}</td>
					<td class="text-center">{{ $subject->credits }}</td>
					<td class="text-center">{{ $subject->level }}</td>
					{{ dd($subject->students()->count() )}}
					<td class="text-center">{{ $subject->students->count() }}</td>
					<td class="text-center">
						  <a class="btn btn-primary btn-sm" href="/instructor/subject/{{$subject->id}}/add/student"><i class='fa fa-plus'></i></a>
						  <a class="btn btn-info btn-sm" href="{{ route('subject.students.show', [$subject->id]) }}"><i class='fa fa-eye'></i></a>
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
<script>
	$('#subjects-table').dataTable();
</script>
@endpush
@endsection