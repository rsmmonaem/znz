@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Company Bank Information</li>
    </ul>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box-info full">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-center">Company Bank Accounts</h2>
                            <p class="text-center text-muted">Manage the company's official bank account details here.</p>
                        </div>
                    </div>

                    <!-- Entry Panel -->
                    <div class="panel panel-default" style="border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-top: 20px;">
                        <div class="panel-heading" style="background-color: #fcfcfc; border-bottom: 1px solid #eee;">
                            <h3 class="panel-title"><i class="fa fa-plus-circle"></i> Add New Bank Account</h3>
                        </div>
                        <div class="panel-body">
                            <form id="bankForm">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bank Name <span class="text-danger">*</span></label>
                                            <input type="text" id="bank_name" class="form-control" placeholder="e.g. City Bank" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Account Name <span class="text-danger">*</span></label>
                                            <input type="text" id="account_name" class="form-control" placeholder="e.g. Tokyo ERP Solutions" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Account Number <span class="text-danger">*</span></label>
                                            <input type="text" id="account_number" class="form-control" placeholder="e.g. 1234567890" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Branch Name</label>
                                            <input type="text" id="branch" class="form-control" placeholder="e.g. Gulshan Branch">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Routing Number</label>
                                            <input type="text" id="routing_number" class="form-control" placeholder="e.g. 123456789">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>SWIFT / BIC Code</label>
                                            <input type="text" id="swift_code" class="form-control" placeholder="e.g. CITYBDDH">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description / Remarks</label>
                                            <textarea id="description" class="form-control" rows="2" placeholder="Any additional details..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="button" id="resetBtn" class="btn btn-default">Reset</button>
                                    <button type="button" id="saveBtn" class="btn btn-primary" style="min-width: 120px;">Save Account</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- List Panel -->
                    <div class="panel panel-default" style="border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-top: 30px;">
                        <div class="panel-heading" style="background-color: #fcfcfc; border-bottom: 1px solid #eee;">
                            <h3 class="panel-title"><i class="fa fa-list"></i> Registered Bank Accounts</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="bankTable" class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Bank Name</th>
                                            <th>Account Detail</th>
                                            <th>Branch & Codes</th>
                                            <th>Status</th>
                                            <th style="width: 120px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data loaded by AJAX -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 10px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Bank Account</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank Name</label>
                                <input type="text" id="edit_bank_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Name</label>
                                <input type="text" id="edit_account_name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Number</label>
                                <input type="text" id="edit_account_number" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Branch Name</label>
                                <input type="text" id="edit_branch" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Routing Number</label>
                                <input type="text" id="edit_routing_number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SWIFT / BIC Code</label>
                                <input type="text" id="edit_swift_code" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="edit_description" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id="updateBtn" class="btn btn-primary">Update Changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            loadBanks();

            function loadBanks() {
                $.get('/company-bank', function(response) {
                    let rows = '';
                    if (response.length === 0) {
                        rows = '<tr><td colspan="5" class="text-center">No bank accounts found.</td></tr>';
                    } else {
                        $.each(response, function(index, bank) {
                            rows += `
                                <tr data-id="${bank.id}">
                                    <td><strong>${bank.bank_name}</strong></td>
                                    <td>
                                        <div>${bank.account_name}</div>
                                        <small class="text-muted">Acc: ${bank.account_number}</small>
                                    </td>
                                    <td>
                                        <div>${bank.branch || 'N/A'}</div>
                                        <small class="text-muted">Routing: ${bank.routing_number || '-'} | SWIFT: ${bank.swift_code || '-'}</small>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="status-toggle" data-id="${bank.id}" ${bank.status == 1 ? 'checked' : ''} data-toggle="toggle" data-size="mini">
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-xs editBtn"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger btn-xs deleteBtn"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            `;
                        });
                    }
                    $('#bankTable tbody').html(rows);
                });
            }

            $('#saveBtn').on('click', function() {
                const data = {
                    bank_name: $('#bank_name').val(),
                    account_name: $('#account_name').val(),
                    account_number: $('#account_number').val(),
                    branch: $('#branch').val(),
                    routing_number: $('#routing_number').val(),
                    swift_code: $('#swift_code').val(),
                    description: $('#description').val(),
                    _token: '{{ csrf_token() }}'
                };

                if (!data.bank_name || !data.account_name || !data.account_number) {
                    toastr.warning('Please fill in all required fields.');
                    return;
                }

                $(this).prop('disabled', true).text('Saving...');

                $.post('/company-bank', data, function(response) {
                    $('#saveBtn').prop('disabled', false).text('Save Account');
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $('#bankForm')[0].reset();
                        loadBanks();
                    } else {
                        toastr.error(response.message);
                    }
                }).fail(function() {
                    $('#saveBtn').prop('disabled', false).text('Save Account');
                    toastr.error('Internal Server Error.');
                });
            });

            $(document).on('click', '.editBtn', function() {
                const row = $(this).closest('tr');
                const id = row.data('id');
                
                $.get('/company-bank', function(response) {
                    const bank = response.find(b => b.id == id);
                    if (bank) {
                        $('#edit_id').val(bank.id);
                        $('#edit_bank_name').val(bank.bank_name);
                        $('#edit_account_name').val(bank.account_name);
                        $('#edit_account_number').val(bank.account_number);
                        $('#edit_branch').val(bank.branch);
                        $('#edit_routing_number').val(bank.routing_number);
                        $('#edit_swift_code').val(bank.swift_code);
                        $('#edit_description').val(bank.description);
                        $('#editModal').modal('show');
                    }
                });
            });

            $('#updateBtn').on('click', function() {
                const id = $('#edit_id').val();
                const data = {
                    bank_name: $('#edit_bank_name').val(),
                    account_name: $('#edit_account_name').val(),
                    account_number: $('#edit_account_number').val(),
                    branch: $('#edit_branch').val(),
                    routing_number: $('#edit_routing_number').val(),
                    swift_code: $('#edit_swift_code').val(),
                    description: $('#edit_description').val(),
                    _token: '{{ csrf_token() }}',
                    _method: 'PUT'
                };

                $(this).prop('disabled', true).text('Updating...');

                $.post('/company-bank/' + id, data, function(response) {
                    $('#updateBtn').prop('disabled', false).text('Update Changes');
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $('#editModal').modal('hide');
                        loadBanks();
                    } else {
                        toastr.error(response.message);
                    }
                });
            });

            $(document).on('click', '.deleteBtn', function() {
                if (confirm('Are you sure you want to delete this bank account?')) {
                    const id = $(this).closest('tr').data('id');
                    $.ajax({
                        url: '/company-bank/' + id,
                        type: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(response) {
                            if (response.status === 'success') {
                                toastr.success(response.message);
                                loadBanks();
                            } else {
                                toastr.error(response.message);
                            }
                        }
                    });
                }
            });

            $(document).on('change', '.status-toggle', function() {
                const id = $(this).data('id');
                const status = $(this).prop('checked') ? 1 : 0;
                $.post('/company-bank-status', {
                    id: id,
                    status: status,
                    _token: '{{ csrf_token() }}'
                }, function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                    }
                });
            });

            $('#resetBtn').on('click', function() {
                $('#bankForm')[0].reset();
            });
        });
    </script>
@endsection
