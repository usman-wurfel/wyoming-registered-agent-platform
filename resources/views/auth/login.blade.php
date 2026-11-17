@extends('layouts.auth')
@section('content')
    <?php
    $setting = \App\Models\Setting::pluck('value','name')->toArray();
    $site_title = isset($setting['site_title']) ? $setting['site_title'] : '';
    $auth_logo = isset($setting['auth_logo']) ? 'uploads/'.$setting['auth_logo'] : 'assets/media/logos/logo-light.png';
    $auth_page_heading = isset($setting['auth_page_heading']) ? $setting['auth_page_heading'] : '';
    $auth_image = isset($setting['auth_image']) ? 'uploads/'.$setting['auth_image'] : 'assets/media/svg/illustrations/login-visual-1.svg';
    $copy_right = isset($setting['copy_right']) ? $setting['copy_right'] : '#';
    ?>
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
            <!--begin::Aside-->
            <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #1e1e2d;">
                <!--begin::Aside Top-->
                <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                    <!--begin::Aside header-->
                    <a  class="text-center mb-10">
                        <!-- <h2>{{ config('app.name') }}</h2> -->
                        <h2 style="font-weight: bolder;"><img src="{{$auth_logo}}" style="    max-width: 250px;" /></h2>
                    </a>
                    <!--end::Aside header-->
                    <!--begin::Aside title-->
                    <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #fff;">{{$site_title}}</h3>
                    <!--end::Aside title-->
                </div>
                <!--end::Aside Top-->
                <!--begin::Aside Bottom-->
                <div class="side-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
                     style="height:100%; margin-right:5%;  margin-left:5%; padding-top:30px; width:auto;background-size: contain;background-position: center; background-image: url({{ asset($auth_image) }})"></div>
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
                        <form class="form" action="{{ route('login') }}" method="post" novalidate="novalidate" >

                            @csrf
                            @if (strpos(url()->previous(), 'cart') == true)
                                <input type="hidden" name="cart" value="1">

                            @else
                                <input type="hidden" name="cart" value="0">

                            @endif

                            <!--begin::Title-->
                            <div class="pb-13 pt-lg-0 pt-5">
                                <h4 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">
                                    Welcome Back</h4>
                                {{--<span class="text-muted font-weight-bold font-size-h4">New Here?
                                    <a href="javascript:;" id="kt_login_signup" class="text-primary font-weight-bolder">Create an Account</a></span>--}}
                                @if (Session::has('error'))
                                    <h5 style="color: red"><strong>{{ Session::get('error') }}</strong></h5>
                                @endif
                            </div>
                            <!--begin::Title-->
                            <!--begin::Form group-->
                            <div class="form-group">

                                <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                                <input class="@error('email') is-invalid @enderror form-control form-control-solid h-auto py-6 px-6 rounded-lg" type="email" name="email" value="{{ old('email') }}" autocomplete="off" />
                                @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <!--end::Form group-->
                            <!--begin::Form group-->
                            <div class="form-group">
                                <div class="d-flex justify-content-between mt-n5">
                                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
                                    <a href="{{ route('password.request') }}" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" >Forgot Password ?</a>
                                </div>
                                <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg @error('password') is-invalid @enderror"  required autocomplete="current-password" type="password" name="password"/>
                                <i class="bi bi-eye-slash" id="togglePassword"></i>
                                @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>@enderror
                            </div>
                            <!--end::Form group-->
                            <!--begin::Action-->
                            <div class="pb-lg-0 pb-5">
                                <button type="submit"  id="kt_btn" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Sign In</button>
                                <!--<a href="{{ route('register') }}"-->
                                <!--    <button type="button" class="btn btn-light-primary font-weight-bolder px-8 py-4 my-3 font-size-lg">-->
                                <!--    Register</button>-->
                                <!--</a>-->
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
