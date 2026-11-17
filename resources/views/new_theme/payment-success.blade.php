@extends('new_theme.layouts')

@section('title', getpagedata('seo_title' , 'order_page'))
@section('description', getpagedata('seo_description' , 'order_page'))
@section('keywords', implode(',', json_decode(getpagedata('keywords' , 'order_page'))) )
@section('image', url('uploads').'/'.getpagedata('seo_image' , 'order_page') )

@push('styles')


<style>

.header-absolute {
    background: black;
}
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

</style>


@endpush
    
    
@section('content')


<section class="py-7">
<center><img src="{{asset('payment-success.png')}}" /> </center>
<center>
    <a href="{{route('home')}}" class="btn btn-secondary btn-sm">Home</a>
    <button type="button" class="btn btn-primary btn-sm" onclick="openModal()">View & Download</button>
</center>
</section>

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order No : <span id="order_no" style="font-size: 13px;color: gray;">{{$order_id}}</span></h5>
        <button type="button" class="close" onclick="closeModal()" style="background: none;border: none;">
          X
        </button>
      </div>
      <div class="modal-body" id="pushdata">
      <div class="row" style="padding:1rem;">
    <div id="hereweappend" class="col-md-12"></div>
    <input type="hidden" id="orderID" value="{{$order_id}}"/>
    <div class="col-md-12 ">
     <center style="background: #181824;
    color: white;
    padding: 0.8rem;
    border-radius: 7px;
    font-size: 20px;margin-bottom:3rem">   <b>Order Detail: </b> </center>
    </div>
    
    @php
    $order_type = '';
    @endphp
    
    @foreach($order_data as $order)
    
   
     @if( $order->key_name == 'no_of_manager' || $order->key_name  == 'no_of_owner' || $order->key_name == 'total_price' || $order->key_name == 'cash')
       <div class="col-md-12">
        <hr>
        @if($order->key_name == 'no_of_manager')
         <center style="margin-bottom: 2rem;"><span style="border-bottom: 1px solid;font-size: 15px;margin-bottom: 1rem;font-weight: 700;">Managers</span></center>
         @elseif( $order->key_name  == 'no_of_owner')
         <center style="margin-bottom: 2rem;"><span style="border-bottom: 1px solid;font-size: 15px;margin-bottom: 1rem;font-weight: 700;">Owners</span></center>
         @elseif( $order->key_name  == 'cash')
         <center style="margin-bottom: 2rem;"><span style="border-bottom: 1px solid;font-size: 15px;margin-bottom: 1rem;font-weight: 700;">Annual Report</span></center>
         @else
         <center style="margin-bottom: 2rem;"><span style="border-bottom: 1px solid;font-size: 15px;margin-bottom: 1rem;font-weight: 700;">Purchase Details</span></center>
        @endif
     </div>
    
    @endif
    
    
    @if( $order->key_name == 'manager_two_street_address')
    <div class="col-md-12" style="margin-bottom: 1rem;    font-size: 15px;">
      <span style="border-bottom: 1px solid;margin-bottom: 1rem;font-weight: 700;">Manager Two</span>
    </div>
    @endif
    
    @if( $order->key_name == 'manager_three_street_address')
    <div class="col-md-12" style="margin-bottom: 1rem;    font-size: 15px;">
      <span style="border-bottom: 1px solid;margin-bottom: 1rem;font-weight: 700;">Manager Three</span>
    </div>
    @endif
    
    @if( $order->key_name == 'manager_one_street_address')
    <div class="col-md-12" style="margin-bottom: 1rem;    font-size: 15px;">
      <span style="border-bottom: 1px solid;margin-bottom: 1rem;font-weight: 700;">Manager One</span>
    </div>
    @endif
     
     
     
     @if( $order->key_name == 'owner_two_firstname')
    <div class="col-md-12" style="margin-bottom: 1rem;    font-size: 15px;">
      <span style="border-bottom: 1px solid;margin-bottom: 1rem;font-weight: 700;">Owner Two</span>
    </div>
    @endif
    
    @if( $order->key_name == 'owner_three_firstname')
    <div class="col-md-12" style="margin-bottom: 1rem;    font-size: 15px;">
      <span style="border-bottom: 1px solid;margin-bottom: 1rem;font-weight: 700;">Owner Three</span>
    </div>
    @endif
    
    @if( $order->key_name == 'owner_one_firstname')
    <div class="col-md-12" style="margin-bottom: 1rem;    font-size: 15px;">
      <span style="border-bottom: 1px solid;margin-bottom: 1rem;font-weight: 700;">Owner One</span>
    </div>
    @endif
    
    
   
    @if($order->key_name !== 'company_name')
    <div class="col-md-6" style="margin-bottom: 1rem;">
        @if($order->key_name == 'buildingsandotherdepreciabletangibleassets')
         <label><b>Buildings and Other Depreciable Tangible Assets</b></label>
        @else
         <label><b>{{str_replace('_' , ' ' , Ucfirst($order->key_name) )}}</b></label>
        @endif
       
        <div>
            @if($order->key_name == 'total_price')
            ${{number_format($order->key_value , 2)}}
            @else
            {{$order->key_value}}
            @endif
        </div>
    </div>
    @endif
    
    
    @if($order->key_name == 'company_name')
    
    <div class="col-md-6" >
    
     <label><b>{{str_replace('_' , ' ' , Ucfirst($order->key_name) )}}</b></label>
    
    </div>
    
    <div class="col-md-6">
        {{$order->key_value}}
    </div>
    
     <div class="col-md-12">
        <hr>
        <center style="    margin-bottom: 2rem;"><span style="border-bottom: 1px solid;smargin-bottom: 1rem;font-weight: 700;">Designated Contact</span></center>
     </div>
     @endif
   
   
    @php
    $order_type = $order->order_type;
    $order_id = $order->order_id;
    @endphp
    
    
    @endforeach
    
    @php
    if($order_type == 'registered_agent_renew_llc')
    {
        $changing_agent = getorderdata('file_annual_report' , $order_type , $order_id);
    }
    else
    {
        $changing_agent = getorderdata('changing_agent' , $order_type , $order_id);
    }
     
    @endphp
    
     <div class="col-md-6" style="margin-bottom: 1rem;">
      
         <label><b>Changing Agent</b></label>
      
        <div>
            @if($changing_agent == 1)
            Yes
            @else
            No
            @endif
        </div>
    </div>
    
    
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeModal()"  >Close</button>
        <button id="downloadPdfButton" class="btn btn-primary">Download</button>

      </div>
    </div>
  </div>
