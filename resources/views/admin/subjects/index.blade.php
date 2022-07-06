@extends('admin.layouts.dashboard-template')
@section('title','List of subject')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endprepend
<div class="card shadow mb-4 rounded-0">
	<div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-medium text-primary">Subjects</h6>
	</div>
	<div class="card-body">
		<a class="btn btn-primary float-right mb-2" href="{{ route('subject.create') }}">Add Subject</a>
		<div class="clearfix"></div>
		<table class="table table-bordered table-hover" id="subjects-table">
			<thead>
				<tr>
					<th class='text-uppercase'>Course No</th>
					<th class='text-uppercase'>Description</th>
					<th class='text-uppercase'>Year level</th>
					<th class='text-uppercase'>Units</th>
					<th class='text-uppercase'>Semester</th>
					<th class='text-uppercase'>School year</th>
					<th class='text-uppercase'>Department</th>
					<th class="text-center text-uppercase">Action</th>
				</tr>
			</thead>
		</table>
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
	let table = $('#subjects-table').DataTable({
	    orderCellsTop: true,
	    serverSide: true,
	    processing: true,
	    responsive: true,
	    ajax: '/admin/subject/list',
	    columns: [
	        { name: 'name' },
	        { name: 'description' },
	        { name: 'level', className : 'text-center' },
	        { name: 'credits', className : 'text-center' },
	        { name: 'semester', className : 'text-center' },
	        { name: 'school_year', className : 'text-center' },
	        { name: 'department.name' },
	        { name: 'action' , searchable : false,},
	    ],
	});

    $(document).on('click', '.btn-remove-subject', function () {
        // Change the content of this button to a loader
        $(this).html('<i class="fa fa-spinner fa-spin"></i>');
        // Get the value of data-id attribute
        let id = $(this).attr('data-id');
        // Using sweetalert v1 prompt a message to the user if she/he wants to run a scan first before deleting the record
        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            dangerMode : true,
            buttons : ["No", "Yes delete it!"],
        }).then((result) => {
            if (result) {
                // If the user clicks on the OK button, send the id of the record to the delete method
                $.ajax({
                    url: "{{ route('subject.destroy', ':id') }}".replace(':id', id),
                    type: 'DELETE',
                    success: function (response) {
                        // If the response is successful, reload the page
                        if (response.success) {
                            // Reload the datatables
                            table.ajax.reload(null, false);

                            // Display sweet alert for success
                            swal({
                                title: "Deleted!",
                                text: "Subject has been deleted successfully.",
                                icon: "success",
                                buttons : false,
                                timer : 5000,
                            });

                            // Revert the button to its original html content
                            $('.btn-remove-subject').html('<i class="fa fa-trash"></i>');
                        }
                    }
                });
            } else {
                $('.btn-remove-subject').html('<i class="fa fa-trash"></i>');
            }
        });
    });

</script>
@endpush
@endsection