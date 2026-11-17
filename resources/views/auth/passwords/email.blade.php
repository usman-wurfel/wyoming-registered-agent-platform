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
					
					<!--end::Signin-->
					<!--begin::Signup-->
				{{--<div class="login-form login-signup">
					<!--begin::Form-->
					<form class="form" novalidate="novalidate" id="kt_login_signup_form">
						<!--begin::Title-->
						<div class="pb-13 pt-lg-0 pt-5">
							<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Sign Up</h3>
							<p class="text-muted font-weight-bold font-size-h4">Enter your details to create your account</p>
						</div>
						<!--end::Title-->
						<!--begin::Form group-->
						<div class="form-group">
							<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="text" placeholder="Fullname" name="fullname" autocomplete="off" />
						</div>
						<!--end::Form group-->
						<!--begin::Form group-->
						<div class="form-group">
							<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" autocomplete="off" />
						</div>
						<!--end::Form group-->
						<!--begin::Form group-->
						<div class="form-group">
							<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="password" placeholder="Password" name="password" autocomplete="off" />
						</div>
						<!--end::Form group-->
						<!--begin::Form group-->
						<div class="form-group">
							<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="password" placeholder="Confirm password" name="cpassword" autocomplete="off" />
						</div>
						<!--end::Form group-->
						<!--begin::Form group-->
						<div class="form-group">
							<label class="checkbox mb-0">
								<input type="checkbox" name="agree" />
								<span></span>
								<div class="ml-2">I Agree the
									<a href="#">terms and conditions</a>.</div>
							</label>
						</div>
						<!--end::Form group-->
						<!--begin::Form group-->
						<div class="form-group d-flex flex-wrap pb-lg-0 pb-3">
							<button type="button" id="kt_login_signup_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
							<button type="button" id="kt_login_signup_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
						</div>
						<!--end::Form group-->
					</form>
					<!--end::Form-->
				</div>--}}
				<!--end::Signup-->
					<!--begin::Forgot-->
				<div class="login-formt">
					<!--begin::Form-->
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif
					<form class="form" novalidate="novalidate" method="POST" action="{{ route('password.email') }}">
					@csrf
						<!--begin::Title-->
						<div class="pb-13 pt-lg-0 pt-5">
							<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Forgotten Password ?</h3>
							<p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password</p>
						</div>
						<!--end::Title-->
						<!--begin::Form group-->
						<div class="form-group">
							<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6 @error('email') is-invalid @enderror" type="email" placeholder="Email" name="email" autocomplete="off" />
							@error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
						</div>
						<!--end::Form group-->
						<!--begin::Form group-->
						<div class="form-group  flex-wrap pb-lg-0">
							<button type="submit" id="kt_login_forgot_submit" class="btn btn-primary my-3 mr-4">Send Password Reset Link</button>
							<a href="{{url('login')}}" class="btn btn-secondary">Back To Login</a>
						</div>
						<!--end::Form group-->
					</form>
					<!--end::Form-->
				</div>
				<!--end::Forgot-->
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