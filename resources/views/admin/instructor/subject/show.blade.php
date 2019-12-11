@extends('admin.layouts.dashboard-template')
@section('title','List of ' . $instructor->name . ' subjects')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
<div class="card shadow mb-4 rounded-0">
	<div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-bold text-primary">Subjects</h6>
	</div>
	<div class="card-body">
		<table class="table table-bordered table-hover" id="instructor-subjects-table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Credits</th>
					<th>Level</th>
					<th>Semester</th>
					<th>Students</th>
				</tr>
			</thead>
			<tbody>
				@foreach($instructor->subjects as $subject)
					<tr>
						<td>{{ $subject->name }}</td>
						<td>{{ $subject->description }}</td>
						<td class="text-center">{{ $subject->credits }}</td>
						<td class="text-center">{{ $subject->level }}</td>
						<td class="text-center">{{ $subject->semester }}</td>
						<td class="text-center">{{ $subject->students->count() }}</td>
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
	$('#instructor-subjects-table').DataTable();
</script>
@endpush
@endsection