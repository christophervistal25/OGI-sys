<div class="text-center">
	<a href="{{ route('student.edit', [$student]) }}" class="btn btn-success btn-sm text-center mr-3"><i class="fa fa-edit"></i></a>
	<button class="btn btn-info btn-sm btn-white text-center text-white" onclick="printGrade(this)" data-student-id="{{$student->id}}"><i class="fa fa-print" style="pointer-events: none;"></i></button>
</div>
