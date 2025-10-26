@extends('layouts.default')

@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
    <li><a href="/salary-bank-part">{!! trans('messages.Salary_BankPart') !!}</a></li>
    <li class="active">{!! trans('messages.edit') !!}</li>
</ul>
@stop

@section('content')
<style>
    .flex-form-group { display: flex; align-items: center; margin-bottom: 15px; }
    .flex-form-group label { min-width: 120px; margin-right: 10px; font-weight: bold; flex-shrink: 0; }
    .flex-form-group .form-control { flex-grow: 1; }
    .employee-info { background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
    .action-buttons { text-align: center; margin-top: 30px; }
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="box-info full">
            <h2 class="text-center">Edit Salary Bank Part</h2>



            <!-- Form -->
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="flex-form-group">
                            <label for="gross">Gross Salary</label>
                            <input type="number" id="gross" class="form-control" value="{{ $bankPart->gross }}" readonly>
                        </div>
                        <div class="flex-form-group">
                            <label for="cash_amount">Cash Amount</label>
                            <input type="number" id="cash_amount" class="form-control" value="{{ $bankPart->cash_amount }}" step="0.01" min="0">
                        </div>
                        <div class="flex-form-group">
                            <label for="remarks">Remarks</label>
                            <input type="text" id="remarks" class="form-control" value="{{ $bankPart->remarks }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="flex-form-group">
                            <label for="bank_amount">Bank Amount</label>
                            <input type="number" id="bank_amount" class="form-control" value="{{ $bankPart->bank_amount }}" step="0.01" min="0">
                        </div>
                        <div class="flex-form-group">
                            <label for="effective_date">Effective Date</label>
                            <input type="date" id="effective_date" class="form-control" value="{{ $bankPart->effective_date }}">
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <button type="button" class="btn btn-success" id="updateBankPart">Update</button>
                    <a href="/salary-bank-part" class="btn btn-danger">Close</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script>
$(document).ready(function() {

    $('#updateBankPart').click(function() {
        $(this).attr('disabled', true).text('Saving...');

        var formData = {
            id: {{ $bankPart->id }},
            gross: $('#gross').val(),
            cash_amount: $('#cash_amount').val(),
            bank_amount: $('#bank_amount').val(),
            remarks: $('#remarks').val(),
            effective_date: $('#effective_date').val(),
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: '/update-bank-part',
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#updateBankPart').attr('disabled', false).text('Update');
                toastr.success(response.message || 'Data updated successfully.');
            },
            error: function(xhr) {
                $('#updateBankPart').attr('disabled', false).text('Update');
                console.error(xhr.responseText);
                toastr.error('Something went wrong. Please try again.');
            }
        });
    });

});
</script>
@stop
