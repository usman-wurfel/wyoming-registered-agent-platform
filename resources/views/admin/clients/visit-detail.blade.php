<div class="row">
	<div class="col-md-12">
		<center><img src="{{ asset('uploads/'.$logo->value) }}" style="    width: 250px;"/> </center>
	</div>
</div>


<div class="row mt-10">
	<div class="col-md-6 col-sm-6 col-xs-6">
		<label><b>Patient </b><label>&nbsp;&nbsp;
			<div style="margin-left: 2rem;border-bottom: 1px solid;">{{$patient_checkup->patient->name}}</div>
	</div>

	<div class="col-md-6 col-sm-6 col-xs-6">
		<label><b>Phone </b><label>&nbsp;&nbsp;
			<div style="margin-left: 7rem;border-bottom: 1px solid;">{{$patient_checkup->patient->phone_number}}</div>
	</div>

	<div class="col-md-6 col-sm-6 col-xs-6" style="margin-bottom: 1rem;">
		<label><b>Fee</b><label> &nbsp;&nbsp;
		<div style="margin-left: 4rem;border-bottom: 1px solid;">{{number_format($patient_checkup->fees , 2)}}</div>
	</div>


	<div class="col-md-6 col-sm-6 col-xs-6" style="margin-bottom: 1rem;">
		<label><b>Visit Date & Time</b> <label>&nbsp;&nbsp;
		<div style="margin-left: 1.5rem;border-bottom: 1px solid;">
		{{date('d F, Y' , strtotime($patient_checkup->visiting_date))}} {{date('h:i:a' , strtotime($patient_checkup->visiting_time))}}</div>
	</div>

</div>

<div class="card-datatable table-responsive">
	<table id="clients" class="datatables-demo table table-striped table-bordered">
		<thead>
			<th>Name</th>
			<th>Description</th>
			<th  class="print-hide">Action</th>
		</thead>
		<tbody>
			@foreach($patients as $patient)

				<tr>
					<td>{{$patient->name}}</td>
					<td>{{$patient->description}}</td>
					<td  class="print-hide"> 
						<a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();deleteVisitInfo({{$patient->id}});" title="View Visit Details" href="javascript:void(0)">
						<i class="fa fa-trash text-danger" aria-hidden="true"></i>
						</a>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>
</div>

