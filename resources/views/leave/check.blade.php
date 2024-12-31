@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.leave') !!}</li>
    </ul>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <h2><strong>{!! trans('messages.check') !!}</strong> {!! trans('messages.leave_blance_check') !!}
                    {{-- <div class="additional-btn">
                            <a href="/leave"><button class="btn btn-sm btn-primary"><i class="fa fa-bars icon"></i> {!! trans('messages.list_all') !!}</button></a>
                        </div> --}}
                </h2>
                <div class="container">
                    {{-- <h3 class="text-center">Leave Management</h3>
                    <h4 class="text-center">Leave Balance Check</h4> --}}
                    {{-- Check Form --}}
                    @include('leave._check')
                    {{-- End Check Form --}}
                    {{-- Check Result --}}
                    {{-- <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Leave Name</th>
                                <th>Entitled Balance</th>
                                <th>Availed</th>
                                <th>Left Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>CL</td>
                                <td>10</td>
                                <td>1</td>
                                <td>9</td>
                            </tr>
                            <tr>
                                <td>SL</td>
                                <td>14</td>
                                <td>2</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td>LWP</td>
                                <td>30</td>
                                <td>2</td>
                                <td>28</td>
                            </tr>
                        </tbody>
                    </table> --}}
                    <table class="table table-bordered" id="result_table" style="display: none">
                        <thead>
                            <tr>
                                <th>Leave Name</th>
                                <th>Entitled Balance</th>
                                <th>Availed</th>
                                <th>Left Balance</th>
                            </tr>
                        </thead>
                        <tbody id="result">

                        </tbody>
                    </table>

                </div>
                {{-- End Check Result --}}
            </div>
        </div>
    </div>

@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#employeeID').change(function() {
                var employee_id = $(this).val();
                // Start Employee Data
                if (employee_id) {
                    $.ajax({
                        url: '/getuserData',
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": employee_id
                        },
                        success: function(response) {
                            $('#employeeName').val(response.name);
                            $('#employeeDesignation').val(response.designation);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching employee data:", error);
                            alert("Failed to retrieve employee data. Please try again.");
                        }
                    });
                } else {
                    $('#employeeName').val('');
                    $('#employeeDesignation').val('');
                }
                // End Employee Data
                // Start Leave Data
               const financialYear = $('#financialYear').val();
               const branch = $('#branch').val();
                $.ajax({
                    url: '/leave/check',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "employee_id": employee_id,
                        "financialYear": financialYear,
                        "branch": branch
                    },
                    success: function(response) {
                        $('#result').html('');
                        $('#result_table').show();
                        $('#result').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching employee data:", error);
                         toastr.error("Failed to retrieve employee data. Please try again.");
                        // alert("Failed to retrieve employee data. Please try again.");
                    }
                })
                // End Leave Data
            });
        });
    </script>
@stop
