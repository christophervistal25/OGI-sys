<div class="text-center">
	<a href="{{ route('student.subject.create', [$student]) }}" title="Add Subject" class="btn btn-primary btn-sm text-center mr-3"><i class="fa fa-plus"></i></a>
	<a href="{{ route('student.grade.show', [$student]) }}" title="View grade" class="btn btn-primary btn-sm text-center mr-3"><i class="fa fa-eye"></i></a>
	<a href="{{ route('student.edit', [$student]) }}" title="Student Edit" class="btn btn-success btn-sm text-center mr-3"><i class="fa fa-edit"></i></a>
	<button class="btn btn-info btn-sm btn-white text-center text-white" title="Print Grade" onclick="printGrade(this)" data-student-id="{{$student->id}}"><i class="fa fa-print" style="pointer-events: none;"></i></button>
</div>
