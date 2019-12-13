@extends('admin.layouts.dashboard-template')
@section('title','List of Department')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
<div class="card shadow mb-4 rounded-0">
	<div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-bold text-primary">Departments</h6>
	</div>

	<div class="card-body">
		<button class="btn btn-primary btn-sm mb-2 text-center text-white  float-right font-weight-bold" onclick="addDepartment()"><i class="fa fa-plus"></i> Add Department</button>
		<div class="clearfix"></div>
		<table class="table table-bordered table-hover" id="departments-table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Action</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
	let session = sessionStorage;
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
	    ajax: '/admin/department/list',
	    columns: [
	        { name : 'name' },
	        { name: 'action', searchable :false },
	    ],
	});

	const requestByAjax = (type, route , data) => {
		$.ajax({
			   url: route,
			   type: type,
			   data : data,
			   success: function(response) {
			   		if (response.success) {
			   			$('#departments-table').DataTable().ajax.reload();
			   		}
			   },
			  statusCode : {
			  	422 : function (response) {
			  		let formMessages = Object.values(response.responseJSON.errors);
			  		let messages = "";

			  		formMessages.forEach((message) => {
			  			messages += message[0]  + " ";
			  		});

			  		alert(messages);
			  	}
			  }	
		});
	};

	const addDepartment = () => {
		let departmentName = prompt("Please enter department name:", "");
		if (departmentName.trim() !== null && departmentName.trim() !== "") {
			requestByAjax('POST', '/admin/department', { name : departmentName });
		} else {
			alert('Please enter department name to process your request.');
		}
	};

	const editDepartment = (e) => {
		let departmentInfo = JSON.parse(e.getAttribute('data-src'));

		let departmentName = prompt("Please enter department name:", departmentInfo.name);

		if (departmentName.trim() !== null && departmentName.trim() !== "") {
			requestByAjax('PUT', `/admin/department/${departmentInfo.id}`, {
				name : departmentName,
			});
		} else {
			alert('Please enter department name to process your request.');
		}
	};

	const viewSubjects = (e) => window.location.href = `/admin/subject/${JSON.parse(e.getAttribute('data-src')).id}`;
</script>
@endpush
@endsection