<div class="row">
 @if($attachment == false)
<div class="col-md-12"><center>No Attachments Sent till yet.</center></div>
 @else
 <div class="col-md-12 mt-5"><b>Order Id</b> : <br> {{$attachment->order_id}}</div>

 <div class="col-md-12 mt-5"><b>Sent On </b> : <br> {{date('d-F-Y h:i' , strtotime($attachment->created_at))}}</div>

 <div class="col-md-12 mt-5"><b>Message</b> : <br> {!!$attachment->mesasge!!}</div>

 <div class="col-md-12 mt-5"><b>Attachments</b> : <br> 
 <div style="display:flex;">
 @foreach($attachment->attachmentFiles as $files)

 <a href="{{asset('uploads/'. $files->file_name)}}" target="_blank"><img src="{{asset('3767084.png')}}" style="padding:0.5rem;width: 100px;" /> </a>
 
 @endforeach
 </div>
</div>

 @endif
</div>