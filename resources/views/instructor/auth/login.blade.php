@extends('instructor.layouts.app')
@section('title', 'Instructor Login')
@section('content')
@prepend('page-css')
<style>
    .bg-login-image {
        background:url('https://res.cloudinary.com/dpcxcsdiw/image/upload/v1569824198/ascb-csogi/undraw_professor_8lrt.svg') center center; 
        background-size: cover;
    }
    body {
        background:url('https://res.cloudinary.com/dpcxcsdiw/image/upload/v1569829814/ascb-csogi/slider_3.webp') center center; 
        background-size: cover;   
    }
</style>
@endprepend
<body>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="text-center mt-5">
                    <img src="https://res.cloudinary.com/dpcxcsdiw/image/upload/v1575120138/ascb-csogi/school_logo.png" width="150" alt="school image">
                </div>
                <h3 class="text-center mt-5" style="color:#1a1a1a">Andres Soriano Colleges of Bislig College Students Online Grade Inquiry</h3>
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Instructor!</h1>
                                    </div>
                                    <form class="user"  method="POST" action="{{  route('instructor.auth.loginInstructor') }}">
                                        {{ csrf_field() }}
                                        
                                        <div class="form-group">
                                            @include('templates.error')
                                        </div>


                                        <div class="form-group">
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control form-control-user" name="id_number" id="idNumber" aria-describedby="idNumberHelper" placeholder="Enter ID Number ..." value="{{ old('id_number') }}">

                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" id="userPassword" placeholder="Password">
                                        </div>
                                     {{--    <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div> --}}
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                        </button>
                                        <hr>
                                        <a href="/admin/login" class="btn btn-google btn-user btn-block">
                                            <i class="fa fa-lock"></i> Administrator Login
                                        </a>
                                        <a href="/student/login" class="btn btn-facebook btn-user btn-block">
                                            <i class="fa fa-lock"></i> Student Login
                                        </a>
                                        <a href="/hr/login" class="btn btn-success btn-user btn-block">
                                            <i class="fa fa-lock"></i> HR Login
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
