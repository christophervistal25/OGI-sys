@extends('student.layouts.dashboard-template')
@section('title','List of your subjects')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
<div class="row">
	<div class="col-lg-4 ml-2">
		<p class="font-weight-bold text-primary">Name : ({{ Auth::user()->id_number }}) {{ Auth::user()->name }}</p>
		<p class="font-weight-bold text-primary">Course : {{ Auth::user()->course->abbr }}</p>
	</div>
</div>
<hr>
@foreach($subjects as $level => $year)
<div class="card shadow mb-4 rounded-0">
	@php
		$semesters = ['First' , 'Second', 'Third'];
		$years = ['1st' , '2nd', '3rd', '4th', '5th'];
		$total_credits  = 0; $total_subjetcs = 0; $total_rating = 0;
	@endphp
	<div class="card-header py-3 rounded-0">
		@php $level--; @endphp
		<h6 class="m-0 font-weight-bold text-primary"> {{ $years[$level] }} Year</h6>
	</div>
	<div class="card-body">
		@foreach($year as $semester => $subject)
		@php $semester--; @endphp

		<h6 class="p-2 m-0 font-weight-bold">{{ $semesters[$semester] }} semester</h6>
		
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Course No.</th>
					<th>Description</th>
					<th class="text-center">Rating</th>
					<th class="text-center">Credit</th>
					<th class="text-center">Remarks</th>
					<th class="text-center">Wt.</th>
				</tr>
			</thead>
			@foreach($subject as $items)
			<tbody>
				<tr>
					<td> {{ $items->name }}</td>
					<td> {{ $items->description }}</td>
					<td class="text-center"> {{ number_format($items->pivot->remarks, 1) }}</td>
					@php $total_credits += $items->credits @endphp
					@php $total_subjetcs++ @endphp
					@php $total_rating += $items->pivot->remarks @endphp
					<td class="text-center"> {{ number_format($items->credits, 1) }}</td>
					<td class="text-center font-weight-bold text-{{ ($items->pivot->remarks > 3.0 ) ? 'danger' : 'primary' }}"> {{ ($items->pivot->remarks > 3.0 ) ? 'FAILED' : 'PASSED' }}</td>
					<td></td>
				</tr>
			@endforeach
				<tr>
					<td></td>
					<td class="text-right font-weight-bold">TOTAL > > ></td>
					<td class="text-center"></td>
					<td class="text-center"> {{ number_format($total_credits, 1) }}</td>
					<td class="text-center font-weight-bold"></td>
					<td class="text-center font-weight-bold">WT</td>
				</tr>
				<tr>
					<td></td>
					<td class="text-right font-weight-bold">TOTAL RATING > > ></td>
					<td class="text-center font-weight-bold">{{ number_format($total_rating / $total_subjetcs, 2) }}</td>
				</tr>
			</tbody>
		</table>
		@endforeach
	</div>
</div>
@endforeach
@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>
@endpush
@endsection