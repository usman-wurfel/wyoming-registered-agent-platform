<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use File;
use App\Service;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('new_theme.index' , compact('services') ); 
    }
    
    public function orderDone()
    {
        $order_id = session('order_key', null);

        $ignoredKeyes = ['changing_agent' , 'principle_business_address' , 'mailing_address' ,'cardholderemail' , 'cardholder_name' , 'i_aggree'  , 'consent_i_aggree' , 'owner_details',
        'manager_details' , 'designed_contact' , 'business_mailing_address' , 'principle_business_address' , 'update_business_details', 'file_annual_report'];
        $order_data = Order::where('order_id' , $order_id )->whereNotIn('key_name' , $ignoredKeyes )->get();

        return view('new_theme.payment-success' , compact('order_data' , 'order_id') );
    }

    public function orderNow()
    {
        $services = Service::all();
        return view('new_theme.order-now' , compact('services')); 
    }
    
      function renewAgentLLC()
    {
        $services = Service::all();
        return view('new_theme.renew-agent-llc' , compact('services'));  
    }
    
    public function wyRegisteredAgentService()
    {
        $services = Service::all();
        return view('new_theme.wy-registered-agent-service' , compact('services')); 
    }
    
    public function wyRegisteredAgent()
    {
        return view('new_theme.wy-registered-agent' ); 
    }
    
    function termAndConditions()
    {
       return view('new_theme.terms-and-conditions');  
    }
    
    public function chooseAWyomingLlc()
    {
        return view('new_theme.choose-a-wyoming-llc'); 
    }
    
    public function howToFileYourWyLlc()
    {
        return view('new_theme.how-to-file-your-wy-llc'); 
    }
    
    public function contactUs()
    {
        return view('new_theme.contact-us'); 
    }
    
    
    public function faqs()
    {
        return view('new_theme.faqs'); 
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
