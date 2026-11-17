@extends('admin.layouts.master')
@section('title',$title)
@section('content')
<style>
    /* Custom CSS styles for pagination links */
ul.pagination {
    list-style-type: none;
    margin: 0;
    padding: 0;
}


#editor {
      height: 250px; /* Set your desired height */
      margin-bottom:1rem;
    }

ul.pagination li {
    display: inline;
    margin-right: 5px;
}

ul.pagination li a {
    text-decoration: none;
    padding: 5px 10px;
    border: 1px solid #ddd;
    color: #333;
    background-color: #fff;
}
#detailModal .modal-body {
    max-height: 500px;
    overflow-y: auto;
}

#sendAttchemntModal .modal-body {
    max-height: 500px;
    overflow-y: auto;
}

 .modal-body::-webkit-scrollbar {
    width: 12px; /* Set the width of the scrollbar */
}

 .modal-body::-webkit-scrollbar-thumb {
    background-color: #888; /* Set the color of the thumb (the draggable part of the scrollbar) */
    border-radius: 6px; /* Set the radius of the thumb */
}

.modal-body::-webkit-scrollbar-track {
    background-color: #f1f1f1; /* Set the color of the track (the non-draggable part of the scrollbar) */
}

/* For Firefox */
 .modal-body {
    scrollbar-width: thin; /* Set the width of the scrollbar in Firefox */
}

 .modal-body::-webkit-scrollbar-thumb {
    background-color: #888; /* Set the color of the thumb in Firefox */
    border-radius: 6px; /* Set the radius of the thumb in Firefox */
}

.modal-body::-webkit-scrollbar-track {
    background-color: #f1f1f1; /* Set the color of the track in Firefox */
}

ul.pagination li.active a {
    background-color: #007bff;
    color: #fff;
}

</style>
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	
		<!--begin::Entry-->
		<div class="d-flex flex-column-fluid">
			<!--begin::Container-->
			<div class="container">
				<!--begin::Card-->
				<div class="card card-custom card-sticky" id="kt_page_sticky_card">
					<div class="card-header" style="">
						<div class="card-title">
						    
                            <h3 class="card-label" style="margin:0px;">
                                <a href="{{route('admin.order.data' )}}" class="btn btn-sm  <?=(empty(request()->type)) ? 'us_custom_active' : '' ?> " >All Orders </a>
                            </h3>
                            
                            <h3 class="card-label" style="margin:0px;">
                                <a href="{{route('admin.order.data' , ['type' => 'registered_agent_renew_llc'] )}}" class="btn btn-sm  <?=(!empty(request()->type) && request()->type == 'registered_agent_renew_llc') ? 'us_custom_active' : '' ?> " >Registered Renew llc Orders </a>
                            </h3>
                            
                          
						</div>
						<div class="card-toolbar">
							<a href="{{ route('admin.dashboard') }}" class="btn btn-light-primary font-weight-bolder mr-2">
								<i class="ki ki-long-arrow-back icon-sm"></i>Back</a>
						</div>
					</div>
					<div class="card-body">
					@include('admin.partials._messages')
					
					
					 <table class="table table-bordered table-hover table-checkable" id="clients"
                           style="margin-top: 13px !important">
                        <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Company Name</th>
                            <th>Order Date</th>
                            <th>Actions</th>
                            
                            <tbody>
                                
                            </tbody>
                        </tr>
                        </thead>
                    </table>
                    

                 
                    
                    
					</div>
				</div>
				<!--end::Card-->
				
		
			</div>
			<!--end::Container-->
		</div>
		<!--end::Entry-->
	</div>
	
	
	<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order No : <span id="order_no" style="font-size: 13px;color: gray;"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          X
        </button>
      </div>
      <div class="modal-body" id="pushdata">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="downloadPdfButton" class="btn btn-primary">Download</button>
        <button id="sendAttachmentButton" class="btn btn-info" onclick="openAttachmentModal()">Send Attachments</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="sendAttchemntModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send Attachments </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          X
        </button>
      </div>

      <form method="POST" onsubmit="return sendAndSave()" id="sendAndSave">
      @csrf
      <div class="modal-body" >

        <div class="alert " role="alert" id="message_alert" style="display:none;">
        loading...
        </div>


      <div id="editor"></div>

      <input type="hidden" name="quillContent" id="quillContent">
      <input type="hidden" name="uploaded_files" id="uploaded_files">
      <input type="hidden" name="dropzone_order_no" id="dropzone_order_no">

        </form>

      <form id="myDropzone" class="dropzone" action="{{ route('upload.files') }}" enctype="multipart/form-data">
        @csrf
        <div class="fallback">
            <input name="file[]" type="file" multiple />
        </div>
      
    </form>


      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="SendAttachemntButton" class="btn btn-primary" onclick="sendRequest()">Send</button>
        
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="attachemntDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Attachment History</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          X
        </button>
      </div>
      <div class="modal-body" id="pushattachemntdata">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>

