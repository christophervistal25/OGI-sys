@extends('admin.layouts.dashboard-template')
@section('title','List of instructor')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
<div class="card shadow mb-4 rounded-0">
	<div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-bold text-primary">Instructors</h6>
	</div>
	<div class="card-body">
		<table class="table table-bordered table-hover" id="instructors-table">
			<thead>
				<tr>
					<th>ID Number</th>
					<th>Firstname</th>
					<th>Middlename</th>
					<th>Lastname</th>
					<th>Email</th>
					<th>Contact No</th>
				{{-- 	<th>Status</th>
					<th>Civil Status</th>
					<th>Department</th> --}}
					<th>Added on</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

   <!-- Logout Modal-->
    <div class="modal fade" id="instructorProfileModal" tabindex="-1" role="dialog" aria-labelledby="instructorProfile" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-primary" id="instructorProfile">Instructor Profile</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
          		<div class="text-center" id="loader">
          			<div class="spinner-grow text-primary" role="status">
				  		<span class="sr-only">Loading...</span>
					</div>
          		</div>
          		<div id="profileContainer" class="d-none">
          			<div class="text-center">
          				<img src="" alt="Instructor Image" id="instructorProfileImage">
          				<div class="text-center">
          					<p class="text-primary font-weight-bold" id="instructorIdNumber"></p>
          				</div>
          			</div>
          			<br>
          			<div class="row">
          				<div class="col-lg-4">
          					<div class="form-group">
          						First name : 
	          					<input type="text" class="form-control" readonly id="instructorFirstname">
	          				</div>
          				</div>

          				<div class="col-lg-4">
          					<div class="form-group">
          						Middle name : 
	          					<input type="text" class="form-control" readonly id="instructorMiddlename">
	          				</div>
          				</div>


          				<div class="col-lg-4">
          					<div class="form-group">
          						Last name : 
	          					<input type="text" class="form-control" readonly id="instructorLastname">
	          				</div>
          				</div>

          				<div class="col-lg-6">
          					<div class="form-group">
          						Email : 
	          					<input type="text" class="form-control" readonly id="instructorEmail">
	          				</div>
          				</div>

          				<div class="col-lg-6">
          					<div class="form-group">
          						Contact No : 
	          					<input type="text" class="form-control" readonly id="instructorContactNo">
	          				</div>
          				</div>

          				<div class="col-lg-6">
          					<div class="form-group">
          						Civil Status : 
	          					<input type="text" class="form-control" readonly id="instructorCivilStatus">
	          				</div>
          				</div>

          				<div class="col-lg-6">
          					<div class="form-group">
          						Status : 
	          					<input type="text" class="form-control" readonly id="instructorStatus">
	          				</div>
          				</div>

          				<div class="col-lg-6">
          					<div class="form-group">
          						Gender : 
	          					<input type="text" class="form-control" readonly id="instructorGender">
	          				</div>
          				</div>

          				<div class="col-lg-6">
          					<div class="form-group">
          						Birthdate : 
	          					<input type="text" class="form-control" readonly id="instructorBirthdate">
	          				</div>
          				</div>

          				<div class="col-lg-6">
          					<div class="form-group">
          						Department : 
	          					<input type="text" class="form-control" readonly id="instructorDepartment">
	          				</div>
          				</div>

          				<div class="col-lg-6">
          					<div class="form-group">
          						Date Registered : 
	          					<input type="text" class="form-control" readonly id="instructorDateRegistered">
	          				</div>
          				</div>

          			</div>
          		</div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
	$('#instructors-table').DataTable({
    orderCellsTop: true,
    serverSide: true,
    processing: true,
    responsive: true,
    ajax: '/admin/instructor/list',
    columns: [
        { name: 'id_number' },
        { name: 'firstname' },
        { name: 'middlename' },
        { name: 'lastname' },
        { name: 'email' },
        { name: 'contact_no' },
        // { name: 'status' },
        // { name: 'civil_status' },
        // { name: 'department.name' },
        { name: 'created_at' },
        { name: 'action', orderable: false, searchable: false }
    ],
});
</script>
<script>
	$.ajaxSetup({
	    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
	});
	
	String.prototype.capitalize = function() {
    	return this.charAt(0).toUpperCase() + this.slice(1);
	}

	const inActiveInstructor = (instructorId) =>
	{
		let confirmation = confirm('Are you sure you want to mark this instructor as in-active?');
		
		if ( confirmation ) {
			$.ajax({
			   url: `/admin/instructor/${instructorId}`,
			   type: 'DELETE',
			   success: function(response) {
			   		if (response.success) {
			   			$('#instructors-table').DataTable().ajax.reload();
			   		}
			   }
			});
		}
	}

	const viewProfile = (e) => {
		let instructorId = parseInt(e.getAttribute('data-id'));
		$('#instructorProfileModal').modal('toggle');

		$.ajax({
			url : `/admin/instructor/${instructorId}`,
			method : 'GET',
			success : function (instructor) {
				$('#loader').hide();

				$('#instructorProfileImage').attr('src', instructor.profile);
				$('#instructorIdNumber').html(`(ID Number : ${instructor.id_number})`);
				$('#instructorFirstname').val(instructor.firstname.capitalize());
				$('#instructorMiddlename').val(instructor.middlename.capitalize());
				$('#instructorLastname').val(instructor.lastname.capitalize());
				$('#instructorGender').val(instructor.gender.capitalize());
				$('#instructorBirthdate').val(instructor.birthdate);
				$('#instructorDepartment').val(instructor.department.name);
				$('#instructorEmail').val(instructor.email);
				$('#instructorContactNo').val(instructor.contact_no);
				$('#instructorCivilStatus').val(instructor.civil_status.capitalize());
				$('#instructorStatus').val(instructor.status.capitalize());
				$('#instructorDateRegistered').val(instructor.created_at);

				$('#profileContainer').removeClass('d-none');
			}
		});
	};

</script>
@endpush
@endsection