@extends('admin.layouts.master')
@section('title',$title)
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">

                <h3 class="card-label">Table List</h3>
                <div class="d-flex align-items-center ">

                </div>
            </div>
            <div class="card-toolbar">

                <div class="btn-group">

                        <a href="{{ route('table-columns') }}"  onclick="event.preventDefault(); document.getElementById('table_form').submit();" id="kt_btn" class="btn btn-primary font-weight-bolder">
                            <i class="ki ki-check icon-sm"></i>Get Table information </a>



                </div>
            </div>
        </div>
        <div class="card-body">
            @include('admin.partials._messages')
            <div class="">
                <form action="{{route('table-columns')}}" method="post" id="table_form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!--begin: Datatable-->
                    <div class="row">
                        <div class="col-6">
                            <table class="table table-bordered table-hover table-checkable" id="clients"
                                   style="margin-top: 13px !important">
                                <thead>
                                <tr>

                                    <th> Database: {{ getDatabaseNameFromString(key($database1[0])) }} <br> Total tables : {{ count($database1) }}<br> Tables </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($database1 as $table)
                                    <tr>
                                        <td><input type="radio" name="db_tbl1" id="db_tbl1{{ array_values((array)$table)[0] }}" value="{{ array_values((array)$table)[0] }}"> &nbsp; {{ array_values((array)$table)[0] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                            <table class="table table-bordered table-hover table-checkable" id="clients"
                                   style="margin-top: 13px !important">
                                <thead>
                                <tr>

                                    <th>Database: {{ getDatabaseNameFromString(key($database2[0])) }} <br> Total tables : {{ count($database2) }}<br> Tables</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($database2 as $table)
                                    <tr>
                                        <td><input type="radio" name="db_tbl2" id="db_tbl2{{ array_values((array)$table)[0] }}" value="{{ array_values((array)$table)[0] }}"> &nbsp; {{ array_values((array)$table)[0] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </form>
                <!--end: Datatable-->
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

