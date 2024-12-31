@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Leave Edit</li>
    </ul>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <h2>Leave Edit</h2>
                {{-- Form Container --}}
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6" style="margin: 0 auto">
                        <form method="POST" action="#" id="leaveForm">
                            {{ csrf_field() }}
                            @include('common.group')
                            <div class="form-group">
                                <label>Financial Year</label>
                                <select class="form-control" name="financial_year" id="financial_year">
                                    <option value="">Select Year</option>
                                    @for ($i = 2030; $i >= date('Y') - 10; $i--)
                                        <option value="{{ $i }}" {{ $i == $financialYear ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            @foreach ($levaeType as $type)
                                <div class="form-group">
                                    <label>{{ $type->name }}</label>
                                    @php
                                        $index = array_search($type->id, $leaveTypesArray);
                                    @endphp
                                    <input type="number" name="leave[{{ $type->id }}]" id="leave_{{ $type->id }}"
                                        class="form-control" value="{{ $index !== false ? $leaveCountsArray[$index] : 0 }}"
                                        min="0" required>
                                </div>
                            @endforeach
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="save">Update Leave</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#save').on('click', function(e) {
                e.preventDefault();

                // Collect form data
                var formData = {
                    group: $('#group').val(),
                    financial_year: $('#financial_year').val(),
                    leave: {} // To store the leave type data
                };

                // Collect the leave type data
                @foreach ($levaeType as $type)
                    formData.leave[{{ $type->id }}] = $('#leave_{{ $type->id }}').val();
                @endforeach

                // Send the data via AJAX
                $.ajax({
                    url: '/LeaveBulk-update', // Update with the correct URL
                    type: 'POST',
                    contentType: 'application/json', // Ensures the server expects JSON
                    data: JSON.stringify(formData), // Send data as JSON
                    success: function(response) {
                        toastr.success('Leave data saved successfully.');
                        fetchLeaveData(); // Refresh the leave data on success
                    },
                    error: function(xhr, status, error) {
                        console.error("Error saving leave data:", error);
                        toastr.error("Failed to save leave data. Please try again.");
                    }
                });
            });
        })
    </script>
@stop
