
<!DOCTYPE html>
<html lang="en">
<head>

	<title>{{env('APP_NAME')}}</title>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Webestica.com">
	<meta name="description" content="Technology and Corporate Bootstrap Theme">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Favicon -->
	<link rel="shortcut icon" href="https://mizzle.webestica.com/assets/images/favicon.ico">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="https://mizzle.webestica.com/assets/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="https://mizzle.webestica.com/assets/vendor/bootstrap-icons/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="https://mizzle.webestica.com/assets/vendor/swiper/swiper-bundle.min.css">
	
	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="https://mizzle.webestica.com/assets/css/style.css">

    <style>
        .fs-14
        {
            font-size:14px;
        }
        .us_step
        {
            color: gray;
            font-size: 14px;
            margin-bottom: 0.3rem;
        }
        .us_parent_row
        {
            box-shadow: 0px 0px 10px #c8c8c8;
            border-radius: 10px;
            padding: 0px 5rem 3rem;
        }
        .usmt10
        {
            margin-top:1rem;
        }
        .us_label_changng
        {
            font-weight: 100;
            font-size: 12px;
        }


        .loading-screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.9);
        display:flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        }

.loader {
  border: 8px solid #f3f3f3;
  border-top: 8px solid #09B850;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}



    </style>
</head>

<body>
<?php
    $setting = \App\Models\Setting::pluck('value','name')->toArray();
    $auth_logo = isset($setting['auth_logo']) ? 'uploads/'.$setting['auth_logo'] : 'assets/media/logos/logo-light.png';
    $auth_page_heading = isset($setting['auth_page_heading']) ? $setting['auth_page_heading'] : '';
   
    ?>
<div class="loading-screen" style="display:none;">
  <div class="loader"></div>
</div>

<!-- Header START -->
<header class="header-sticky header-absolute ">
	<!-- Logo Nav START -->
	<nav class="navbar navbar-expand-xl">
		<div class="container">
			<!-- Logo START -->
			<a class="navbar-brand me-0" href="index.html">
				<img class="light-mode-item navbar-brand-item" src="{{$auth_logo}}" alt="logo">
				<img class="dark-mode-item navbar-brand-item" src="{{$auth_logo}}" alt="logo">
			</a>
			<!-- Logo END -->

			<!-- Main navbar START -->
			<div class="navbar-collapse collapse" id="navbarCollapse">
				<ul class="navbar-nav navbar-nav-scroll dropdown-hover mx-auto">

					<!-- Nav item -->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Demos</a>
						
					</li>

					<!-- Nav item -->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">Pages</a>
						
					</li>

					<!-- Nav item -->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Portfolio</a>
						
					</li>

					<!-- Nav item -->
					<li class="nav-item"> <a class="nav-link" href="contact-v1.html">Contact us</a> </li>

					<!-- Nav item -->
					<li class="nav-item"> <a class="nav-link" href="docs/index.html" target="_blank">Docs</a> </li>
				</ul>
			</div>
			<!-- Main navbar END -->

			<!-- Buttons -->
			<ul class="nav align-items-center dropdown-hover ms-sm-2">
				<!-- Dark mode option START -->
				<li class="nav-item dropdown dropdown-animation">
					<button class="btn btn-link mb-0 px-2 lh-1" id="bd-theme"
					type="button"
					aria-expanded="false"
					data-bs-toggle="dropdown"
					data-bs-display="static">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"  class="bi bi-circle-half theme-icon-active fill-mode fa-fw" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
						<use href="#"></use>
					</svg>
					</button>

					<ul class="dropdown-menu min-w-auto dropdown-menu-end" aria-labelledby="bd-theme">
						<li class="mb-1">
							<button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">
								<svg width="16" height="16" fill="currentColor" class="bi bi-brightness-high-fill fa-fw mode-switch me-1" viewBox="0 0 16 16">
									<path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
									<use href="#"></use>
								</svg>Light
							</button>
						</li>
						<li class="mb-1">
							<button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-moon-stars-fill fa-fw mode-switch me-1" viewBox="0 0 16 16">
									<path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
									<path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
									<use href="#"></use>
								</svg>Dark
							</button>
						</li>
						<li>
							<button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-half fa-fw mode-switch me-1" viewBox="0 0 16 16">
									<path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
									<use href="#"></use>
								</svg>Auto
							</button>
						</li>
					</ul>
				</li>
				<!-- Dark mode option END -->

				<!-- Sign up button -->
				<li class="nav-item me-2">
					<a href="sign-up.html" class="btn btn-sm btn-light mb-0"><i class="bi bi-person-circle me-1"></i>Sign up</a>
				</li>
				<!-- Buy now button -->
				<li class="nav-item d-none d-sm-block">
					<button class="btn btn-sm btn-primary mb-0">Buy now!</button>
				</li>
				<!-- Responsive navbar toggler -->
				<li class="nav-item">
					<button class="navbar-toggler ms-sm-3 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-animation">
							<span></span>
							<span></span>
							<span></span>
						</span>
					</button>
				</li>	
			</ul>

		</div>
	</nav>
	<!-- Logo Nav END -->
</header>
<!-- Header END -->

<!-- **************** MAIN CONTENT START **************** -->
<main class="content">

<!-- =======================
Main hero START -->
<section class="pt-lg-8 pt-xl-9">
	<div class="container position-relative pt-4 pt-lg-0">
		<div class="row align-items-center">
			<!-- Title -->
			<div class="col-md-7 col-xl-6 mb-7 mb-md-0">
				<h1 class="mb-4">Discover the solutions we offer</h1>
				<p class="mb-4">Our experienced team is dedicated to helping you achieve your goals through innovative technology. </p>
				<a href="#" class="btn btn-lg btn-dark mb-5">Order Now</a>
				<!-- Rating -->
				
			</div>

			<!-- Image -->
			<div class="col-md-5 ms-auto">
				<img src="https://mizzle.webestica.com/assets/images/elements/service.svg" alt="">
			</div>
		</div>
	</div>	
</section>
<!-- =======================
Main hero END -->

<!-- =======================
Feature START -->
<section class="pt-0">

<form method="post" id="dataForm" action="{{route('save')}}"> 
                @csrf
    
	 <div class="container">
		<div class="row g-4 g-lg-5 us_parent_row" >

        <div class="alert alert-danger" style="display:none;" role="alert" id="error_message"></div>

            @if(session('success'))
                <div class="alert alert-success" id="success-message">
                    {{ session('success') }}
                </div>
            @endif

			<!-- Service item -->
			<div class="col-md-12">
                <div class="us_step">Step <span id="step_no">1</span> of <span id="step_no_of">3</span></div>
                <div class="progress" id="progress_bar">
                <div class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">33%</div>
                </div>
			</div>

     
        <!--------------STEP 1--------------------------------------->

		    <div class="usmt10 steps" id="step_1">

                <div class="col-md-12">
                <b>Registered Agent</b>
                <div class="pt-1 fs-14">Price: <span class="text-danger">${{$services[0]->price}}</span></div>
                </div>

                <div class="col-md-12 usmt10">
                <b>Name of Company <span class="text-danger us_label_changng">[Required]</span> </b>
                <div class="pt-1 fs-14">
                    <input type="text" class="form-control" name="company_name" id="company_name" />
                </div>
                </div>

                <div class="col-md-12 usmt10">
                <b>File Annual Report <span class="text-danger us_label_changng">[Required]</span> </b>
                <div class="pt-1 fs-14"> <input type="radio" name="file_annual_report" onchange="change_total_price(this , {{$services[1]->price - $services[0]->price}})"  value="0" />  No</div>
                <div class="pt-1 fs-14"><input type="radio" name="file_annual_report"  onchange="change_total_price(this , {{$services[1]->price - $services[0]->price}})"  value="1" /> <span class="">Yes +$95.00</span></div>
                <br>
                We can file your annual report for optimal privacy on public records.
                </div>

            </div>


        <!--------------STEP 2--------------------------------------->


        <div class="usmt10 steps" id="step_2" style="display:none;">

               


                <div class="col-md-12 usmt10">
                <b style="font-size: 1.3rem;">Company Updates</b>
                <div class="pt-1 fs-14"> 
                  <hr>
                </div>
                </div>

                <div class="col-md-12 usmt10">
                <b>Do you need to update your business details?</b>
                <div class="pt-1 fs-14"> 
                    Select if you need to update your principal business address, business mailing address, contact, or managers/owners.
                     </div>
                </div>
                

                <div class="col-md-12 usmt10">
                <div class="pt-1 fs-14"> <input type="checkbox"  name="update_business_details" id="update_business_details"  onclick="checkifparentcheckboxenable(this)"/>  Update Business Details </div>
                </div>


                <div id="business_detail_checkboxes"></div>

            </div>

            <!--------------STEP 3--------------------------------------->


        <div class="usmt10 steps" id="step_3" data-is_enable='no' style="display:none;">

            <div class="col-md-12">
                <b>Any Updates To Business Address? </b>
                <div class="pt-1 fs-14 usmt10">
                Natural person who is authorized to be the communications contact for the business entity.
                </div>
            </div>

         


                <div class="row pt-1 usmt10" >

                    <div class="col-md-12 pb-2">
                        <b>Principal Address </b>
                    </div>

                    <div class="col-md-12">
                        <div class="pt-1 fs-14">
                            <label class="pb-1">Street Address</label>
                            <input type="text" class="form-control" name="principal_street_address" id="principal_street_address" />
                            
                        </div>
                    </div>

                    <div class="col-md-12 pt-2">
                        <div class="pt-1 fs-14">
                            <label class="pb-1"> Address Line 2</label>
                            <input type="text" class="form-control" name="principal_street_address" id="principal_street_address" />
                            
                        </div>
                    </div>


                    <div class="col-md-6 pt-2">
                        <div class="pt-1 fs-14">
                        <label class="pb-1">City</label>
                            <input type="text" class="form-control" name="principal_city" id="principal_city" />
                            
                        </div>
                    </div>

                    <div class="col-md-6 pt-2">
                        <div class="pt-1 fs-14">
                        <label class="pb-1">State / Province / Region</label>
                            <input type="text" class="form-control" name="principal_state_province_region" id="principal_state_province_region" />
                            
                        </div>
                    </div>


                    <div class="col-md-6 pt-2">
                        <div class="pt-1 fs-14">
                        <label class="pb-1">ZIP / Postal Code</label>
                            <input type="text" class="form-control" name="principal_zip_code" id="principal_zip_code" />
                            
                        </div>
                    </div>

                    <div class="col-md-6 pt-2">
                        <div class="pt-1 fs-14">
                        <label class="pb-1">Country</label>
                        <select name="principal_country" class="form-control input_1_22_6"  ></select>
                        </div>
                    </div>


                    <div class="col-md-12 pb-2 usmt10">
                        <b>Mailing Address </b>
                    </div>

                    <div class="col-md-12">
                        <div class="pt-1 fs-14">
                            <label class="pb-1">Street Address</label>
                            <input type="text" class="form-control" name="mailing_street_address" id="mailing_street_address" />
                            
                        </div>
                    </div>

                    <div class="col-md-12 pt-2">
                        <div class="pt-1 fs-14">
                            <label class="pb-1"> Address Line 2</label>
                            <input type="text" class="form-control" name="mailing_street_address" id="mailing_street_address" />
                            
                        </div>
                    </div>


                    <div class="col-md-6 pt-2">
                        <div class="pt-1 fs-14">
                        <label class="pb-1">City</label>
                            <input type="text" class="form-control" name="mailing_city" id="mailing_city" />
                            
                        </div>
                    </div>

                    <div class="col-md-6 pt-2">
                        <div class="pt-1 fs-14">
                        <label class="pb-1">State / Province / Region</label>
                            <input type="text" class="form-control" name="mailing_state_province_region" id="mailing_state_province_region" />
                            
                        </div>
                    </div>


                    <div class="col-md-6 pt-2">
                        <div class="pt-1 fs-14">
                        <label class="pb-1">ZIP / Postal Code</label>
                            <input type="text" class="form-control" name="mailing_zip_code" id="mailing_zip_code" />
                            
                        </div>
                    </div>

                    <div class="col-md-6 pt-2">
                        <div class="pt-1 fs-14">
                        <label class="pb-1">Country</label>
                        <select name="mailing_country" class="form-control input_1_22_6"  ></select>
                        </div>
                    </div>

                   

                </div>


            </div>



              <!--------------STEP 3--------------------------------------->


        <div class="usmt10 steps" id="step_4" data-is_enable='no' style="display:none;">

                <div class="col-md-12">
                    <b>Do You Need To Update Designated Communications Contact?  </b>
                    <div class="pt-1 fs-14 usmt10">
                        Natural person who is authorized to be the communications contact for the business entity.
                    </div>
                </div>

                <div class="row pt-1 usmt10">

                <div class="col-md-12 pb-2">
                    <b>Communication Contact Name </b>
                </div>

                <div class="col-md-6 ">
                    <div class="pt-1 fs-14">
                        <label class="pb-1">Firstname</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" />
                        
                    </div>
                </div>

                <div class="col-md-6">
            
                    <div class="pt-1 fs-14">
                    <label class="pb-1">Lastname</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" />
                        
                    </div>
                </div>

                </div>



                    <div class="row pt-1 usmt10">

                        <div class="col-md-12 pb-2">
                            <b>Communication Contact Address </b>
                        </div>

                        <div class="col-md-12">
                            <div class="pt-1 fs-14">
                                <label class="pb-1">Street Address</label>
                                <input type="text" class="form-control" name="street_address" id="street_address" />
                                
                            </div>
                        </div>

                        <div class="col-md-12 pt-2">
                            <div class="pt-1 fs-14">
                                <label class="pb-1"> Address Line 2</label>
                                <input type="text" class="form-control" name="street_address" id="street_address" />
                                
                            </div>
                        </div>


                        <div class="col-md-6 pt-2">
                            <div class="pt-1 fs-14">
                            <label class="pb-1">City</label>
                                <input type="text" class="form-control" name="city" id="city" />
                                
                            </div>
                        </div>

                        <div class="col-md-6 pt-2">
                            <div class="pt-1 fs-14">
                            <label class="pb-1">State / Province / Region</label>
                                <input type="text" class="form-control" name="state_province_region" id="state_province_region" />
                                
                            </div>
                        </div>


                        <div class="col-md-6 pt-2">
                            <div class="pt-1 fs-14">
                            <label class="pb-1">ZIP / Postal Code</label>
                                <input type="text" class="form-control" name="zip_code" id="zip_code" />
                                
                            </div>
                        </div>

                        <div class="col-md-6 pt-2">
                            <div class="pt-1 fs-14">
                            <label class="pb-1">Country</label>
                            <select name="country" class="form-control input_1_22_6"  ></select>
                            </div>
                        </div>



                        <div class="col-md-12 pt-2">
                            <div class="pt-1 fs-14">
                                <label class="pb-1">Communication Contact Phone</label>
                                <input type="text" class="form-control" name="contact_phone" id="contact_phone" />
                                
                            </div>
                        </div>

                        <div class="col-md-12 pt-2">
                            <div class="pt-1 fs-14">
                                <label class="pb-1"> Communication Contact Email</label>
                                <input type="text" class="form-control" name="communication_email" id="communication_email" />
                                
                            </div>
                        </div>

                    </div>
        </div>




             <!--------------STEP 5--------------------------------------->


        <div class="usmt10 steps" id="step_5"  data-is_enable='no' style="display:none;">

            <div class="col-md-12">
                <b>Manager(s) </b>
                <div class="pt-1 fs-14 usmt10">
                    The Wyoming Secretary of State requires that contact information for all managers be maintained by the registered agent. It is your responsibility to notify us within 30 days of any changes to your LLC's managers.
                </div>

                <hr>
            </div>


            <div class="col-md-12 ">
                <b>Number of Managers  </b>
                <div class="pt-1 fs-14 usmt10 mb-2">
                    <select class="form-control" name="no_of_manager" onchange="appendNewManger(this)">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>

                <b class="pt-2">Manager 1</b>
                <hr>
            </div>



                <div class="row pt-1 usmt10">

                    <div class="col-md-12 pb-2">
                        <b>Manager 1 Address </b>
                    </div>

                    <div class="col-md-12">
                        <div class="pt-1 fs-14">
                            <label class="pb-1">Street Address</label>
                            <input type="text" class="form-control" name="manager_one_street_address" id="manager_one_street_address" />
                            
                        </div>
                    </div>

                    <div class="col-md-12 pt-2">
                        <div class="pt-1 fs-14">
                            <label class="pb-1"> Address Line 2</label>
                            <input type="text" class="form-control" name="manager_one_street_address" id="manager_one_street_address" />
                            
                        </div>
                    </div>


                    <div class="col-md-6 pt-2">
                        <div class="pt-1 fs-14">
                        <label class="pb-1">City</label>
                            <input type="text" class="form-control" name="manager_one_city" id="manager_one_city" />
                            
                        </div>
                    </div>

                    <div class="col-md-6 pt-2">
                        <div class="pt-1 fs-14">
                        <label class="pb-1">State / Province / Region</label>
                            <input type="text" class="form-control" name="manager_one_state_province_region" id="manager_one_state_province_region" />
                            
                        </div>
                    </div>


                    <div class="col-md-6 pt-2">
                        <div class="pt-1 fs-14">
                        <label class="pb-1">ZIP / Postal Code</label>
                            <input type="text" class="form-control" name="manager_one_zip_code" id="manager_one_zip_code" />
                            
                        </div>
                    </div>

                    <div class="col-md-6 pt-2">
                        <div class="pt-1 fs-14">
                        <label class="pb-1">Country</label>
                        <select name="manager_one_country" class="form-control input_1_22_6"  ></select>
                        </div>
                    </div>



                    <div class="col-md-12 pt-2">
                        <div class="pt-1 fs-14">
                            <label class="pb-1">Manager 1 Phone</label>
                            <input type="text" class="form-control" name="manager_one_contact_phone" id="manager_one_contact_phone" />
                            
                        </div>
                    </div>

                    <div class="col-md-12 pt-2">
                        <div class="pt-1 fs-14">
                            <label class="pb-1"> Manager 1 Email</label>
                            <input type="text" class="form-control" name="manager_one_communication_email" id="manager_one_communication_email" />
                            
                        </div>
                    </div>

                </div>

                <div id="manger_listing"></div>
        </div>



         <!--------------STEP 6--------------------------------------->


        <div class="usmt10 steps" id="step_6" data-is_enable='no' style="display:none;">

            <div class="col-md-12">
                <b>Owner(s) </b>
                <div class="pt-1 fs-14 usmt10">
                    The Wyoming Secretary of State requires that contact information for all owners be maintained by the registered agent. It is your responsibility to notify us within 30 days of any changes to your LLC's owner(s).
                </div>

                <hr>
            </div>


            <div class="col-md-12 ">
                <b>Number of Owners   </b>
                <div class="pt-1 fs-14 usmt10 mb-2">
                    <select class="form-control" name="no_of_owner" onchange="appendNewOwner(this)">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>

                <b class="pt-2">Owner 1</b>
                <hr>
            </div>


            <div class="row pt-1 usmt10">

                    <div class="col-md-12 pb-2">
                        <b>Owner 1 Name </b>
                    </div>

                  
                    <div class="col-md-6 pt-2">
                        <div class="pt-1 fs-14">
                        <label class="pb-1">Firstname</label>
                            <input type="text" class="form-control" name="owner_one_firstname" id="owner_one_firstname" />
                            
                        </div>
                    </div>


                    <div class="col-md-6 pt-2">
                        <div class="pt-1 fs-14">
                        <label class="pb-1">Lastname</label>
                            <input type="text" class="form-control" name="owner_one_lastname" id="owner_one_lastname" />
                            
                        </div>
                    </div>

                    <div class="col-md-12 pt-2">
                        <div class="pt-1 fs-14">
                            <label class="pb-1">Owner 1 Phone</label>
                            <input type="text" class="form-control" name="owner_one_contact_phone" id="owner_one_contact_phone" />
                            
                        </div>
                    </div>

                    <div class="col-md-12 pt-2">
                        <div class="pt-1 fs-14">
                            <label class="pb-1"> Owner 1 Email</label>
                            <input type="text" class="form-control" name="owner_one_communication_email" id="owner_one_communication_email" />
                            
                        </div>
                    </div>

            </div>

                <div id="owner_listing"></div>


        </div>





         <!--------------STEP 7--------------------------------------->


        <div class=" row usmt10 steps" id="step_7" data-is_enable='no' style="display:none;">

            <div class="col-md-12">
                <b>Annual Report </b>
                <div class="pt-1 fs-14 usmt10" >
                List only assets physically located in Wyoming. It is not uncommon for businesses to enter all 0.
                </div>

                <hr>
            </div>


        <div class="col-md-6 usmt10">
            <b class="usmt10">Cash </b>
            <div class="pt-1 fs-14 ">
                <div class="pt-1 fs-14"> 
                    <input type="text" class="form-control" placeholder="0" name="cash" id="cash" />    
                </div>
            </div>
        </div>

        <div class="col-md-6 usmt10">
            <b class="usmt10">Trade Notes and Accounts Receivable </b>
            <div class="pt-1 fs-14 ">
                <div class="pt-1 fs-14"> 
                    <input type="text" class="form-control" placeholder="0" name="trade_notes_and_accounts_receivable" id="trade_notes_and_accounts_receivable" />   
                </div>
            </div>
        </div>


        <div class="col-md-6 usmt10">
            <b class="usmt10">Subtract Allowance for Bad Debts </b>
            <div class="pt-1 fs-14 ">
                <div class="pt-1 fs-14"> 
                    <input type="text" class="form-control" placeholder="0" name="subtract_allowance_for_bad_debts" id="subtract_allowance_for_bad_debts" />    
                </div>
            </div>
        </div>

        <div class="col-md-6 usmt10">
            <b class="usmt10">Trade Notes and Accounts Receivable </b>
            <div class="pt-1 fs-14 ">
                <div class="pt-1 fs-14"> 
                    <input type="text" class="form-control" placeholder="0" name="inventories" id="inventories" />   
                </div>
            </div>
        </div>



        <div class="col-md-6 usmt10">
            <b class="usmt10">U.S. Government Obligations </b>
            <div class="pt-1 fs-14 ">
                <div class="pt-1 fs-14"> 
                    <input type="text" class="form-control" placeholder="0" name="U_S_government_obligations" id="U_S_government_obligations" />    
                </div>
            </div>
        </div>

        <div class="col-md-6 usmt10">
            <b class="usmt10">Tax Exempt Securities </b>
            <div class="pt-1 fs-14 ">
                <div class="pt-1 fs-14"> 
                    <input type="text" class="form-control" placeholder="0" name="tax_exempt_securities" id="tax_exempt_securities" />   
                </div>
            </div>
        </div>


        <div class="col-md-6 usmt10">
            <b class="usmt10">Other Current Assets </b>
            <div class="pt-1 fs-14 ">
                <div class="pt-1 fs-14"> 
                    <input type="text" class="form-control" placeholder="0" name="other_current_assets" id="other_current_assets" />    
                </div>
            </div>
        </div>

        <div class="col-md-6 usmt10">
            <b class="usmt10">Loans to Stockholders </b>
            <div class="pt-1 fs-14 ">
                <div class="pt-1 fs-14"> 
                    <input type="text" class="form-control" placeholder="0" name="loans_to_stockholders" id="loans_to_stockholders" />   
                </div>
            </div>
        </div>



        <div class="col-md-6 usmt10">
            <b class="usmt10">Mortgage and Real Estate Loans </b>
            <div class="pt-1 fs-14 ">
                <div class="pt-1 fs-14"> 
                    <input type="text" class="form-control" placeholder="0" name="mortgage_and_real_estate_loans" id="mortgage_and_real_estate_loans" />    
                </div>
            </div>
        </div>

        <div class="col-md-6 usmt10">
            <b class="usmt10">Other Investments </b>
            <div class="pt-1 fs-14 ">
                <div class="pt-1 fs-14"> 
                    <input type="text" class="form-control" placeholder="0" name="other_investments" id="other_investments" />   
                </div>
            </div>
        </div>



        <div class="col-md-6 usmt10">
            <b class="usmt10">Buildings and Other Depreciable Tangible Assets </b>
            <div class="pt-1 fs-14 ">
                <div class="pt-1 fs-14"> 
                    <input type="text" class="form-control" placeholder="0" name="buildingsandotherdepreciabletangibleassets" id="buildingsandotherdepreciabletangibleassets" />    
                </div>
            </div>
        </div>

        <div class="col-md-6 usmt10">
            <b class="usmt10">Depletable assets </b>
            <div class="pt-1 fs-14 ">
                <div class="pt-1 fs-14"> 
                    <input type="text" class="form-control" placeholder="0" name="depletable_assets" id="depletable_assets" />   
                </div>
            </div>
        </div>


        <div class="col-md-6 usmt10">
            <b class="usmt10">Land </b>
            <div class="pt-1 fs-14 ">
                <div class="pt-1 fs-14"> 
                    <input type="text" class="form-control" placeholder="0" name="land" id="land" />    
                </div>
            </div>
        </div>

        <div class="col-md-6 usmt10">
            <b class="usmt10">Subtract Accumulated Amortization</b>
            <div class="pt-1 fs-14 ">
                <div class="pt-1 fs-14"> 
                    <input type="text" class="form-control" placeholder="0" name="subtract_accumulated_amortization" id="subtract_accumulated_amortization" />   
                </div>
            </div>
        </div>


        <div class="col-md-6 usmt10">
            <b class="usmt10"> Other Assets </b>
            <div class="pt-1 fs-14 ">
                <div class="pt-1 fs-14"> 
                    <input type="text" class="form-control" placeholder="0" name="other_assets" id="other_assets" />    
                </div>
            </div>
        </div>

        <div class="col-md-6 usmt10">
            <b class="usmt10">Subtract Accumulated Amortization</b>
            <div class="pt-1 fs-14 ">
                <div class="pt-1 fs-14"> 
                    <input type="text" class="form-control" placeholder="0" name="subtract_accumulated_amortization" id="subtract_accumulated_amortization" />   
                </div>
            </div>
        </div>


            <div class="col-md-12 usmt10">
            <b>Consent <span class="text-danger us_label_changng">[Required]</span> </b>
                <div class="pt-1 fs-14 usmt10">
                <div class="pt-1 fs-14"> <input type="checkbox"  name="consent_i_aggree" checked  id="consent_i_aggree" /> I agree </div>
                <hr>
                <p>
                I agree to allow WYCRA or its agent's to file an annual report on behalf of my entity. I understand that information provided will be used to file an annual report. I also certify that the information provided is true and correct and that I have authority to allow WYCRA or its agent's to file such annual report.
                </p>
                </div>

              
            </div>

        </div>




        <!--------------STEP 8--------------------------------------->


        <div class="usmt10 steps" id="step_8" data-is_enable='no' style="display:none;">

            <div class="col-md-12">
                <b>Total </b>
                <div class="pt-1 fs-14 usmt10" id="totl_amt">
                   
                </div>

                <hr>
            </div>



            <div class="col-md-12">
            <b>Agree to Terms of Service <span class="text-danger us_label_changng">[Required]</span> </b>
                <div class="pt-1 fs-14 usmt10">
                <div class="pt-1 fs-14"> <input type="checkbox"  name="i_aggree"  id="i_aggree" /> I agree </div>
                </div>

                <hr>
            </div>

            
            <div class="col-md-12">
            <b>Card Holder Name </b>
                <div class="pt-1 fs-14 usmt10">
                    <div class="pt-1 fs-14"> 
                        <input type="text" class="form-control" name="cardholder_name" id="cardholder_name" />    
                    </div>
                </div>

            </div>

            <div class="col-md-12">
            <b>Email </b>
                <div class="pt-1 fs-14 usmt10">
                    <div class="pt-1 fs-14"> 
                        <input type="text" class="form-control" name="cardholderemail" id="cardholderemail" />   
                    </div>
                </div>

            </div>


        </div>


            <div class="col-md-12 usmt10">
                <button class="btn btn-sm btn-secondary" type="button" style="display:none;" onclick="previousStep()" id="previous_btn" >Previous</button>
                <button class="btn btn-sm btn-primary" type="button" onclick="nextStep()">Next</button>
                <button id="customButton" class="btn comman" type="button" style="display:none;width: 100%;">{{ trans('labels.stripe_payment') }}</button>
            </div>


		</div>

	    </div>	
   
        <input type="hidden" id="total_price" name="total_price"  value="{{ $services[0]->price + ($services[1]->price - $services[0]->price)}}" />
        <input type="hidden" name="order_type"  value="registered_agent_renew_llc" />
        <input type="hidden" id="current_step" max="6" value="1" />
  </form>
</section>
<!-- =======================
Feature END -->




</main>
<!-- **************** MAIN CONTENT END **************** -->


<!-- Back to top -->
<div class="back-top"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://mizzle.webestica.com/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Vendors -->
<script src="https://mizzle.webestica.com/assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Theme Functions -->
<script src="https://mizzle.webestica.com/assets/js/functions.js"></script>

<script src="https://checkout.stripe.com/v2/checkout.js"></script>


<script>
    // Check if the success message exists and scroll to it on page load
    document.addEventListener('DOMContentLoaded', function () {
        var successMessage = document.getElementById('success-message');

        if (successMessage) 
        {
            successMessage.scrollIntoView({ behavior: 'smooth' });
        }
    });
</script>


<script>

function checkifparentcheckboxenable(self)
{
    if($(self).is(':checked'))
    {
        $('#business_detail_checkboxes').html('<div class="col-md-12 usmt10"><h5 class="">Please select what you would like to update.</h5><hr></div><div class="col-md-12 usmt10"><b>Principal Business Address</b><div class="pt-1 fs-14"> <input type="checkbox" name="principle_business_address" class="checkbx" id="pba" onclick="checkIfEable(this, 1)" /> I Need To Update My Principal Business Address </div></div><div class="col-md-12 usmt10"><b>Business Mailing Address</b><div class="pt-1 fs-14"> <input type="checkbox" name="business_mailing_address" class="checkbx" id="bma" onclick="checkIfEable(this,1)" /> I Need To Update My Business Mailing Address </div></div><div class="col-md-12 usmt10"><b>Designated Contact</b><div class="pt-1 fs-14"> <input type="checkbox" name="designed_contact" class="checkbx" id="dc" onclick="checkIfEable(this)" /> I Need To Update My Designated Contact </div></div><div class="col-md-12 usmt10"><b>Manager Details</b><div class="pt-1 fs-14"> <input type="checkbox" name="manager_details" class="checkbx" id="md" onclick="checkIfEable(this)" /> I Need To Update My Company\'s Manager(s) </div></div><div class="col-md-12 usmt10"><b>Owner Details</b><div class="pt-1 fs-14"> <input type="checkbox" name="owner_details" class="checkbx" id="od" onclick="checkIfEable(this)" /> I Need To Update My Company\'s Owner(s) Details </div></div>');
    }
    else
    {
        $('#business_detail_checkboxes').html('');

        var selectedValue = $('input[name="file_annual_report"]:checked').val();

        $stepNo=4;
        $widthTotl=50;

        if (selectedValue !== undefined && selectedValue == 0) 
        {
            $stepNo=3;
            $widthTotl=66;
        } 
        

        $('#step_no_of').html($stepNo)
        $('#progress_bar').html('<div class="progress-bar" role="progressbar" style="width:'+$widthTotl+'%;" aria-valuenow="'+$widthTotl+'" aria-valuemin="0" aria-valuemax="100">'+$widthTotl+'%</div>');
    } 
}

function checkIfEable(self , is_check = null)
{
    if($(self).is(':checked'))
    {
        $('#step_no_of').html( parseInt($('#step_no_of').html()) + 1);
    }
    else if (is_check != null && (!$('#pba').is(':checked') && !$('#bma').is(':checked') )) 
    {
        $('#step_no_of').html( parseInt($('#step_no_of').html()) - 1);
    }
    else if(is_check == null)
    {
        $('#step_no_of').html( parseInt($('#step_no_of').html()) - 1);
    }
       
    
    if (is_check != null && $('#pba').is(':checked') && $('#bma').is(':checked')) 
    {
        $('#step_no_of').html( parseInt($('#step_no_of').html()) - 1);
    }

        var current_step =  parseInt($('#current_step').val());

        $total_steps = parseInt($('#step_no_of').html());

        $current_percentage = Math.floor( (100 / $total_steps ) * current_step );

        $('#progress_bar').html('<div class="progress-bar" role="progressbar" style="width: '+$current_percentage+'%;" aria-valuenow="'+$current_percentage+'" aria-valuemin="0" aria-valuemax="100">'+$current_percentage+'%</div>')
       
}

function change_total_price(self , price)
{
    var selfval = $(self).val();

    if(selfval == 0)
    {
        $('#total_price').val('{{ $services[0]->price}}');
        $('#step_no_of').html('3');
        $('#progress_bar').html('<div class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">33%</div>');
    }
    else
    {
        $('#total_price').val('{{ $services[0]->price + 95}}');
        $('#step_no_of').html('4');
        $('#progress_bar').html('<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>')
    }

    if ($("#update_business_details").prop("checked")) 
    {
        $('#update_business_details').click();
    }

    
    $('#totl_amt').html('$'+$('#total_price').val())
}

      var handler = StripeCheckout.configure({
      key: '{{env('live_public_key')}}',
      image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
      locale: 'auto',
      token: function(token) {
        // You can access the token ID with `token.id`.
        // Get the token ID to your server-side code for use.

        var order_total = $('#total_price').val();
      
        var token = token.id;

        $('.loading-screen').show('slow')
      // Show the content after the loading is complete
      $('.content').hide('slow');


        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{ URL::to('stripe-payment/charge') }}",
            data: 
            {
                order_total : parseFloat(order_total),
                stripeToken : token,
                stripeEmail : $('#cardholderemail').val(),
                stripeName  : $('#cardholder_name').val()
            }, 
            method: 'POST',
            success: function(response) 
            {
                if (response.status == 1) 
                {
                    $('#dataForm').submit();
                }
                 else 
                 {
                    $('#error_message').html(response.message);
                    $('#error_message').show('slow');

                    $('.loading-screen').hide('slow')
                    // Show the content after the loading is complete
                    $('.content').show('slow');

                    setTimeout(function() 
                    { 
                        $('#error_message').hide('slow');
                    }, 2500);
                }
            },
            error: function(error) {

                // $('#errormsg').show();
            }
        });

      },
      opened: function() {
        // console.log("Form opened");
      },
      closed: function() {
        // console.log("Form closed");
      }
    });



    $('#customButton').on('click', function(e) {
        "use strict";
      var paid_amount = parseInt($('#total_price').val());
            
                handler.open({
                    name: '{{env('APP_NAME')}}',
                    description: 'Order payment',
                    amount: paid_amount*100,
                    currency: "USD",
                    email: $('#cardholderemail').val()
                });
                e.preventDefault();
                // Close Checkout on page navigation:
                $(window).on('popstate', function() {
                  handler.close();
                });
       
    });



   function appendNewOwner(self)
   {
    var tillLoop = parseInt($(self).val());

        // Clear the existing content
        $('#owner_listing').html('');

        for (var i = 1; i <= tillLoop; i++) 
        {
                if (i > 1) 
                {  // Skip the first alteration, start from 2nd
                    var suffix = i === 2 ? 'two' : 'three';  // Add a suffix based on the index
                    $('#owner_listing').append('<div class="row pt-1 usmt10">' +
    '<div class="col-md-12 pb-2"><b>Owner ' + i + '</b> <hr></div>' +
    '<div class="col-md-6 pt-2">' +
    '<div class="pt-1 fs-14">' +
    '<label class="pb-1">Firstname</label>' +
    '<input type="text" class="form-control" name="owner_' + suffix + '_firstname" id="owner_' + suffix + '_firstname" />' +
    '</div>' +
    '</div>' +
    '<div class="col-md-6 pt-2">' +
    '<div class="pt-1 fs-14">' +
    '<label class="pb-1">Lastname</label>' +
    '<input type="text" class="form-control" name="owner_' + suffix + '_lastname" id="owner_' + suffix + '_lastname" />' +
    '</div>' +
    '</div>' +
    '<div class="col-md-12 pt-2">' +
    '<div class="pt-1 fs-14">' +
    '<label class="pb-1">Owner ' + i + ' Phone</label>' +
    '<input type="text" class="form-control" name="owner_' + suffix + '_contact_phone" id="owner_' + suffix + '_contact_phone" />' +
    '</div>' +
    '</div>' +
    '<div class="col-md-12 pt-2">' +
    '<div class="pt-1 fs-14">' +
    '<label class="pb-1"> Owner ' + i + ' Email</label>' +
    '<input type="text" class="form-control" name="owner_' + suffix + '_communication_email" id="owner_' + suffix + '_communication_email" />' +
    '</div>' +
    '</div>' +
    '</div>');

                }
        }
   }

    function appendNewManger(self) 
    {
        var tillLoop = parseInt($(self).val());

        // Clear the existing content
        $('#manger_listing').html('');

        for (var i = 1; i <= tillLoop; i++) 
        {
                if (i > 1) 
                {  // Skip the first alteration, start from 2nd
                    var suffix = i === 2 ? 'two' : 'three';  // Add a suffix based on the index
                    $('#manger_listing').append('<div class="row pt-1 usmt10">' +
                    '<div class="col-md-12 pb-2"><b>Manager ' + i + '  </b> <hr></div>' +
                    '<div class="col-md-12"><div class="pt-1 fs-14"><label class="pb-1">Street Address</label><input type="text" class="form-control" name="manager_' + suffix + '_street_address" id="manager_' + suffix + '_street_address" /></div></div>' +
                    '<div class="col-md-12 pt-2"><div class="pt-1 fs-14"><label class="pb-1"> Address Line 2</label><input type="text" class="form-control" name="manager_' + suffix + '_address_line_2" id="manager_' + suffix + '_address_line_2" /></div></div>' +
                    '<div class="col-md-6 pt-2"><div class="pt-1 fs-14"><label class="pb-1">City</label><input type="text" class="form-control" name="manager_' + suffix + '_city" id="manager_' + suffix + '_city" /></div></div>' +
                    '<div class="col-md-6 pt-2"><div class="pt-1 fs-14"><label class="pb-1">State / Province / Region</label><input type="text" class="form-control" name="manager_' + suffix + '_state_province_region" id="manager_' + suffix + '_state_province_region" /></div></div>' +
                    '<div class="col-md-6 pt-2"><div class="pt-1 fs-14"><label class="pb-1">ZIP / Postal Code</label><input type="text" class="form-control" name="manager_' + suffix + '_zip_code" id="manager_' + suffix + '_zip_code" /></div></div>' +
                    '<div class="col-md-6 pt-2"><div class="pt-1 fs-14"><label class="pb-1">Country</label><select name="manager_' + suffix + '_country" class="form-control input_1_22_6"  ></select></div></div>' +
                    '<div class="col-md-12 pt-2"><div class="pt-1 fs-14"><label class="pb-1">Manager ' + i + ' Phone</label><input type="text" class="form-control" name="manager_' + suffix + '_contact_phone" id="manager_' + suffix + '_contact_phone" /></div></div>' +
                    '<div class="col-md-12 pt-2"><div class="pt-1 fs-14"><label class="pb-1"> Manager ' + i + ' Email</label><input type="text" class="form-control" name="manager_' + suffix + '_communication_email" id="manager_' + suffix + '_communication_email" /></div></div>' +
                    '</div>');
                }
        }

            appendCountries()
}


    function previousStep()
    {
        var current_step =  parseInt($('#current_step').val());

        $current_val = current_step - 1;

        var current_step = $('#current_step').val($current_val);

        $total_steps = parseInt($('#step_no_of').html());

        $current_percentage = Math.floor( (100 / $total_steps ) * $current_val );

        $('#step_no').html($current_val);

        $('#progress_bar').html('<div class="progress-bar" role="progressbar" style="width: '+$current_percentage+'%;" aria-valuenow="'+$current_percentage+'" aria-valuemin="0" aria-valuemax="100">'+$current_percentage+'%</div>')

        if($current_val > 1)
        {
            $('#previous_btn').show();
        }
        else
        {
            $('#previous_btn').hide();
        }

        $('.steps').hide();

            var is_enable_step_3 = $("#step_3").attr("data-is_enable");
            var is_enable_step_4 = $("#step_4").attr("data-is_enable");
            var is_enable_step_5 = $("#step_5").attr("data-is_enable");
            var is_enable_step_6 = $("#step_6").attr("data-is_enable");
            var is_enable_step_7 = $("#step_7").attr("data-is_enable");
            

            if( ($current_val >= 3 || $current_val <=8 ) && is_enable_step_7 === "yes")
            {
                $('#step_7').show();
                $("#step_7").attr("data-is_enable", "no");
            }
            else if(($current_val >= 3 || $current_val <=8 )  && is_enable_step_6 === "yes"  && $('#od').is(':checked') )
            {
                $('#step_6').show();
                $("#step_6").attr("data-is_enable", "no");
            }
            else if(($current_val >= 3 || $current_val <=8 )  && is_enable_step_5 === "yes" && $('#md').is(':checked') )
            {
                $('#step_5').show();
                $("#step_5").attr("data-is_enable", "no");
            }
            else if(($current_val >= 3 || $current_val <=8 )  && is_enable_step_4 === "yes"  && $('#dc').is(':checked') )
            {
                $('#step_4').show();
                $("#step_4").attr("data-is_enable", "no");
            }
            else if(($current_val >= 3 || $current_val <=8 )  && is_enable_step_3 === "yes" && ($('#pba').is(':checked') || $('#bma').is(':checked')))
            {
                $('#step_3').show();
                $("#step_3").attr("data-is_enable", "no");
            }
            else
            {
                $('#step_'+$current_val).show();  
            }
    }

    function nextStep()
    {

        var current_step =  parseInt($('#current_step').val());
        $total_steps = parseInt($('#step_no_of').html());

        if (!$('input[name="file_annual_report"]:checked').length) 
        {
            $('#error_message').html('Please select one option from File Annual Report!');
            $('#error_message').show('slow');
            setTimeout(function() 
            { 
                $('#error_message').hide('slow');
            }, 2500);

        }
        else if(current_step == 1 && $('#company_name').val() == '')
        {
            $('#error_message').html('Company Name field required!');
            $('#error_message').show('slow');
            setTimeout(function() 
            { 
                $('#error_message').hide('slow');
            }, 2500);
        } 
        else if (current_step == 7 && !$('#consent_i_aggree').is(':checked')) 
        {
            $('#error_message').html('Please check on i agree condition!');
            $('#error_message').show('slow');

            setTimeout(function() 
            { 
                $('#error_message').hide('slow');
            }, 3500);
        } 
        else 
        {
            $('#error_message').hide('slow');
            
            if((current_step + 1) > $total_steps)
            {
                $current_val = $total_steps ;

                if (!$('#i_aggree').is(':checked')) 
                {
                    $('#error_message').html('Please check on i agree condition!');
                    $('#error_message').show('slow');
                }
                else if( $('#cardholder_name').val() == '' ||  $('#cardholderemail').val() == '' )
                {
                    $('#error_message').html('Card holder name & email field required!');
                    $('#error_message').show('slow');
                }
                else
                {
                    $('#customButton').click()
                }

                setTimeout(function() 
                { 
                    $('#error_message').hide('slow');
                }, 2500);
            }
            else
            {
                $current_val = current_step + 1;
            }
            
            var current_step = $('#current_step').val($current_val);

            $current_percentage = Math.floor( (100 / $total_steps) * $current_val );

            $('#step_no').html($current_val);

            $('#progress_bar').html('<div class="progress-bar" role="progressbar" style="width: '+$current_percentage+'%;" aria-valuenow="'+$current_percentage+'" aria-valuemin="0" aria-valuemax="100">'+$current_percentage+'%</div>')

            if($current_val > 1)
            {
                $('#previous_btn').show();
            }
            else
            {
                $('#previous_btn').hide();
            }

            $('.steps').hide();

            var is_enable_step_3 = $("#step_3").attr("data-is_enable");
            var is_enable_step_4 = $("#step_4").attr("data-is_enable");
            var is_enable_step_5 = $("#step_5").attr("data-is_enable");
            var is_enable_step_6 = $("#step_6").attr("data-is_enable");
            var is_enable_step_7 = $("#step_7").attr("data-is_enable");
            
            if($current_val == 3 && is_enable_step_3 === "no" && ($('#pba').is(':checked') || $('#bma').is(':checked')))
            {
                $('#step_3').show();
                $("#step_3").attr("data-is_enable", "yes");
            }
            else if(($current_val == 3 || $current_val == 4  )  && is_enable_step_4 === "no"  && $('#dc').is(':checked') )
            {
                $('#step_4').show();
                $("#step_4").attr("data-is_enable", "yes");
            }
            else if(($current_val == 3 || $current_val == 4 || $current_val == 5  ) && is_enable_step_5 === "no" && $('#md').is(':checked') )
            {
                $('#step_5').show();
                $("#step_5").attr("data-is_enable", "yes");
            }
            else if(($current_val == 3 || $current_val == 4 || $current_val == 5 || $current_val == 6 ) && is_enable_step_6 === "no"  && $('#od').is(':checked') )
            {
                $('#step_6').show();
                $("#step_6").attr("data-is_enable", "yes");
            }
            else if( ($current_val == 3 || $current_val == 4 || $current_val == 5 || $current_val == 6 || $current_val == 7 ) && is_enable_step_7 === "no")
            {
                var selectedValue = $('input[name="file_annual_report"]:checked').val();

                if (selectedValue !== undefined && selectedValue == 0) 
                {
                    $('#step_8').show();
                } 
                else
                {
                    $('#step_7').show();
                    $("#step_7").attr("data-is_enable", "yes");
                }
            }
            else if($current_val > 2)
            {
                $('#step_8').show();  
            }
            else
            {
                $('#step_'+$current_val).show();  
            }
        }


        var error_message = document.getElementById('error_message');

        if (error_message) 
        {
            error_message.scrollIntoView({ behavior: 'smooth' });
        }
      
    }

