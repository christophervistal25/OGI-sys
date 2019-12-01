<div class="text-center">
	<a href="{{ route('instructorsubjects.show', [$instructor] ) }}" class="btn btn-primary btn-sm btn-white text-center text-white mr-3"><i class="fa fa-book"></i> Subjects <span class="badge badge-secondary">{{ $instructor->subjects->count() }}</span></a>
	<a href="{{ route('instructor.edit', [$instructor]) }}" class="btn btn-success btn-sm text-center mr-3"><i class="fa fa-edit"></i> Edit</a>
	<a style="cursor:pointer;" onclick="inActiveInstructor('{{$instructor->id}}')" class="btn btn-danger btn-sm btn-white text-center text-white  mr-3"><i class="fa fa-trash" ></i> In-active</a>
</div>
