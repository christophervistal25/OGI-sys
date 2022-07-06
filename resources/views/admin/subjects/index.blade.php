@extends('admin.layouts.dashboard-template')
@section('title','List of subject')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
<div class="card shadow mb-4 rounded-0">
	<div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-bold text-primary">Subjects</h6>
	</div>
	<div class="card-body">
		<a class="btn btn-primary float-right mb-2" href="{{ route('subject.create') }}">Add Subject</a>
		<div class="clearfix"></div>
		<table class="table table-bordered table-hover" id="subjects-table">
			<thead>
				<tr>
					<th class='text-uppercase'>Course No</th>
					<th class='text-uppercase'>Description</th>
					<th class='text-uppercase'>Year level</th>
					<th class='text-uppercase'>Units</th>
					<th class='text-uppercase'>Semester</th>
					<th class='text-uppercase'>School year</th>
					<th class='text-uppercase'>Department</th>
					<th class="text-center text-uppercase">Action</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
	
	let table = $('#subjects-table').DataTable({
	    orderCellsTop: true,
	    serverSide: true,
	    processing: true,
	    responsive: true,
	    ajax: '/admin/subject/list',
	    columns: [
	        { name: 'name' },
	        { name: 'description' },
	        { name: 'level' },
	        { name: 'credits' },
	        { name: 'semester' },
	        { name: 'school_year' },
	        { name: 'department.name' },
	        { name: 'action' , searchable : false,},
	    ],
	});

	/*
	$('.dataTable').on('click', 'tbody tr', function(e) {
	})

	$('.dataTable').on('mouseover', 'tbody tr', function() {
  		$(this).css('cursor', 'pointer');
	})*/

</script>
@endpush
@endsection