</div>


@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.js"></script>

<script>


document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('downloadPdfButton').addEventListener('click', function() {
        // Update the content of '#hereweappend'
        $('#hereweappend').html('<h5 class="modal-title" style="margin-bottom:2rem;">Order No: <span id="order_no_2" style="font-size: 13px;color: gray;">'+$('#orderID').val()+'</span></h5>');
        $('#hereweappend').show()
        // Store a reference to '#hereweappend' for later use
        var hereweappendElement = document.getElementById('hereweappend');

        var element = document.getElementById('pushdata');

        // Generate a file name with the current date and time
        var currentDate = new Date();
        var formattedDate = currentDate.toISOString().split('T')[0];
        var formattedTime = currentDate.toTimeString().split(' ')[0].replace(/:/g, '-'); // Replace colons with dashes
        var fileName = 'Order' + formattedDate + '_' + formattedTime + '.pdf';

        // Use html2pdf to generate the PDF with the customized file name
        html2pdf(element, {
            filename: fileName,
            margin: 10, // Adjust margin as needed
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
            pagebreak: { mode: 'avoid-all' },
            tableExtraCSS: 'border-collapse: collapse; width: 100%;', // Ensure table layout is correct
            tableWidth: 'auto', // Specify the table width
            onAfterSave: function(pdf) {
                // Hide '#hereweappend' after the PDF is saved
            
              
            }
        });
        
          setTimeout(function() { 
           $('#hereweappend').hide()
    }, 1500);
    
    
    });
});




    function closeModal()
    {
        $('#detailModal').modal('hide')
    }

    function openModal()
    {
        $('#detailModal').modal('show')
    }

$( document ).ready(function() {
    if( storedTheme == 'dark' || storedTheme == 'light')
{
    var lightModeImagePath = '{{'uploads/'.getsettingval('footer_logo')}}';

    var lightModeImage = document.querySelector('.light-mode-item');

    lightModeImage.src = lightModeImagePath;
}


$('#detailModal').modal('show')
});

</script>

@endpush