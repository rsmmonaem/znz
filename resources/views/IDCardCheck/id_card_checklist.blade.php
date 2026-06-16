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
                        <!-- Filters -->
                        <div class="row" style="margin-bottom: 20px;">
                            <div class="col-md-4">
                                <label>Filter by Branch:</label>
                                <select id="branchFilter" class="form-control">
                                    <option value="">All Branches</option>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Filter by Employee:</label>
                                <select id="employeeFilter" class="form-control" disabled>
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
                        // Load employees when branch changes
            $('#branchFilter').on('change', function() {
                var branchId = $(this).val();
                // Reset employee filter
                $('#employeeFilter').empty().append('<option value="">All Employees</option>').prop('disabled', true);
                if (branchId) {
                    $.ajax({
                        url: '/branch-employees',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '{{ csrf_token() }}',
                            branch_id: branchId
                        },
                        success: function(response) {
                            console.log('Branch employees response:', response);
                            // Normalize response to array of employees
                            var employees = Array.isArray(response) ? response : (response.data || []);
                            console.log('Parsed employees:', employees);
                            $.each(employees, function(index, employee) {
                                $('#employeeFilter').append('<option value="' + employee.id + '">' + employee.employee_name + '</option>');
                            });
                            $('#employeeFilter').prop('disabled', false);
                        },
                        error: function() {
                            console.error('Failed to load employees');
                        }
                    });
                }
                filterTable();
            });

            // Filter when employee selection changes or branch changes
            $('#employeeFilter').on('change', function() {
                filterTable();
            });

            function filterTable() {
                var selectedBranch = $('#branchFilter').val().toLowerCase();
                var selectedEmployee = $('#employeeFilter').val().toLowerCase();
                $('table.table tbody tr').each(function() {
                    var rowBranch = $(this).find('td:nth-child(2)').text().toLowerCase();
                    var rowEmployee = $(this).find('td:nth-child(4)').text().toLowerCase();
                    var branchMatch = !selectedBranch || rowBranch.includes(selectedBranch);
                    var employeeMatch = !selectedEmployee || rowEmployee.includes(selectedEmployee);
                    $(this).toggle(branchMatch && employeeMatch);
                });
            }

            $('#close').on('click', function() {
                window.location.reload();
            });

            $('#save').on('click', function(e) {
                e.preventDefault();
                $(this).attr('disabled', true);
                $(this).text('Saving...');
                var data = [];

                // Iterate through all checkboxes (both checked and unchecked)
                $('input[name="check"]').each(function() {
                    var id = $(this).data('id');
                    var status = $(this).is(':checked') ? 1 : 0; // 1 if checked, 0 otherwise
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
        });
    </script>
@stop
