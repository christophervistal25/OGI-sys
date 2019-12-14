@extends('instructor.layouts.dashboard-template')
@section('title','Add Subject')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
<div class="row mb-2">
    <div class="col-lg-12">
        @if(\Session::has('success'))
            @include('templates.success')
        @elseif($errors->any())
            @include('templates.error')
        @else
        <div class="card bg-info text-white shadow mb-2">
                <div class="card-body font-weight-bold">
                  Click the <i class="fas fa-arrow-right"></i> icon to add the students in the list.
                </div>
            </div>
        @endif
    </div>
</div>

<div class="card shadow mb-4 rounded-0">
    <div class="card-body">
        Course No : <span class="text-primary font-weight-bold">{{ $subject->name }}</span> <br>
        Level : <span class="text-primary font-weight-bold">{{ $subject->level }}</span> <br>
        Semester : <span class="text-primary font-weight-bold">{{ addSuffixToLevel($subject->semester) }} Semester</span> <br>
        School Year : <span class="text-primary font-weight-bold">{{ $subject->school_year }}</span>
    </div>
</div>

<div class="card shadow mb-4 rounded-0">
    <div class="card-header py-3 rounded-0">
        <h6 class="m-0 font-weight-bold text-primary">Add subject form</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('instructor.subject.store') }}" method="POST" autocomplete="off">
            @csrf
            <div class="row">
                {{-- <label for="subjectId">Subject ID</label> --}}
                <input class="form-control" hidden type="number" name="subject_id"  id="subjectId" value="{{ $subject->id }}">
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <table class="table table-bordered" id="students-table">
                        <thead>
                            <tr>
                                <th>ID Number</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Department</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-lg-6" style="border : 1px solid #e3e6f0;">
                    <h6 class="m-0 pt-3 pl-3 font-weight-bold text-primary">Students</h6>
                    <hr>
                    <div id="added-students">
                        @if( !empty(old('students.ids')) )
                            @foreach(old('students.ids') as $index => $id)
                            <div id="student-{{$id}}-container" class="row">
                                <input type="hidden" class="form-control" name="students[ids][]" value="{{ $id }}" />
                                <div class="col-lg-6 mb-2">
                                    <input type="text" id="student-${student.id}" class="form-control" readonly name="students[names][]" value="{{ old("students.names")[$index] }}" />
                                </div>
                                <div class="col-lg-5">
                                    <input type="text" class="form-control" name="students[remarks][]" value="{{ old("students.remarks")[$index] }}" />
                                </div>
                                <div class="col-lg-1">
                                    <button type="button" class="btn btn-sm font-weight-bold mt-1 btn-danger" onclick="removeStudent({{$id}})">X</button>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="float-right mt-2">
                <input type="button" value="Add students by CSV" id="addStudentByCsv" class="btn btn-success font-weight-bold">
                <input type="submit" value="Add subject with students" class="btn btn-primary font-weight-bold">
            </div>
        </form>
        
    </div>
</div>
@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    $('#students-table').DataTable({
            orderCellsTop: true,
            serverSide: true,
            processing: true,
            responsive: true,
            ajax : `/instructor/student/list`,
            columns: [
                { name: 'id_number', },
                { name: 'name', },
                { name: 'course.abbr', orderable: false },
                { name: 'department', orderable: false , searchable : false },
                { name : 'instructoraction' , searchable : false, }
            ],
    });
</script>
<script>
    let studentIds = [];
    const studentsParentContainer = document.querySelector('#added-students');

    const isInTheList   = (id) => studentIds.includes(id);
    const pushIdsToList = (id) => studentIds.push(id);
    const removeInList  = (id) => studentIds.filter(studentId => studentId !== id);
    
    const removeStudent = (id) => {
        // Remove the student id in list.
        studentIds = removeInList(id);

        // Remove the element of student in DOM.
        document.querySelector(`#student-${id}-container`).remove();
    };
        

    const addStudentToSubject = (e) => {
        let student = JSON.parse(JSON.stringify(e.getAttribute('data-src')));
        student = JSON.parse(student);
        if ( !isInTheList(student.id) ) {
            // Push new item to studentsParentContainer
            studentsParentContainer.innerHTML += `
            <div id="student-${student.id}-container" class="row">
                    <input type="hidden" class="form-control" name="students[ids][]" value="${student.id}" />
                    <div class="col-lg-6 mb-2">
                        <input type="text" id="student-${student.id}" class="form-control" readonly name="students[names][]" value="${student.name}" />
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="students[remarks][]" onblur="sample(this)" placeholder="Enter Grade here..." />
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="btn btn-sm font-weight-bold mt-1 btn-danger" onclick="removeStudent(${student.id})">X</button>
                    </div>
                </div>
            `;
            pushIdsToList(student.id);
        } else {
            let studentItem = document.querySelector(`#student-${student.id}`);
            studentItem.classList.add('is-invalid');
            setTimeout(() => {
                let studentItemClass = [...studentItem.classList];
                if (studentItemClass.includes('is-invalid')) {
                    alert(`${student.name} is already in the list.`);
                    studentItem.classList.remove('is-invalid');
                }
            }, 200);
        }
    };

/*    // Subject sections.
    const subjectNameField = document.querySelector('#subjectName');*/

    /*subjectNameField.addEventListener('change', (e) => {
        let subject = e.target.options[e.target.selectedIndex];
        let dataSource = JSON.parse(subject.getAttribute('data-src'));
   
        document.querySelector('#subjectId').value          = dataSource.id;
        document.querySelector('#subjectDescription').value = dataSource.description;
        document.querySelector('#subjectLevel').value       = dataSource.level;
        document.querySelector('#subjectSemester').value    = dataSource.semester;
        document.querySelector('#subjectCredits').value     = dataSource.credits;
        document.querySelector('#subjectSchoolYear').value  = dataSource.school_year;
        document.querySelector('#subjectDepartment').value  = dataSource.department.name;
    });*/

    document.querySelector('#addStudentByCsv').addEventListener('click', (e) => {
        window.location.href = `/instructor/subject/{{$subject->id}}/edit`;
    });


</script>
@endpush
@endsection