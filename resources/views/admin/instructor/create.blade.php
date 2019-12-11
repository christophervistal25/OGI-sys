@extends('admin.layouts.dashboard-template')
@section('title','New Instructor')
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
<form method="POST" action="{{ route('instructor.store') }}" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-lg-12">
			<div class="card shadow mb-4 rounded-0">
				<div class="card-header py-3 rounded-0">
					<h6 class="m-0 font-weight-bold text-primary">Instructor Information</h6>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-2">
							<div class="form-group">
								<label for="firstname">Firstname</label>
								<input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter Firstname..." value="{{ old('firstname') }}">
							</div>
						</div>

						<div class="col-lg-2">
							<div class="form-group">
								<label for="middlename">Middlename</label>
								<input type="text" class="form-control" name="middlename" id="middlename" placeholder="Enter Middlename..." value="{{ old('middlename') }}">
							</div>
						</div>

						<div class="col-lg-2">
							<div class="form-group">
								<label for="lastname">Lastname</label>
								<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Lastname..." value="{{ old('lastname') }}">
							</div>
						</div>

						<div class="col-lg-3">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" name="email" id="email" placeholder="Enter Email..." value="{{ old('email') }}">
							</div>
						</div>

						<div class="col-lg-3">
							<div class="form-group">
								<label for="contact">Contact No</label>
								<input type="text" class="form-control" name="contact_no" id="contact" placeholder="Enter Contact No..." value="{{ old('contact_no') }}">
							</div>
						</div>

						<div class="col-lg-3">
							<div class="form-group">
								<label for="studentGender">Gender</label>
								<select name="gender" class="form-control" id="studentGender">
									<option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
									<option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
								</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="studentBirthDate">Birthdate</label>
								<input type="date" class="form-control" value="{{ old('birthdate') }}" name="birthdate" >
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="instructorDepartment">Department</label>
								<select name="department_id" class="form-control" id="instructorDepartment">
									@foreach($departments as $department)
									<option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Profile Picture <span class="text-primary font-weight-bold">(Optional)</span></label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="customFile" name="profile">
									<label class="custom-file-label" for="customFile">Instructor Image</label>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="instructorStatus">Status</label>
								<select name="status" class="form-control" id="instructorStatus">
									<option value="full-time" {{ old('status') == 'full-time' ? 'selected' : '' }}>Full time</option>
									<option value="part-time" {{ old('status') == 'part-time' ? 'selected' : '' }}>Part time</option>
								</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="instructorCivilStatus">Civil Status</label>
								<select name="civil_status" class="form-control" id="instructorCivilStatus">
									<option value="single" {{ old('civil_status') == 'Single' ? 'selected' : '' }}>Single</option>
									<option value="married" {{ old('civil_status') == 'Married' ? 'selected' : '' }}>Married</option>
									<option value="widow" {{ old('civil_status') == 'Widow' ? 'selected' : '' }}>Widow</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" name="password" value="{{ old('password') }}" id="password" placeholder="Enter Your password..." >
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="retypePassword">Re-type password</label>
								<input type="password" class="form-control" value="{{ old('password_confirmation') }}" name="password_confirmation" id="retypePassword" placeholder="Password Confirmation..." >
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="float-right">
		<input type="submit" value="Add Instructor" class="btn btn-primary font-weight-bold">
	</div>
</form>
@endsection