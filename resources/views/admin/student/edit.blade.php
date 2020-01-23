@extends('admin.layouts.dashboard-template')
@section('title','Update student information')
@section('content')
<div class="row">
	<div class="col-lg-12">
		@if(\Session::has('success'))
			@include('templates.success')
		@else
			@include('templates.error')
		@endif
	</div>

</div>
<form method="POST" action="{{ route('student.update', ['student' => $student]) }}" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<input type="hidden" name="id" value="{{$student->id}}">
	<div class="card shadow mb-4 rounded-0">
		<div class="card-header py-3 rounded-0">
			<h6 class="m-0 font-weight-bold text-primary">Student Information & Credentials</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-lg-3">
					<div class="form-group">
						<label for="studentFullname">Firstname</label>
						<input type="text" class="text-capitalize form-control" name="firstname" id="studentFullname" value="{{ old('firstname') ?? $student->firstname }}" placeholder="Enter Firstname...">
					</div>
				</div>

				<div class="col-lg-3">
					<div class="form-group">
						<label for="studentMiddlename">Middlename</label>
						<input type="text" class="text-capitalize form-control" name="middlename" id="studentMiddlename" value="{{ old('middlename') ?? $student->middlename }}" placeholder="Enter Middlename...">
					</div>
				</div>

				<div class="col-lg-3">
					<div class="form-group">
						<label for="studentLastname">Lastname</label>
						<input type="text" class="text-capitalize form-control" name="lastname" id="studentLastname" value="{{ old('lastname')  ?? $student->lastname }}" placeholder="Enter Lastname...">
					</div>
				</div>

				<div class="col-lg-3">
					<div class="form-group">
						<label for="studentParentsEmail">Parent's Email</label>
						<input type="text" class="form-control" name="parents_email" id="studentParentsEmail" value="{{ old('parents_email')  ?? $student->parents_email }}" placeholder="Enter Parent's Email...">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label for="studentLevel">Year Level</label>
						<select name="level" class="form-control" id="studentLevel">
							<option value="1" {{ $student->level == '1' ? 'selected' : null }}>1</option>
							<option value="2" {{ $student->level == '2' ? 'selected' : null }} >2</option>
							<option value="3" {{ $student->level == '3' ? 'selected' : null }} >3</option>
							<option value="4" {{ $student->level == '5' ? 'selected' : null }} >4</option>
							<option value="5" {{ $student->level == '5' ? 'selected' : null }} >5</option>
						</select>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="studentCourse">Course</label>
						<select name="course_id" class="form-control" id="studentCourse">
							@foreach($courses as $course)
							<option value="{{$course->id}}" {{ old('course_id') == $course->id ? 'selected' : $student->course_id === $course->id ? 'selected' : null }} >{{ $course->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
			
				<div class="col-lg-6">
					<div class="form-group">
						<label for="studentSchoolYear">School Year</label>
						<input name="school_year" type="text" class="form-control" id="studentSchoolYear" value="{{ old('school_year')  ?? $student->school_year }}">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label for="studentSemester">Semester</label>
						<input name="semester" type="number" class="form-control" id="studentSemester" value="{{ old('semester')  ?? $student->semester }}">
					</div>
				</div>

				{{-- <div class="col-lg-6">
					<div class="form-group">
						<label>&nbsp;</label>
						  <div class="custom-file">
						    <input type="file" class="custom-file-input" id="customFile" name="profile">
						    <label class="custom-file-label" for="customFile">Student Image</label>
						  </div>
					</div>
				</div> --}}

				<div class="col-lg-6">
					<div class="form-group">
						<label for="studentNewPassword">New password <small class="font-weight-bold text-primary">(optional)</small></label>
						<input name="password" type="password" class="form-control" id="studentNewPassword">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label for="studentRetypePassword">Re-type new password</label>
						<input name="password_confirmation" type="password" class="form-control" id="studentRetypePassword">
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="float-right">
		<input type="submit" value="Update Student Information" class="btn btn-success font-weight-bold">
	</div>
</form>
@push('page-scripts')
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  let fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

@endpush
@endsection