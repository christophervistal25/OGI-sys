@extends('admin.layouts.dashboard-template')
@section('title',$student->name . " Subjects Grade")
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
<div class="row">
	<div class="col-lg-4 ml-2">
		<p class="font-weight-bold text-primary"><span class="text-dark">Name : </span>({{ $student->id_number }}) {{ $student->name }}</p>
		<p class="font-weight-bold text-primary"><span class="text-dark">Course : </span>{{ $student->course->abbr }} {{ $studentLevel }}</p>
	</div>
</div>
<hr>
@foreach($subjects as $level => $year)
<div class="card shadow mb-4 rounded-0">
	@php
	$semesters = ['First' , 'Second', 'Third'];
	$years = ['1st' , '2nd', '3rd', '4th', '5th'];
	@endphp
	<div class="card-header py-3 rounded-0">
		@php $level--; @endphp
		<h6 class="m-0 font-weight-bold text-primary"> {{ $years[$level] }} Year</h6>
	</div>
	<div class="card-body">
		@foreach($year as $semester => $subject)
		@php
			$total_credits  = 0; $total_subjects = 0; $total_rating = 0; $total_weighted = 0;
		@endphp
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
					@php $total_subjects++ @endphp
					@php $total_rating += $items->pivot->remarks @endphp
					@php $total_weighted += $items->pivot->remarks * $items->credits @endphp
					@if(number_format($items->pivot->remarks, 1) == 0.0)
                          <td class="text-center"></td>
                          <td class="text-center">NG</td>
                         @elseif(number_format($items->credits, 1) <= 3.1)
                          <td class="text-center"></td>
                          <td>FAILED</td>
                         @else
                          <td class="text-center"> {{ number_format($items->credits, 1) }}</td>
                          <td class="text-center">PASSED</td>
                    @endif
					
					<td class="text-center">{{ number_format($items->pivot->remarks * $items->credits, 1) }}</td>
				</tr>
				@endforeach
				<tr>
					<td></td>
					<td class="text-right font-weight-bold">TOTAL > > ></td>
					<td class="text-center"></td>
					<td class="text-center font-weight-bold"> {{ number_format($total_credits, 1) }}</td>
					<td class="text-center font-weight-bold"></td>
					<td class="text-center font-weight-bold">{{ number_format($total_weighted, 1) }}</td>
				</tr>
				<tr>
					<td></td>
					<td class="text-right font-weight-bold">WEIGHTED AVERAGE > > ></td>
					<td class="text-center font-weight-bold">{{ number_format($total_rating / $total_subjects, 2) }}</td>
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