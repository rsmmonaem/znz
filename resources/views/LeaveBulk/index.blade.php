@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Leave Create</li>
    </ul>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <h2>Leave Create</h2>
                {{-- Form Container --}}
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6" style="margin: 0 auto">
                        <form method="POST" action="#" id="leaveForm">
                            {{ csrf_field() }}
                            @include('common.group')
                            @include('common.finacial_year')
                            @foreach ($levaeType as $type)
                                <div class="form-group">
                                    <label>{{ $type->name }}</label>
                                    <input type="number" name="leave[{{ $type->id }}]" id="leave_{{ $type->id }}"
                                        class="form-control" value="0" min="0" required>
                                </div>
                            @endforeach
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="save">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <h2>Leave List</h2>
                <div class="table-responsive">
                    <table class="table table-hover" id="leave-table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Financial Year</th>
                                @foreach ($levaeType as $type)
                                    <th>{{ $type->name }}</th>
                                @endforeach
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="leave-list">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            fetchLeaveData();
            $('#save').on('click', function(e) {
                e.preventDefault();

                // Collect form data
                var formData = {
                    group: $('#group').val(),
                    financial_year: $('#financial_year').val(),
                    leave: {} // To store the leave type data
                };

                @foreach ($levaeType as $type)
                    formData.leave[{{ $type->id }}] = $('#leave_{{ $type->id }}').val();
                @endforeach

                // Send the data via AJAX
                $.ajax({
                    url: '/LeaveBulk', // Update with the correct URL
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        toastr.success('Leave data saved successfully.');
                        fetchLeaveData();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error saving leave data:", error);
                        toastr.error("Failed to save leave data. Please try again.");
                    }
                });
            });

            // Fetch leave data and populate the table
            function fetchLeaveData() {
                $.ajax({
                    url: '/LeaveBulk-show', // Update with the correct URL
                    type: 'GET',
                    success: function(response) {
                        // Check if the data exists and is in the expected format
                        if (!response.data) {
                            console.error('Invalid data structure:', response);
                            toastr.error('Failed to load leave data. Please try again.');
                            return;
                        }

                        var leaveData = response.data;
                        var tableBody = $('#leave-list');
                        tableBody.empty(); 
                        var i = 1;
                        leaveData.forEach(function(data) {
                            var row = $('<tr>');
                            row.append('<td>' +  i++ + '</td>');
                            row.append('<td>' + data.financial_year + '</td>');
                            var leaveCountsArray = data.leave_counts.split(',');
                            leaveCountsArray.forEach(function(leaveCount) {
                                row.append('<td>' + leaveCount + '</td>');
                            });
                            row.append('<td><button class="btn btn-xs btn-warning btn-edit" data-id="' + data.financial_year + '"><i class="fa fa-edit"></i></button> <button class="btn btn-xs btn-danger btn-delete" data-id="' + data.financial_year + '"><i class="fa fa-trash"></i></button></td>');

                            tableBody.append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching leave data:", error);
                        toastr.error("Failed to load leave data. Please try again.");
                    }
                });
            }

            // Handle edit button click
            $(document).on('click', '.btn-edit', function() {
                var id = $(this).data('id');
                // Redirect to the edit page with the leave ID
                window.location.href = '/LeaveBulk/' + id + '/edit';
            });

            // Handle delete button click
            $(document).on('click', '.btn-delete', function() {
                confirm('Are you sure you want to delete this leave data?');
                var financialYear = $(this).data('id');
                // Redirect to the delete page with the financial year
                $.ajax({
                    url: '/LeaveBulk-delete',
                    type: 'POST',
                    data: {
                        financial_year: financialYear
                    },
                    success: function(response) {
                        toastr.success(response.message || 'Data deleted successfully.');
                        fetchLeaveData(); // Refresh the data after successful deletion
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        toastr.error('Something went wrong. Please try again.');
                    }
                })
            })


        });
    </script>
@stop
