@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Cost Unit Set Panel</li>
    </ul>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box-info full" style="padding-bottom:20px">
                <h2 class="text-center"><strong>Cost Unit Set Panel</strong></h2>
                 <div class="container">
                    <!-- Entry Panel -->
                    <div class="panel-section">
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="group">Group</label>
                                        <select class="form-control" id="group">
                                            <option value="">Select</option>
                                            @foreach ($groups as $g)
                                                <option value="{{ $g->id }}" selected>{{ $g->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="branch">Branch</label>
                                        <select class="form-control" id="branch">
                                            <option value="">Select</option>
                                            @foreach ($branches as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <select class="form-control" id="department">
                                            <option value="">Select</option>
                                            @foreach ($departments as $d)
                                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Designation</label>
                                        <select class="form-control" id="designation">
                                            <option value="">Select</option>
                                            @foreach ($designation as $d)   
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
                                        <label for="employeeId">Employee ID</label>
                                        <select class="form-control" id="employeeId">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <input type="text" class="form-control" id="designation_name" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    {{-- <div class="form-group">
                                        <label for="entryDate">Entry Date</label>
                                        <input type="date" class="form-control" id="entryDate" value="{{ date('Y-m-d') }}">
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="effectiveDate">Effective Date</label>
                                        <input type="date" class="form-control" id="effectiveDate">
                                    </div>
                                    <div class="form-group">
                                        <label for="costUnit">Cost Unit</label>
                                        <select class="form-control" id="costUnit">
                                            <option value="">Select</option>
                                            @foreach ($tax_cost_unit_type as $bt)
                                                <option value="{{ $bt->id }}">{{ $bt->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="remarks">Remarks </label>
                                        <input type="text" class="form-control" id="remarks">
                                    </div>
                                </div>
                            </div>
                            <div class="action-buttons">
                                <button type="button" id="save" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-danger" onclick="window.location.reload();">Close</button>
                            </div>
                        </form>
                    </div>

                    <table class="table table-bordered table-striped" id="datatable" style="width: 100%; margin-top: 20px; display: none">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Branch</th>
                                <th>Cost Unit</th>
                                <th>Effective Date</th>
                                <th>Date</th> 
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
@stop

@section('javascript')
<script>
    $(document).ready(function() {
        $('#branch').on('change', function() {
            var branch_id = $(this).val();
            $('#employeeId').val('').trigger('change');
            HandleBranchWiseEmployees(branch_id, '#employeeId');
        });
        // Employee Details
        $('#employeeId').on('change', function() {
            var employee_id = $(this).val();
            $.ajax({
                url: '/get-employee-details/' + employee_id,
                type: "POST",
                dataType: "json",
                success: function(data) {
                    $('#name').val(data.first_name);
                    $('#designation_name').val(data.designation);
                }
            })
        });

        // Save form data
        $('#save').on('click', function(e) {
            $('#save').prop('disabled', true);
            $('#save').text('Saving...');
            e.preventDefault();
            var formData = {
                branch: $('#branch').val(),
                department: $('#department').val(),
                designation: $('#designation').val(),
                section: $('#section').val(),
                employeeId: $('#employeeId').val(),
                effectiveDate: $('#effectiveDate').val(),
                costUnit: $('#costUnit').val(),
                remarks: $('#remarks').val()
            };
            $.ajax({
                url: '/cost-unit-set-panel',
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
            })
        });

        // Load existing data
        function loadExistingData(response) {
            $('#datatable').show();
            const data = response.data;
            $('#tbody').append(`
                <tr>
                    <td>${data.ID}</td>
                    <td>${data.first_name}</td>
                    <td>${data.branch}</td>
                    <td>${data.cost_unit_type}</td>
                    <td>${data.effective_date}</td>
                    <td>${data.created_at}</td>
                    <td>${data.remarks}</td>
                </tr>
            `);
        }
    });
</script>
@stop