@endsection
@section('stylesheets')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!--end::Page Vendors Styles-->
@endsection
@section('scripts')

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

  <script>

function viewOrderAttachments(self)
{
    var orderid =  $(self).data("order_id")
     
      $.ajax({
            type: 'GET',
            url: "{{route('get.attachment')}}",
            data:{orderid:orderid },
            success:function(data){
             $('#pushattachemntdata').html(data);
             $('#attachemntDetailModal').modal('show')
            }
        });
}

    function sendRequest()
    {
        $('#SendAttachemntButton').html('Processing...')
        $('#SendAttachemntButton').prop('disabled' , true)
        $('#sendAndSave').submit();
    }

    function sendAndSave() {
    // Collect additional form data
    var formData = {
        'quillContent': $('#quillContent').val(),
        'uploaded_files': $('#uploaded_files').val(),
        'order_no': $('#dropzone_order_no').val()
    };

    // Include CSRF token in headers
    var headers = {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    };

    // Make the AJAX request
    $.ajax({
        url: "{{ route('send.save') }}",
        type: "post",
        data: formData,
        headers: headers,
        dataType:"json",
        success: function (data) 
        {
           if(data.response=='success')
           {
                $('#message_alert').addClass('alert-success');
                $('#message_alert').removeClass('alert-danger');
                $('#message_alert').html(data.message);
                $('#message_alert').show();
                location.reload(true)
           }
           else
           {
                $('#message_alert').addClass('alert-danger');
                $('#message_alert').removeClass('alert-success');
                $('#message_alert').html(data.message);
                $('#message_alert').show();

                $('#SendAttachemntButton').html('Send')
                $('#SendAttachemntButton').prop('disabled' , false)
           }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });

    return false;
}


    

document.addEventListener('DOMContentLoaded', function () {
    Dropzone.instances.forEach(instance => instance.destroy());

    var uploadedFiles = []; // Array to store uploaded file names

    // Dropzone configuration
    var myDropzone = new Dropzone('#myDropzone', {
        url: '{{ route('upload.files') }}',
        autoProcessQueue: true,
        maxFilesize: 5,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
        }
    });

    // Event listener for successful file uploads
    myDropzone.on('success', function (file, response) {
       
        // Add the actual filename to the array
        uploadedFiles.push(response.files);

        // Update the 'uploaded_files' element with the current list of uploaded files
        document.getElementById('uploaded_files').value = uploadedFiles.join(', ');

    });

    // Event listener for removed files
    myDropzone.on('removedfile', function (file , response) {
    

        // Remove the actual filename from the array
        var index = uploadedFiles.indexOf(response.files);
        if (index !== -1) {
            uploadedFiles.splice(index, 1);
        }

        // Update the 'uploaded_files' element with the current list of uploaded files after removal
        document.getElementById('uploaded_files').value = uploadedFiles.join(', ');

    });
});



  </script>


<script>
    var quill = new Quill('#editor', {
        theme: 'snow' // or 'bubble' for a different theme
    });

    // Update the hidden input with the Quill content on each change
    quill.on('text-change', function () {
        $('#quillContent').val(quill.root.innerHTML);
    });
</script>

<script type="text/javascript">



function openAttachmentModal()
{
    $('#dropzone_order_no').val($('#order_no').html())
    $('#detailModal').modal('hide')
    $('#sendAttchemntModal').modal('show')
}

var clients = $('#clients').DataTable({
            "order": [
                [1, 'asc']
            ],
            "processing": true,
            "serverSide": true,
            "searchDelay": 500,
            "responsive": true,
            "ajax": {
                "url": "{{ route('admin.order.getdata') }}",
                "dataType": "json",
                "type": "POST",
                "data": {"_token": "<?php echo csrf_token() ?>" , 'type' : "{{$type}}"}
            },
            "columns": [
                {"data": "id", "searchable": false, "orderable": false},
                {"data": "company_name"},
                {"data": "order_date"},
                {"data": "action", "searchable": false, "orderable": false}
            ]
        });



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

        
        
  function viewOrderInfo(self)
  {
     var orderid =  $(self).data("order_id")
     
      $.ajax({
            type: 'GET',
            url: "{{route('admin.single.order.data')}}",
            data:{orderid:orderid , 'type' : '{{$type}}'},
            success:function(data){
             $('#pushdata').html(data);
             $('#order_no').html($('#orderID').val())
             $('#detailModal').modal('show')
            }
        });
  }
  

  
   function del(self) {
       id = $(self).data("order_id");
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function (result) {
                if (result.value) {
                    Swal.fire(
                        "Deleted!",
                        "Your order has been deleted.",
                        "success"
                    );
                    var APP_URL = {!! json_encode(url('/')) !!}
                        window.location.href = APP_URL + "/admin/order/delete/" + id;
                }
            });
        }
        

</script>

@endsection
