@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.Salary_BankPart') !!}</li>
    </ul>
@stop

@section('content')
    <style>
        .panel-section {
            margin: 20px 0;
        }

        .form-group {
            display: flex;
            align-items: center;
        }

        .form-group label {
            width: 150px;
            margin-right: 10px;
        }

        .form-group input,
        .form-group select {
            flex: 1;
        }

        .action-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .table-container {
            margin-top: 30px;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="container">
                    <h2 class="text-center">Salary Bank Panel</h2>
                    <!-- Entry Panel -->
                    <div class="panel-section">
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="group">Group</label>
                                        <select class="form-control" id="group">
                                            <option value="">Select</option>
                                            @foreach ($group as $g)
                                                <option value="{{ $g->id }}" selected>{{ $g->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="branch">Branch <span class="text-danger">*</span></label>
                                        <select class="form-control" id="branch">
                                            <option value="">Select</option>
                                            @foreach ($branch as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <select class="form-control" id="department">
                                            <option value="">Select</option>
                                            @foreach ($department as $d)
                                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="section">Section</label>
                                        <select class="form-control" id="section">
                                            <option value="">Select</option>
                                            @foreach ($section as $s)
                                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="employeeId">Employee ID <span class="text-danger">*</span></label>
                                        <select class="form-control" style="width: 100%" id="employeeId">
                                            <option value="">Select</option>
                                            {{-- @foreach ($employee as $e)
                                                <option value="{{ $e->id }}">{{ $e->first_name }} -
                                                    {{ $e->employee_code }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" id="name" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <input type="text" class="form-control" id="designation" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <input type="text" class="form-control" id="category" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Gross</label>
                                        <input type="text" class="form-control" id="gross" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="entryDate">Entry Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="entryDate" value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="effectiveDate">Effective Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="effectiveDate">
                                    </div>
                                    <div class="form-group">
                                        <label for="bankAmount">Bank Amount<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="bankAmount">
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="bankAmount">Cash Amount</label>
                                        <input type="text" class="form-control" id="cahsAmount" readonly>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="remarks">Remarks</label>
                                        <input type="text" class="form-control" id="remarks">
                                    </div>
                                </div>
                            </div>
                            <div class="action-buttons">
                                <button type="button" class="btn btn-success" id="saveData">Save</button>
                                <button type="button" class="btn btn-danger">Close</button>
                            </div>
                        </form>
                    </div>

                    <!-- Data Table -->
                    <div class="table-container">
                        <table class="table table-bordered table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <th>Emp ID</th>
                                    <th>Effective Date</th>
                                    <th>Bank Amount</th>
                                    <th>Cash Amount</th>
                                    <th>Hold</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#branch').on('change', function() {
                var branch_id = $(this).val();
                $('#employeeId').val('').trigger('change');
                HandleBranchWiseEmployees(branch_id, '#employeeId');
            });
            GetBankPart()
            $('#employeeId').on('change', function() {
                var employeeId = $(this).val();
                $.ajax({
                    url: '/get-user-data-salary',
                    type: 'POST',
                    data: {
                        employeeId: employeeId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#name').val(response.first_name);
                        $('#designation').val(response.designation);
                        $('#category').val(response.category);
                        $('#gross').val(response.gross);
                    },
                    error: function() {
                        console.log('error');
                    }
                });
            })
             function validate(data) {
                toastr.error(data);
                $('#saveData').attr('disabled', false);
                $('#saveData').text('Save');
                return false;
            }
            // Save Data
            $('#saveData').on('click', function() {
                $('#saveData').attr('disabled', true);
                $('#saveData').text('Saving...');
                const FormData = {
                    employeeId: $('#employeeId').val(),
                    entryDate: $('#entryDate').val(),
                    effectiveDate: $('#effectiveDate').val(),
                    gross: $('#gross').val(),
                    bankAmount: $('#bankAmount').val(),
                    remarks: $('#remarks').val(),
                };
                if(FormData.employeeId === '') {
                    return validate('Please select employee');
                }
                if(FormData.entryDate === '') {
                    return validate('Please select entry date');
                }
                if(FormData.effectiveDate === '') {
                    return validate('Please select effective date');
                }
                if(FormData.bankAmount === '') {
                    return validate('Please enter bank amount');
                }
                $.ajax({
                    url: '/salary-bank-part-create',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: FormData,
                    success: function(response) {
                        GetBankPart();
                        $('#saveData').attr('disabled', false);
                        $('#saveData').text('Save');
                        console.log(response);
                        toastr.success(response.message || 'Data saved successfully.');
                        // getData();
                    },
                    error: function() {
                        $('#saveData').attr('disabled', false);
                        $('#saveData').text('Save');
                        console.log('error');
                        toastr.error('Data save failed.');
                    }
                });
            })
        })
        function GetBankPart() {
            $.ajax({
                url: '/GetBankPart',
                type: 'GET',
                success: function(response) {
                    const datatable = $('#datatable');
                    datatable.DataTable().destroy();

                    var tableBody = $('#tbody');
                    tableBody.empty();
                    response.forEach(function(item) {
                        var row = `<tr>
                            <td><input type="checkbox"></td>
                            <td>${item.employee_code}</td>
                            <td>${item.effective_date}</td>
                            <td>${item.bank_amount}</td>
                            <td>${item.cash_amount}</td>
                            <td><input type="checkbox" data-id="${item.id}" class="status" ${item.status == 1 ? 'checked' : ' '}></td>
                            <td>${item.status == 0 ? 'false' : 'true'}</td>
                            <td>${item.remarks}</td>`;
                        row += `</tr>`;
                        tableBody.append(row); // Append each row to the table body
                    });

                    // Reinitialize the DataTable after adding new rows
                    datatable.DataTable({
                        lengthMenu: [10, 20, 50, 100],
                    });
                },
                error: function() {
                    console.log('error');
                }
            })
        }

        // Update Status 
      $(document).on('change', '.status', function () {
            var id = $(this).data('id');
            var status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: '/updatebank-status',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    status: status
                },
                success: function (response) {
                    GetBankPart();
                    toastr.success(response.message || 'Status updated successfully.');
                },
                error: function () {
                    toastr.error('Failed to update status.');
                }
            });
        });
    </script>
@stop
