<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientCheckup;
use App\Models\PatientCheckupDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use App\Service;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $title = 'Customers';
	    return view('admin.clients.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

	public function getClients(Request $request){
		$columns = array(
			0 => 'id',
			1 => 'title',
			2 => 'price',
			3 => 'duration',
			4 => 'action'
		);

		$totalData = Service::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');

		if(empty($request->input('search.value'))){
			$users = Service::offset($start)
				->limit($limit)
				->orderBy($order,$dir)
				->get();
			$totalFiltered = Service::count();
		}else{
			$search = $request->input('search.value');
			$users = Service::where([
				['title', 'like', "%{$search}%"],
			])
				->orWhere('price','like',"%{$search}%")
				->orWhere('duartion','like',"%{$search}%")
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->get();
			$totalFiltered = Service::where([

				['title', 'like', "%{$search}%"],
			])
                ->orWhere('price','like',"%{$search}%")
                ->orWhere('duartion','like',"%{$search}%")
				->count();
		}


		$data = array();

		if($users){
			foreach($users as $r){
				$edit_url = route('services.edit',$r->id);
				$nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="'.$r->id.'"><span></span></label></td>';
				$nestedData['title'] = $r->title;
				$nestedData['price'] = $r->price;
                $nestedData['duration'] = $r->duration;
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewInfo('.$r->id.');" title="View Client" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-eye"></i>
                                    </a>
                                    <a title="Edit Client" class="btn btn-sm btn-clean btn-icon"
                                       href="'.$edit_url.'">
                                       <i class="icon-1x text-dark-50 flaticon-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();del('.$r->id.');" title="Delete Client" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-delete"></i>
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
    public function create()
    {
	    $title = 'Add New Patient';
	    return view('admin.clients.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

	    $this->validate($request, [
		    'title' => 'required',
		    'sub_title' => 'required',
		    'price' => 'required',
            'duration'=>'required',
            'description'=>'required'
	    ]);

	    $user = new Service();
        $user->title  = $request->title;
	    $user->sub_title =$request->sub_title;
	    $user->price = $request->price;
        $user->duration  = $request->duration ;
        $user->description = $request->description;

	    $user->save();

	    Session::flash('success_message', 'Great! Service has been added successfully!');
	    $user->save();
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
	    $user = Service::find($id);
	    return view('admin.clients.single', ['title' => 'Service detail', 'user' => $user]);
    }

	public function clientDetail(Request $request)
	{

		$service = Service::find($request->id);

		return view('admin.clients.detail', ['title' => 'Service Detail', 'service' => $service ]);
	}


	public function clientVisitDetail(Request $request)
	{
		$patients = PatientCheckupDetail::where('patient_checkup_id' , $request->visit_id)->get();
		$logo = Setting::where('name' , 'logo')->select('value')->first();
		$patient_checkup = PatientCheckup::where('id' , $request->visit_id)->first();
		return view('admin.clients.visit-detail', ['title' => 'Client Detail' , 'logo' => $logo , 'patient_checkup' => $patient_checkup, 'patients' => $patients]);
	}

	public function clientVisitHistory(Request $request)
	{
		$p_id = $request->pateint_id;
		$patient_visit = PatientCheckup::where('patient_id' , $p_id)->latest()->first();
		$patient_checkup_details = json_decode(json_encode($patient_visit->patient_checkup_details) , true);
		
		return view('admin.clients.patient-checkup-details', ['title' => 'Client Detail' , 'patient_checkup_details' => $patient_checkup_details, 'patient_id' => $p_id]);
	}

	public function saveClientHistory(Request $request)
	{
	
		try {
			DB::beginTransaction();
		
			$patient_checkup = new PatientCheckup();
			$patient_checkup->user_id = auth()->id();
			$patient_checkup->patient_id = $request->patient_id;
			$patient_checkup->visiting_date = $request->visit_date;
			$patient_checkup->visiting_time = $request->visit_time;
			$patient_checkup->fees = $request->fees;
			$patient_checkup->save();
		
			for ($i = 0; $i < count($request->name); $i++) {
				$patient_checkup_detail = new PatientCheckupDetail();
				$patient_checkup_detail->patient_checkup_id = $patient_checkup->id; // Assuming you want to link to the primary key of the main checkup table
				$patient_checkup_detail->name = $request->name[$i];
				$patient_checkup_detail->description = $request->description[$i];
				$patient_checkup_detail->save();
			}
		
			DB::commit();
			Session::flash('success_message', 'Great! Patient Checkup has been added successfully!');
		} catch (\Exception $e) {
			// If an exception occurs, rollback the transaction
			DB::rollBack();
			Session::flash('error_message', 'An error occurred while adding the Patient Checkup. Please try again.');
			// Log the exception if necessary: \Log::error($e->getMessage());
		} 
		
		return redirect()->back();

	}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $user = Service::find($id);
	    return view('admin.clients.edit', ['title' => 'Edit Service details'])->withUser($user);
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
	    
        $this->validate($request, [
		    'title' => 'required',
		    'sub_title' => 'required',
		    'price' => 'required',
            'duration'=>'required',
            'description'=>'required'
	    ]);
	    
	    
        $user = Service::find($id);
        $user->title  = $request->title;
	    $user->sub_title =$request->sub_title;
	    $user->price = $request->price;
        $user->duration  = $request->duration ;
        $user->description = $request->description;

	    $user->save();

	    Session::flash('success_message', "Great! Service's record successfully updated!");
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
	    $user = Service::find($id);
	    
	    $user->delete();
	    Session::flash('success_message', 'services successfully deleted!');
   
	    return redirect()->route('services.index');

    }




	public function deleteSelectedClients(Request $request)
	{
		$input = $request->all();
		$this->validate($request, [
			'clients' => 'required',

		]);
		foreach ($input['clients'] as $index => $id) {

			$user = Service::find($id);
		
			$user->delete();
			

		}
		Session::flash('success_message', 'services successfully deleted!');
		return redirect()->back();

	}
}
