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
						<div class="col-lg-6">
							<div class="form-group">
								<label for="fullName">Fullname</label>
								<input type="text" class="form-control" name="name" id="fullName" placeholder="Enter Fullname..." value="{{ old('name') ?? $instructor->name }}">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentGender" >Gender</label>
								<select name="gender" class="form-control" id="studentGender">
									<option value="male" {{ (old('gender') == 'male') ? 'selected' : ($instructor->gender === 'male' ? 'selected' : '') }}>Male</option>
									<option value="female" {{ (old('gender') == 'female') ? 'selected' : ($instructor->gender === 'female' ? 'selected' : '') }}>Female</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentBirthDate">Birthdate</label>
								<input type="date" class="form-control" name="birthdate" value="{{ old('birthdate') ?? $instructor->birthdate }}">
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