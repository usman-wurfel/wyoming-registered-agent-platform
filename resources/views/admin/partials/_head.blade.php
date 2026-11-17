<base href="">
<meta charset="utf-8" />
<title>@yield('title')</title>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<link rel="canonical" href="https://keenthemes.com/metronic" />

<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

<!--end::Fonts-->

<!--begin::Page Vendors Styles(used by this page)-->
<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />

<!--end::Page Vendors Styles-->

<!--begin::Global Theme Styles(used by all pages)-->
<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

<!--end::Global Theme Styles-->

<!--begin::Layout Themes(used by all pages)-->
<link href="{{ asset('assets/css/themes/layout/header/base/dark.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/themes/layout/header/menu/dark.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/frontend/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!--end::Layout Themes-->
<link rel="shortcut icon" href="{{ asset($favicon) }}" />

<style>

.svg-icon.svg-icon-primary svg g [fill] 
{
    fill: #617a93 !important;
}

 .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-link .menu-icon.svg-icon svg g [fill] {
   
    fill: #3699FF !important;
}


.select2-container .select2-selection--multiple {
    
    display: flex !important;
}
.us_custom_active
{
    border: 5px solid #bdbdbd;
    padding: 5px;
    border-radius: 10px;    
}

   .note-editor ul li {
    list-style-type: none; /* Remove default list-style-type (dots, numbers, etc.) */
    padding-left: 25px;    /* Add padding for indentation */
}

.note-editor ul li::before {
    content: '\2022';      /* Unicode character for a bullet point */
    color: #yourColor;     /* Set the color of the bullet point */
    font-size: 1.25em;      /* Adjust the font size of the bullet point */
    margin-left: -30px;    /* Adjust the left margin to align with the padding */
    padding-right: 0.5rem;
}

</style>
@yield('stylesheets')
