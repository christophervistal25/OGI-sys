@extends('admin.layouts.dashboard-template')
@section('title','Departments')
@section('content')
@prepend('page-css')
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
<button class="btn btn-primary mb-2 text-center text-white  float-right font-weight-medium" id="btnAddDepartment">
    <i class="fa fa-plus-circle" style="pointer-events:none;"></i> 
    Add Department
</button>
<div class="clearfix"></div>
<div class="card shadow-none rounded-0">
    <div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-bold text-primary">Departments</h6>
	</div>
    <div class="card-body">
        
        <div class="clearfix"></div>
        <table class="table table-bordered table-hover" id="departments-table" width="100%">
            <thead>
                <tr>
                    <th class='text-uppercase'>Department Code</th>
                    <th class='text-uppercase'>Name</th>
                    <th class='text-uppercase'>Shortname</th>
                    <th class='text-uppercase'>Department Head</th>
                    <th class='text-uppercase'>Department Head Position</th>
                    <th class='text-center text-uppercase'>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal for adding new department -->
<div class="modal fade" id="addDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="addDepartmentModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Create Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="addNewDepartmentForm">
            <div class="form-group">
                <label for="departmentCode" class='text-dark'>Department Code: </label>
                <input type="text" class='form-control' id="departmentCode" name="departmentCode">
                <span id='departmentCodeError' class='text-danger'></span>
            </div>

            <div class="form-group">
                <label for="departmentName" class='text-dark'>Department Name: </label>
                <input type="text" class='form-control' id="departmentName" name="departmentName">
                <span id='departmentNameError' class='text-danger'></span>
            </div>
            
            <div class="form-group">
                <label for="departmentShortname" class='text-dark'>Department Short name: </label>
                <input type="text" class='form-control' id="departmentShortname" name="departmentShortname">
                <span id='departmentShortnameError' class='text-danger'></span>
            </div>
            
            <div class="form-group">
                <label for="departmentHead" class='text-dark'>Department Head: </label>
                <input type="text" class='form-control' id="departmentHead" name="departmentHead">
                <span id='departmentHeadError' class='text-danger'></span>
            </div>

            <div class="form-group">
                <label for="departmentHeadPosition" class='text-dark'>Department Head Position: </label>
                <input type="text" class='form-control' id="departmentHeadPosition" name="departmentHeadPosition">
                <span id='departmentHeadPositionError' class='text-danger'></span>
            </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnAddNewDepartment">Submit Department</button>
      </div>
    </div>
  </div>
</div>


{{-- Modal for edit a department --}}
<div class="modal fade" id="editDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="editDepartmentModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Edit Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="editDepartmentForm">
            <div class="form-group">
                <label for="editDepartmentCode" class='text-dark'>Department Code: </label>
                <input type="text" class='form-control' id="editDepartmentCode" name="editDepartmentCode">
                <span id='editDepartmentCodeError' class='text-danger'></span>
            </div>

            <div class="form-group">
                <label for="editDepartmentName" class='text-dark'>Department Name: </label>
                <input type="text" class='form-control' id="editDepartmentName" name="editDepartmentName">
                <span id='editDepartmentNameError' class='text-danger'></span>
            </div>
            
            <div class="form-group">
                <label for="editDepartmentShortname" class='text-dark'>Department Short name: </label>
                <input type="text" class='form-control' id="editDepartmentShortname" name="editDepartmentShortname">
                <span id='editDepartmentShortnameError' class='text-danger'></span>
            </div>
            
            <div class="form-group">
                <label for="editDepartmentHead" class='text-dark'>Department Head: </label>
                <input type="text" class='form-control' id="editDepartmentHead" name="editDepartmentHead">
                <span id='editDepartmentHeadError' class='text-danger'></span>
            </div>

            <div class="form-group">
                <label for="editDepartmentHeadPosition" class='text-dark'>Department Head Position: </label>
                <input type="text" class='form-control' id="editDepartmentHeadPosition" name="editDepartmentHeadPosition">
                <span id='editDepartmentHeadPositionError' class='text-danger'></span>
            </div>

        </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="btnUpdateDepartment">Update Department</button>
        </div>
    </div>
    </div>
