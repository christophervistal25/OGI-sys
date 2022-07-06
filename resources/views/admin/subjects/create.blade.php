@extends('admin.layouts.dashboard-template')
@section('title','Add subject')
@section('content')
<div class="row mb-2">
	<div class="col-lg-12">
		@if(Session::has('success'))
            @include('templates.success')
		@endif
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4 rounded-0">
			<div class="card-header py-3 rounded-0">
				<h6 class="m-0 text-primary">Add subject</h6>
			</div>
			<div class="card-body" >
				<form action="{{ route('subject.store') }}" method="POST">
					@csrf
					<div class="row">
						<div class="col-lg-12 form-group">
							<label for="name">Course No.</label>
							<input type="text" class="form-control rounded-0 {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="col-lg-12 form-group">
							<label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class='form-control rounded-0 {{ $errors->has('description') ? 'is-invalid' : '' }}'>{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>

						<div class="col-lg-6 form-group">
							<label for="department">Department</label>
							<select name="department_id" class="form-control rounded-0 form-select {{ $errors->has('department_id') ? 'is-invalid' : '' }}" id="department">
								<option value="" selected disabled hidden>Select Department</option>
								@foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
								@endforeach
							</select>
                            @error('department_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>

						<div class="col-lg-6 form-group">
							<label for="level">Year Level</label>
							<input type="number" min="1" max="5" class="form-control rounded-0 {{ $errors->has('level') ? 'is-invalid' : '' }}" id="level" name="level" value="{{ old('level') }}">
                            @error('level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                
                            @enderror
						</div>
						<div class="col-lg-4 form-group">
							<label for="credits">Units</label>
							<input type="number" min="1" max="8" class="form-control rounded-0 {{ $errors->has('credits') ? 'is-invalid' : '' }}" id="credits" name="credits" value="{{ old('credits') }}">
                            @error('credits')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                
                            @enderror
                        </div>
						<div class="col-lg-4 form-group">
							<label for="semester">Semester</label>
							<input type="number" min="1" max="3" class="form-control rounded-0 {{ $errors->has('semester') ? 'is-invalid' : '' }}" id="semester" name="semester" value="{{ old('semester') }}">
                            @error('semester')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="col-lg-4 form-group">
							<label for="school_year">School Year</label>
							<input type="number" class="form-control rounded-0 {{ $errors->has('school_year') ? 'is-invalid' : ''}}" id="school_year" name="school_year" value="{{ old('school_year', date('Y')) }}">
                            @error('school_year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
					</div>
					<div class="float-right">
                        <button type="submit" class="btn btn-primary font-weight-medium" value="Submit new subject">
                            <i class='fa fa-save'></i> Submit new subject
                        </button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@push('page-scripts')
@endpush
@endsection