@extends('admin.layouts.dashboard-template')
@section('title','')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
<div class="card shadow mb-4 rounded-0">
	<div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-bold text-primary">List of all schedules</h6>
	</div>

	<div class="card-body">
		<a class="btn btn-primary btn-sm mb-2 text-center text-white  float-right font-weight-bold" href="{{ route('view-grade.control')  }}"><i class="fa fa-plus"></i> Add new schedule</a>
		<div class="clearfix"></div>
		<table class="table table-bordered table-hover" id="evaluations-table">
			<thead>
				<tr>
					<th class='text-center'>Start Date</th>
					<th class='text-center'>End Date</th>
					<th class='text-center'>Duration</th>
					<th class='text-center'>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($evaluations as $evaluation)
					<tr>
						<td class='text-center text-primary font-weight-bold'>{{ $evaluation->start_date->format('F d, Y') }}</td>
						<td class='text-center text-primary font-weight-bold'>{{ $evaluation->end_date->format('F d, Y') }}</td>
						@php $duration = $evaluation->start_date->diffInDays($evaluation->end_date) @endphp
						<td class='text-center text-primary font-weight-bold'>{{ $duration }} {{ ($duration > 1) ? 'Days' : 'Day' }}</td>
						<td class='text-center'>
							<a href='{{ route('view-grade.control.edit', [$evaluation]) }}' class='btn btn-sm btn-success'><i class='fa fa-edit'></i></a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>
@endpush
@endsection