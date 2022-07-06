@extends('admin.layouts.dashboard-template')
@section('title','New Instructor')
@section('content')
<div class="row mb-2">
    <div class="col-lg-12">
        @if(Session::has('success'))
            @include('templates.success')
        @endif
    </div>
</div>
<form method="POST" action="{{ route('instructor.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-none mb-4 rounded-0">
                <div class="card-header py-3 rounded-0">
                    <h6 class="m-0 font-weight-bold text-primary">Personal Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="firstname" class='text-dark'>Firstname</label>
                                <input type="text" class="form-control rounded-0 {{ $errors->has('firstname') ? 'is-invalid': '' }}" name="firstname"
                                    id="firstname" value="{{ old('firstname') }}">
                                @error('firstname')
                                    <span class='text-danger'>{{ $errors->first('firstname') }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="middlename" class='text-dark'>Middlename</label>
                                <input type="text" class="form-control rounded-0 {{ $errors->has('middlename') ? 'is-invalid' : '' }}" name="middlename" id="middlename"
                                    value="{{ old('middlename') }}">
                                @error('middlename')
                                    <span class='text-danger'>{{ $errors->first('middlename') }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="lastname" class='text-dark'>Lastname</label>
                                <input type="text" class="form-control rounded-0 {{ $errors->first('lastname') ? 'is-invalid' : '' }}" name="lastname" id="lastname"
                                    value="{{ old('lastname') }}">
                                @error('lastname')
                                    <span class='text-danger'>{{ $errors->first('lastname') }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="suffix" class='text-dark'>Suffix</label>
                                <input type="text" class="form-control rounded-0" name="suffix" id="suffix"
                                    placeholder="(e.g) Jr. Sr." value="{{ old('suffix') }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="contact" class='text-dark'>Contact No</label>
                                <input type="text" class="form-control rounded-0 {{ $errors->has('contact_no') ? 'is-invalid' : '' }}" name="contact_no" id="contact"
                                    value="{{ old('contact_no') }}">
                                    @error('contact_no')
                                        <span class='text-danger'>{{ $errors->first('contact_no') }}</span>
                                    @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="gender" class='text-dark'>Gender</label>
                                <select name="gender" class="form-control rounded-0 {{ $errors->has('gender') ? 'is-invalid' : '' }}" id="gender">
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                                @error('gender')
                                    <span class='text-danger'>{{ $errors->first('gender') }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="birthdate" class='text-dark'>Birthdate</label>
                                <input type="date" class="form-control rounded-0 {{ $errors->has('birthdate') ? 'is-invalid' : '' }}" value="{{ old('birthdate') }}"
                                    name="birthdate">
                                    @error('birthdate')
                                        <span class='text-danger'>{{ $errors->first('birthdate') }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="civil_status" class='text-dark'>Civil Status</label>
                                <select name="civil_status" class="form-control rounded-0 {{ $errors->has('civil_status') ? 'is-invalid' : '' }}" id="civil_status">
                                    <option value="single" {{ old('civil_status') == 'Single' ? 'selected' : '' }}>
                                        Single</option>
                                    <option value="married" {{ old('civil_status') == 'Married' ? 'selected' : '' }}>
                                        Married</option>
                                    <option value="widowed" {{ old('civil_status') == 'Widow' ? 'selected' : '' }}>Widowed
                                    </option>
                                    <option value="divorced" {{ old('civil_status') == 'Divorced' ? 'selected' : '' }}>Divorced
                                    </option>
                                </select>
                                @error('civil_status')
                                    <span class='text-danger'>{{ $errors->first('civil_status') }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="department" class='text-dark'>Department</label>
                                <select name="department_id" class="form-control rounded-0 {{ $errors->first('department_id') ? 'is-invalid ' : '' }}" id="department">
                                    @foreach($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <span class='text-danger'>{{ $errors->first('department_id') }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="work_status" class='text-dark'>Status</label>
                                <select name="work_status" class="form-control rounded-0 {{ $errors->has('work_status') ? 'is-invalid' : '' }}" id="work_status">
                                    <option value="full-time" {{ old('work_status') == 'full-time' ? 'selected' : '' }}>Full
                                        time</option>
                                    <option value="part-time" {{ old('work_status') == 'part-time' ? 'selected' : '' }}>Part
                                        time</option>
                                </select>
                                @error('work_status')
                                    <span class='text-danger'>{{ $errors->first('status') }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card shadow-none mb-4 rounded-0">
                <div class="card-header py-3 rounded-0">
                    <h6 class="m-0 font-weight-bold text-primary">Login Credentials</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="email" class='text-dark'>Email</label>
                                <input type="email" class="form-control rounded-0 {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class='text-danger'>{{ $errors->first('email') }}</span>
                                @enderror
                            </div>
                        
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="password" class='text-dark'>Password</label>
                                <input type="password" class="form-control rounded-0 {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password"
                                    value="{{ old('password') }}" id="password">
                                @error('password')
                                    <span class='text-danger'>{{ $errors->first('password') }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="retypePassword" class='text-dark'>Re-type password</label>
                                <input type="password" class="form-control rounded-0 {{ $errors->has('password') ? 'is-invalid' : '' }}" value="{{ old('password_confirmation') }}"
                                    name="password_confirmation" id="retypePassword">
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="float-right mb-3">
                <button type="submit" class='btn btn-primary'>
                    <i class="fas fa-save"></i>
                    Submit New Instructor
                </button>
            </div>
        </div>
    </div>
    
</form>
@endsection
