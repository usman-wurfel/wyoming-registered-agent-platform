@extends('new_theme.layouts')

@section('title', getpagedata('seo_title' , 'home_page'))
@section('description', getpagedata('seo_description' , 'home_page'))
@section('keywords', implode(',', json_decode(getpagedata('keywords' , 'home_page'))) )
@section('image', url('uploads').'/'.getpagedata('seo_image' , 'home_page') )

@push('styles')

<style>
header.header-sticky-on 
    {
    background-color: #000000;
    }
    
      @media screen and (max-width: 1199px) 
    {
   #navbarCollapse .navbar-nav.navbar-nav-scroll.dropdown-hover.mx-auto
   {
       background-color: #000000 !important;
   }
}
    .us_step
    {
    color: white;
    margin-bottom: 1rem;
    }
    
    .progress-bar
    {
    font-size:16px;
    }
#navbarCollapse li a {
        color: white;
    }

    .fill-mode 
    {
    fill: white !important;
}

.fs-14
{
    font-size:14px;
}
.us_step
{
    color: #fff;
    font-size: 14px;
    margin-bottom: 0.3rem;
}

.us_width
{
    width:500px;
}

section 
{
    padding-top: 7.5rem;
    padding-bottom: 2.5rem;
}

.us_font_5_rem
{
        font-size: 5rem;
}

.header-absolute {
    background: black;
}
</style>


@endpush
    
    
@section('content')

<section class="bg-light bg-opacity-10 text-center ">
    
    	<div class="inner-container text-center">
            
            <h4 class="mb-4 mt-0 us_font_5_rem">404</h4>
			<h1 class="mb-0 mt-0">Page Not Found</h1>
		</div>

        <img src="{{asset('images/error.png')}}"  class="us_width"/>
</section>



@endsection

@push('scripts')

<script>

if( storedTheme == 'dark' || storedTheme == 'light')
{
    var lightModeImagePath = '{{'uploads/'.getsettingval('footer_logo')}}';

    var lightModeImage = document.querySelector('.light-mode-item');

    lightModeImage.src = lightModeImagePath;
}
</script>

@endpush