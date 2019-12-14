@extends('admin.layouts.dashboard-template')
@section('title','List of student')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
<div class="card shadow mb-4 rounded-0">
	<div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-bold text-primary">Students</h6>
	</div>
	<div class="card-body">
		<table class="table table-bordered table-hover" id="students-table">
			<thead>
				<tr>
					<th>ID Number</th>
					<th>Name</th>
					<th>Gender</th>
					<th>Birthdate</th>
					<th>Course</th>
					<th>Actions</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<!-- Print Grade Modal-->
<div class="modal fade" id="printGradeModal" tabindex="-1" role="dialog" aria-labelledby="studentPrintGrade" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="studentPrintGrade">Print grade</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<form autocomplete="off" method="POST" id="studentPrintGradeModalForm" action="{{ route('admin.student.subjects.print') }}">
			@csrf
			<div class="modal-body">
				<div class="row">
					<input type="hidden" name="student_id" id="studentId">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="fromYear">From year : </label>
							<select name="from_year" id="fromYear" required class="form-control">
							  <option value="" disabled selected hidden>From year</option>
							  <option value="1">1</option>
							  <option value="2">2</option>
							  <option value="3">3</option>
							  <option value="4">4</option>
							  <option value="5">5</option>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="toYear">To year : </label>
							<select name="to_year" id="toYear" required class="form-control">
							  <option value="" disabled selected hidden>To year</option>
							  <option value="1">1</option>
							  <option value="2">2</option>
							  <option value="3">3</option>
							  <option value="4">4</option>
							  <option value="5">5</option>
							</select>
						</div>
					</div>

					<div class="col-lg-12">
						<label for="semesters">Semester : <small class="text-primary font-weight-bold">Press CTRL for multiple select</small></label>
					    <select multiple required name="semesters[]" class="form-control" id="semesters">
					      <option value="1">1</option>
					      <option value="2">2</option>
					      <option value="3">3</option>
					    </select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" type="submit">Print</button>
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
			</form>
			</div>
		</div>
	</div>
</div>
@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
	$('#students-table').DataTable({
	  		orderCellsTop: true,
		    serverSide: true,
		    processing: true,
		    responsive: true,
		    ajax: '/admin/student/department/list/{{$departmentId}}',
		    columns: [
		        { name: 'id_number' },
		        { name: 'name' },
		        { name: 'gender' },
		        { name: 'birthdate' },
		        { name: 'course.abbr', orderable: false },
		         { name: 'action', orderable: false, searchable: false }
		    ],
	});

	function printGrade(e)
	{
		let student = $(e).attr('data-student-id');
		$('#studentId').val(student)
		$('#printGradeModal').modal('show');
	}
	
</script>
@endpush
@endsection