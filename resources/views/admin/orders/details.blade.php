<div class="row">
    <div id="hereweappend" class="col-md-12"></div>
    <input type="hidden" id="orderID" value="{{$order_id}}"/>
    <div class="col-md-12 mb-8">
     <center style="background: #181824;
    color: white;
    padding: 0.8rem;
    border-radius: 7px;
    font-size: 20px;margin-bottom:3rem">   <b>Order Detail: </b> </center>
       
    </div>
    
    @php
    $order_type = '';
    $order_id = '';
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