@extends('admin.layouts.master')
@section('title',$title)
@section('content')

<style>

@media print {
        .print-hide {
            display: none !important;
        }
    }
    
    .us_sty
    {
        font-weight:bold;
    }
    </style>
    
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">

                <h3 class="card-label">Service List</h3>
                <div class="d-flex align-items-center ">

                </div>
            </div>
            <div class="card-toolbar">

                <!--begin::Button-->
                <a href="{{ route('services.create') }}" class="btn mr-2 btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24"/>
														<circle fill="#000000" cx="9" cy="15" r="6"/>
														<path
                                                            d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                                            fill="#000000" opacity="0.3"/>
													</g>
												</svg>
                                                <!--end::Svg Icon-->
											</span>New Record</a>


                <!--end::Button-->
                <a class="btn btn-danger font-weight-bolder" onclick="del_selected()" href="javascript:void(0)"> <i
                        class="la la-trash-o"></i>Delete All</a>

            </div>
        </div>
        <div class="card-body">
            @include('admin.partials._messages')
            <div class="">
                <form action="{{route('admin.delete-selected-clients')}}" method="post" id="client_form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!--begin: Datatable-->
                    <table class="table table-bordered table-hover table-checkable" id="clients"
                           style="margin-top: 13px !important">
                        <thead>
                        <tr>
                             <th>
                                <label class="checkbox checkbox-outline checkbox-success"><input
                                        type="checkbox"><span></span></label>

                            </th> 

                            <th>Title</th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                </form>
                <!--end: Datatable-->
            </div>
        </div>
        <!-- Modal-->
            <div class="modal fade" id="clientModel" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="staticBackdrop" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Service Detail</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
            </div>



 

    </div>
    <!--end::Card-->
@endsection
@section('stylesheets')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <!--end::Page Vendors Styles-->
@endsection
@section('scripts')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('js/printThis.js') }}"></script>


    <script>
      $(document).ready(function () {
        var printButton = $("#printButton");
        var vistBody = $("#vist_body");

        // Check if the element with id "vist_body" exists
        if (vistBody.length) {
            // If it exists, make the print button visible
            printButton.show();
        } else {
            // If it doesn't exist, hide the print button
            printButton.hide();
        }

        // Print button click event using PrintThis plugin
        printButton.click(function () {
            // Replace 'vist_body' with the appropriate element or selector you want to print
            vistBody.printThis({
                importCSS: true,         // Import page CSS
                printContainer: true,    // Print outer container, if set to false, only prints the contents of the element
                loadCSS: "",             // Optional additional CSS
                pageTitle: "Visit Details", // Add title to print page
            });
        });
    });
</script>


    <!--end::Page Vendors-->
    <script>
        function removeRow(self)
        {
            $(self).closest('.row').remove()
        }

        function addRow(self)
        {
            $('#medicine_history').append('<div class="row" style="margin-bottom:1rem;"><div class="col-md-3"><input type="text" placeholder="Enter name" name="name[]" class="form-control" /></div><div class="col-md-8"><input type="text" placeholder="Enter description" name="description[]" class="form-control" /> </div><div class="col-md-1 text-right" > <button type="button" onclick="removeRow(this)" class="btn btn-danger btn-sm" >x</button>  </div></div>')
        }

        function addNewVisit(pateint_id)
        {
            $('#clientModel').modal('hide');
            var CSRF_TOKEN = '{{ csrf_token() }}';
            $.post("{{ route('admin.getClientVisitHistory') }}", {_token: CSRF_TOKEN, pateint_id: pateint_id}).done(function (response) {
                $('#medicine_history').html(response);
                $('#clientVisitAddModel').modal('show');
            });
        }

        function viewVisitInfo(visit_id)
        {
            var CSRF_TOKEN = '{{ csrf_token() }}';
            $.post("{{ route('admin.getClientVisitDeatails') }}", {_token: CSRF_TOKEN, visit_id: visit_id}).done(function (response) {
                $('#vist_body').html(response);
                $('#clientVisitModel').modal('show');
            }); 
        }

        $(document).on('click', 'th input:checkbox', function () {

            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                .each(function () {
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
                });
        });
        var clients = $('#clients').DataTable({
            "order": [
                [1, 'asc']
            ],
            "processing": true,
            "serverSide": true,
            "searchDelay": 500,
            "responsive": true,
            "ajax": {
                "url": "{{ route('admin.getClients') }}",
                "dataType": "json",
                "type": "POST",
                "data": {"_token": "<?php echo csrf_token() ?>"}
            },
            "columns": [
                {"data": "id", "searchable": false, "orderable": false},
                {"data": "title"},
                {"data": "price"},
                {"data": "duration"},
                {"data": "action", "searchable": false, "orderable": false}
            ]
        });

        function viewInfo(id) {

            var CSRF_TOKEN = '{{ csrf_token() }}';
            $.post("{{ route('admin.getClient') }}", {_token: CSRF_TOKEN, id: id}).done(function (response) {
                $('.modal-body').html(response);
                $('#clientModel').modal('show');

            });
        }

        function del(id) {
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
                        "Your user has been deleted.",
                        "success"
                    );
                    var APP_URL = {!! json_encode(url('/')) !!}
                        window.location.href = APP_URL + "/admin/client/delete/" + id;
                }
            });
        }

        function deleteInfo(id)
        {
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
                        "Your record has been deleted.",
                        "success"
                    );
                    
                    var APP_URL = {!! json_encode(url('/')) !!}
                        window.location.href = APP_URL + "/admin/client/visitinfo/delete/" + id;
                }
            });
        }

        function deleteVisitInfo(id)
        {
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
                        "Your record has been deleted.",
                        "success"
                    );
                    
                    var APP_URL = {!! json_encode(url('/')) !!}
                        window.location.href = APP_URL + "/admin/client/visit/delete/" + id;
                }
            });
        }

        function del_selected() {
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
                        "Your users has been deleted.",
                        "success"
                    );
                    $("#client_form").submit();
                }
            });
        }

    </script>
@endsection
