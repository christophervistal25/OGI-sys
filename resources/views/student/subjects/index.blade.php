@extends('student.layouts.dashboard-template')
@section('title','List of your subjects')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
<div class="row">
	<div class="col-lg-4 ml-2">
		<p class="font-weight-bold text-primary"><span class="text-dark">Name : </span>({{ Auth::user()->id_number }}) {{ Auth::user()->name }}</p>
		<p class="font-weight-bold text-primary"><span class="text-dark">Course : </span>{{ Auth::user()->course->abbr }} {{ $studentLevel }}</p>
	</div>
</div>
<hr>
<div class="text-right">
	<div class="fixed-bottom mb-4 mr-5">
		<button title="Print Grades" data-toggle="modal" data-target="#printGradeModal" class="btn btn-primary shadow"><i class="fas fa-print"></i> Print</button>
	</div>
</div>
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
					<td class="text-center font-weight-bold"> {{ (number_format($items->pivot->remarks, 1) == 0.0) ?	'NG' : number_format($items->pivot->remarks, 1) }}</td>
					@php $total_credits += $items->credits @endphp
					@php $total_subjects++ @endphp
					@php $total_rating += $items->pivot->remarks @endphp
					@php $total_weighted += $items->pivot->remarks * $items->credits @endphp
					<td class="text-center"> {{ number_format($items->credits, 1) }}</td>
					@if(number_format($items->pivot->remarks, 1) == 0.0)
						<td class="text-center font-weight-bold text-danger">NO GRADE</td>
					@else
						<td class="text-center font-weight-bold text-{{ ($items->pivot->remarks > 3.0 ) ? 'danger' : 'primary' }}"> {{ ($items->pivot->remarks > 3.0 ) ? 'FAILED' : 'PASSED' }}</td>
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
					<td class="text-right font-weight-bold">TOTAL RATING > > ></td>
					<td class="text-center font-weight-bold">{{ number_format($total_rating / $total_subjects, 2) }}</td>
				</tr>
			</tbody>
		</table>
		@endforeach
	</div>
</div>
@endforeach

<!-- Print Grade Modal-->
<div class="modal fade" id="printGradeModal" tabindex="-1" role="dialog" aria-labelledby="studentPrintGrade" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="studentPrintGrade">Print grade</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<form autocomplete="off" method="POST" action="{{ route('student.subjects.print') }}">
			@csrf
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="fromYear">From year : </label>
							<select name="from_year" id="fromYear" required class="form-control">
							  <option value="" disabled selected hidden>From year</option>
							  <option value="1">1</option>
							  <option value="2">2</option>
							  <option value="3">3</option>
							  <option value="4">4</option>
							  <option value="5">5</option>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="toYear">To year : </label>
							<select name="to_year" id="toYear" required class="form-control">
							  <option value="" disabled selected hidden>To year</option>
							  <option value="1">1</option>
							  <option value="2">2</option>
							  <option value="3">3</option>
							  <option value="4">4</option>
							  <option value="5">5</option>
							</select>
						</div>
					</div>

					<div class="col-lg-12">
						<label for="semesters">Semester : <small class="text-primary font-weight-bold">Press CTRL for multiple select</small></label>
					    <select multiple required name="semesters[]" class="form-control" id="semesters">
					      <option value="1">1</option>
					      <option value="2">2</option>
					      <option value="3">3</option>
					    </select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" type="submit">Print</button>
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
			</form>
			</div>
		</div>
	</div>
</div>
@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>
@endpush
@endsection