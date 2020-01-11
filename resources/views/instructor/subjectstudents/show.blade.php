@extends('instructor.layouts.dashboard-template')
@section('title','List of your student in ' . $subject->name . ' - ' . $subject->description)
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.css"/>
@endprepend
<div class="row">
	<div class="card bg-primary text-white shadow col-lg-12">
		<div class="card-body">
		  <b>Edit student grade by just clicking the rating field of student then press enter after you input new value.</b>
		</div>
	</div>
</div>


<br>


<div class="card shadow mb-4 rounded-0">
	<div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-bold text-primary">Students </h6>
	</div>

	<div class="card-body">
		@if(isset($evaluation->end_date))
			<span class='text-danger font-weight-bold'>You can only update grade until {{ $evaluation->end_date->format('F d, Y') }}</span>
			@else
			<span class='text-danger font-weight-bold'>You can only view the grades of your student</span>
		@endif
	<hr>
		<table class="table table-bordered table-hover" id="student-subjects-table">
			<thead>
				<tr>
					<th>ID Number</th>
					<th>Name</th>
					<th class="text-center">Course</th>
					<th class="text-center">Department</th>
					<th class="text-center">Rating</th>
					<th class="text-center">Remarks</th>
				</tr>
			</thead>
			<tbody>
				@foreach($students as $student)
				<tr>
					<td>{{ $student->id_number }}</td>
					<td>{{ $student->name }}</td>
					<td class="text-center">{{ $student->course->abbr }}</td>
					<td class="text-center">{{ $student->course->department->name }}</td>
					@if(number_format($student->subjects[0]->pivot->remarks, 1) == 0.0 ) 
						<td class="text-center {{isset($evaluation->end_date) ? 'studentGradeField' : ''}} text-danger font-weight-bold" {{isset($evaluation->end_date) ? 'contenteditable=true' : ''}} data-student-id="{{ $student->id }}" data-student-subject="{{ $student->subjects[0] }}">NG</td>
						<td class="text-center font-weight-bold">NO GRADE</td>
					@else
						<td class="text-center {{isset($evaluation->end_date) ? 'studentGradeField' : ''}}" {{isset($evaluation->end_date) ? 'contenteditable=true' : ''}} data-student-id="{{ $student->id }}" data-student-subject="{{ $student->subjects[0] }}">
						{{ number_format($student->subjects[0]->pivot->remarks, 1) }}</td>
						<td class="text-center font-weight-bold text-{{ ($student->subjects[0]->pivot->remarks > 3.0 ) ? 'danger' : 'primary' }}"> {{ ($student->subjects[0]->pivot->remarks > 3.0) ? 'FAILED' : 'PASSED' }}</td>
					@endif
					
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
	let studentGradeOldValue = '';

	$.ajaxSetup({
	    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
	});

 	$('#student-subjects-table').DataTable();

 	$('.studentGradeField').focus(function (e) {
 		studentGradeOldValue = e.target.innerText.trim();
 	});

 	
 	$('#student-subjects-table ').on('keypress', 'tr td.studentGradeField', function(e) {
   		if (e.keyCode == 13) {
 			e.preventDefault();
 			let studentGradeNewValue = e.target.innerText.trim();
	 		if (studentGradeNewValue !== studentGradeOldValue) {
	 			let studentId = $(this).attr('data-student-id');
				let studentSubject = JSON.parse($(this).attr('data-student-subject'));
				studentSubject['student_id'] = studentId;
				studentSubject['pivot']['remarks'] = studentGradeNewValue;
	 			let confirmation = confirm(`Are you sure to edit this grade?`);
	 			if (confirmation) {
					$.ajax({
		 				url : `/instructor/subject/${studentSubject.id}/students`,
		 				method  : 'PUT',
		 				data : studentSubject,
		 				success : function (response) {
		 					if (response.success) {
		 						alert('Student grade succesfully update please wait a couple of second to apply changes..');
		 						window.location.reload();
		 					}
		 				},
		 				error : function (response) {
		 					if (response.status === 422) {
		 						let errors = response.responseJSON.errors;
		 						let messages = "";
		 						errors['pivot.remarks'].forEach((error) => {
		 							messages += error + "\n";
		 						});
		 						alert(messages);
		 					}
		 				}
		 			});
	 			} else {
	 				$(this).html(studentGradeOldValue);
	 			}
	 		}
 		}
	});
 	
 
</script>
@endpush
@endsection