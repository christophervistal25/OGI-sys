@extends('admin.layouts.dashboard-template')
@section('title','List of course')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endprepend
<div class="card shadow mb-4 rounded-0">
	<div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-bold text-primary">Course</h6>
	</div>

	<div class="card-body">
		<button id='btnDisplayCourseModal' class="btn btn-primary mb-3 text-center text-white  float-right">
            <i class="fa fa-plus"></i> Add Course
        </button>
		<div class="clearfix"></div>
		<table class="table table-bordered table-hover" id="courses-table">
			<thead>
				<tr>
					<th class='text-uppercase'>Description</th>
					<th class='text-uppercase'>Short name</th>
					<th class='text-uppercase'>Department</th>
					<th class='text-uppercase text-center'>Action</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<!-- EDIT COURSE MODAL -->
<div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog" aria-labelledby="editCourseModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCourseModalLabel">Edit Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="modalFormEditCourse">
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-lg-12">
	      			<div class="form-group">
	      				<label for="courseName">Course Name :</label>
	      				<input type="text" name="name" id="courseName" class="form-control">
                        <span class='text-danger' id='courseNameError'></span>
	      			</div>
	      		</div>

	      		<div class="col-lg-12">
	      			<div class="form-group">
	      				<label for="courseShortname">Short Name :</label>
	      				<input type="text" name="abbr" id="courseShortname" class="form-control">
                        <span class='text-danger' id='courseShortnameError'></span>
	      			</div>
	      		</div>
				
				<div class="col-lg-12">
	      			<div class="form-group">
	      				<label for="department">Department :</label>
	      				<select name="department_id" id="department" class="form-control">
		      				@foreach($departments as $department)
		      					<option value="{{$department->id}}">{{ $department->name }}</option>
		      				@endforeach
	      				</select>
                        <span class='text-danger' id='departmentError'></span>
	      			</div>
	      		</div>

	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary" id='btnSaveCourse'>Save changes</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<!-- ADD COURSE MODAL -->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCourseModalLabel">Add Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="modalFormAddCourse">
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-lg-12">
	      			<div class="form-group">
	      				<label for="addCourseName">Course Name :</label>
	      				<input type="text" name="name" id="addCourseName" class="form-control">
                        <span class='text-danger' id='addCourseNameError'></span>
	      			</div>
	      		</div>

	      		<div class="col-lg-12">
	      			<div class="form-group">
	      				<label for="addCourseShortname">Short Name :</label>
	      				<input type="text" name="abbr" id="addCourseShortname" class="form-control">
                        <span class='text-danger' id='addCourseShortnameError'></span>
	      			</div>
	      		</div>
				
				<div class="col-lg-12">
	      			<div class="form-group">
	      				<label for="department">Department :</label>
	      				<select name="department_id" id="addCourseDepartment" class="form-control">
		      				@foreach($departments as $department)
		      					<option value="{{$department->id}}">{{ $department->name }}</option>
		      				@endforeach
	      				</select>
                        <span class='text-danger' id='addCourseDepartmentError'></span>
	      			</div>
	      		</div>

	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary" id="btnAddCourse">Add course</button>
	      </div>
      </form>
    </div>
  </div>
</div>
@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
	$.ajaxSetup({
	    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
	});
