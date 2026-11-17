@extends('layouts.auth')


@section('content')
    <?php
    $setting = \App\Models\Setting::pluck('value','name')->toArray();
    $auth_logo = isset($setting['auth_logo']) ? 'uploads/'.$setting['auth_logo'] : 'assets/media/logos/logo-light.png';
    $auth_page_heading = isset($setting['auth_page_heading']) ? $setting['auth_page_heading'] : '';
    $auth_image = isset($setting['auth_image']) ? 'uploads/'.$setting['auth_image'] : 'assets/media/svg/illustrations/login-visual-1.svg';
    $copy_right = isset($setting['copy_right']) ? $setting['copy_right'] : '#';
    ?>
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
            <!--begin::Aside-->
            <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">
                <!--begin::Aside Top-->
                <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                    <!--begin::Aside header-->
                    <a  class="text-center mb-10">
                        <!-- <h2>{{ config('app.name') }}</h2> -->
                        <h2 style="font-weight: bolder;">CHEAP</h2>
                    </a>
                    <!--end::Aside header-->
                    <!--begin::Aside title-->
                    <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #986923;"> CHEAPER<?php //echo stripcslashes($auth_page_heading )?></h3>
                    <!--end::Aside title-->
                </div>
                <!--end::Aside Top-->
                <!--begin::Aside Bottom-->
                <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
                     style="height:100%; margin-bottom:80%; margin-right:5%;  margin-left:5%; width:auto;background-size: contain;background-position: center; background-image: url({{ asset($auth_image) }})"></div>
                <!--end::Aside Bottom-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
                <!--begin::Content body-->
                <div class="d-flex flex-column-fluid flex-center">

                    <!--begin::Signin-->
                    <div class="login-form login-signin">
                        @include('admin.partials._messages')
                        <!--begin::Form-->
                        <form class="form" method="POST" action="{{ route('register') }}" novalidate="novalidate" >

                            @csrf

                            <!--begin::Title-->
                            <div class="pb-13 pt-lg-0 pt-5">
                                <h4 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">
                                    Welcome to the Cheapsst.com Portal</h4>
                                {{--<span class="text-muted font-weight-bold font-size-h4">New Here?
                                    <a href="javascript:;" id="kt_login_signup" class="text-primary font-weight-bolder">Create an Account</a></span>--}}
                                @if (Session::has('error'))
                                    <h5 style="color: red"><strong>{{ Session::get('error') }}</strong></h5>
                                @endif
                            </div>
                            <!--begin::Title-->
                            <!--begin::Form group-->
                            <div class="form-group">

                                <label class="font-size-h6 font-weight-bolder text-dark">First Name</label>
                                <input class="@error('first_name') is-invalid @enderror form-control form-control-solid h-auto py-3 px-3 rounded-lg" type="text" name="first_name" value="{{ old('first_name') }}" autocomplete="off" />
                                @error('first_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="form-group">

                                <label class="font-size-h6 font-weight-bolder text-dark">Last Name</label>
                                <input class="@error('last_name') is-invalid @enderror form-control form-control-solid h-auto py-3 px-3 rounded-lg" type="text" name="last_name" value="{{ old('last_name') }}" autocomplete="off" />
                                @error('last_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="form-group">

                                <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                                <input class="@error('email') is-invalid @enderror form-control form-control-solid h-auto py-3 px-3 rounded-lg" type="email" name="email" value="{{ old('email') }}" autocomplete="off" />
                                @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>


                            <div class="form-group">

                                <label class="font-size-h6 font-weight-bolder text-dark">BirthDay</label>
                                <input class="@error('birthday') is-invalid @enderror form-control form-control-solid h-auto py-3 px-3 rounded-lg" type="date" name="birthday" value="{{ old('birthday') }}" autocomplete="off" />
                                @error('birthday')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="form-group">

                                <label class="font-size-h6 font-weight-bolder text-dark">{{ __('Gender') }}</label>
                                <select name="gender"class="@error('gender') is-invalid @enderror form-control form-control-solid h-auto py-3 px-3 rounded-lg">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                @error('gender')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">

                                    <label class="font-size-h6 font-weight-bolder text-dark">Street Address</label>
                                          <input class="@error('address') is-invalid @enderror form-control form-control-solid h-auto py-3 px-3 rounded-lg" placeholder="street 10/4" type="address" name="address" value="{{ old('address') }}" autocomplete="off" />
                                            @error('address')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-size-h6 font-weight-bolder text-dark">APT</label>
                                        <input class="@error('apt') is-invalid @enderror form-control form-control-solid h-auto py-3 px-3 rounded-lg" placeholder="Apartment *" type="apt" name="apt" value="{{ old('apt') }}" autocomplete="off" />
                                        @error('apt')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-size-h6 font-weight-bolder text-dark">City</label>
                                        <input class="@error('city') is-invalid @enderror form-control form-control-solid h-auto py-3 px-3 rounded-lg" placeholder="Your City" type="city" name="city" value="{{ old('city') }}" autocomplete="off" />
                                        @error('city')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-size-h6 font-weight-bolder text-dark">State</label>
                                        <input class="@error('state') is-invalid @enderror form-control form-control-solid h-auto py-3 px-3 rounded-lg" placeholder="Your state" type="state" name="state" value="{{ old('state') }}" autocomplete="off" />
                                        @error('state')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-size-h6 font-weight-bolder text-dark">Zipcode</label>
                                        <input class="@error('zipcode') is-invalid @enderror form-control form-control-solid h-auto py-3 px-3 rounded-lg" placeholder="Zip Code" type="zipcode" name="zipcode" value="{{ old('zipcode') }}" autocomplete="off" />
                                        @error('zipcode')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">

                                <div class="d-flex justify-content-between mt-n5">
                                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>

                                </div>
                                <div class="input-group">
                                    <input type="password" id="password" name="password" placeholder="Password" class=" @error('password') is-invalid @enderror form-control form-control-solid h-auto py-3  rounded-lg @error('password') is-invalid @enderror" >
                                    <div class="input-group-append">
                                      <span  class="input-group-text" id="togglePassword" onclick="togglePasswordVisibility()">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                      </span>

                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                    @enderror
                                </div>


                            </div>
                            <div class="form-group">

                                <div class="d-flex justify-content-between mt-n5">
                                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Confirm Password</label>

                                </div>
                                <div class="input-group">
                                    <input type="password" id="password1" name="password_confirmation" placeholder="Confirm Password" class=" @error('password') is-invalid @enderror form-control form-control-solid h-auto py-3  rounded-lg"  autocomplete="new-password">
                                    <div class="input-group-append">
                                      <span  class="input-group-text" id="togglePassword1" onclick="togglePasswordVisibility1()">
                                        <i class="fas fa-eye" id="eyeIcon1"></i>
                                      </span>
                                    </div>
                                </div>

                                @error('password-confirm')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>@enderror
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="terms_conditions" name="terms_conditions" required>
                                    <label class="form-check-label" for="terms_conditions">I accept the <a href="{{ route('terms-condition') }}" target="_blank">Terms and Conditions</a></label>
                                </div>
                                @error('terms_conditions')
                                <span style="color: red;font-weight: 400">
                                    <strong>{{ $message }}</strong>
                                </span>

                                @enderror
                            </div>
                            
                            <!--end::Form group-->
                            <!--begin::Action-->

                            <div class="pb-lg-0 pb-5">
                                <button type="submit"  id="kt_btn" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Register</button>
                                <a href="{{ route('login') }}"
                                    <button type="button" class="btn btn-light-primary font-weight-bolder px-8 py-4 my-3 font-size-lg">
                                    Login</button>
                                </a>
                            </div>

                            <!--end::Action-->
                        </form>
                        <!--end::Form-->
                    </div>

                </div>
                <!--end::Content body-->
                <!--begin::Content footer-->
                <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                    <div class="text-dark-50 font-size-lg font-weight-bolder mr-10">
                        <span class="mr-1">{{ date('Y') }}©</span>
                        <a href="{{ config('app.url') }}" target="_blank" class="text-dark-75 text-hover-primary">{{ $copy_right }}</a>
                    </div>
                </div>
                <!--end::Content footer-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Login-->
    </div>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var eyeIcon = document.getElementById("eyeIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
        function togglePasswordVisibility1() {
            var passwordInput = document.getElementById("password1");
            var eyeIcon = document.getElementById("eyeIcon1");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
@endsection
@section('scripts')
    <script>
        var btn = KTUtil.getById("kt_btn");

        KTUtil.addEvent(btn, "click", function() {
            KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Please wait");

            setTimeout(function() {
                KTUtil.btnRelease(btn);
            }, 1000);
        });


    </script>

@endsection
