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

                        <a href="{{ route('insert-data') }}"  onclick="event.preventDefault(); document.getElementById('table_form').submit();" id="kt_btn" class="btn btn-primary font-weight-bolder">
                            <i class="ki ki-check icon-sm"></i>Get Table information </a>



                </div>
            </div>
        </div>
        <div class="card-body">
            @include('admin.partials._messages')
            <div class="">
                <form action="{{route('insert-data')}}" method="post" id="table_form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="table1" value="{{ $table1 }}">
                    <input type="hidden" name="table2" value="{{ $table2 }}">
                    <!--begin: Datatable-->
                    <div class="row">
                        <div class="col-6">
                            <table class="table table-bordered table-hover table-checkable" id="clients"
                                   style="margin-top: 13px !important">
                                <thead>
                                <tr>

                                    <th> Database: {{ getDatabaseNameFromString(key($database1Name[0])) }} <br>
                                        Table Name : {{ $table1 }} <br>
                                        Total Columns : {{ count($database1) }}<br>
                                        Columns </th>
                                    <th>Field info</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($database1 as $table)
                                    <tr>
                                        <td><input type="checkbox" name="db_tbl1[]" id="db_tbl1{{ array_values((array)$table)[0] }}" value="{{ array_values((array)$table)[0] }}"> &nbsp; {{ array_values((array)$table)[0] }}</td>
                                        <td>Field : {{  array_values((array)$table)[0] }}<br>
                                            Type : {{  array_values((array)$table)[1] }}<br>
                                            Null : {{  array_values((array)$table)[2] }}<br>
                                            Key : {{  array_values((array)$table)[3] }}<br>
                                            Default : {{  array_values((array)$table)[4] }}<br>
                                            Extra : {{  array_values((array)$table)[5] }}<br>
                                        </td>
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
                                    <th>Database: {{ getDatabaseNameFromString(key($database2Name[0])) }} <br>
                                        Table Name : {{ $table2 }} <br>
                                        Total Columns : {{ count($database2) }}<br>
                                        Columns</th>
                                    <th>Field info</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($database2 as $table)
                                    @php //echo '<pre>'; print_r($table); exit;@endphp
                                    <tr>
                                        <td><input type="checkbox" name="db_tbl2[]" id="db_tbl2{{ array_values((array)$table)[0] }}" value="{{ array_values((array)$table)[0] }}"> &nbsp; {{ array_values((array)$table)[0] }}</td>
                                        <td>Field : {{  array_values((array)$table)[0] }}<br>
                                            Type : {{  array_values((array)$table)[1] }}<br>
                                            Null : {{  array_values((array)$table)[2] }}<br>
                                            Key : {{  array_values((array)$table)[3] }}<br>
                                            Default : {{  array_values((array)$table)[4] }}<br>
                                            Extra : {{  array_values((array)$table)[5] }}<br>
                                        </td>
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

