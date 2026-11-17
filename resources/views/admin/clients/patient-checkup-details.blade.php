<div class="row" style="margin-bottom:1rem;">
<input type="hidden" value="{{$patient_id}}"  name="patient_id"/> 
<div class="col-md-3">
<b>  Name</b>
    </div>

    <div class="col-md-8">
       <b>Description</b>
    </div>

    <div class="col-md-1 text-right">
      .
    </div>
</div>

@foreach($patient_checkup_details as  $key => $patient_checkup_detail)

<div class="row" style="margin-bottom:1rem;">
    <div class="col-md-3">
        <input type="text" value="{{$patient_checkup_detail['name']}}" name="name[]" class="form-control" />
    </div>

    <div class="col-md-8">
        <input type="text" value="{{$patient_checkup_detail['description']}}" name="description[]" class="form-control" />
    </div>

    <div class="col-md-1 text-right" >
        @if($key == 0)
        <button type="button" onclick="addRow(this)" class="btn btn-info btn-sm" >+</button>
        @else
        <button type="button" onclick="removeRow(this)" class="btn btn-danger btn-sm" >x</button>
        @endif
       
    </div>

</div>
@endforeach