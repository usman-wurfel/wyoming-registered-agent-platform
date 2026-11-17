<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\OrderPageContent;
use App\Models\HomePageContent;
use App\Models\ServicePageContent;
use App\Models\ContactusPageContent;
use App\Models\FaqsPageContent;
use App\Models\WyregisteredPageContent;
use App\Models\ChoosePageContent;
use App\Models\HowtoPageContent;
use App\Models\TermPageContent;
use App\Models\RenewLlcPageContent;
use Illuminate\Support\Facades\DB;
use File;
use App\Models\Order;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Admin';
        return view('admin.dashboard.index',compact('title'));
    }
    
    public function getSingleOrderData(Request $request)
    {
        $order_id = $request->orderid;
        $type = $request->type;
        $ignoredKeyes = ['changing_agent' , 'principle_business_address' , 'mailing_address' ,'cardholderemail' , 'cardholder_name' , 'i_aggree'  , 'consent_i_aggree' , 'owner_details',
        'manager_details' , 'designed_contact' , 'business_mailing_address' , 'principle_business_address' , 'update_business_details', 'file_annual_report'];
        $order_data = Order::where('order_type' , $type )->where('order_id' , $order_id )->whereNotIn('key_name' , $ignoredKeyes )->get();
       
        return view('admin.orders.details', compact('order_id' , 'type' , 'order_data')); 
        
    }


    public function getOrderData(Request $request)
    {
		$columns = array(
			0 => 'id',
			1 => 'company_name',
			2 => 'order_date',
			3 => 'action'
		);

        $type = $request->type;
        
        if(empty($type))
        {
            $type = 'simple_order';
        }

		$totalData = Order::where('order_type' , $type )->distinct('order_id')->orderBy('id' , 'DESC')->count();

		$limit = $request->input('length');
		$start = $request->input('start');
		$order = 'id';
		$dir = $request->input('order.0.dir');

		if(empty($request->input('search.value')))
        {
			$users = Order::where('order_type' , $type )->groupBy('order_id')->offset($start)
				->limit($limit)
				->orderBy($order,$dir)
				->get();
			$totalFiltered = Order::where('order_type' , $type )->distinct('order_id')->orderBy('id' , 'DESC')->count();
		}else{
			$search = $request->input('search.value');
			$users = Order::where('order_type' , $type )->groupBy('order_id')->where([
				['key_value', 'like', "%{$search}%"],
			])
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->get();

			$totalFiltered = Order::where('order_type' , $type )->distinct('order_id')->where([

				['key_value', 'like', "%{$search}%"],
			])
               
				->count();
		}


		$data = array();

		if($users){
			foreach($users as $r){
				
				$nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="'.$r->id.'"><span></span></label></td>';
				$nestedData['company_name'] = Ucfirst(getorderdata('company_name' , $type , $r->order_id)) ;
				$nestedData['order_date'] = date('d F,Y' , strtotime($r->created_at));
              
				$nestedData['action'] = '
                                <div>
                                <td>
                            
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewOrderInfo(this);" data-order_id="'.$r->order_id.'" title="View Client" href="javascript:void(0)">
                                            <i class="icon-1x text-dark-50 flaticon-eye"></i>
                                        </a>
                                        
                                        <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();del(this);" data-order_id="'.$r->order_id.'" title="Delete Order" href="javascript:void(0)">
                                            <i class="icon-1x text-dark-50 flaticon-delete"></i>
                                        </a>

                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewOrderAttachments(this);" data-order_id="'.$r->order_id.'" title="View send attachment" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-file"></i>
                                    </a>

                                </td>
                                </div>
                            ';
				$data[] = $nestedData;
			}
		}

		$json_data = array(
			"draw"			=> intval($request->input('draw')),
			"recordsTotal"	=> intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data"			=> $data
		);

		echo json_encode($json_data);

	}


    
    function deleteOrder(Request $request)
    {
        $id = $request->id;
        Order::where('order_id' , $id )->delete();
        Session::flash('success_message', 'Order Deleted successfully!');
        return redirect()->back(); 
    }
    
    public function orderData(Request $request)
    {
        $type = $request->type;
        
        if(empty($type))
        {
            $type = 'simple_order';
        }
        
       
        $title= 'All  Orders';
        return view('admin.orders.index', compact( 'title' , 'type')); 
    }
    
    public function pageData(Request $request)
    {
        if(empty($request->type))
        {
            $home_page_data = HomePageContent::all();
            $title= 'Home Page Content';
            return view('admin.pages.home_page_data', compact('home_page_data' , 'title'));
        }
        else if(!empty($request->type) && $request->type == 'order_page')
        {
            $order_page_data = OrderPageContent::all();
            $title= 'Order Page Content';
            return view('admin.pages.order_page_data', compact('order_page_data' , 'title'));
        }
        else if(!empty($request->type) && $request->type == 'service_page')
        {
            $service_page_data = ServicePageContent::all();
            $title= 'Service Page Content';
            return view('admin.pages.service_page_data', compact('service_page_data' , 'title'));
        }
        else if(!empty($request->type) && $request->type == 'contact_page')
        {
            $contacus_page_data = ContactusPageContent::all();
            $title= 'Contact Us Page Content';
            return view('admin.pages.contacus_page_data', compact('contacus_page_data' , 'title'));
        }
        else if(!empty($request->type) && $request->type == 'faqs_page')
        {
            $faqs_page_data = FaqsPageContent::all();
            $title= 'Contact Us Page Content';
            return view('admin.pages.faqs_page_data', compact('faqs_page_data' , 'title'));
        }
        else if(!empty($request->type) && $request->type == 'wy_register_page')
        {
           $wyregister_page_data = WyregisteredPageContent::all();
            $title= 'Wyregistered Page Content';
            return view('admin.pages.wyregister_page_data', compact('wyregister_page_data' , 'title'));
        }
         else if(!empty($request->type) && $request->type == 'choose_wyoming_llc_page')
        {
           $choose_page_data = ChoosePageContent::all();
            $title= 'Choose Page Content';
            return view('admin.pages.choose_page_data', compact('choose_page_data' , 'title'));
        }
         else if(!empty($request->type) && $request->type == 'how_to_file_your_wy_llc')
        {
           $how_to_file_your_wy_llc = HowtoPageContent::all();
            $title= 'How To Choose Page Content';
            return view('admin.pages.how_to_file_your_wy_llc', compact('how_to_file_your_wy_llc' , 'title'));
        }
          else if(!empty($request->type) && $request->type == 'term_n_condition')
        {
           $term_n_condition = TermPageContent::all();
            $title= 'Term & Condition Content';
            return view('admin.pages.term_n_condition', compact('term_n_condition' , 'title'));
        }
          else if(!empty($request->type) && $request->type == 'renew_llc')
        {
           $renew_llc_page_contents = RenewLlcPageContent::all();
            $title= 'Renew Llc Content';
            return view('admin.pages.renew_llc_page_contents', compact('renew_llc_page_contents' , 'title'));
        }
    }
    
    function storeRenewPageContent(Request $request)
    {
      
        $input = $request->all();
          
        $filteredInput = array_filter($input);
        
        if (count($input) !== count($filteredInput)) 
        {
          Session::flash('error_message', 'Please do not send empty values');
             return redirect()->back(); 
        }

        $settings = RenewLlcPageContent::pluck('value', 'name')->all();

        $data = array();
        
        if(!empty($request->file())){

            foreach($request->file() as $name=>$file_data){


                if ($request->hasFile($name)) {

                    if ($request->file($name)->isValid()) {

                        $this->validate($request, [
                            $name => 'required|image|mimes:jpeg,png,jpg,svg'
                        ]);

                        $file = $request->file($name);

                        $fileName = $file->getClientOriginalName();

                        $newFileName = rand().$fileName;

                        $destinationPath = public_path('/uploads/');

                        $request->file($name)->move($destinationPath,$newFileName);

                        if (isset($settings[$name])) {
                            if (file_exists(public_path('/uploads/'.$settings[$name]))) {

                                $delete_old_file = public_path('/uploads/'.$settings[$name]);

                                File::delete($delete_old_file);
                            }
                        }

                        $data[$name] = $newFileName;

                    }


                }


            }

        }

        unset($input['_token']);

        unset($input['_method']);
        
        
        
        if(count($data) > 0)
        {
            $input = array_merge($input,$data);
        }
        
        
        foreach ($input as $key => $value) 
        {
            if(!empty($value))
            {
                RenewLlcPageContent::where('name' , $key)->update([ 'value' => $value ]);
            }
        }
        
        Session::flash('success_message', 'Settings saved successfully!');

        return redirect()->back();
    }
    
    function storeTermPageContent(Request $request)
    {
    
        $input = $request->all();
          
        $filteredInput = array_filter($input);
        
        if (count($input) !== count($filteredInput)) 
        {
          Session::flash('error_message', 'Please do not send empty values');
             return redirect()->back(); 
        }

      
        $settings = TermPageContent::pluck('value', 'name')->all();

        $data = array();
        
        if(!empty($request->file())){

            foreach($request->file() as $name=>$file_data){


                if ($request->hasFile($name)) {

                    if ($request->file($name)->isValid()) {

                        $this->validate($request, [
                            $name => 'required|image|mimes:jpeg,png,jpg,svg'
                        ]);

                        $file = $request->file($name);

                        $fileName = $file->getClientOriginalName();

                        $newFileName = rand().$fileName;

                        $destinationPath = public_path('/uploads/');

                        $request->file($name)->move($destinationPath,$newFileName);

                        if (isset($settings[$name])) {
                            if (file_exists(public_path('/uploads/'.$settings[$name]))) {

                                $delete_old_file = public_path('/uploads/'.$settings[$name]);

                                File::delete($delete_old_file);
                            }
                        }

                        $data[$name] = $newFileName;

                    }


                }


            }

        }

        unset($input['_token']);

        unset($input['_method']);
        
        
        
        if(count($data) > 0)
        {
            $input = array_merge($input,$data);
        }
        
        
        foreach ($input as $key => $value) 
        {
            if(!empty($value))
            {
                TermPageContent::where('name' , $key)->update([ 'value' => $value ]);
            }
        }
        
        Session::flash('success_message', 'Settings saved successfully!');

        return redirect()->back();
    
    
    
    
      
    }
    
    function storeHowPageContent(Request $request)
    {
        
        $input = $request->all();
          
        $filteredInput = array_filter($input);
        
        if (count($input) !== count($filteredInput)) 
        {
          Session::flash('error_message', 'Please do not send empty values');
             return redirect()->back(); 
        }

      
        $settings = HowtoPageContent::pluck('value', 'name')->all();

        $data = array();
        
        if(!empty($request->file())){

            foreach($request->file() as $name=>$file_data){


                if ($request->hasFile($name)) {

                    if ($request->file($name)->isValid()) {

                        $this->validate($request, [
                            $name => 'required|image|mimes:jpeg,png,jpg,svg'
                        ]);

                        $file = $request->file($name);

                        $fileName = $file->getClientOriginalName();

                        $newFileName = rand().$fileName;

                        $destinationPath = public_path('/uploads/');

                        $request->file($name)->move($destinationPath,$newFileName);

                        if (isset($settings[$name])) {
                            if (file_exists(public_path('/uploads/'.$settings[$name]))) {

                                $delete_old_file = public_path('/uploads/'.$settings[$name]);

                                File::delete($delete_old_file);
                            }
                        }

                        $data[$name] = $newFileName;

                    }


                }


            }

        }

        unset($input['_token']);

        unset($input['_method']);
        
        
        
        if(count($data) > 0)
        {
            $input = array_merge($input,$data);
        }
        
        
        foreach ($input as $key => $value) 
        {
            if(!empty($value))
            {
                HowtoPageContent::where('name' , $key)->update([ 'value' => $value ]);
            }
        }
        
        Session::flash('success_message', 'Settings saved successfully!');

        return redirect()->back();
    
    
    
    
    }
    
    function storeChoosePageContent(Request $request)
    {
        
        
          $input = $request->all();
          
        
          
        $filteredInput = array_filter($input);
        
        if (count($input) !== count($filteredInput)) 
        {
          Session::flash('error_message', 'Please do not send empty values');
             return redirect()->back(); 
        }

      
        $settings = ChoosePageContent::pluck('value', 'name')->all();

        $data = array();
        
        if(!empty($request->file())){

            foreach($request->file() as $name=>$file_data){


                if ($request->hasFile($name)) {

                    if ($request->file($name)->isValid()) {

                        $this->validate($request, [
                            $name => 'required|image|mimes:jpeg,png,jpg,svg'
                        ]);

                        $file = $request->file($name);

                        $fileName = $file->getClientOriginalName();

                        $newFileName = rand().$fileName;

                        $destinationPath = public_path('/uploads/');

                        $request->file($name)->move($destinationPath,$newFileName);

                        if (isset($settings[$name])) {
                            if (file_exists(public_path('/uploads/'.$settings[$name]))) {

                                $delete_old_file = public_path('/uploads/'.$settings[$name]);

                                File::delete($delete_old_file);
                            }
                        }

                        $data[$name] = $newFileName;

                    }


                }


            }

        }

        unset($input['_token']);

        unset($input['_method']);
        
        
        
        if(count($data) > 0)
        {
            $input = array_merge($input,$data);
        }
        
        
        foreach ($input as $key => $value) 
        {
            if(!empty($value))
            {
                ChoosePageContent::where('name' , $key)->update([ 'value' => $value ]);
            }
        }
        
        Session::flash('success_message', 'Settings saved successfully!');

        return redirect()->back();
    
    
    
    }
    
   function  storeWyregisterPageContent(Request $request)
    {
        
          $input = $request->all();
          
        
          
        $filteredInput = array_filter($input);
        
        if (count($input) !== count($filteredInput)) 
        {
          Session::flash('error_message', 'Please do not send empty values');
             return redirect()->back(); 
        }

      
        $settings = WyregisteredPageContent::pluck('value', 'name')->all();

        $data = array();
        
        if(!empty($request->file())){

            foreach($request->file() as $name=>$file_data){


                if ($request->hasFile($name)) {

                    if ($request->file($name)->isValid()) {

                        $this->validate($request, [
                            $name => 'required|image|mimes:jpeg,png,jpg,svg'
                        ]);

                        $file = $request->file($name);

                        $fileName = $file->getClientOriginalName();

                        $newFileName = rand().$fileName;

                        $destinationPath = public_path('/uploads/');

                        $request->file($name)->move($destinationPath,$newFileName);

                        if (isset($settings[$name])) {
                            if (file_exists(public_path('/uploads/'.$settings[$name]))) {

                                $delete_old_file = public_path('/uploads/'.$settings[$name]);

                                File::delete($delete_old_file);
                            }
                        }

                        $data[$name] = $newFileName;

                    }


                }


            }

        }

        unset($input['_token']);

        unset($input['_method']);
        
        
        
        if(count($data) > 0)
        {
            $input = array_merge($input,$data);
        }
        
        
        foreach ($input as $key => $value) 
        {
            if(!empty($value))
            {
                WyregisteredPageContent::where('name' , $key)->update([ 'value' => $value ]);
            }
        }
        
        Session::flash('success_message', 'Settings saved successfully!');

        return redirect()->back();
    
    
    }
    public function storeFaqsPageContent (Request $request)
    {
        
            
          $input = $request->all();
          
          if(empty($input['keywords']))
          {
             Session::flash('error_message', 'Please add some meta keywords!');
             return redirect()->back(); 
          }
      
        $settings = FaqsPageContent::pluck('value', 'name')->all();

        $data = array();
        
        if(!empty($request->file())){

            foreach($request->file() as $name=>$file_data){


                if ($request->hasFile($name)) {

                    if ($request->file($name)->isValid()) {

                        $this->validate($request, [
                            $name => 'required|image|mimes:jpeg,png,jpg,svg'
                        ]);

                        $file = $request->file($name);

                        $fileName = $file->getClientOriginalName();

                        $newFileName = rand().$fileName;

                        $destinationPath = public_path('/uploads/');

                        $request->file($name)->move($destinationPath,$newFileName);

                        if (isset($settings[$name])) {
                            if (file_exists(public_path('/uploads/'.$settings[$name]))) {

                                $delete_old_file = public_path('/uploads/'.$settings[$name]);

                                File::delete($delete_old_file);
                            }
                        }

                        $data[$name] = $newFileName;

                    }


                }


            }

        }

        unset($input['_token']);

        unset($input['_method']);
        
        if(count($input['keywords']) > 0 )
        {
            $keywords = implode(',', $input['keywords']);
            
           FaqsPageContent::where( 'name' , 'keywords')->update(['value' => $keywords]);
        }
        
        if(count($data) > 0)
        {
            $input = array_merge($input,$data);
        }
        
        
        foreach ($input as $key => $value) 
        {
            if(!empty($value))
            {
                FaqsPageContent::where('name' , $key)->update([ 'value' => $value ]);
            }
        }
        
        Session::flash('success_message', 'Settings saved successfully!');

        return redirect()->back();
    
    }
        
        public function  storeContactPageContent(Request $request)
        {
            
          $input = $request->all();
          
          if(empty($input['keywords']))
          {
             Session::flash('error_message', 'Please add some meta keywords!');
             return redirect()->back(); 
          }
      
        $settings = ContactusPageContent::pluck('value', 'name')->all();

        $data = array();
        
        if(!empty($request->file())){

            foreach($request->file() as $name=>$file_data){


                if ($request->hasFile($name)) {

                    if ($request->file($name)->isValid()) {

                        $this->validate($request, [
                            $name => 'required|image|mimes:jpeg,png,jpg,svg'
                        ]);

                        $file = $request->file($name);

                        $fileName = $file->getClientOriginalName();

                        $newFileName = rand().$fileName;

                        $destinationPath = public_path('/uploads/');

                        $request->file($name)->move($destinationPath,$newFileName);

                        if (isset($settings[$name])) {
                            if (file_exists(public_path('/uploads/'.$settings[$name]))) {

                                $delete_old_file = public_path('/uploads/'.$settings[$name]);

                                File::delete($delete_old_file);
                            }
                        }

                        $data[$name] = $newFileName;

                    }


                }

            }

        }

        unset($input['_token']);

        unset($input['_method']);
        
        if(count($input['keywords']) > 0 )
        {
            $keywords = implode(',', $input['keywords']);
            
           ContactusPageContent::where( 'name' , 'keywords')->update(['value' => $keywords]);
        }
        
        if(count($data) > 0)
        {
            $input = array_merge($input,$data);
        }
        
        
        foreach ($input as $key => $value) 
        {
            if(!empty($value))
            {
             ContactusPageContent::where('name' , $key)->update([ 'value' => $value ]);
            }
        }
        
        Session::flash('success_message', 'Settings saved successfully!');

        return redirect()->back();
    
         
     
        }
        
     public function storeServicePageContent(Request $request)
     {
     
         
      $input = $request->all();
      
      if(empty($input['keywords']))
      {
         Session::flash('error_message', 'Please add some meta keywords!');
         return redirect()->back(); 
      }
      
        $settings = ServicePageContent::pluck('value', 'name')->all();

        $data = array();
        if(!empty($request->file())){

            foreach($request->file() as $name=>$file_data){


                if ($request->hasFile($name)) {

                    if ($request->file($name)->isValid()) {

                        $this->validate($request, [
                            $name => 'required|image|mimes:jpeg,png,jpg,svg'
                        ]);

                        $file = $request->file($name);

                        $fileName = $file->getClientOriginalName();

                        $newFileName = rand().$fileName;

                        $destinationPath = public_path('/uploads/');

                        $request->file($name)->move($destinationPath,$newFileName);

                        if (isset($settings[$name])) {
                            if (file_exists(public_path('/uploads/'.$settings[$name]))) {

                                $delete_old_file = public_path('/uploads/'.$settings[$name]);

                                File::delete($delete_old_file);
                            }
                        }

                        $data[$name] = $newFileName;

                    }


                }


            }

        }

        unset($input['_token']);

        unset($input['_method']);
        
        if(count($input['keywords']) > 0 )
        {
            $keywords = implode(',', $input['keywords']);
            
           ServicePageContent::where( 'name' , 'keywords')->update(['value' => $keywords]);
        }
        
        if(count($data) > 0)
        {
            $input = array_merge($input,$data);
        }
        
        
        foreach ($input as $key => $value) 
        {
            if(!empty($value))
            {
                ServicePageContent::where('name' , $key)->update([ 'value' => $value ]);
            }
        }
        
        Session::flash('success_message', 'Settings saved successfully!');

        return redirect()->back();
    
         
     }
     
     public function storeHomePageContent(Request $request)
     {
         
      $input = $request->all();
      
        
          
        $filteredInput = array_filter($input);
        
        if (count($input) !== count($filteredInput)) 
        {
          Session::flash('error_message', 'Please do not send empty values');
             return redirect()->back(); 
        }

      
        $settings = HomePageContent::pluck('value', 'name')->all();

        $data = array();
        if(!empty($request->file())){

            foreach($request->file() as $name=>$file_data){


                if ($request->hasFile($name)) {

                    if ($request->file($name)->isValid()) {

                        $this->validate($request, [
                            $name => 'required|image|mimes:jpeg,png,jpg,svg'
                        ]);

                        $file = $request->file($name);

                        $fileName = $file->getClientOriginalName();

                        $newFileName = rand().$fileName;

                        $destinationPath = public_path('/uploads/');

                        $request->file($name)->move($destinationPath,$newFileName);

                        if (isset($settings[$name])) {
                            if (file_exists(public_path('/uploads/'.$settings[$name]))) {

                                $delete_old_file = public_path('/uploads/'.$settings[$name]);

                                File::delete($delete_old_file);
                            }
                        }

                        $data[$name] = $newFileName;

                    }


                }


            }

        }

        unset($input['_token']);

        unset($input['_method']);
        
     
        if(count($data) > 0)
        {
            $input = array_merge($input,$data);
        }
        
        
        foreach ($input as $key => $value) 
        {
            if(!empty($value))
            {
                HomePageContent::where('name' , $key)->update([ 'value' => $value ]); 
            }
        }
        
        Session::flash('success_message', 'Settings saved successfully!');

        return redirect()->back();
    
     }
     
    public function storeOrderPageContent(Request $request)
    {
      $input = $request->all();
      
      if(empty($input['keywords']))
      {
         Session::flash('error_message', 'Please add some meta keywords!');
         return redirect()->back(); 
      }
      
        $settings = OrderPageContent::pluck('value', 'name')->all();

        $data = array();
        if(!empty($request->file())){

            foreach($request->file() as $name=>$file_data){


                if ($request->hasFile($name)) {

                    if ($request->file($name)->isValid()) {

                        $this->validate($request, [
                            $name => 'required|image|mimes:jpeg,png,jpg,svg'
                        ]);

                        $file = $request->file($name);

                        $fileName = $file->getClientOriginalName();

                        $newFileName = rand().$fileName;

                        $destinationPath = public_path('/uploads/');

                        $request->file($name)->move($destinationPath,$newFileName);

                        if (isset($settings[$name])) {
                            if (file_exists(public_path('/uploads/'.$settings[$name]))) {

                                $delete_old_file = public_path('/uploads/'.$settings[$name]);

                                File::delete($delete_old_file);
                            }
                        }

                        $data[$name] = $newFileName;

                    }


                }


            }

        }

        unset($input['_token']);

        unset($input['_method']);
        
        if(count($input['keywords']) > 0 )
        {
            $keywords = implode(',', $input['keywords']);
            
            OrderPageContent::where( 'name' , 'keywords')->update(['value' => $keywords]);
        }
        
        if(count($data) > 0)
        {
            $input = array_merge($input,$data);
        }
        
        
        foreach ($input as $key => $value) 
        {
            if(!empty($value))
            {
                OrderPageContent::where('name' , $key)->update([ 'value' => $value ]);
            }
        }
        
        Session::flash('success_message', 'Settings saved successfully!');

        return redirect()->back();
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
    public function edit(){
        $user = Auth::user();
        return view('admin.settings.edit', ['title' => 'Edit Admin Profile','user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $admin = Auth::user();
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,'.$admin->id,
        ]);
        $input = $request->all();
        if (empty($input['password'])) {
            $input['password'] = $admin->password;
        } else {
            $input['password'] = bcrypt($input['password']);
        }
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $this->validate($request, [
                    'image' => 'required|mimes:jpeg,png,jpg'
                ]);
                $file = $request->file('image');
                $destinationPath = public_path('/uploads');

                $imagePath = public_path('/uploads/'.$admin->image);

                //$extension = $file->getClientOriginalExtension('logo');
                $thumbnail = $file->getClientOriginalName('image');
                $thumbnail = rand() . $thumbnail;
                $request->file('image')->move($destinationPath, $thumbnail);
                $input['image'] = $thumbnail;
            }
        }
        $admin->fill($input)->save();
        Session::flash('success_message', 'Great! admin successfully updated!');
        return redirect()->back();
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
