@extends('admin.layouts.master')
@section('title',$title)
@section('content')
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	
		<!--begin::Entry-->
		<div class="d-flex flex-column-fluid">
			<!--begin::Container-->
			<div class="container">
				<!--begin::Card-->
				<div class="card card-custom card-sticky" id="kt_page_sticky_card">
					<div class="card-header" style="">
						<div class="card-title">
					        	 @include('admin.pages.main-naviagation')
						</div>
						<div class="card-toolbar">
							<a href="{{ route('admin.dashboard') }}" class="btn btn-light-primary font-weight-bolder mr-2">
								<i class="ki ki-long-arrow-back icon-sm"></i>Back</a>
							<div class="btn-group">
								<a href="javascript:void(0);"  onclick="event.preventDefault(); document.getElementById('setting_form').submit();" id="kt_btn" class="btn btn-primary font-weight-bolder">
									<i class="ki ki-check icon-sm"></i>Save
								</a>
							</div>
						</div>
					</div>
					<div class="card-body">
					@include('admin.partials._messages')
						<!--begin::Form-->
						<form class="form" id="setting_form" method="POST" action="{{ route('admin.store.service.page.content') }}" enctype='multipart/form-data'>
							@csrf
							<div class="row">
								<div class="col-xl-2"></div>
								<div class="col-xl-8">
									<div class="my-5">
										<h3 class="text-dark font-weight-bold mb-10">Change Settings for {{ $title }}</h3>
										@foreach($service_page_data as $column)
										
										
										@if($column['name'] !== 'keywords' && $column['name'] !== 'faq1' && $column['name'] !== 'privacy' && $column['name'] !== 'M_F_B_A' )
										
											@if($column['input_type']=="text")
												<div class="form-group row">
													<label class="col-3">{{$column['label']}}</label>
													<div class="col-9">
														<input class="{{$column['class']}}" type="text" name="{{$column['name']}}" placeholder="{{$column['place_holder']}}" value="{{ isset($column['value']) ? $column['value'] : ''}}" >
													</div>
												</div>
											@endif
											@if($column['input_type']=="hidden")
												<input type="hidden" name="{{$column['name']}}" value="{{ isset($column['value']) ? $column['value']: ''}}">
											@endif
											@if($column['input_type']=="file")
												<div class="form-group row">
													<label class="col-3">{{$column['label']}}</label>
														<?php
															if(isset($column['name'])){
															$column['name'] = $column['name'];
															}else {
																$column['name']='abc.png';
															}
														?>
													<div class="col-9">
													    <input type="file" name="{{$column['name']}}" class="{{$column['class']}}" id="{{$column['name']}}">
													    
													@if(File::exists('uploads/'.$column['value']))
																<img src="{{asset('uploads/'.$column['value'])}}" style="margin: 1rem;width: 50px;" alt="{{$column['name']}} is not found" />
															@else
																<img src="{{asset('uploads/img.png')}}" style="margin: 1rem;width: 50px;"  alt="{{$column['name']}} is not found"/>
															@endif
													</div>
												</div>
											@endif
											@if($column['input_type']=="textarea")
												<div class="form-group row">
													<label class="col-3">{{$column['label']}}</label>
													<div class="col-9">
														<textarea name="{{$column['name']}}" class="{{$column['class']}}"
																	rows="{{isset($column['rows'] )? $column['rows'] :'2'}}"
																	placeholder="{{$column['place_holder']}}"
																	id="{{$column['id']}}">{{ isset($column['value']) ? $column['value'] : ''}}
														</textarea>
													</div>
												</div>
											@endif
											@else
											@php
											if($column['name'] == 'keywords')
											{
										       $tagsArray = json_decode($column['value'], true); 	
											}
											 
											 if($column['name'] == 'faq1')
											{
										       $tagsArrayFaqs = json_decode($column['value'], true); 	
											}  
											
											 if($column['name'] == 'privacy')
											{
										       $tagsArrayprivacy = json_decode($column['value'], true); 	
											}  
											
											 if($column['name'] == 'M_F_B_A')
											{
										       $tagsArrayM_F_B_As = json_decode($column['value'], true); 	
											}  
											
											    
											@endphp
										@endif
										@endforeach
										
										
                                        <div class="form-group row">
                                        	<label class="col-3">Meta Keywords</label>
                                        	<div class="col-9">
                                        	    <select class="form-control select2" multiple="multiple"  name="keywords[]">
                                        	       @foreach($tagsArray as $tagsArr)
                                        	        <option value="{{$tagsArr}}" selected>{{$tagsArr}}</option>
                                        	       @endforeach
                                        	    </select>
                                        	</div>
                                        </div>
												
										
										
										<div class="form-group row" >
                                        	<label class="col-3">FAQ Section</label>
                                        	<div class="col-9">
                                        	    <select class="form-control select2" multiple="multiple"  name="faq1[]">
                                        	     
                                        	       @foreach($tagsArrayFaqs as $tagsArrayFaq)
                                        	        <option value="{{$tagsArrayFaq}}" selected>{{$tagsArrayFaq}}</option>
                                        	       @endforeach
                                        	 
                                        	    </select>
                                        	</div>
                                        </div>
                                        
                                        
                                        <div class="form-group row" >
                                        	<label class="col-3">Privacy</label>
                                        	<div class="col-9">
                                        	    <select class="form-control select2" multiple="multiple"  name="privacy[]">
                                        	     
                                        	       @foreach($tagsArrayprivacy as $tagsArrayprivac)
                                        	        <option value="{{$tagsArrayprivac}}" selected>{{$tagsArrayprivac}}</option>
                                        	       @endforeach
                                        	 
                                        	    </select>
                                        	</div>
                                        </div>
                                        
                                        
                                        <div class="form-group row" >
                                        	<label class="col-3">Mail Forwarding and Business Address</label>
                                        	<div class="col-9">
                                        	    <select class="form-control select2" multiple="multiple"  name="M_F_B_A[]">
                                        	     
                                        	       @foreach($tagsArrayM_F_B_As as $tagsArrayM_F_B_A)
                                        	        <option value="{{$tagsArrayM_F_B_A}}" selected>{{$tagsArrayM_F_B_A}}</option>
                                        	       @endforeach
                                        	 
                                        	    </select>
                                        	</div>
                                        </div>
                                        
                                        
                                        
                                        
												
									</div>
									<div class="separator separator-dashed my-10"></div>
								</div>
								<div class="col-xl-2"></div>
							</div>
						</form>
						<!--end::Form-->
					</div>
				</div>
				<!--end::Card-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Entry-->
	</div>
@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote();
    });
    
 var selectedTags = <?php echo json_encode($tagsArray); ?>;
 
 $(document).ready(function() 
 {
    $(document).ready(function() 
    {
    $(".select2").select2({
        tags: true,
       
    });
});

 });

</script>

@endsection
