<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Service;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Support\Facades\Redirect;
use App\Mail\ContactMail;
use Mail;
use App\Models\Attachment;
use App\Models\AttachmentFile;
use Illuminate\Support\Str;

class DatabaseMappingController extends Controller
{
   function getAttachment(Request $request)
   {
        $orderid = $request->orderid;
        $attachment = Attachment::with('attachmentFiles')->where('order_id', $orderid)->first();
        return view('admin.orders.attachments' , compact('attachment'));
        
   }

    public function sendAndSave(Request $request)
    {
        $quillContent = $request->quillContent;
        $order_no = $request->order_no;
        $uploaded_files = $request->uploaded_files;
        $explode = explode(',', $uploaded_files);
    
        if (empty($explode[0])) 
        {
            return response()->json(['response' => 'error', 'message' => 'Please send valid files.']);
        }
     
        try {
         
                $attachment = Attachment::where('order_id', $order_no)->first();
    
                if (!$attachment) {
                    $attachment = Attachment::create([
                        'order_id' => $order_no,
                        'status' => 1,
                        'mesasge' => $quillContent
                    ]);
                }
               
                $files = [];
       
                
                    for ($i = 0; $i < count($explode); $i++) 
                    {
                        if (!empty(trim($explode[$i]))) 
                        {
                            AttachmentFile::create([
                                'atatchment_id' => $attachment->id,
                                'file_name' => trim($explode[$i])
                            ]);
    
                            $files[] = url('uploads/' . trim($explode[$i]) );
                        } 
                    }
                
                
                    if($attachment)
                    {
                        $type = Order::where('order_id' , $order_no )->first()->order_type;

                        $userEmail = getorderdata('cardholderemail', $type, $order_no);
        
                        Mail::to( $userEmail)->send(new \App\Mail\SendAttachment($quillContent, $files));
                    }
                
                    \DB::commit();
            // If the transaction is successful, you can return a success response
            return response()->json(['response' => 'success', 'message' => 'Data saved successfully.']);
        } 
        catch (\Exception $e) 
        {
            \DB::rollBack();
            // If an exception occurs, the transaction will be rolled back
            return response()->json(['response' => 'error', 'message' => 'Error saving data.']);
        }
  
    }
    


    public function uploadFile(Request $request)
    {
        $request->validate([
            'file.*' => 'required|file|max:10240', // Max file size is 10 MB (10240 KB) for each file
        ]);
    
        $file = $request->file('file');
    
        // Extract the file extension
        $extension = $file->getClientOriginalExtension();
    
        // Generate a unique filename based on the extension
        $filename = Str::uuid()->toString() . '.' . $extension;
    
        // Move the file to the public/uploads directory
        $file->move(public_path('uploads'), $filename);
    
        return response()->json(['files' => $filename]);
    }
    


    
      public function index2()
    {    
      $services = Service::orderBy('price' , 'asc')->get();
        return view('home2' , compact('services'));
    }

       public function charge(Request $request)
    {
        try {

            $order_total = $request->order_total;
           
            $stripe_secret = getsettingval('stripe_secret');
            
            Stripe::setApiKey($stripe_secret);

            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken,
                'name' => $request->stripeName
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => $order_total*100,
                'currency' => 'usd',
                'description' => 'Service Payment',
            ));

            return response()->json(['status'=> 1,'message'=>trans('messages.order_placed')],200); 

            // return 'Charge successful, you get the course!';
        } catch (\Exception $ex) {
            $response = $ex->getMessage() ;

            return response()->json(['status'=>0,'message'=>trans('messages.wrong')],200);
        }
    }
    
    
    public function saveData(Request $request)
    {
        $order_id = bin2hex(random_bytes(32));
        $orderData = $request->all();
        $type = 'registered_agent_renew_llc';
        
        try 
        {
  
        foreach ($orderData as $key => $value) 
        {
            if ($key === 'order_type') {
                $type = $value;
            }

            // Ignore the "_token" & "order_type" field
            if ($key === '_token' || $key === 'order_type') {
                continue;
            }

            if (!empty($value)) {
                Order::create([
                    'order_id' => $order_id,
                    'key_name' => $key,
                    'key_value' => $value,
                    'order_type' => !empty($orderData['order_type']) ? $orderData['order_type'] : 'simple_order',
                ]);
            }
        }

        $ignoredKeys = ['principle_business_address', 'mailing_address', 'cardholderemail', 'cardholder_name', 'i_aggree', 'consent_i_aggree', 'owner_details',
        'manager_details', 'designed_contact', 'business_mailing_address', 'principle_business_address', 'update_business_details'];

        $order_data = Order::where('order_type', $type)->where('order_id', $order_id)->whereNotIn('key_name', $ignoredKeys)->get();

        $userEmail = getorderdata('cardholderemail', $type, $order_id);

        session(['order_key' => $order_id]);

        Mail::to($userEmail)->send(new ContactMail($order_data));

        return Redirect::route('order.done');
} 
catch (\Exception $e) 
{
    
    return Redirect::back()->with('error', "An error occurred while processing your request. Please try again later.");
}

    }

  
    public function index()
    {    
      $services = Service::orderBy('price' , 'asc')->get();
        return view('home' , compact('services'));
    }
    
    
    
    // public function index() {
    //     $title = 'Database Tables';
    //     $database1 = DB::connection('mysql')->select("SHOW TABLES");
    //     $database2 = DB::connection('mysql1')->select('SHOW TABLES');
    //     return view('admin.databasemapping.index',compact('title','database1','database2'));
    // }

    function tableColumn(Request $request) {
        $title = 'Table column';
        $table1 = $request->db_tbl1;
        $table2 = $request->db_tbl2;
        $database1 = DB::connection('mysql')->select("Describe $table1");

        $database2 = DB::connection('mysql1')->select("Describe $table2");

        $database1Name = DB::connection('mysql')->select("SHOW TABLES");
        $database2Name = DB::connection('mysql1')->select('SHOW TABLES');

        return view('admin.databasemapping.column',compact('title','database1','database2','database1Name','database2Name','table1','table2'));
    }
    function insertData(Request $request) {
        $title = 'Table column';

        //$select = implode("`,`",$request->db_tbl1);


        $database1 = DB::connection('mysql')->table($request->table1)->select($request->db_tbl1)->orderBy('id','desc')->get();
        //dd($request->db_tbl2[0]);
        $table2column = $request->db_tbl2;
        foreach ($database1 as $record ){

           $database2 = DB::connection('mysql1')->table($request->table2)->insert([
                                                                                            $table2column[0]=>$record->id,
                                                                                            $table2column[1]=>$record->connection,
                                                                                            $table2column[2]=>$record->queue,
                                                                                            $table2column[3]=>$record->payload,
                                                                                            $table2column[4]=>$record->exception,
                                                                                            $table2column[5]=>$record->failed_at
                                                                            ]);
       }
        dd($database1);


        $database1Name = DB::connection('mysql')->select("SHOW TABLES");
        $database2Name = DB::connection('mysql1')->select('SHOW TABLES');

        return view('admin.databasemapping.column',compact('title','database1','database2','database1Name','database2Name'));
    }
}
