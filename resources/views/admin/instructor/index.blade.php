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
		<a class="btn btn-primary float-right mb-2" href="{{ route('instructor.create') }}">
            <i class='fa fa-plus-circle'></i>
            Add Instructor
        </a>
		<div class="clearfix"></div>
		<table class="table table-bordered table-hover" id="instructors-table">
			<thead>
				<tr>
					<th class='text-uppercase'>ID Number</th>
					<th class='text-uppercase'>Firstname</th>
					<th class='text-uppercase'>Middlename</th>
					<th class='text-uppercase'>Lastname</th>
					<th class='text-uppercase'>Suffix</th>
					<th class='text-uppercase text-center'>Contact #</th>
					<th class='text-uppercase'>Department</th>
					<th class="text-center text-uppercase">Actions</th>
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
          				<div class="col-lg-12">
          					<div class="form-group">
                                <span class="text-dark">
                                    Firstname : 
                                </span>
	          					<input type="text" class="form-control text-uppercase" readonly id="instructorFirstname">
	          				</div>
          				</div>

          				<div class="col-lg-12">
          					<div class="form-group">
                                <span class="text-dark">
                                    Middlename : 
                                </span>
	          					<input type="text" class="form-control text-uppercase" readonly id="instructorMiddlename">
	          				</div>
          				</div>


          				<div class="col-lg-12">
          					<div class="form-group">
          						<span class="text-dark">
                                    Lastname : 
                                </span>
	          					<input type="text" class="form-control text-uppercase" readonly id="instructorLastname">
	          				</div>
          				</div>

          				<div class="col-lg-12">
          					<div class="form-group">
          						<span class="text-dark">
                                    Email : 
                                </span>
	          					<input type="text" class="form-control" readonly id="instructorEmail">
	          				</div>
          				</div>

          				<div class="col-lg-6">
          					<div class="form-group">
          						<span class="text-dark">
                                    Contact No : 
                                </span>
	          					<input type="text" class="form-control" readonly id="instructorContactNo">
	          				</div>
          				</div>

          				<div class="col-lg-6">
          					<div class="form-group">
          						<span class="text-dark">
                                    Civil Status : 
                                </span>
	          					<input type="text" class="form-control text-capitalize" readonly id="instructorCivilStatus">
	          				</div>
          				</div>

          				<div class="col-lg-6">
          					<div class="form-group">
                                <span class="text-dark">Status : </span>
	          					<input type="text" class="form-control text-capitalize" readonly id="instructorStatus">
	          				</div>
          				</div>

          				<div class="col-lg-6">
          					<div class="form-group">
                                <span class='text-dark'>Gender : </span>
	          					<input type="text" class="form-control text-capitalize" readonly id="instructorGender">
	          				</div>
          				</div>

          				<div class="col-lg-6">
          					<div class="form-group">
          						<span class='text-dark'>Birthdate : </span>
	          					<input type="text" class="form-control" readonly id="instructorBirthdate">
	          				</div>
          				</div>

          				<div class="col-lg-6">
          					<div class="form-group">
          						<span class='text-dark'>Department : </span>
	          					<input type="text" class="form-control" readonly id="instructorDepartment">
	          				</div>
          				</div>

          				<div class="col-lg-12">
          					<div class="form-group">
          						Date Registered : 
	          					<input type="text" class="form-control" readonly id="instructorDateRegistered">
	          				</div>
          				</div>

          			</div>
          		</div>
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
            { 
                name: 'id_number', 
                className : 'text-uppercase'
            },
            { 
                name: 'firstname',
                className : 'text-uppercase'
            },
            { 
                name: 'middlename',
                className : 'text-uppercase'
            },
            { 
                name: 'lastname',
                className : 'text-uppercase'
            },
            { 
                name: 'suffix',
                className : 'text-uppercase text-center'
            },
            { 
                name: 'contact_no',
                className : 'text-center',
            },
            { 
                name: 'department.short_name',
                className : 'text-center'
            },
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
				$('#instructorFirstname').val(instructor.firstname);
				$('#instructorMiddlename').val(instructor.middlename);
				$('#instructorLastname').val(instructor.lastname);
				$('#instructorGender').val(instructor.gender);
				$('#instructorBirthdate').val(instructor.birthdate);
				$('#instructorDepartment').val(instructor.department?.name || '');
				$('#instructorEmail').val(instructor.email);
				$('#instructorContactNo').val(instructor.contact_no);
				$('#instructorCivilStatus').val(instructor.civil_status);
				$('#instructorStatus').val(instructor.status);
				$('#instructorDateRegistered').val(instructor.created_at);
				$('#profileContainer').removeClass('d-none');
			}
		});
	};

</script>
@endpush
@endsection