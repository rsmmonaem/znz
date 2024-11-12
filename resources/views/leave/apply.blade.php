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
                <h2><strong>Leave Apply</strong>
                    {{-- <div class="additional-btn">
                            <a href="/leave"><button class="btn btn-sm btn-primary"><i class="fa fa-bars icon"></i> {!! trans('messages.list_all') !!}</button></a>
                        </div> --}}
                </h2>
                <div class="container">
                    {{-- <h3 class="text-center"></h3> --}}

                    <form>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="group">Group</label>
                            <div class="col-sm-4">
                                 <section class="form-control">
                                    <option>J & J Group</option>
                                </section>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="employeeID">Employee ID</label>
                            <div class="col-sm-4">
                                <select class="form-control select2me select2-offscreen" id="employeeID">
                                    <option value="">Select Employee ID</option>
                                    @foreach ($employee as $e)
                                        <option value="{{ $e->id }}">{{ $e->employee_id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="employeeName">Employee Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="employeeName" placeholder="Employee Name"
                                    readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="employeeDesignation">Employee Designation</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="employeeDesignation"
                                    placeholder="Employee Designation" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="leaveType">Leave Type</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="leaveType">
                                    <option value="">Select Leave Type</option>
                                    @foreach ($leaveType as $lt)
                                        <option value="{{ $lt->id }}">{{ $lt->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="fromDate">From Date</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="fromDate">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="toDate">To Date</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="toDate">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="leaveDays">Leave Days</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="balance" placeholder="Balance" readonly>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="appliedDays" placeholder="Applied Days">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Recommend Person Branch</label>
                            {{-- <label class="col-sm-2 control-label" for="recommendBranch"></label> --}}
                            <div class="col-sm-4">
                                <select class="form-control select2me select2-offscreen" id="recommendBranch">
                                    <option value="">Select Branch</option>
                                    @foreach ($branch as $b)
                                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="recommendID">ID</label>
                            <div class="col-sm-4">
                                <select class="form-control select2me select2-offscreen" id="recommendID">
                                    <option value="">Select ID</option>
                                    @foreach ($employee as $e)
                                        <option value="{{ $e->id }}">{{ $e->employee_id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="recommendName">Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="recommendName" placeholder="Name" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="recommendDesignation">Designation</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="recommendDesignation"
                                    placeholder="Designation" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="reason">Reason</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" id="reason" rows="3" placeholder="Reason"></textarea>
                            </div>
                        </div>

                        <div class="form-group form-actions text-center">
                            <button type="button" class="btn btn-primary" id="saveLeave">Save</button>
                            <button type="reset" class="btn btn-warning">Refresh</button>
                            <button type="button" class="btn btn-danger">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
  <script type="text/javascript">
    const employeeName = $('#employeeName').val();
    const employeeDesignation = $('#employeeDesignation').val();
    $('#employeeID').change(function() {
        var employee_id = $(this).val();
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
    })

    // Start recommendID Data
    $('#recommendID').change(function() {
        var employee_id = $(this).val();
        $.ajax({
            url: '/getuserData',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": employee_id
            },
            success: function(response) {
                // $('#recommendID').html(response);
                $('#recommendName').val(response.name);
                $('#recommendDesignation').val(response.designation);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching employee data:", error);
                toastr.error("Failed to retrieve employee data. Please try again.");
            }
        });
    })
    // End recommendID Data

    // leaveType
    $('#leaveType').change(function() {
        var leaveType = $(this).val();
        const employee_id = document.getElementById('employeeID').value;
        if (employee_id) {
            $.ajax({
            url: '{{ url('getLeave') }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "leaveType": leaveType,
                "user_id": employee_id
            },
            success: function(response) {
            //    console.log(response[0].remaining); // Corrected this line
               if(response>0){
                 $('#balance').val('');
               }else{
                 $('#balance').val(response[0].remaining); 
               }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching employee data:", error);
                toastr.error("Failed to retrieve employee data. Please try again.");
            }
         });
        }
        else{
           toastr.error("Failed to retrieve employee data. Please try again.");
           $('#leaveType').val('');
        }
    })
    
    // Leave create
    // $('#saveLeave').click(function() {
    //     $.ajax({
    //         url: '{{ url('leave-apply-save') }}',
    //         type: 'get',
    //         // data: {
    //         //     "_token": "{{ csrf_token() }}",
    //         //     "user_id": employee_id,
    //         //     "leave_type_id": leaveType,
    //         //     "from_date": fromDate,
    //         //     "to_date": toDate,
    //         //     "reason": reason,
    //         //     "applied_days": appliedDays,
    //         //     "branch": branch,
    //         //     "recommend_id": recommendID,
    //         //     "recommend_name": recommendName,
    //         //     "recommend_designation": recommendDesignation
    //         // },
    //         success: function(response) {
    //             // console.log(response);
    //             // $('#leaveType').val('');
    //             // $('#fromDate').val(''); 
    //             // $('#toDate').val('');
    //             // $('#reason').val('');
    //             // $('#appliedDays').val('');
    //             // $('#branch').val('');
    //             // $('#recommendID').val('');
    //             // $('#recommendName').val('');
    //             // $('#recommendDesignation').val('');
    //             // $('#balance').val('');
    //             // $('#result').html('');
    //             // $('#result_table').hide();
    //             // if (response.status == 'success') {
    //             //     toastr.success(response.message);
    //             // } else {
    //             //     toastr.error(response.message);
    //             // }
    //         }
    //     })
    // })
$('#saveLeave').click(function() {
    const employee_id = document.getElementById('employeeID').value;
    const leaveType = document.getElementById('leaveType').value;
    const fromDate = document.getElementById('fromDate').value;
    const toDate = document.getElementById('toDate').value;
    const reason = document.getElementById('reason').value;
    const balance = document.getElementById('balance').value;
    const appliedDays = document.getElementById('appliedDays').value;
    const branch = document.getElementById('recommendBranch').value;
    const recommendID = document.getElementById('recommendID').value;
    if (employee_id == '' || leaveType == '' || fromDate == '' || toDate == '' || balance == '' || appliedDays == '' || branch == '' || recommendID == '') {
        toastr.error('Please fill all the required fields.');
        return;
    }else{
    $.ajax({
        url: '{{ url('leave-apply-save') }}',
        type: 'post',
        data: {
            "_token": "{{ csrf_token() }}",
            "user_id": employee_id,
            "leave_type_id": leaveType,
            "from_date": fromDate,
            "to_date": toDate,
            "reason": reason,
            "balance": balance,
            "appliedDays": appliedDays,
            "branch": branch,
            "recommendID": recommendID
        },
        success: function(response) {
            if (response.status === 'success') {
                toastr.success(response.message);
                // $('#leaveModal').modal('hide'); // Close the modal
            } else {
                toastr.error(response.message || 'An error occurred.');
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching employee data:", error);
            console.error("Status:", status);
            console.error("Response:", xhr.responseText);
            toastr.error("An error occurred. Please check the console for details.");
        }
    });
}
});

$('#reset').click(function() {
    location.reload();
});
  </script>
@stop