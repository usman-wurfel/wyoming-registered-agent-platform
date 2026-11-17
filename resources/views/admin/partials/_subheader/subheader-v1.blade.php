<?php  use Illuminate\Support\Facades\Request;  ?>
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader" kt-hidden-height="54" style="">
			<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
				<!--begin::Info-->
				<div class="d-flex align-items-center flex-wrap mr-1">
					<!--begin::Page Heading-->
					<div class="d-flex align-items-baseline flex-wrap mr-5">
						<!--begin::Page Title-->
						<h5 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h5>
						<!--end::Page Title-->
						<!--begin::Breadcrumb-->
						<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
							<li class="breadcrumb-item text-muted" id="li_data">
							    <?php 
							    if (Request::segment(1) == 'admin' && Request::segment(2) == 'setting')
							    { 
							      echo '<div>CMS</div>  &nbsp; &nbsp; >  &nbsp; &nbsp; <a href="'.route('setting.index').'" class="text-muted"> Setting</a>';
							    }
							    else if (Request::segment(1) == 'admin' && Request::segment(2) == 'pages')
							    {
							      echo '<div>CMS</div>  &nbsp; &nbsp; >  &nbsp; &nbsp; <a href="'.route('admin.page.data').'" class="text-muted">Manage Pages </a>';  
							    }
							    else if (Request::segment(1) == 'admin' && Request::segment(2) == 'services')
							    {
							      echo '<div>CMS</div>  &nbsp; &nbsp; >  &nbsp; &nbsp;<a href="'.route('services.index').'" class="text-muted">Services</a>';  
							    }
							    else if (Request::segment(1) == 'admin' && Request::segment(2) == 'dashboard')
							    {
							      echo ' <a href="#" class="text-muted">Wellcome Back!</a>';  
							    }
								else if (Request::segment(1) == 'admin' && Request::segment(2) == 'orders')
							    {
									echo '<div>CMS</div>  &nbsp; &nbsp; >  &nbsp; &nbsp;<a href="'.route('admin.order.data').'" class="text-muted">Orders</a>';  
 
							    }

							    ?>
							
							</li>
						</ul>
						<!--end::Breadcrumb-->
					</div>
					<!--end::Page Heading-->
				</div>
				<!--end::Info-->

			</div>
		</div>