</div>

                
@push('page-scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/jquery.dataTables.min.js">
</script>
<script
    src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.js">
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#departments-table').DataTable({
        orderCellsTop: true,
        serverSide: true,
        processing: true,
        responsive: true,
        language: {
            processing: '<i class="text-primary fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span> ',
        },
        ajax: '/admin/department/list',
        columns: [
            {
                name: 'department_code',
                className : 'text-center',
            },
            {
                name: 'name',
                className : 'text-truncate',
                render : function (data) {
                    return data.toUpperCase();
                }
            },
            {
                name: 'short_name',
                className : 'text-center',
            },
            {
                name: 'department_head',
            },
            {
                name: 'department_head_position',
            },
            {
                name: 'action',
                orderable : false,
                searchable: false
            },
        ],
    });


    $('#btnAddDepartment').click(function () {
        $('#addDepartmentModal').modal('toggle');
    });

    $('#btnAddNewDepartment').click(function () {
        // get form data
        let formData = $('#addNewDepartmentForm').serialize();
        
        // Remove the is-invalid class in input fields
        $('#addNewDepartmentForm input').removeClass('is-invalid');
        $('#addNewDepartmentForm span').text('');
        
        
        // send request
        $.ajax({
            url: '/admin/department/',
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.success) {
                    $('#addDepartmentModal').modal('toggle');
                    $('#departments-table').DataTable().ajax.reload();
                    
                    // Display success message
                    swal({
                        title: "Success!",
                        text: "Department created successfully",
                        icon: "success",
                        buttons : false,
                        timer : 5000,
                    });

                    // Clear the form
                    $('#addNewDepartmentForm')[0].reset();
                }
            },
            error : function (response) {
                if(response.status === 422) {
                    let formMessages = Object.values(response.responseJSON.errors);
                    let keys = Object.keys(response.responseJSON.errors);

                    formMessages.forEach((message, key) => {
                        let [m] = message;
                        $('#' + keys[key] + 'Error').text(m);
                        $('#' + keys[key]).addClass('is-invalid');
                    });
                }
            }
        });
    });

    let departmentID = 0;
    $(document).on('click', '.btn-edit-department', function () {
        // Change the content of this button to a spinner
        $(this).html('<i class="fa fa-spinner fa-spin"></i>');

        departmentID = $(this).attr('data-key');

        $.ajax({
            url : '/admin/department/' + departmentID,
            success : function (response) {
                    $('#editDepartmentCode').val(response.data.department_code);
                    $('#editDepartmentName').val(response.data.name);
                    $('#editDepartmentShortname').val(response.data.short_name);
                    $('#editDepartmentHead').val(response.data.department_head);
                    $('#editDepartmentHeadPosition').val(response.data.department_head_position);
                    $('#editDepartmentModal').modal('toggle');
                    $('.btn-edit-department').html('<i class="fa fa-pen"></i>');
                    
            }
        });
    });

    $('#btnUpdateDepartment').click(function () {
        // get form data
        let formData = $('#editDepartmentForm').serialize();
        
        // Remove the is-invalid class in input fields
        $('#editDepartmentForm input').removeClass('is-invalid');
        $('#editDepartmentForm span').text('');
        
        
        // send request
        $.ajax({
            url: '/admin/department/' + departmentID,
            type: 'PUT',
            data: formData,
            success: function (response) {
                if (response.success) {
                    $('#editDepartmentModal').modal('toggle');
                    $('#departments-table').DataTable().ajax.reload();

                    // Display success message
                    swal({
                        title: "Success!",
                        text: "Department updated successfully!",
                        icon: "success",
                        buttons: false,
                        timer: 5000,
                    });

                    // Clear the edit form
                    $('#editDepartmentForm')[0].reset();
                }
            },
            error : function (response) {
                if(response.status === 422) {
                    let formMessages = Object.values(response.responseJSON.errors);
                    let keys = Object.keys(response.responseJSON.errors);

                    formMessages.forEach((message, key) => {
                        let [m] = message;
                        $('#' + keys[key] + 'Error').text(m);
                        $('#' + keys[key]).addClass('is-invalid');
                    });
                }
            }
        });
    });
    
    // Ajax request delete department record
    

    $(document).on('click', '.btn-delete-department', function () {
        // Change the content of this button to a spinner
        $(this).html('<i class="fa fa-spinner fa-spin"></i>');

        // Get the department id in button attribute
        let id = $(this).attr('data-key');
        
        // Display sweet alert for confirmation
        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/admin/department/' + id,
                    type: 'DELETE',
                    success: function (response) {
                        if (response.success) {
                            $('#departments-table').DataTable().ajax.reload();

                            // Display success message
                            swal({
                                title : 'Deleted!',
                                text : 'Department has been deleted.',
                                icon : 'success',
                                buttons : false,
                                timer : 5000,
                            });

                            // Change the content of this button to an trash icon
                            $('.btn-delete-department').html('<i class="fa fa-trash"></i>');
                        }
                    }
                });
            } else {
                $('.btn-delete-department').html('<i class="fa fa-trash"></i>');
            }
        });

    });

</script>
@endpush
@endsection
