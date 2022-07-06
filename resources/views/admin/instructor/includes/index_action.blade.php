<div class="text-center">
	{{-- <a href="{{ route('instructorsubjects.show', [$instructor] ) }}" class="btn btn-primary btn-sm btn-white text-center text-white mr-3"><i class="fa fa-book"></i> Subjects</a> --}}
	<a href="{{ route('instructor.edit', [$instructor->id]) }}" class="btn btn-success btn-sm text-center mr-3 rounded-circle shadow">
        <i class="fa fa-pen"></i>
     </a>
	{{-- <a style="cursor:pointer;" onclick="inActiveInstructor('{{$instructor->id}}')" class="btn btn-danger btn-sm btn-white text-center text-white  mr-3"><i class="fa fa-trash" ></i> In-active</a> --}}
</div>
