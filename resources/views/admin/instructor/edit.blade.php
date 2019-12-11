@extends('admin.layouts.dashboard-template')
@section('title','Edit Instructor')
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
<form method="POST" action="{{ route('instructor.update', [$instructor]) }}" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<div class="row">
		<div class="col-lg-12">
			<div class="card shadow mb-4 rounded-0">
				<div class="card-header py-3 rounded-0">
					<h6 class="m-0 font-weight-bold text-primary">{{ $instructor->name }} Information</h6>
				</div>
				<div class="card-body">
					<div class="row">
						<input type="hidden" name="id" value="{{$instructor->id}}">
						<div class="col-lg-2">
							<div class="form-group">
								<label for="firstname">Firstname</label>
								<input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter Firstname..." value="{{ old('firstname') ?? $instructor->firstname }}">
							</div>
						</div>

						<div class="col-lg-2">
							<div class="form-group">
								<label for="middlename">Middlename</label>
								<input type="text" class="form-control" name="middlename" id="middlename" placeholder="Enter Middlename..." value="{{ old('middlename') ?? $instructor->middlename }}">
							</div>
						</div>


						<div class="col-lg-2">
							<div class="form-group">
								<label for="lastname">Lastname</label>
								<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Lastname..." value="{{ old('lastname') ?? $instructor->lastname }}">
							</div>
						</div>

						<div class="col-lg-3">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" name="email" id="email" placeholder="Enter Email..." value="{{ old('email') ?? $instructor->email }}">
							</div>
						</div>

						<div class="col-lg-3">
							<div class="form-group">
								<label for="contact_no">Contact No</label>
								<input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="Enter Contact No..." value="{{ old('contact_no') ?? $instructor->contact_no }}">
							</div>
						</div>

						<div class="col-lg-3">
							<div class="form-group">
								<label for="studentGender" >Gender</label>
								<select name="gender" class="form-control" id="studentGender">
									<option value="male" {{ (old('gender') == 'male') ? 'selected' : ($instructor->gender === 'male' ? 'selected' : '') }}>Male</option>
									<option value="female" {{ (old('gender') == 'female') ? 'selected' : ($instructor->gender === 'female' ? 'selected' : '') }}>Female</option>
								</select>
							</div>
						</div>


						<div class="col-lg-3">
							<div class="form-group">
								<label for="studentBirthDate">Birthdate</label>
								<input type="date" class="form-control" name="birthdate" value="{{ old('birthdate') ?? $instructor->birthdate }}">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="department" >Department</label>
								<select name="department_id" class="form-control" id="department">
									@foreach($departments as $department)
										<option value="{{ $department->id }}" {{ (old('department_id') == $instructor->department->id ) ? 'selected' : ($instructor->department->id === $department->id ? 'selected' : '') }}>{{ $department->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label>Profile Picture <span class="text-primary font-weight-bold">(Optional)</span></label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="customFile" name="profile">
									<label class="custom-file-label" for="customFile">New profile image</label>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="instructorStatus">Status</label>
								<select name="status" class="form-control" id="instructorStatus">
									<option value="full-time" {{ (old('status') == 'full-time') ? 'selected' : ($instructor->status === 'full-time' ? 'selected' : '') }}>Full time</option>
									<option value="part-time" {{ (old('status') == 'part-time') ? 'selected' : ($instructor->status === 'part-time' ? 'selected' : '') }}>Part time</option>
								</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="instructorCivilStatus">Civil Status</label>
								<select name="civil_status" class="form-control" id="instructorCivilStatus">
									<option value="single" {{ (old('civil_status') == 'single') ? 'selected' : ($instructor->civil_status === 'single' ? 'selected' : '') }}>Single</option>
									<option value="married" {{ (old('civil_status') == 'married') ? 'selected' : ($instructor->civil_status === 'married' ? 'selected' : '') }}>Married</option>
									<option value="widow" {{ (old('civil_status') == 'widow') ? 'selected' : ($instructor->civil_status === 'widow' ? 'selected' : '') }}>Widow</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="password">New password <span class="text-primary font-weight-bold">(Optional)</span></label>
								<input type="password" class="form-control" name="password" id="password" placeholder="Enter Your password..." value="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="reTypePassword">Re-type new password <span class="text-primary font-weight-bold">(Fill this if you fill the new password field)</span></label>
								<input type="password" class="form-control" name="password_confirmation" id="reTypePassword" placeholder="Password Confirmation..." value="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="float-right">
		<input type="submit" value="Update Instructor" class="btn btn-success font-weight-bold">
	</div>
</form>
@endsection