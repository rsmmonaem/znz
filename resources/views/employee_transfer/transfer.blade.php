@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.employee_transfer') !!}</li>
    </ul>
@stop

@section('content')
    <style>
        .container {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .remarks-box {
            width: 100%;
            height: 60px;
            resize: none;
        }

        .btn-group {
            margin-top: 15px;
        }

        .table-container {
            margin-top: 30px;
        }
    </style>
    <div class="row">
        @if (Entrust::can('create_employee'))
            <div class="col-sm-12">
                <div class="box-info full">
                    <h2><strong>{!! trans('messages.employee_transfer') !!}</strong>
                        <div class="additional-btn">
                            {{-- @if (Entrust::can('create_employee'))
							<a href="#" data-toggle="collapse" data-target="#box-detail"><button class="btn btn-sm btn-primary"><i class="fa fa-plus icon"></i> {!! trans('messages.add_new') !!}</button></a>
							@endif --}}
                        </div>
                    </h2>
                    {{-- Transfer Form --}}
                    <div class="container">
                        {{-- <h3 class="text-center">Employee Transfer</h3> --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Group</label>
                                     @php $group = DB::table('com_group')->get();  @endphp
                                    <select class="form-control" id="group">
                                        <option value="">Select Group</option>
                                        @foreach ($group as $g)
                                            <option value="{{ $g->id }}" selected>{{ $g->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="section-title">From</div>
                                <div class="form-group">
                                    <label>Branch</label>
                                    <select class="form-control" name="fbranch">
                                        <option value="">Select Branch</option>
                                        @foreach ($branch as $b)
                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Department</label>
                                    <select class="form-control" name="fdepartment">
                                        <option value="">Select Department</option>
                                        @foreach ($department as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Section</label>
                                    <select class="form-control" name="fsection">
                                        <option value="">Select Section</option>
                                        @foreach ($section as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                                    <label>Designation</label>
                                    <select class="form-control select2me select2-offscreen" name="fdesignation">
                                        <option value="">Select Designation</option>
                                        @foreach ($designation as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="form-group">
                                    <label>Employee ID</label>
                                    <select id="employeeId" class="form-control select2me select2-offscreen" name="femployee">
                                        <option value="">Select Employee ID</option>
                                        {{-- @foreach ($employee as $e)
                                            <option value="{{ $e->id }}">{{ $e->first_name }} -
                                                {{ $e->employee_code }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="form-group">
                                        <label>Employee Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Employee Name" id="employeeName" readonly>
                                </div>
                                 <div class="form-group">
                                        <label>Degisnation</label>
                                        <input type="text" class="form-control" name="fdesignation" id="employeeDesignation" placeholder="Enter Employee Designation" readonly>
                                        <input type="hidden" name= "fdesignation_id" id="employeeDesignationID" >
                                </div>

                                <div class="form-group">
                                    <label>Transfer Date</label>
                                    <input type="date" class="form-control" name="ftransfer_date">
                                </div> 
                            </div>

                            <div class="col-md-6">
                                <div class="section-title">To</div>
                                <div class="form-group">
                                    <label>Branch</label>
                                    <select class="form-control" name="tbranch">
                                        <option value="">Select Branch</option>
                                        @foreach ($branch as $b)
                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Department</label>
                                    <select class="form-control" name="tdepartment">
                                        <option value="">Select Department</option>
                                        @foreach ($department as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Section</label>
                                    <select class="form-control" name="tsection">
                                        <option value="">Select Section</option>
                                        @foreach ($section as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Designation</label>
                                    <select class="form-control" name="tdesignation">
                                        <option value="">Select Designation</option>
                                        @foreach ($designation as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Join Date</label>
                                    <input type="date" class="form-control" name="tjoin_date">
                                </div>
                                </form>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea class="form-control remarks-box" name="remarks"></textarea>
                        </div>

                        <div class="btn-group" style="margin-bottom: 20px;">
                            <button type="button" class="btn btn-primary" id="save">Save</button>
                            <button type="button" class="btn btn-default" id="refresh">Refresh</button>
                            {{-- <button type="button" class="btn btn-danger">Close</button> --}}
                            <button type="reset" class="btn btn-danger" id="reset">Close</button>
                        </div>

                        <div class="table-container" style="margin-bottom: 20px;" id="transfer-table">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Edit</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Transfer Date</th>
                                        <th>Join Date</th>
                                        <th>Remarks</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="transfer-tbody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- End of Transfer Form --}}
                </div>
            </div>
        @endif
    </div>
@stop
@section('javascript')
    <script>
        document.getElementById('refresh').addEventListener('click', function() {
            location.reload();
        });
        document.getElementById('reset').addEventListener('click', function() {
            location.reload();
        })
        document.getElementById('save').addEventListener('click', function() {
            const fbranch = document.querySelector('select[name="fbranch"]').value;
            const fdepartment = document.querySelector('select[name="fdepartment"]').value;
            const fsection = document.querySelector('select[name="fsection"]').value;
            const fdesignation = document.getElementById('employeeDesignationID').value;
            const ftransfer_date = document.querySelector('input[name="ftransfer_date"]').value;
            const femployee = document.querySelector('select[name="femployee"]').value;
            const tbranch = document.querySelector('select[name="tbranch"]').value;
            const tdepartment = document.querySelector('select[name="tdepartment"]').value;
            const tsection = document.querySelector('select[name="tsection"]').value;
            const tdesignation = document.querySelector('select[name="tdesignation"]').value;
            const tjoin_date = document.querySelector('input[name="tjoin_date"]').value;
            const remarks = document.querySelector('.remarks-box').value;
            // alert(fdesignation);
            // return;
            const formData = {
                fbranch: fbranch,
                fdepartment: fdepartment,
                fsection: fsection,
                fdesignation: fdesignation,
                ftransfer_date: ftransfer_date,
                femployee: femployee,
                tbranch: tbranch,
                tdepartment: tdepartment,
                tsection: tsection,
                tdesignation: tdesignation,
                tjoin_date: tjoin_date,
                remarks: remarks
            };

            $.ajax({
                url: "{{ url('employee/transfer') }}",
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success response
                    response.status == 'success' ? toastr.success(response.message) : toastr.error(
                        response.message);
                    // console.log(response);
                    getTransferData();
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(error);
                }
            })
        })
        $(document).ready(function() {
            getTransferData();
            $('select[name="fbranch"]').on('change', function() {
                var branch_id = $(this).val();
                $('#employeeId').val('').trigger('change');
                HandleBranchWiseEmployees(branch_id, '#employeeId');
            });
        });

        async function getTransferData() {
            const tbody = document.getElementById('transfer-tbody');
            $.ajax({
                url: "{{ url('employee/transfer-list') }}",
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    tbody.innerHTML = ''; // Clear any existing rows in the table body

                    // Populate table body with data from the response
                    response.forEach((item, index) => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                    <td>
                        <a href="{{ url('employee/transfer-edit') }}/${item.id}" class="btn btn-xs btn-warning">Edit</a>
                        <button class="btn btn-xs btn-danger" id="cancel" data-id="${item.id}">Cancel</button>
                    </td>
                    <td>${item.employee_code}</td>
                    <td>${item.first_name}</td>
                    <td>${item.designation_name}</td>
                    <td>${item.ftransfer_date}</td>
                    <td>${item.tjoin_date}</td>
                    <td>${item.remarks}</td>
                    <td>${item.status}</td>
                `;
                        tbody.appendChild(tr);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        $(document).on('click', '#cancel', function() {
            // Show confirmation dialog
            if (confirm('Are you sure you want to cancel this transfer?')) {
                const id = $(this).data('id');

                $.ajax({
                    url: "{{ url('employee/transfer-cancel') }}/" + id,
                    method: 'POST',
                    success: function(response) {
                        console.log(response);
                        // Display success or error message based on the response
                        if (response.status == 'success') {
                            toastr.success(response.message); // Show success toast
                        } else {
                            toastr.error(response.message); // Show error toast
                        }

                        // Refresh the transfer data
                        getTransferData();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(error);
                        toastr.error(
                        'An error occurred. Please try again.'); // Show generic error toast
                    }
                });
            } else {
                // If user cancels, show a toast message (optional)
                toastr.info('Action cancelled.'); // Info toast for cancelled action
            }
        });

        $('#employeeId').on('change', function() {
            var employeeId = $(this).val();
            $.ajax({
                url: '/getuserData',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": employeeId
                },
                success: function(response) {
                    console.log(response);
                    $('#employeeName').val(response.name);
                    // $('select[name="fbranch"]').val(1).trigger('change');
                    $('#employeeDesignation').val(response.designation);
                    $('#employeeDesignationID').val(response.designation_id);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching employee data:", error);
                    toastr.error("Failed to retrieve employee data. Please try again.");
                }
            });
        })
    </script>
@stop
