<html>
  <head>
    <title>Student Grades</title>
    <style>
     @page { margin: 100px 25px; } 
    header { position: fixed; top: 0px; left: 0px; right: 0px; height: auto;  }
    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
    .text-center { text-align:center; }
    .text-right { text-align: right; }
    .font-weight-bold { font-weight: bold; }
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
    <header>
      <h4>ANDRES SORIANO COLLEGES OF BISLIG <span style="font-size: 17px;"><br>Mangagoy, Bislig City</span></h4>
    </header>
    <br>
    <main>
      @php $index = 0; @endphp
      @foreach($subjects as $level => $year)
      @php
        $semesters = ['1' , '2', '3'];
        $years = ['1st' , '2nd', '3rd', '4th', '5th'];
        $total_credits  = 0; $total_subjects = 0; $total_rating = 0;  $total_weighted = 0;
      @endphp
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
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      @if($index === 0)
      <h4>GRADE EVALUATION</h4>
      <h4>Stundent I.D : {{ $student->id_number }}  <br>Student Name : <span>{{ \Str::title($student->name) }}</span></h4>
      @endif
      <table width="100%" style="border-collapse: collapse; margin-top : 20px;">
        <thead>
          <tr>
            <th>Course No.</th>
            <th>Description</th>
            <th>Rating</th>
            <th>Credit</th>
            <th>Remarks</th>
          </tr>
        </thead>
        <tbody>
          @foreach($year as $student_level => $student_subject)
            <tr>
              <td colspan="5" class='font-weight-bold'>
                <u>{{ addSuffixToLevel($student_subject->first()->semester) }} Semester {{$student_subject[0]->pivot->created_at->format('Y')}}-{{ Carbon\Carbon::parse($student_subject[0]->pivot->created_at)->addYears(1)->format('Y') }} ({{ $student->course->abbr }} {{ $student_subject[0]->level}})</u>
              </td>
            </tr>
            @foreach($student_subject as $items)
                      <tr>
                        <td> {{ $items->name }}</td>
                        <td> {{ $items->description }}</td>
                        <td> {{ number_format($items->pivot->remarks, 1) }}</td>
                        @php $total_credits += $items->credits @endphp
                        @php $total_subjects++ @endphp
                        @php $total_rating += $items->pivot->remarks @endphp
                        @php $total_weighted += $items->pivot->remarks * $items->credits @endphp
                         @if(number_format($items->pivot->remarks, 1) == 0.0)
                          <td class="text-center"></td>
                          <td class="text-center">NG</td>
                         @elseif(number_format($items->pivot->remarks, 1) >= 3.1)
                          <td class="text-center"></td>
                          <td>FAILED</td>
                         @else
                          <td class="text-center"> {{ number_format($items->credits, 1) }}</td>
                          <td class="text-center">PASSED</td>
                        @endif
                      </tr>
           @endforeach
          @endforeach
        </tbody>
      </table>
      @php $index++; @endphp
      @endforeach
    </main>
  </body>
</html>