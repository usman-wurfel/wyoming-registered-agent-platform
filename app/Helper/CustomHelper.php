<?php

if(!function_exists('getDatabaseNameFromString')){

    function getDatabaseNameFromString($string) {

        $string_to_array = explode('_',$string);
        return $database_name = $string_to_array[2].'_'.$string_to_array[3];
    }
}


    if(!function_exists('getsettingval'))
    {
        function getsettingval($key) 
        {
            $setting = \App\Models\Setting::where('name',$key)->first();
            
            if($setting == true)
            {
                return $setting->value;
            }
            else
            {
                return 'null';
            }
        }
    }
    
    
     if(!function_exists('getorderdata'))
    {
        function getorderdata($key , $order_type , $order_id) 
        {
            
            $setting = \App\Models\Order::where('order_id',$order_id)->where('order_type',$order_type)->where('key_name',$key)->first(); 
            
            
            if($setting == true)
            {
                return $setting->key_value;
            }
            else
            {
                return 'null';
            }
        }
    }
    
    

    if(!function_exists('getpagedata'))
    {
        function getpagedata($key , $page_name) 
        {
            if($page_name == 'order_page')
            {
                 $setting = \App\Models\OrderPageContent::where('name',$key)->first(); 
            }
            elseif($page_name == 'home_page')
            {
               $setting = \App\Models\HomePageContent::where('name',$key)->first();  
            }
             elseif($page_name == 'service_page')
            {
               $setting = \App\Models\ServicePageContent::where('name',$key)->first();  
            }
             elseif($page_name == 'contact_page')
            {
               $setting = \App\Models\ContactusPageContent::where('name',$key)->first();  
            }
             elseif($page_name == 'faqs_page')
            {
               $setting = \App\Models\FaqsPageContent::where('name',$key)->first();  
            }
             elseif($page_name == 'wyregistered_page')
            {
               $setting = \App\Models\WyregisteredPageContent::where('name',$key)->first();  
            }
             elseif($page_name == 'choose_page')
            {
               $setting = \App\Models\ChoosePageContent::where('name',$key)->first();  
            }
            elseif($page_name == 'how_to_page')
            {
               $setting = \App\Models\HowtoPageContent::where('name',$key)->first();  
            }
            elseif($page_name == 'term_n_con_page')
            {
               $setting = \App\Models\TermPageContent::where('name',$key)->first();  
            }
            elseif($page_name == 'renew_llc')
            {
               $setting = \App\Models\RenewLlcPageContent::where('name',$key)->first();  
            }
          
            if($setting == true)
            {
                return $setting->value;
            }
            else
            {
                return 'null';
            }
        }
    }


