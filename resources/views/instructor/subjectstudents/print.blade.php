<html>
  <head>
    <title>Student Grades</title>
    <style>
     /*@page { margin: 100px 25px; } */
    /*header { position: fixed; top: 0px; left: 0px; right: 0px; height: auto;  }*/
    /*footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }*/
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
    .text-center { text-align:center; }
    .text-right { text-align: right; }
    .font-weight-bold { font-weight: bold; }
    .text-center { text-align :center; }
    /* Create three equal columns that floats next to each other */
    .column {
    float: left;
    width: 60%;
    text-align: center;
    }
    .img-header {
    position:absolute;
    left : 60%;
    top : 2%;
    }
    /* Clear floats after the columns */
    .row:after {
    display: table;
    clear: both;
    }
    table > thead {
    border-top : 1px solid black;
    border-bottom : 1px solid black;
    }
    </style>
  </head>
  <body>
    <main>
       <center>
      <h4>
        ANDRES SORIANO COLLEGES OF BISLIG 
        <span style="font-size: 17px;">
          <br>Mangagoy, Bislig City
        </span>
        <span style="font-size: 17px;">
          <br>SCHOOL YEAR : {{ date('Y') }} - {{ date('Y', strtotime('+1 years')) }}
        </span>
      </h4>
      </center>
      
      {{--       <h3>
      <center>
      GRADE EVALUATION <br>
      <span>
        @php $semester-- @endphp
        {{ addSuffixToLevel($level)  }} Year -
        {{ $semesters[$semester] }} Semester
        {{ date('Y', strtotime($subject->first()->pivot->created_at)) }} - {{ date('Y', strtotime($subject->first()->pivot->created_at . ' +1 year')) }}
      </span>
      </center>
      </h3> --}}
      <span>Department : <b>{{ $subject->department->name }}</b></span>
      <span style='margin-left : 277px;'>Subject : <b>{{ $subject->name }}</b></span>
      <br>
      <span>Semester : <b>{{ addSuffixToLevel($subject->semester) }} Semester</b></span>
      <span style='margin-left : 278px;'>Units : <b>{{ $subject->credits }}</b></span>
      <br>
      <table style='border-collapse : collapse;' width="100%" border='1'>
			<thead>
				<tr>
					<th class='text-center'>NO</th>
					<th class='text-center'>Name</th>
					<th class="text-center">Course</th>
					<th class="text-center">Ratings</th>
					<th class="text-center">Remarks</th>
				</tr>
			</thead>
			<tbody>
				@foreach($students as $student)
				<tr>
					<td>{{ $student->id_number }}</td>
					<td>{{ ucfirst($student->name) }}</td>
					<td class="text-center">{{ $student->course->abbr }}</td>
					@if(number_format($student->subjects[0]->pivot->remarks, 1) == 0.0 ) 
						<td class="text-center {{isset($evaluation->end_date) ? 'studentGradeField' : ''}} text-danger font-weight-bold" {{isset($evaluation->end_date) ? 'contenteditable=true' : ''}} data-student-id="{{ $student->id }}" data-student-subject="{{ $student->subjects[0] }}">NG</td>
						<td class="text-center font-weight-bold">NO GRADE</td>
					@else
						<td class="text-center {{isset($evaluation->end_date) ? 'studentGradeField' : ''}}" {{isset($evaluation->end_date) ? 'contenteditable=true' : ''}} data-student-id="{{ $student->id }}" data-student-subject="{{ $student->subjects[0] }}">
						{{ number_format($student->subjects[0]->pivot->remarks, 1) }}</td>
						<td class="text-center font-weight-bold text-{{ ($student->subjects[0]->pivot->remarks > 3.0 ) ? 'danger' : 'primary' }}"> {{ ($student->subjects[0]->pivot->remarks > 3.0) ? 'FAILED' : 'PASSED' }}</td>
					@endif
					
				</tr>
				@endforeach
			</tbody>
		</table>
    </main>
  </body>
</html>