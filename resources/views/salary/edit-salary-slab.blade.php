@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li><a href="/salary-slab">Salary Slab</a></li>
        <li class="active">Edit Salary Slab</li>
    </ul>
@stop

@section('content')
<style>
    .form-group {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .form-group label {
        width: 150px !important;
        margin-right: 10px;
    }

    .form-group input,
    .form-group select {
        flex: 1;
    }

    .panel-section {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .panel-left,
    .panel-right {
        flex: 1;
        margin-right: 20px;
    }

    .panel-right {
        margin-right: 0;
    }

    .action-buttons {
        text-align: center;
        margin-top: 20px;
    }

    .form-control {
        width: 69% !important;
    }
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="box-info">
            <div class="container">
                <h2 class="text-center">Salary Slab - Edit Panel</h2>
                <div class="panel-section">

                    <!-- Left Panel -->
                    <div class="panel-left">
                        <form id="salaryForm">
                            <div class="form-group">
                                <label for="branch">Branch <span class="text-danger">*</span></label>
                                <select id="branch" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($branch as $b)
                                        <option value="{{ $b->id }}" {{ $user->branch_id == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="employeeId">Employee ID <span class="text-danger">*</span></label>
                                <select id="employeeId" class="form-control select2me" disabled>
                                    <option value="{{ $user->employee_code }}" selected>{{ $user->employee_code }} - {{ $user->first_name }}</option>
                                </select>
                                <input type="hidden" id="userId" value="{{ $user->id }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" value="{{ $user->first_name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input type="text" id="designation" class="form-control" value="{{ $user->designation }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="joiningDate">Joining Date</label>
                                <input type="text" id="date_of_joining" class="form-control" value="{{ $user->date_of_joining }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <input type="text" id="category" class="form-control" value="{{ $user->category }}" disabled>
                            </div>
                        </form>
                    </div>

                    <!-- Right Panel -->
                    <div class="panel-right">
                        <form id="editSalaryForm">
                            <input type="hidden" id="slab_id" value="{{ $slab->id }}">
                            <div class="form-group">
                                <label for="entryDate">Entry Date</label>
                                <input type="date" id="entryDate" class="form-control" value="{{ date('Y-m-d', strtotime($slab->entrydate)) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="effectiveDate">Effective Date <span class="text-danger">*</span></label>
                                <input type="date" id="effectiveDate" class="form-control" value="{{ $slab->effactive_date ? date('Y-m-d', strtotime($slab->effactive_date)) : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="gross">Gross <span class="text-danger">*</span></label>
                                <input type="text" id="gross" class="form-control" value="{{ $slab->gross }}">
                            </div>
                            <div class="form-group">
                                <label>Basic </label>
                                <input type="text" class="form-control" id="basic1" disabled value="{{ isset($salaries['Basic']) ? $salaries['Basic'] : '' }}">
                                <input type="hidden" class="form-control" id="basic" value="50">
                            </div>
                            <div class="form-group">
                                <label>House Rent </label>
                                <input type="text" class="form-control" id="houseRent1" disabled value="{{ isset($salaries['House Rent']) ? $salaries['House Rent'] : '' }}">
                                <input type="hidden" class="form-control" id="houseRent" value="28">
                            </div>
                            <div class="form-group">
                                <label>Medical </label>
                                <input type="text" class="form-control" id="medical1" disabled value="{{ isset($salaries['Medical']) ? $salaries['Medical'] : '' }}">
                                <input type="hidden" class="form-control" id="medical" value="9">
                            </div>
                            <div class="form-group">
                                <label>Conveyance </label>
                                <input type="text" class="form-control" id="conveyance1" disabled value="{{ isset($salaries['Conveyance']) ? $salaries['Conveyance'] : '' }}">
                                <input type="hidden" class="form-control" id="conveyance" value="8">
                            </div>
                            <div class="form-group">
                                <label>Others </label>
                                <input type="text" class="form-control" id="others1" disabled value="{{ isset($salaries['Others']) ? $salaries['Others'] : '' }}">
                                <input type="hidden" class="form-control" id="others" value="5">
                            </div>

                            <script>
                                const grossInput = document.getElementById('gross');
                                const basic = document.getElementById('basic1');
                                const houseRent = document.getElementById('houseRent1');
                                const medical = document.getElementById('medical1');
                                const conveyance = document.getElementById('conveyance1');
                                const others = document.getElementById('others1');

                                function calculateSalary() {
                                    const gross = parseFloat(grossInput.value) || 0;
                                    basic.value = (gross * 0.50).toFixed();
                                    houseRent.value = (gross * 0.28).toFixed();
                                    medical.value = (gross * 0.09).toFixed();
                                    conveyance.value = (gross * 0.08).toFixed();
                                    others.value = (gross * 0.05).toFixed();
                                }

                                grossInput.addEventListener('input', calculateSalary);
                                
                                // Calculate on page load if gross value exists
                                if (grossInput.value) {
                                    calculateSalary();
                                }
                            </script>
                        </form>
                    </div>
                </div>

                <div class="action-buttons">
                    <button class="btn btn-success" id="updateData">Update</button>
                    <a href="/salary-slab" class="btn btn-danger">Close</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('#branch').on('change', function() {
        var branch_id = $(this).val();
        $('#employeeId').val('').trigger('change');
        HandleBranchWiseEmployees(branch_id, '#employeeId', true);
    });

    // Load employees for the selected branch on page load
    var branch_id = $('#branch').val();
    if (branch_id) {
        HandleBranchWiseEmployees(branch_id, '#employeeId', true);
    }

    $('#employeeId').on('change', function() {
        var employeeCode = $(this).val();
        if (!employeeCode) return;
        
        // Get user_id from employee_code via profile table
        $.ajax({
            url: '/get-user-by-employee-code',
            type: "POST",
            data: { 
                _token: '{{ csrf_token() }}',
                employee_code: employeeCode
            },
            dataType: "json",
            success: function(userData) {
                if (userData && userData.id) {
                    $('#userId').val(userData.id);
                    // Now fetch employee details using user_id
                    $.ajax({
                        url: '/get-employee-details/' + userData.id,
                        type: "POST",
                        data: { 
                            _token: '{{ csrf_token() }}',
                            id: userData.id
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#name').val(data.first_name || '');
                                $('#designation').val(data.designation || '');
                                $('#date_of_joining').val(data.date_of_joining || '');
                                $('#category').val(data.category || '');
                            }
                        },
                        error: function() {
                            console.log('Error fetching employee details');
                        }
                    });
                }
            },
            error: function() {
                console.log('Error fetching user by employee code');
            }
        });
    });

    // Update Data
    $('#updateData').on('click', function(e) {
        e.preventDefault();
        $('#updateData').attr('disabled', true).text('Updating...');


        if (!$('#effectiveDate').val()) {
            $('#updateData').attr('disabled', false).text('Update');
            return toastr.error('Please select an effective date.');
        }
        if (!$('#gross').val()) {
            $('#updateData').attr('disabled', false).text('Update');
            return toastr.error('Please enter a gross amount.');
        }

        const formData = {
            slab_id: $('#slab_id').val(),
            branch: $('#branch').val(),
            employeeId: $('#userId').val(), // Use user_id for backend
            employeeCode: $('#employeeId').val(), // Keep employee_code for reference
            effectiveDate: $('#effectiveDate').val(),
            gross: $('#gross').val(),
            basic: $('#basic').val(),
            house_rent: $('#houseRent').val(),
            medical: $('#medical').val(),
            conveyance: $('#conveyance').val(),
            others: $('#others').val(),
            _token: '{{ csrf_token() }}'
        };
        
        $.ajax({
            url: '/salary-slab-update',
            type: "POST",
            dataType: "json",
            data: formData,
            success: function(data) {
                $('#updateData').attr('disabled', false).text('Update');
                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Success!',
                        text: data.message || 'Salary slab updated successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '/salary-slab';
                    });
                } else {
                    toastr.error(data.message || 'Update failed.');
                }
            },
            error: function(xhr) {
                $('#updateData').attr('disabled', false).text('Update');
                var errorMsg = 'Update failed.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                toastr.error(errorMsg);
            }
        });
    });
});
</script>
@stop

