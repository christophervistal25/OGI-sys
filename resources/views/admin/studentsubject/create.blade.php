@extends('admin.layouts.dashboard-template')
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
        Student ID Number : <span class="text-primary font-weight-bold">{{ $student->id_number }}</span> <br>
        Student Name : <span class="text-primary font-weight-bold">{{ $student->name }}</span> <br>
        Course : <span class="text-primary font-weight-bold">{{ $student->course->abbr }}</span> <br>
    </div>
</div>


<div class="card shadow mb-4 rounded-0">
    <div class="card-header py-3 rounded-0">
        <h6 class="m-0 font-weight-bold text-primary">Add subject form</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('student.subject.store', [$student]) }}" method="POST" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <table class="table table-bordered" id="subjects-table">
                        <thead>
                            <tr>
                                <th>Course No</th>
                                <th>Description</th>
                                <th>Level</th>
                                <th>Semester</th>
                                <th>School Year</th>
                                <th>Select</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-lg-6" style="border : 1px solid #e3e6f0;">
                    <h6 class="m-0 pt-3 pl-3 font-weight-bold text-primary">Subjects</h6>
                    <hr>
                    <div id="added-subjects">
                    </div>
                </div>
            </div>
            <div class="float-right mt-2">
                <input type="submit" value="Add subject to student" class="btn btn-primary font-weight-bold">
            </div>
        </form>
        
    </div>
</div>
@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    let studentId = "{{$student->id}}";
    $('#subjects-table').DataTable({
            orderCellsTop: true,
            serverSide: true,
            processing: true,
            responsive: true,
            ajax : `/admin/student/subject/list/${studentId}`,
            columns: [
                { name: 'name', },
                { name: 'description', orderable: false },
                { name: 'level', orderable: false , searchable : false },
                { name : 'semester' , searchable : false, },
                { name : 'school_year' , searchable : false, },
                { name : 'actionclick' , searchable : false, }
            ],
    });

    function removeSubject(id) {
        $(`#subject-${id}-container`).remove();
    }

    function addThisSubject(e) {
        let subject = JSON.parse(e.getAttribute('data-src'));
        $('#added-subjects').append(`
                <div id="subject-${subject.id}-container" class="row">
                    <input type="hidden" class="form-control" name="subjects[ids][]" value="${subject.id}" />
                    <div class="col-lg-6 mb-2">
                        <label>Course No.</label>
                        <input type="text"  class="form-control" readonly name="subjects[names][]" value="${subject.name}" />
                    </div>
                    <div class="col-lg-5 mb-2">
                        <label>Course Description.</label>
                        <input type="text"  class="form-control" readonly  value="${subject.description}" />
                    </div>
                    <div class="col-lg-1">
                        <p></p>
                        <button type="button" class="btn btn-sm font-weight-bold mt-3 btn-danger" onclick="removeSubject(${subject.id})">X</button>
                    </div>
                </div>

        `);
    }
</script>
@endpush
@endsection