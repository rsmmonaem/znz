@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Month Challan Set Panel</li>
    </ul>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box-info full" style="padding-bottom:20px">
                <h2 class="text-center"><strong>Month Challan Set Panel</strong></h2>
                 <div class="container">
                    <!-- Entry Panel -->
                    <div class="panel-section">
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="unitname">Cost Unit Name</label>
                                        <select class="form-control" id="unitname">
                                            <option value="">Select</option>
                                             @foreach ($costUnitName as $cun)
                                                 <option value="{{ $cun->id }}">{{ $cun->name }}</option>
                                             @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="financialyear">Financial Year</label>
                                        <select class="form-control" id="financialyear">
                                            <option value="">Select</option>
                                            @foreach ($finacialyear as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="taxfinancialyear">Tax Financial Year</label>
                                        <select class="form-control" id="taxfinancialyear">
                                            <option value="">Select</option>
                                          @foreach ($taxFinacialyear as $tyear)
                                             <option value="{{ $tyear }}">{{ $tyear }}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="bankname">Bank Name</label>
                                        <select class="form-control" id="bankname">
                                            <option value="">Select</option>
                                            @foreach ($taxBank as $tb)
                                               <option value="{{ $tb->id }}">{{ $tb->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="bankbranch">Bank Branch</label>
                                        <select class="form-control" id="bankbranch">
                                            <option value="">Select</option>
                                            {{-- @foreach ($taxBank as $tb)
                                               <option value="{{ $tb->id }}">{{ $tb->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>

                                    <div class="form-group">
                                      <label for="employee_id">Employee ID</label>
                                        <select class="form-control" id="employee_id" name="employee_id" multiple>
                                            {{-- <option value="">Select</option> --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="challan_no">Challan No </label>
                                        <input type="text" class="form-control" id="challan_no">
                                    </div>
                                    <div class="form-group">
                                        <label for="challan_amount">Challan Amount </label>
                                        <input type="text" class="form-control" id="challan_amount">
                                    </div>

                                    <div class="form-group">
                                        <label for="paymentdate">Payment Date</label>
                                        <input type="date" class="form-control" id="paymentdate">
                                    </div>

                                    <div class="form-group">
                                        <label for="remarks">Month </label>
                                        <select class="form-control" name="month" id="month">
                                            <option value="">Select Month</option>
                                            @for ($month = 1; $month <= 12; $month++)
                                            <option value="{{ $month }}" {{ $month == date('m') ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $month, 10)) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="action-buttons">
                                <button type="button" id="save" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-danger" onclick="window.location.reload();">Close</button>
                            </div>
                        </form>
                    </div>

                    <div class="panel-section" style="margin-top:30px">
                        <div class="table-responsive">
                            <table data-sortable class="table show-table table-hover table-striped"
                            id="data-table">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Cost Unit Name</th>
                                        <th>Tax Financial Year</th>
                                        <th>Financial Year</th>
                                        <th>Month</th>
                                        <th>Challan No</th>
                                        <th>Payment Date</th>
                                        <th>Bank Name</th>
                                        <th>Bank Branch</th>
                                        <th>Challan Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <!-- Rows will go here -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
<script>
    $(document).ready(function() {
        $('#unitname').on('change', function(){
            let employee_id = '#employee_id';
            $(employee_id).val('').trigger('change');
            const id = $(this).val();
            $.ajax({
                url: '/GetCostUnitEmployee/' + id,
                type: "get",
                dataType: "json",
                success: function(data) {
                    // Loop through each employee and append them to the dropdown
                    data.forEach(function(employee) {
                        $(employee_id).append($('<option>', {
                            value: employee.id, // The unique identifier for the employee
                            text: employee.employee_code + ' - ' + employee.name // The display text combining code and name
                        }));
                    });
                }
            })
        });

        $('#bankname').on('change', function(){
            const id = $(this).val();
            $('#bankbranch').empty();
            $('#bankbranch').val('').trigger('change');
            $.ajax({
                url: '/GetBankBranch/' + id,
                type: "get",
                dataType: "json",
                success: function(data) {
                    // Add a default option to the dropdown
                    $('#bankbranch').append($('<option>', {
                        value: '', 
                        text: 'Select Employee' 
                    }));
                    data.forEach(function(employee) {
                        $('#bankbranch').append($('<option>', {
                            value: employee.id, 
                            text: employee.name
                        }));
                    });
                }
            })
        });
        
        $('#save').on('click', function(e) {
            $('#save').prop('disabled', true);
            $('#save').text('Saving...');
            e.preventDefault();
            var formData = {
                unitname: $('#unitname').val(),
                financialyear: $('#financialyear').val(),
                taxfinancialyear: $('#taxfinancialyear').val(),
                bankname: $('#bankname').val(),
                bankbranch: $('#bankbranch').val(),
                employee_id: $('#employee_id').val(),
                challan_no: $('#challan_no').val(),
                challan_amount: $('#challan_amount').val(),
                paymentdate: $('#paymentdate').val(),
                month: $('#month').val(),
            };
            $.ajax({
                url: '/month-wise-challan-set-panel',
                type: "POST",
                dataType: "json",
                data: formData,
                success: function(data) {
                    toastr.success(data.message);
                    $('#save').prop('disabled', false);
                    $('#save').text('Save');
                    loadExistingData(data)
                },
                error: function(xhr, status, error) {
                    console.error("Error saving leave data:", error);
                    toastr.error("Failed to save leave data. Please try again.");
                    $('#save').prop('disabled', false);
                    $('#save').text('Save');
                }
            });
        });
        loadExistingData();
        function loadExistingData(data) {
            $.ajax({
                url: '/month-wise-challan-set-panel-get-data',
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#tbody').empty();
                    data.forEach(function(item) {
                        var row = '<tr>';
                        row += '<td><button type="button" class="btn btn-primary btn-xs edit-challan" data-id="' + item.id + '"><i class="fa fa-pencil"></i></button><button type="button" class="btn btn-danger btn-xs delete_challan" data-id="' + item.id + '"><i class="fa fa-trash"></i></button></td>';
                        row += '<td>' + item.unitname + '</td>';
                        row += '<td>' + item.taxfinancialyear + '</td>';
                        row += '<td>' + item.financialyear + '</td>';
                        row += '<td>' + getMonthName(item.month) + '</td>';
                        row += '<td>' + item.challan_no + '</td>';
                        row += '<td>' + item.paymentdate + '</td>';
                        row += '<td>' + item.bankname + '</td>';
                        row += '<td>' + item.bankbranchname + '</td>';
                        row += '<td>' + item.challan_amount + '</td>';
                        row += '</tr>';
                        $('#tbody').append(row);
                    });
                    if ($.fn.DataTable.isDataTable('#data-table')) {
                        $('#data-table').DataTable().destroy();
                    }
                    $('#data-table').DataTable({
                        "paging": true,          // Enable pagination
                        "searching": true,       // Enable searching
                        "ordering": true,        // Enable column sorting
                        "info": true,            // Show information about the table
                        "responsive": true       // Make table responsive
                    });

                    function getMonthName(monthDigit) {
                        const months = [
                            'January', 'February', 'March', 'April', 'May', 'June',
                            'July', 'August', 'September', 'October', 'November', 'December'
                        ];

                        // Subtract 1 because month digits are 1-based and array is 0-based
                        return months[monthDigit - 1] || 'Invalid Month';
                    }
                }
            })
        }

        $(document).on('click', '.delete_challan', function() {
            const id = $(this).data('id'); 
            delete_challan(id);
            loadExistingData();
        });
        function delete_challan(id) {
            if (confirm('Are you sure you want to delete this record?')) {
                // Send AJAX request to delete the record
                $.ajax({
                    url: '/month-wise-challan-delete',  // URL for deletion
                    type: 'POST',
                    data: {
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content')  // CSRF Token for security
                    },
                    success: function(response) {
                        toastr.success(response.message || 'Data deleted successfully.');
                        loadExistingData();  // Reload the data after successful deletion
                        window.location.reload();
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        toastr.error('Something went wrong. Please try again.');
                    }
                });
            }
        }
    //    $('.delete_challan').on('click', function() {
    //         var id = $(this).data('id');
    //         console.log(id);
    //         // Ask for confirmation before deleting
            
    //     });

    });
</script>
@stop