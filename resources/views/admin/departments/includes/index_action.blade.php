<div class="text-center">
	
	@if(Str::contains(url()->previous(), 'department/students'))
		<a href="/admin/student/{{$department->id}}" class="btn btn-primary btn-sm"><i class="fa fa-users"></i> Students</a>
		@else
		<button class="btn btn-primary btn-sm text-center mr-3 text-white" onclick="viewSubjects(this)" data-src="{{ $department }}"><i class="fa fa-book"></i> Subjects  - <span class="font-weight-bold">{{ $department->subjects->count() }}</span></button>
    @endif
	<button class="btn btn-success btn-sm text-center mr-3 text-white" onclick="editDepartment(this)" data-src="{{ $department }}"><i class="fa fa-edit"></i> Edit</button>
</div>
