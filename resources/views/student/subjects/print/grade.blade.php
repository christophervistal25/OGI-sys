<html>
<head>
  <title>Student Grades</title>
  <style>
    /* @page { margin: 100px 25px; } */
    header { position: fixed; top: 0px; left: 0px; right: 0px; height: auto; }
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
  </style>
</head>
<body>
  <header>
  </header>
  <main>
    @php $index = 0; @endphp
@foreach($subjects as $level => $year)
    @foreach($year as $semester => $subject)
    @php
      $semesters = ['First' , 'Second', 'Third'];
      $years = ['1st' , '2nd', '3rd', '4th', '5th'];
      $total_credits  = 0; $total_subjects = 0; $total_rating = 0;  $total_weighted = 0;
    @endphp
      <div class="row">
        <div class="column" style="width : 20%;">
         <img class="img-header" src="https://res.cloudinary.com/dpcxcsdiw/image/upload/w_60,h_60/v1569386717/ogi-sys/andres-soriano-logo.png">
        </div>
        <div class="column">
          <h3><center>ANDRES SORIANO COLLEGES OF BISLIG</center> <span style="font-size: 17px;"><center>Mangagoy, Bislig City</center></span></h3>
        </div>
      </div>
      <h3>
        <center>
          GRADE EVALUATION <br> 
            <span>
              @php $semester-- @endphp
              {{ addSuffixToLevel($level)  }} Year - 
              {{ $semesters[$semester] }} Semester
              {{ date('Y', strtotime($subject->first()->pivot->created_at)) }} - {{ date('Y', strtotime($subject->first()->pivot->created_at . ' +1 year')) }}
            </span>
        </center>
      </h3>
        @if($index === 0)
          <h4>Name : ({{ $student->id_number }}) {{ $student->name }} <br>Course : {{ $student->course->abbr }} - {{ $studentLevel }}</h4>
        @endif
     
              <table border="1" width="100%" style="border-collapse: collapse;">
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
                          <td class="text-center">{{ number_format($items->pivot->remarks * $items->credits, 1) }}</td>
                         @elseif(number_format($items->pivot->remarks, 1) >= 3.1)
                          <td class="text-center"></td>
                          <td>FAILED</td>
                          <td class="text-center">0</td>
                          {{-- <td class="text-center">{{ number_format($items->pivot->remarks * $items->credits, 1) }}</td> --}}
                         @else
                          <td class="text-center"> {{ number_format($items->credits, 1) }}</td>
                          <td class="text-center">PASSED</td>
                          <td class="text-center">{{ number_format($items->pivot->remarks * $items->credits, 1) }}</td>
                    @endif
                    
                  </tr>
                  @endforeach
                  <tr>
                    <td></td>
                    <td class="text-right font-weight-bold">TOTAL > > >&nbsp;</td>
                    <td class="text-center"></td>
                    <td class="text-center font-weight-bold"> {{ number_format($total_credits, 1) }}</td>
                    <td class="text-center font-weight-bold"></td>
                    <td class="text-center font-weight-bold">{{ number_format($total_weighted, 1)}}</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td class="text-right font-weight-bold">WEIGHTED AVERAGE > > >&nbsp;</td>
                    <td class="text-center font-weight-bold">{{ number_format($total_rating / $total_subjects, 2) }}</td>
                    <td colspan="3" style="border: 1px solid white;"></td>
                  </tr>
                </tbody>
              </table>
              <span>Not valid when printed without authorized signatures</span>
            {{-- This P tag represents new page --}}
            <p></p>
            @php $index++; @endphp
          @endforeach
      @endforeach
  </main>
</body>
</html>