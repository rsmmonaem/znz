@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.employee_separetion') !!}</li>
    </ul>
@stop

@section('content')
<style>
    .form-group label { font-weight: bold; }
    .table { margin-top: 20px; }
    .dflex { display: flex; justify-content: space-between; }
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="box-info">
            <div class="container">
                <h2 class="text-center">Employee Separation (Entry Panel)</h2>
                <form id="separationForm">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="group">Group</label>
                                <select class="form-control" id="group">
                                    <option value="">J & Z Group</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="branch">Branch</label>
                                <input type="text" class="form-control" id="branch" readonly>
                            </div>
                            <div class="form-group">
                                <label for="employeeId">Employee ID</label>
                                <select class="form-control select2me" id="employeeId">
                                    <option value="">Select Employee ID</option>
                                    @foreach ($employee as $e)
                                        <option value="{{ $e->id }}">{{ $e->first_name }} - {{ $e->employee_code }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="employeeName">Employee Name</label>
                                <input type="text" class="form-control" id="employeeName" readonly>
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control" id="designation" readonly>
                            </div>
                            <div class="form-group">
                                <label for="section">Section</label>
                                <input type="text" class="form-control" id="section" readonly>
                            </div>
                            <div class="form-group">
                                <label for="doj">Date of Joining (DOJ)</label>
                                <input type="date" class="form-control" id="doj" readonly>
                            </div>
                            <div class="form-group">
                                <label for="separationType">Separation Type</label>
                                <select class="form-control select2me" id="separationType">
                                    <option value="">Select Separation Type</option>
                                    @foreach ($separetionType as $septype)
                                        <option value="{{ $septype }}">{{ $septype }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="reason">Reason</label>
                                <textarea class="form-control" id="reason" rows="3" placeholder="Enter Reason"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="entryDate">Entry Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="entryDate" value="{{ date('Y-m-d') }}" >
                            </div>
                            <div class="form-group">
                                <label for="separationAriseDate">Separation Arise Date</label>
                                <input type="date" class="form-control" id="separationAriseDate">
                            </div>
                            <div class="form-group">
                                <label for="lastWorkingDay">Last Working Day</label>
                                <input type="date" class="form-control" id="lastWorkingDay" onchange="calculateShortDay()">
                            </div>
                            <div class="form-group">
                                <label for="effectiveDate">Effective Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="effectiveDate">
                            </div>
                            <div class="form-group">
                                <label for="noticePeriod">Notice Period</label>
                                <input type="text" class="form-control" id="noticePeriod" readonly>
                            </div>
                            <div class="form-group">
                                <label for="mandatoryNotice">Mandatory Notice</label>
                                <input type="text" class="form-control" id="mandatoryNotice" value="30" readonly>
                            </div>
                            <div class="form-group">
                                <label for="shortDay">Short Day</label>
                                <input type="text" class="form-control" id="shortDay" readonly>
                            </div>

                            <script>
                                function calculateShortDay() {
                                    const separationAriseDate = document.getElementById('separationAriseDate').value;
                                    const lastWorkingDay = document.getElementById('lastWorkingDay').value;
                                    const mandatoryNotice = parseInt(document.getElementById('mandatoryNotice').value, 10);
                                    const effectiveDateField = document.getElementById('effectiveDate');

                                    if (!separationAriseDate || !lastWorkingDay || isNaN(mandatoryNotice)) return;

                                    const start = new Date(separationAriseDate);
                                    const end = new Date(lastWorkingDay);
                                    const notice = Math.ceil((end - start) / (1000 * 60 * 60 * 24) + 1);
                                    const shortDay = mandatoryNotice - notice;

                                    document.getElementById('noticePeriod').value = notice;
                                    document.getElementById('shortDay').value = shortDay;

                                    const effective = new Date(end);
                                    effective.setDate(effective.getDate() + 1);
                                    effectiveDateField.value = effective.toISOString().split('T')[0];
                                }
                            </script>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn btn-primary" id="saveData">Save</button>
                        <button type="button" class="btn btn-danger" id="closeBtn">Close</button>
                    </div>
                </form>

                <table class="table table-bordered" id="datatable" style="margin-top:20px">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Emp ID</th>
                            <th>Employee Name</th>
                            <th>Entry Date</th>
                            <th>Separation Arise Date</th>
                            <th>Last Working Day</th>
                            <th>Effective Date</th>
                            <th>Notice Period</th>
                            <th>Mandatory Notice</th>
                            <th>Short Day</th>
                        </tr>
                    </thead>
                    <tbody id="separationTableBody"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script type="text/javascript">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    // ✅ Fetch employee details
    $('#employeeId').on('change', function() {
        const id = $(this).val();
        if (id) {
            $.ajax({
                url: `/get-employee-details/${id}`,
                type: 'POST',
                success: function(data) {
                    $('#employeeName').val(data.first_name || '');
                    $('#section').val(data.section || '');
                    $('#designation').val(data.designation || '');
                    $('#doj').val(data.date_of_joining || '');
                    $('#branch').val(data.branch || '');
                }
            });
        } else {
            $('#employeeName, #section, #designation, #doj, #branch').val('');
        }
    });

    // ✅ Save data with validation
    $('#saveData').on('click', function(e) {
        e.preventDefault();
        const $btn = $(this);

        const formData = {
            employeeId: $('#employeeId').val(),
            employeeName: $('#employeeName').val(),
            section: $('#section').val(),
            designation: $('#designation').val(),
            doj: $('#doj').val(),
            branch: $('#branch').val(),
            separationType: $('#separationType').val(),
            reason: $('#reason').val(),
            entryDate: $('#entryDate').val(),
            separationAriseDate: $('#separationAriseDate').val(),
            lastWorkingDay: $('#lastWorkingDay').val(),
            effectiveDate: $('#effectiveDate').val(),
            noticePeriod: $('#noticePeriod').val(),
            mandatoryNotice: $('#mandatoryNotice').val(),
            shortDay: $('#shortDay').val()
        };

        // ✅ Validation
        if(!formData.employeeId) return validate('Please select an employee.');
        if(!formData.entryDate) return validate('Please select an entry date.');
        if(!formData.separationAriseDate) return validate('Please select a separation arise date.');
        if(!formData.lastWorkingDay) return validate('Please select a last working day.');
        if(!formData.effectiveDate) return validate('Please select an effective date.');

        $btn.attr('disabled', true).text('Please Wait...');

        $.ajax({
            url: '/employee-separation',
            type: 'POST',
            data: formData,
            success: function(response) {
                $btn.attr('disabled', false).text('Save');
                if (response.status === 'success') {
                    toastr.success(response.message || 'Data saved successfully.');

                    // ✅ Reset all fields except Employee ID & Entry Date
                    $('#separationForm').find('input[type="text"], input[type="date"], textarea, select')
                        .not('#employeeId, #entryDate')
                        .val('');

                    getSeparationData();
                } else {
                    toastr.error(response.message || 'Failed to save data.');
                }
            },
            error: function() {
                $btn.attr('disabled', false).text('Save');
                toastr.error('Something went wrong.');
            }
        });
    });

    function validate(message) {
        toastr.error(message);
        $('#saveData').attr('disabled', false).text('Save');
    }

    $(document).ready(function() {
        getSeparationData();
    });

    // ✅ Get data
    function getSeparationData() {
        $.ajax({
            url: '/employee-separation-data',
            type: 'GET',
            success: function(response) {
                const table = $('#datatable');
                table.DataTable().destroy();
                const body = $('#separationTableBody').empty();

                response.forEach(item => {
                    body.append(`
                        <tr>
                            <td>
                                <div class="btn-group btn-group-xs dflex">
                                    <a href="/employee-separation/${item.id}/edit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                    <a href="#" data-id="${item.id}" class="btn btn-danger btn-xs deleteSeparation"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                            <td>${item.employee_id}</td>
                            <td>${item.employee_name}</td>
                            <td>${item.entry_date}</td>
                            <td>${item.separation_arise_date}</td>
                            <td>${item.last_working_day}</td>
                            <td>${item.effective_date}</td>
                            <td>${item.notice_period}</td>
                            <td>${item.mandatory_notice}</td>
                            <td>${item.short_day}</td>
                        </tr>
                    `);
                });

                table.DataTable({ lengthMenu: [10, 20, 50, 100] });
            }
        });
    }

    // ✅ Delete record with SweetAlert2
    $(document).on('click', '.deleteSeparation', function(e) {
        e.preventDefault();
        const id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this action!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/employee-separation/${id}`,
                    type: 'DELETE',
                    success: function() {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'The record has been deleted successfully.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        getSeparationData();
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong while deleting the record.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    });
</script>
@stop