</script>


<script>
    $(document).ready(function () {
        appendCountries()
    });


    function appendCountries()
    {
         // List of countries
         var countries = [
            "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antarctica", "Antigua and Barbuda", "Argentina",
            "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados",
            "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bonaire, Sint Eustatius and Saba",
            "Bosnia and Herzegovina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam",
            "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Cayman Islands",
            "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos Islands", "Colombia", "Comoros",
            "Congo", "Congo, Democratic Republic of the", "Cook Islands", "Costa Rica", "Croatia", "Cuba", "Curaçao",
            "Cyprus", "Czechia", "Côte d'Ivoire", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador",
            "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Falkland Islands",
            "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories",
            "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe",
            "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard Island and McDonald Islands",
            "Holy See", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland",
            "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati",
            "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao People's Democratic Republic",
            "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Madagascar",
            "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius",
            "Mayotte", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique",
            "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria",
            "Niue", "Norfolk Island", "North Macedonia", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau",
            "Palestine, State of", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal",
            "Puerto Rico", "Qatar", "Romania", "Russian Federation", "Rwanda", "Réunion", "Saint Barthélemy", "Saint Helena, Ascension and Tristan da Cunha",
            "Saint Kitts and Nevis", "Saint Lucia", "Saint Martin", "Saint Pierre and Miquelon", "Saint Vincent and the Grenadines", "Samoa",
            "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore",
            "Sint Maarten", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands",
            "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard and Jan Mayen", "Sweden", "Switzerland", "Syria Arab Republic",
            "Taiwan", "Tajikistan", "Tanzania, the United Republic of", "Thailand", "Timor-Leste", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago",
            "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "US Minor Outlying Islands", "Uganda", "Ukraine",
            "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Viet Nam",
            "Virgin Islands, British", "Virgin Islands, U.S.", "Wallis and Futuna", "Western Sahara", "Yemen", "Zambia", "Zimbabwe", "Åland Islands"
        ];

        // Reference to the select element
        var selectElement = $('.input_1_22_6');

        // Append options to the select element
        $.each(countries, function (index, country) {
            var option = $('<option>', {
                value: country,
                text: country
            });
            selectElement.append(option);
        });
    }
</script>



</body>
</html>