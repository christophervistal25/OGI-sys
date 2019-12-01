@extends('hr.layouts.dashboard-template')
@section('title','Update your information')
@section('content')
<div class="row">
	<div class="col-lg-12 mb-2">
		@if(\Session::has('success'))
			@include('templates.success')
		@else
			@include('templates.error')
		@endif
	</div>

</div>
<form method="POST" action="{{ route('hr.update', [Auth::user()->id]) }}" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<div class="card shadow mb-4 rounded-0">
		<div class="card-header py-3 rounded-0">
			<h6 class="m-0 font-weight-bold text-primary">Informations</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12">
					<div class="form-group">
						<label for="adminFullname">Fullname</label>
						<input type="text" class="form-control" name="name" id="adminFullname" value="{{ Auth::user()->name }}">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label for="adminNewPassword">New Password <span class="text-primary font-weight-bold">(Fill this if you fill the new password field)</label>
						<input type="password" class="form-control" name="password" id="adminNewPassword" >
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label for="adminPasswordConfirmation">Re-type new password </label>
						<input type="password" class="form-control" name="password_confirmation" id="adminPasswordConfirmation" >
					</div>
				</div>

				<div class="col-lg-12">
					<div class="form-group">
						<label>Profile Picture <span class="text-primary font-weight-bold">(Optional)</span></label>
						  <div class="custom-file">
						    <input type="file" class="custom-file-input" id="customFile" name="profile">
						    <label class="custom-file-label" for="customFile">Choose a file</label>
						  </div>
					</div>
				</div>
					
			</div>
		</div>
	</div>

	<div class="float-right">
		<input type="submit" value="Update" class="btn btn-success font-weight-bold">
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