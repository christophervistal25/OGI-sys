@extends('admin.layouts.dashboard-template')
@section('title','Add Student')
@section('content')
<div class="row mb-2">
    <div class="col-lg-12">
        @if(Session::has('success'))
            @include('templates.success')
        {{-- @else
        @include('templates.error') --}}
        @endif
    </div>
</div>

<form method="POST" action="{{ route('student.store') }}" id="#addStudentForm">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4 rounded-0">
                <div class="card-header py-3 rounded-0">
                    <h6 class="m-0 font-weight-medum text-primary">PERSONAL INFORMATION</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="studentFirstname">Firstname</label>
                                <input type="text" class="form-control {{ $errors->has('firstname') ? 'is-invalid' : '' }}" name="firstname" id="studentFirstname" value="{{ old('firstname') }}">
                                @if($errors->has('firstname'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('firstname') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="studentMiddlename">Middlename</label>
                                <input type="text" class="form-control {{ $errors->has('middlename') ? 'is-invalid' : '' }}" name="middlename" id="studentMiddlename" value="{{ old('middlename') }}">
                                @if($errors->has('middlename'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('middlename') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="studentLastname">Lastname</label>
                                <input type="text" class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}" name="lastname" id="studentLastname" value="{{ old('lastname') }}">
                                @if($errors->has('lastname'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('lastname') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="suffix">Suffix</label>
                                <input type="text" class="form-control" name="suffix" id="suffix"
                                    value="{{ old('suffix') }}">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="studentGender">Gender</label>
                                <select name="gender" class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" id="studentGender">
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') =='female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                                @if($errors->has('gender'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('gender') }}
                                    </div>
                                @endif                      
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="civil_status">Civil Status</label>
                                <select name="civil_status" id="civil_status" class='form-control {{ $errors->has('civil_status') ? 'is-invalid' : '' }}'>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="widowed">Widowed</option>
                                    <option value="divorced">Divorced</option>
                                </select>
                                @if($errors->has('civil_status'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('civil_status') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="citizenship">Citizenship</label>
                                <select name="citizenship" id="citizenship" class='form-control {{ $errors->has('citizenship') ? 'is-invalid' : '' }}'>
                                    <option value="filipino">Filipino</option>
                                    <option value="other">Other</option>
                                </select>
                                @if($errors->has('citizenship'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('citizenship') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="birthdate">Birthdate</label>
                                <input type="date" class="form-control {{ $errors->first('birthdate') ? 'is-invalid' : '' }}" name="birthdate" id="birthdate"
                                    value="{{ old('birthdate') }}">
                                    @if($errors->has('birthdate'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('birthdate') }}
                                        </div>
                                    @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="email"
                                    value="{{ old('email') }}">
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="contact_no">Contact No.</label>
                                <input type="text" class="form-control {{ $errors->first('contact_no') ? 'is-invalid' : '' }}" name="contact_no" id="contact_no"
                                    value="{{ old('contact_no') }}">
                                @if($errors->has('contact_no'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('contact_no') }}
                                    </div>
                                @endif
                            </div>
                        </div>





                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="address">Permanent Address</label>
                                <textarea class="form-control {{ $errors->first('address') ? 'is-invalid' : '' }}" name="address" id="address">{{ old('address') }}</textarea>
                                @if($errors->has('address'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('address') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4 rounded-0">
                <div class="card-header py-3 rounded-0">
                    <h6 class="m-0 font-weight-medum text-primary">EDUCATION</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="elementary">Primary</label>
                                <input type="text" class='form-control {{ $errors->has('elementary') ? 'is-invalid' : '' }}' id="elementary" name="elementary" value="{{ old('elementary') }}">
                                @if($errors->has('elementary'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('elementary') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="elementary_average">Average</label>
                                <input type="text" class='form-control {{ $errors->has('elementary_average') ? 'is-invalid' : '' }}' id="elementary_average" name="elementary_average" value="{{ old('elementary_average') }}">
                                @if($errors->has('elementary_average'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('elementary_average') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="elementary_from">From</label>
                                <input type="date" class='form-control {{ $errors->has('elementary_from') ? 'is-invalid' : '' }}' id="elementary_from" name="elementary_from" value="{{ old('elementary_from') }}">
                                @if($errors->has('elementary_from'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('elementary_from') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="elementary_to">To</label>
                                <input type="date" class='form-control {{ $errors->has('elementary_to') ? 'is-invalid' : '' }}' id="elementary_to" name="elementary_to" value="{{ old('elementary_to') }}">
                                @if($errors->has('elementary_to'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('elementary_to') }}
                                    </div>
                                    
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <label for="elementary_address">Address</label>
                            <textarea name="elementary_address" id="elementary_address" class='form-control {{ $errors->has('elementary_address') ? 'is-invalid' : '' }}' rows="3">{{ old('elementary_address') }}</textarea>
                            @if($errors->has('elementary_address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('elementary_address') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="secondary">Seccondary</label>
                                <input type="text" class='form-control {{ $errors->has('secondary') ? 'is-invalid' : '' }}' id="secondary" name="secondary" value="{{ old('secondary') }}">
                                @if($errors->has('secondary'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('secondary') }}
                                    </div>
                                    
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="secondary_average">Secondary Average</label>
                                <input type="text" class='form-control {{ $errors->has('secondary_average') ? 'is-invalid' : '' }}' id="secondary_average" name="secondary_average" value="{{ old('secondary_average') }}">
                                @if($errors->has('secondary_average'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('secondary_average') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="secondary_from">From</label>
                                <input type="date" class='form-control {{ $errors->has('secondary_from') ? 'is-invalid' : '' }}' id="secondary_from" name="secondary_from" value="{{ old('secondary_from') }}">
                                @if($errors->has('secondary_from'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('secondary_from') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="secondary_to">To</label>
                                <input type="date" class='form-control {{ $errors->has('secondary_to') ? 'is-invalid' : '' }}' id="secondary_to" name="secondary_to" value="{{ old('secondary_to') }}">
                                @if($errors->has('secondary_to'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('secondary_to') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <label for="secondary_address">Address</label>
                            <textarea name="secondary_address" id="secondary_address" class='form-control {{ $errors->has('secondary_address') ? 'is-invalid' : '' }}' rows="3">{{ old('secondary_address') }}</textarea>
                            @if($errors->has('secondary_address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('secondary_address') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4 rounded-0">
                <div class="card-header py-3 rounded-0">
                    <h6 class="m-0 font-weight-medum text-primary">FAMILY BACKGROUND</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="mother_name">Mother's Firstname</label>
                                <input type="text" class='form-control {{ $errors->has('mother_name') ? 'is-invalid' : '' }}' name="mother_name" value="{{ old('mother_name') }}">
                                @if($errors->has('mother_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('mother_name') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="mother_lastname">Mother's Lastname</label>
                                <input type="text" class='form-control {{ $errors->has('mother_lastname') ? 'is-invalid' : '' }}' name="mother_lastname" value="{{ old('mother_lastname') }}">
                                @if($errors->has('mother_lastname'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('mother_lastname') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="mother_middlename">Mother's Middlename</label>
                                <input type="text" class='form-control {{ $errors->has('mother_middlename') ? 'is-invalid' : '' }}' name="mother_middlename" value="{{ old('mother_middlename') }}">
                                @if($errors->has('mother_middlename'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('mother_middlename') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="mother_contact_no">Mother's Contact No.</label>
                                <input type="text" class='form-control {{ $errors->has('mother_contact_no') ? 'is-invalid' : '' }}' name="mother_contact_no" value="{{ old('mother_contact_no') }}">
                                @if($errors->has('mother_contact_no'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('mother_contact_no') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="father_name">Father's Firstname</label>
                                <input type="text" class='form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}' name="father_name" value="{{ old('father_name') }}">
                                @if($errors->has('father_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('father_name') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="father_lastname">Father's Lastname</label>
                                <input type="text" class='form-control {{ $errors->has('father_lastname') ? 'is-invalid' : '' }}' name="father_lastname" value="{{ old('father_lastname') }}">
                                @if($errors->has('mother_lastname'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('mother_lastname') }}
                                    </div>
                                    
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="father_middlename">Father's Middlename</label>
                                <input type="text" class='form-control {{ $errors->has('father_middlename') ? 'is-invalid' : '' }}' name="father_middlename" value="{{ old('father_middlename') }}">
                                @if($errors->has('father_middlename'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('father_middlename') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="father_suffix">Father's Suffix</label>
                                <input type="text" class='form-control {{ $errors->has('father_suffix') ? 'is-invalid' : '' }}' name="father_suffix" value="{{ old('father_suffix') }}">
                                @if($errors->has('father_suffix'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('father_suffix') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="father_contact_no">Father's Contact No.</label>
                                <input type="text" class='form-control {{ $errors->has('father_contact_no') ? 'is-invalid' : '' }}' name="father_contact_no" value="{{ old('father_contact_no') }}">
                                @if($errors->has('father_contact_no'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('father_contact_no') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4 rounded-0">
                <div class="card-header py-3 rounded-0">
                    <h6 class="m-0 font-weight-medum text-primary">ACHIEVEMENTS</h6>
                </div>
                <div class="card-body">
                    <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th>Achievement</th>
                                <th class='text-center'>Action</th>
                            </tr>
                        </thead>
                        <tbody id='dynamic-achievements-body'>
                        @if(old('achievements'))
                            @foreach(old('achievements') as $key => $achievement)
                                <tr>
                                    <td>
                                        <input type='text' class='form-control' name='achievements[]' value='{{ $achievement }}'>
                                    </td>
                                    <td class='text-center'>
                                        <button type='button' class='btn btn-danger rounded-circle btn-achievement-remove-row' tabindex="-1">
                                            <i class='fa fa-minus'></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                            <tr>
                                <td>
                                    <input type="text" class='form-control' name="achievements[]" placeholder="(e.g) Elementary Validictorian">
                                </td>
                                <td width="5%" class='text-center'>
                                    <button class='btn btn-primary rounded-circle btn-achievement-add-row' type="button" tabindex="-1">
                                        <i class='fa fa-plus'></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="float-right mb-3">
        <button type="submit" value="Add Student" class="btn btn-primary font-weight-medium">
            <i class='fa fa-save'></i> Submit New Student
        </button>
    </div>

</form>
@push('page-scripts')
{{-- Pull the cdn of sweetalert version 1 --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>    
    // Set on click listener to btn-achievement-add-row
    $(document).on('click', '.btn-achievement-add-row', function(){
        // Get the current table body
        var tbody = $('#dynamic-achievements-body');
        // Get the current table row
        var tr = tbody.children('tr').last();
        // Clone the current table row
        var new_tr = tr.clone();
        // Remove the id from the new row
        new_tr.removeAttr('id');
        // Remove the value from the new row
        new_tr.find('input').val('');
        // Append the new row to the table body
        tbody.append(new_tr);

        // Get the old button then replace the content of it with a minus icon then add a btn-remove-row class
        var old_btn = tr.find('.btn-achievement-add-row');
        old_btn.html('<i class="fa fa-minus"></i>');
        old_btn.addClass('btn-achievement-remove-row').addClass('btn-danger');
        old_btn.removeClass('btn-achievement-add-row');
    });

    $(document).on('click', '.btn-achievement-remove-row', function() {
        // Display a sweet alert then confirmed first before removing the row
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this row!",
            icon: "warning",
            dangerMode : true,
            buttons : ["No", "Yes"],
        }).then((isClicked) => {
            if(isClicked) {
                // Get the current table row
                var tr = $(this).closest('tr');
                // Remove the row
                tr.remove();
            }
        });
    });

</script>
@endpush
@endsection