</script>
<script>
	let courseId = 0;

	$('#courses-table').DataTable({
	    orderCellsTop: true,
	    serverSide: true,
	    processing: true,
	    responsive: true,
        language: {
            processing: '<i class="text-primary fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span> ',
        },
	    ajax: '/admin/course/list',
	    columns: [
	        { name: 'name' },
	        { name: 'abbr' },
	        { 
                name: 'department.name',
                searchable : true,
                orderable : false 
            },
	        { 
                name: 'action',
                searchable: false,
                orderable : false, 
            },
	    ],
	});

    $('#btnAddCourse').click(function (e) {
        e.preventDefault();
        // Send a ajax request
        $.ajax({
            url: '/admin/course',
            type: 'POST',
            data: $('#modalFormAddCourse').serialize(),
            success: function (data) {
                $('#addCourseModal').modal('hide');
                $('#courses-table').DataTable().ajax.reload(null, false);
                // Display sweet alert message for success
                swal({
                    title: 'Success',
                    text: 'Course added successfully',
                    icon: 'success',
                    buttons :false,
                    timer : 5000,
                });
            },
            error : function (response) {
                if(response.status == 422) {
                    let errors = response.responseJSON.errors;
                    if(errors.name) {
                        $('#addCourseName').addClass('is-invalid');
                        $('#addCourseNameError').html(errors.name[0]);
                    }
                    if(errors.abbr) {
                        $('#addCourseShortname').addClass('is-invalid');
                        $('#addCourseShortnameError').html(errors.abbr[0]);
                    }
                    if(errors.department_id) {
                        $('#addCourseDepartment').addClass('is-invalid');
                        $('#addCourseDepartmentError').html(errors.department_id[0]);
                    }
                }
            }
        });
    });
    
    $('#btnDisplayCourseModal').click(function () {
        // Reset the form
        $('#modalFormAddCourse').trigger('reset');
        // Remove all is-invalid class inside of modalFormAddCourse
        $('#modalFormAddCourse .form-control').removeClass('is-invalid');
        // Remove all text-danger class inside of modalFormAddCourse
        $('#modalFormAddCourse .text-danger').html('');
        // Display add course modal
        $('#addCourseModal').modal('show');
    });

    $(document).on('click', '.btn-edit-course', function () {
        // Remove all is-invalid class inside of modalFormAddCourse
        $('#modalFormEditCourse .form-control').removeClass('is-invalid');

        // Remove all text-danger class inside of modalFormEditCourse
        $('#modalFormEditCourse .text-danger').html('');

        // Get the course id by the data-id attribute
        courseId = $(this).data('key');
        
        // Set html content of button to an spinner
        $(this).html('<i class="fa fa-spinner fa-spin"></i>');

        // Fetch record using course ID
        $.ajax({
            url: '/admin/course/' + courseId,
            success: function (data) {
                $('#editCourseModal').modal('toggle');
                // Set values to edit modal input fields
                $('#courseName').val(data.name);
                $('#courseShortname').val(data.abbr);
                $('#courseDepartment').val(data.department_id);
                // Get the button using the data-id attribute
                $('.btn-edit-course').html('<i class="fa fa-pen"></i>');
            }
        });
    });

    $('#btnSaveCourse').click(function (e) {
        e.preventDefault();
        // Update course using ajax request
        $.ajax({
            url: '/admin/course/' + courseId,
            type: 'PUT',
            data: {
                id : courseId,
                name: $('#courseName').val(),
                abbr: $('#courseShortname').val(),
                department_id: $('#department').val(),
            },
            success: function (data) {
                // Reload the table
                $('#courses-table').DataTable().ajax.reload(null, false);
                // Close the modal
                $('#editCourseModal').modal('toggle');
                // Display sweetalert message for success
                swal({
                    title: 'Success',
                    text: 'Course updated successfully',
                    icon: 'success',
                    buttons :false,
                    timer : 5000,
                });
            },
            error : function (response) {
                if(response.status == 422) {
                    // Display error message at the bottom of all input fields of edit course modal
                    let errors = response.responseJSON.errors;
                    if(errors.name) {
                        $('#courseName').addClass('is-invalid');
                        $('#courseNameError').html(errors.name[0]);
                    }
                    if(errors.abbr) {
                        $('#courseShortname').addClass('is-invalid');
                        $('#courseShortnameError').html(errors.abbr[0]);
                    }
                    if(errors.department_id) {
                        $('#department').addClass('is-invalid');
                        $('#departmentError').html(errors.department_id[0]);
                    }
                }
            }
        });
    });


    $(document).on('click', '.btn-remove-course', function () {
        // Set the content of this button to a spinner
        $(this).html('<i class="fa fa-spinner fa-spin"></i>');

        // Get the course id by the data-key attribute
        courseId = $(this).data('key');
        // Ask user using sweet alert if he/she is sure to delete the course
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this course!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((isClicked) => {
            if(isClicked) {
                $.ajax({
                    url: '/admin/course/' + courseId,
                    type: 'DELETE',
                    success: function (data) {
                        if(data.success) {
                            // Reload the table
                            $('#courses-table').DataTable().ajax.reload(null, false);
                            $('.btn-remove-course').html('<i class="fa fa-trash"></i>');
                            // Display sweet alert message for success
                            swal({
                                title: 'Success',
                                text: 'Course deleted successfully',
                                icon: 'success',
                                buttons :false,
                                timer : 5000,
                            });
                        }
                    }
                });
            } else {
                $('.btn-remove-course').html('<i class="fa fa-trash"></i>');
            }
        })
        
    });



</script>
@endpush
@endsection