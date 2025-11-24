@extends('layouts.default')

@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
    <li class="active">Salary Advance</li>
</ul>
@stop

@section('content')
<style>
.form-group label {
    font-weight: bold;
}
.table {
    margin-top: 20px;
}
.dflex {
    display: flex;
    justify-content: space-between;
}
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="box-info">
            <div class="container" style="margin-bottom: 20px">
                <h2 class="text-center">Edit Advance Entry Panel</h2>
                <div class="row">
                    <!-- Left Side -->
                    <div class="col-md-6">
                        <div class="entry-panel">
                            <div class="form-group">
                                <label for="group">Group</label>
                                <select class="form-control" id="group">
                                    <option value="">Select Group</option>
                                    @foreach ($group as $g)
                                        <option value="{{ $g->id }}" selected>{{ $g->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="branch">Branch</label>
                                <input type="text" class="form-control" id="branch" value="" disabled />
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <input type="text" class="form-control" id="department" value="" disabled />
                            </div>
                            <div class="form-group">
                                <label for="section">Section</label>
                                <input type="text" class="form-control" id="section" value="" disabled />
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control" id="designation" value="" disabled />
                            </div>
                            <div class="form-group">
                                <label for="employeeId">Employee ID</label>
                                <select class="form-control select2me" id="employeeId">
                                    <option value="">Select Employee ID</option>
                                    @foreach ($employee as $e)
                                        <option value="{{ $e->id }}" {{ $entry->employeeId == $e->id ? 'selected' : '' }}>
                                            {{ $e->first_name }} - {{ $e->employee_code }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <input type="text" class="form-control" id="category" value="" disabled />
                            </div>

                            <!-- Month Selection -->
                            <div class="form-group">
                                <label for="month">Month</label>
                                <select class="form-control select2me" id="month" multiple>
                                    @for ($month = 1; $month <= 12; $month++)
                                        <option value="{{ $month }}" {{ in_array($month, explode(',', $entry->months)) ? 'selected' : '' }}>
                                            {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Month Amounts -->
                            <div class="form-group">
                                <label>Select Months and Amounts:</label>
                                <div class="row">
                                @php
                                    $selectedMonths = explode(',', $entry->months);
                                    $amountsMap = [];
                                    foreach($salary_advance_data as $data){
                                        $amountsMap[$data->month] = $data->amount;
                                    }
                                @endphp

                                @for ($month = 1; $month <= 12; $month++)
                                    <div class="col-md-4 month-input" data-month="{{ $month }}">
                                        <label>{{ date('F', mktime(0,0,0,$month,1)) }}</label>
                                        <input type="number"
                                               name="months[{{ $month }}]"
                                               class="form-control"
                                               value="{{ isset($amountsMap[$month]) ? $amountsMap[$month] : 0 }}"
                                               min="0"
                                               {{ in_array($month, $selectedMonths) ? '' : 'disabled' }}>
                                    </div>
                                @endfor
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Right Side -->
                    <div class="col-md-6">
                        <div class="entry-panel">
                            <div class="form-group">
                                <label for="effectiveDate">Effective Date</label>
                                <input type="date" class="form-control" id="effectiveDate"
                                    value="{{ $entry->effectiveDate }}" />
                            </div>
                            <div class="form-group radio-group">
                                <label>Gross</label>
                                <div>
                                    <input type="text" class="form-control" name="grossValue"
                                        value="{{ $entry->grossValue }}"
                                        style="display: inline-block; width: auto; margin-left: 10px" />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="action-buttons" style="margin-bottom: 20px">
                    <button type="button" class="btn btn-success" id="updateData">Update</button>
                    <button type="button" class="btn btn-danger">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script>
$(document).ready(function(){

    // Load employee data
    function userData(){
        var UserID = $('#employeeId').val();
        if(!UserID) return;
        $.ajax({
            url:'/UserData',
            type:'POST',
            data:{ employeeId: UserID, _token: '{{ csrf_token() }}' },
            success:function(data){
                $('#branch').val(data.branch);
                $('#department').val(data.department);
                $('#section').val(data.section);
                $('#designation').val(data.designation);
                $('#category').val(data.category);
            }
        });
    }
    userData();
    $('#employeeId').on('change', userData);

    // Month select logic
    $('#month').select2().on('change', function(){
        var selected = $(this).val() || [];
        selected = selected.map(Number);

        $('.month-input').each(function(){
            var month = Number($(this).data('month'));
            var input = $(this).find('input');
            if(selected.indexOf(month) >= 0){
                input.prop('disabled', false);
            } else {
                input.prop('disabled', true);
                input.val(0); // deselected month amount set to 0
            }
        });
    });

    // Update data
    $('#updateData').click(function(){
        $(this).prop('disabled', true).text('Saving...');

        var monthAmounts = {};
        $('input[name^="months["]').each(function(){
            var monthKey = $(this).attr('name').match(/\d+/)[0];
            monthAmounts[monthKey] = $(this).val();
        });

        var formData = {
            employeeId: $('#employeeId').val(),
            effectiveDate: $('#effectiveDate').val(),
            month: $('#month').val(),
            amounts: monthAmounts,
            grossValue: $('input[name="grossValue"]').val(),
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url:'/salary-advance-edit/' + {{ $entry->id }},
            type:'POST',
            data: formData,
            success:function(res){
                $('#updateData').prop('disabled', false).text('Update');
                toastr.success(res.message || 'Data updated successfully.');
            },
            error:function(xhr){
                $('#updateData').prop('disabled', false).text('Update');
                toastr.error('Something went wrong. Please try again.');
            }
        });
    });

});
</script>
@stop
