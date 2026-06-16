@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">ID Card Checklist</li>
    </ul>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" id="id_card_checklist">
                <div class="panel-heading text-center">
                    <h2 class="panel-title">ID Card Checklist</h2>
                </div>
                <div class="panel-body">
                    <div class="container">
                        <!-- Header -->
                        <div class="header">
                            <p>Date: {{ date('d-m-Y') }}</p>
                        </div>

                        <form id="filterForm" method="GET" action="{{ route('id-card-checklist.index') }}">
                            <!-- Filters -->
                            <div class="row" style="margin-bottom: 20px; background:rgba(255,255,255,0.8); backdrop-filter:blur(5px); border-radius:8px; padding:10px;">
                                <div class="col-md-4">
                                    <label>Filter by Branch:</label>
                                    <select id="branchFilter" name="branch_id" class="form-control">
                                        <option value="">All Branches</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Filter by Employee:</label>
                                    <select id="employeeFilter" name="employee_id" class="form-control" disabled>
                                        <option value="">All Employees</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Table -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Branch</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Department</th>
                                        <th>Section</th>
                                        <th>Check Box</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($id_card_checklist as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->branch_name }}</td>
                                            <td>{{ $item->employee_code }}</td>
                                            <td>{{ $item->first_name }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->department_name }}</td>
                                            <td>{{ $item->section_name }}</td>
                                            <td><input type="checkbox" data-id="{{ $item->id }}" name="check"
                                                    {{ $item->status == 1 ? 'checked' : '' }}></td>
                                            <td class="remarks">{{ $item->remarks }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">No data found!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="pagination" style="display: flex; justify-content: end;">
                                {{ $id_card_checklist->links() }}
                            </div>
                        </form>

                        <!-- Buttons -->
                        <div class="text-center">
                            <button class="btn btn-primary" id="save">Save</button>
                            <button class="btn btn-default" id="close">Close</button>
                        </div>

                        <!-- Instructions -->
                        <div class="instructions" style="margin-top: 30px;">
                            <p>ID card provide check panel. When a new joiner is added, their ID appears here. After
                                completing the task, click the checkbox and save. This marks the ID card as provided.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#close').on('click', function() {
                window.location.reload();
            });
            $('#save').on('click', function(e) {
                e.preventDefault();
                $(this).attr('disabled', true);
                $(this).text('Saving...');
                var data = [];

                // Iterate through all checkboxes
                $('input[name="check"]:checked').each(function() {
                    var id = $(this).data('id');
                    var status = 1; // Since it's checked, set the status to 1
                    data.push({
                        id: id,
                        status: status
                    });
                });

                // If there are no checked boxes, do not send data
                if (data.length > 0) {
                    $.ajax({
                        url: '/id-card-checklist',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            data: data
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                toastr.success(response.message);
                                 $('input[name="check"]:checked').each(function() {
                                    $(this).closest('tr').find('.remarks').text('ID Card Provided');
                                });
                                $('#save').attr('disabled', false);
                                $('#save').text('Save');
                            } else {
                                toastr.error(response.message);
                            }
                        }
                    });
                } else {
                    toastr.warning("No checked rows to save.");
                }
            });
            // Branch filter change
            $('#branchFilter').on('change', function() {
                var branchId = $(this).val();
                // Reset employee dropdown
                $('#employeeFilter').prop('disabled', true).empty().append('<option value="">All Employees</option>');
                if (branchId) {
                    $.ajax({
                        url: '/branch-employees',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            branch_id: branchId
                        },
                        success: function(data) {
                            $.each(data, function(i, emp) {
                                $('#employeeFilter').append('<option value="' + emp.id + '">' + emp.employee_name + ' (' + emp.employee_code + ')' + '</option>');
                            });
                            $('#employeeFilter').prop('disabled', false);
                        }
                    });
                }
                // Submit form to refresh table based on selected branch
                $('#filterForm').submit();
            });

            // Employee filter change (optional)
            $('#employeeFilter').on('change', function() {
                $('#filterForm').submit();
            });

        });
    </script>
@stop
