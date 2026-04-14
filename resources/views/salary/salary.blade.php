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
        margin-bottom: 10px;
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

    #saveData {
        display: none;
    }

    /* hide initially */
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="box-info">
            <div class="container">
                <h2 class="text-center">Salary Bank Panel</h2>

                <!-- Entry Panel -->
                <div class="panel-section">
                    <form id="bankForm">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Group</label>
                                    <select class="form-control" id="group">
                                        <option value="">Select</option>
                                        @foreach ($group as $g)
                                            <option value="{{ $g->id }}">{{ $g->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Branch <span class="text-danger">*</span></label>
                                    <select class="form-control" id="branch">
                                        <option value="">Select</option>
                                        @foreach ($branch as $b)
                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Department</label>
                                    <select class="form-control" id="department">
                                        <option value="">Select</option>
                                        @foreach ($department as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Section</label>
                                    <select class="form-control" id="section">
                                        <option value="">Select</option>
                                        @foreach ($section as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Employee ID <span class="text-danger">*</span></label>
                                    <select class="form-control" id="employeeId">
                                        <option value="">Select</option>
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
                                    <label>Entry Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="entryDate" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="form-group">
                                    <label>Effective Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="effectiveDate">
                                </div>
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <input type="text" class="form-control" id="remarks">
                                </div>

                                <div class="distribution-section"
                                    style="margin-top: 20px; border-top: 1px solid #eee; pt-10">
                                    <h4>Bank Distributions</h4>
                                    <table class="table table-condensed" id="distribution-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 60%;">Bank</th>
                                                <th style="width: 30%;">Amount</th>
                                                <th style="width: 10%;"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="distribution-tbody">
                                            <tr class="dist-row">
                                                <td>
                                                    <select class="form-control dist-bank">
                                                        <option value="">Select Bank</option>
                                                        @foreach($companyBanks as $bank)
                                                            <option value="{{ $bank->id }}">{{ $bank->bank_name }}
                                                                ({{ $bank->account_number }})</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control dist-amount"
                                                        placeholder="Amount">
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-danger btn-xs remove-dist-row"><i
                                                            class="fa fa-times"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-info btn-xs" id="add-dist-row"><i
                                            class="fa fa-plus"></i> Add Bank</button>

                                    <div
                                        style="margin-top: 15px; background: #f9f9f9; padding: 10px; border-radius: 4px;">
                                        <div class="row">
                                            <div class="col-xs-6 text-right"><strong>Total Distributed:</strong></div>
                                            <div class="col-xs-6">
                                                <span id="dist-total-display">0</span>
                                            </div>
                                        </div>
                                        <div class="row"
                                            style="border-top: 1px solid #ccc; margin-top: 5px; padding-top: 5px; font-weight: bold;">
                                            <div class="col-xs-6 text-right"><strong>Cash Remainder:</strong></div>
                                            <div class="col-xs-6"><span id="cash-remainder-display">0</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="action-buttons">
                    <button type="button" class="btn btn-success" id="saveData">Save</button>
                    <button type="button" class="btn btn-danger" id="resetForm">Reset</button>
                </div>
                </form>
            </div>

            <!-- Data Table -->
            <div class="table-container">
                <table class="table table-bordered table-striped" id="datatable">
                    <thead>
                        <tr>
                            <th>Emp ID</th>
                            <th>Effective Date</th>
                            <th>Bank Amount</th>
                            <th>Cash Amount</th>
                            <th>Hold</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody"></tbody>
                </table>
            </div>

        </div>
    </div>
</div>
</div>
@stop


@section('javascript')
<script>
    $(document).ready(function () {

        var dt = $('#datatable').DataTable({
            lengthMenu: [10, 20, 50, 100],
            columnDefs: [{ orderable: false, targets: [4, 6] }]
        });

        LoadBankPart();

        $('#branch').on('change', function () {
            var branch_id = $(this).val();
            $('#employeeId').val('');
            HandleBranchWiseEmployees(branch_id, '#employeeId');
            LoadBankPart();
        });

        $('#employeeId').on('change', function () {
            var employeeId = $(this).val();

            if (employeeId == '') {
                $('#saveData').hide(); // hide save when not selected
                LoadBankPart();
                ClearEmployeeForm();
                return;
            }

            $('#saveData').show(); // show save when selected

            $.ajax({
                url: '/get-user-data-salary',
                type: 'POST',
                data: { employeeId: employeeId, _token: '{{ csrf_token() }}' },
                success: function (res) {
                    $('#name').val(res.first_name);
                    $('#designation').val(res.designation);
                    $('#category').val(res.category);
                    $('#gross').val(res.gross);
                },
                error: function () { ClearEmployeeForm(); }
            });

            LoadBankPart(employeeId);
        });

        // Add/Remove Rows
        $('#add-dist-row').on('click', function () {
            const $tbody = $('#distribution-tbody');
            const $newRow = $tbody.find('tr:first').clone();

            // Clean up Select2 if it was cloned
            $newRow.find('.select2-container').remove();
            $newRow.find('select').show().removeClass('select2-hidden-accessible');

            // Reset values
            $newRow.find('input, select').val('');

            $tbody.append($newRow);

            // Re-initialize Select2 on the new dropdown
            $newRow.find('select').select2();
        });

        $(document).on('click', '.remove-dist-row', function () {
            if ($('#distribution-tbody tr').length > 1) {
                $(this).closest('tr').remove();
                calculateRemaining();
            }
        });



        function calculateRemaining() {
            let totalDistributed = 0;
            $('.dist-amount').each(function () {
                totalDistributed += parseFloat($(this).val()) || 0;
            });

            const gross = parseFloat($('#gross').val()) || 0;
            const remainder = gross - totalDistributed;

            $('#dist-total-display').text(totalDistributed.toLocaleString());
            $('#cash-remainder-display').text(remainder.toLocaleString());

            if (remainder < 0) {
                $('#cash-remainder-display').parent().addClass('text-danger');
            } else {
                $('#cash-remainder-display').parent().removeClass('text-danger');
            }
        }

        $(document).on('input', '.dist-amount', function () {
            calculateRemaining();
        });

        $('#saveData').on('click', function () {
            const self = $(this);
            self.attr('disabled', true).text('Saving...');

            const distributions = [];
            const employeeId = $('#employeeId').val();
            const entryDate = $('#entryDate').val();
            const effectiveDate = $('#effectiveDate').val();
            const gross = $('#gross').val();
            let hasError = false;

            if (!employeeId) return validate('Please select employee');
            if (!entryDate) return validate('Please select entry date');
            if (!effectiveDate) return validate('Please select effective date');

            $('#distribution-tbody .dist-row').each(function () {
                var $row = $(this);
                // Use a more specific selector to avoid any ambiguity
                var bankId = $row.find('select.dist-bank').val();
                var amount = $row.find('input.dist-amount').val();
                
                var hasBank = (bankId !== "" && bankId !== null && bankId !== undefined);
                var hasAmount = (amount !== "" && amount !== null && amount !== undefined);

                // Completely ignore empty rows
                if (!hasBank && !hasAmount) {
                    return true; // continue
                }

                if (hasBank && hasAmount) {
                    distributions.push({ bank_id: bankId, amount: amount });
                } else {
                    // Row is partially filled (e.g. Bank selected but no Amount, or vice-versa)
                    hasError = true;
                }
            });

            if (hasError) return validate('Please complete all distribution rows');

            const totalDistributed = distributions.reduce((sum, d) => sum + parseFloat(d.amount), 0);

            if (totalDistributed > parseFloat(gross)) {
                return validate('Total distributed bank amount (' + totalDistributed + ') cannot exceed Gross Salary (' + gross + ')');
            }

            const FormData = {
                employeeId: employeeId,
                entryDate: entryDate,
                effectiveDate: effectiveDate,
                gross: gross,
                remarks: $('#remarks').val(),
                distributions: distributions
            };

            $.ajax({
                url: '/salary-bank-part-create',
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: FormData,
                success: function (res) {
                    if (res.status == 'success') {
                        LoadBankPart(FormData.employeeId);
                        toastr.success(res.message);

                        // Reset distributions
                        $('#distribution-tbody').find('tr:not(:first)').remove();
                        $('#distribution-tbody').find('input, select').val('');
                        calculateRemaining();

                        // Reset other fields
                        $('#effectiveDate, #remarks').val('');
                    } else {
                        toastr.error(res.message || 'Error occurred');
                    }
                    self.attr('disabled', false).text('Save');
                },
                error: function (xhr) {
                    self.attr('disabled', false).text('Save');
                    toastr.error(xhr.responseJSON?.message || 'Data save failed.');
                }
            });
        });

        $('#resetForm').on('click', function () {
            $('#bankForm').find('input[type="text"], input[type="date"], select').not('#entryDate').val('');
            $('#entryDate').val('{{ date('Y-m-d') }}');
            $('#saveData').hide();
        });

        function validate(msg) {
            toastr.error(msg);
            $('#saveData').attr('disabled', false).text('Save');
            return false;
        }

        function ClearEmployeeForm() {
            $('#name,#designation,#category,#gross').val('');
        }

        function LoadBankPart(employeeId = '') {
            $.ajax({
                url: '/GetBankPart',
                type: 'GET',
                data: { employeeId: employeeId },
                success: function (res) {
                    dt.clear();
                    if (!Array.isArray(res) || res.length == 0) {
                        dt.row.add(['No data found', '', '', '', '', '', '']).draw();
                    } else {
                        res.forEach(function (item) {
                            dt.row.add([
                                item.employee_code,
                                item.effective_date,
                                `${item.bank_amount} (${item.company_bank_name || 'N/A'})`,
                                item.cash_amount,
                                `<input type="checkbox" data-id="${item.id}" class="status" ${item.status == 1 ? 'checked' : ''}>`,
                                item.status == 0 ? 'false' : 'true',
                                `<a href="/edit-bank-part/${item.id}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                             <button class="btn btn-xs btn-danger delete-btn" data-id="${item.id}"><i class="fa fa-trash"></i> Delete</button>`
                            ]);
                        });
                        dt.draw();
                    }
                },
                error: function (xhr) {
                    dt.clear();
                    var msg = xhr.responseJSON ? xhr.responseJSON.error : 'Failed to load data';
                    dt.row.add([msg, '', '', '', '', '', '']).draw();
                    console.error('GetBankPart error:', msg);
                }
            });
        }

        $(document).on('click', '.delete-btn', function () {
            var id = $(this).data('id');

            // SweetAlert or default confirm
            if (confirm('Are you sure you want to delete this record?')) {
                $.ajax({
                    url: '/delete-bank-part/' + id,
                    type: 'GET',
                    success: function (res) {
                        toastr.success(res.message || 'Record deleted successfully.');
                        var employeeId = $('#employeeId').val();
                        LoadBankPart(employeeId);
                    },
                    error: function () {
                        toastr.error('Delete failed');
                    }
                });
            } else {
                toastr.info('Delete canceled');
            }
        });

        $(document).on('change', '.status', function () {
            var id = $(this).data('id');
            var status = $(this).is(':checked') ? 1 : 0;
            $.ajax({
                url: '/updatebank-status',
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: { id: id, status: status },
                success: function (res) {
                    var employeeId = $('#employeeId').val();
                    LoadBankPart(employeeId);
                    toastr.success(res.message || 'Status updated successfully.');
                },
                error: function () { toastr.error('Failed to update status.'); }
            });
        });

    });
</script>
@stop