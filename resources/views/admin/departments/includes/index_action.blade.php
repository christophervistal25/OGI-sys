<div class="text-center">
	<button class="btn btn-primary btn-sm text-center mr-3 text-white" onclick="viewSubjects(this)" data-src="{{ $department }}"><i class="fa fa-book"></i> Subjects  - <span class="font-weight-bold">{{ $department->subjects->count() }}</span></button>
	<button class="btn btn-success btn-sm text-center mr-3 text-white" onclick="editDepartment(this)" data-src="{{ $department }}"><i class="fa fa-edit"></i> Edit</button>
</div>
