@extends('instructor.layouts.dashboard-template')
@section('title', 'List of subjects')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.css"/>
@endprepend

<div class="card shadow mb-4 rounded-0">
    <div class="card-header py-3 rounded-0">
        <h6 class="m-0 font-weight-bold text-primary">Students</h6>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover" id="subjects-table">
            <thead>
                <tr>
                    <th>Course No</th>
                    <th>Description</th>
                    <th>Year level</th>
                    <th>Units</th>
                    <th>Semester</th>
                    <th>School year</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
              
            </tbody>
        </table>
    </div>
</div>


@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
    let table = $('#subjects-table').DataTable({
        orderCellsTop: true,
        serverSide: true,
        processing: true,
        responsive: true,
        ajax: '/instructor/subject/list',
        columns: [
            { name: 'name' },
            { name: 'description' },
            { name: 'level' },
            { name: 'credits' },
            { name: 'semester' },
            { name: 'school_year' },
            { name: 'department.name' },
        ],
    });
</script>

@endpush
@endsection