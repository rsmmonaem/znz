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
                            <label for="effective_date">Effective Date</label>
                            <input type="date" id="effective_date" class="form-control" value="{{ $bankPart->effective_date }}">
                        </div>

                        <div class="distribution-section" style="margin-top: 20px; border-top: 1px solid #eee; padding-top: 10px;">
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
                                    @php
                                        $bankIdsStr = $bankPart->company_bank_id;
                                        $bankAmountsStr = $bankPart->bank_amounts;
                                        $bankIds = isset($bankIdsStr) ? json_decode($bankIdsStr) : [];
                                        $bankAmounts = isset($bankAmountsStr) ? json_decode($bankAmountsStr) : [];
                                        
                                        // Legacy support: if array is empty but there's a bank_amount
                                        if (empty($bankIds) && $bankPart->bank_amount > 0) {
                                            $bankIds = [$bankPart->company_bank_id];
                                            $bankAmounts = [$bankPart->bank_amount];
                                        }
                                        $rowCount = max(1, count($bankIds));
                                    @endphp

                                    @for ($i = 0; $i < $rowCount; $i++)
                                        <tr class="dist-row">
                                            <td>
                                                <select class="form-control dist-bank">
                                                    <option value="">Select Bank</option>
                                                    @foreach($companyBanks as $bank)
                                                        <option value="{{ $bank->id }}" {{ (isset($bankIds[$i]) && $bankIds[$i] == $bank->id) ? 'selected' : '' }}>
                                                            {{ $bank->bank_name }} ({{ $bank->account_number }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control dist-amount" placeholder="Amount" value="{{ isset($bankAmounts[$i]) ? $bankAmounts[$i] : '' }}">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-xs remove-dist-row"><i class="fa fa-times"></i></button>
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-info btn-xs" id="add-dist-row"><i class="fa fa-plus"></i> Add Bank</button>

                            <div style="margin-top: 15px; background: #f9f9f9; padding: 10px; border-radius: 4px;">
                                <div class="row">
                                    <div class="col-xs-6 text-right"><strong>Total Distributed:</strong></div>
                                    <div class="col-xs-6">
                                        <span id="dist-total-display">{{ number_format($bankPart->bank_amount, 2) }}</span>
                                    </div>
                                </div>
                                <div class="row" style="border-top: 1px solid #ccc; margin-top: 5px; padding-top: 5px; font-weight: bold;">
                                    <div class="col-xs-6 text-right"><strong>Cash Remainder:</strong></div>
                                    <div class="col-xs-6"><span id="cash-remainder-display">{{ number_format($bankPart->cash_amount, 2) }}</span></div>
                                </div>
                            </div>
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
    $('select').select2();

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

    // Add Row logic
    $('#add-dist-row').on('click', function () {
        const $tbody = $('#distribution-tbody');
        const $newRow = $tbody.find('tr:first').clone();

        $newRow.find('.select2-container').remove();
        $newRow.find('select').show().removeClass('select2-hidden-accessible');
        
        $newRow.find('input, select').val('');

        $tbody.append($newRow);
        
        $newRow.find('select').select2();
    });

    $(document).on('click', '.remove-dist-row', function () {
        if ($('#distribution-tbody tr').length > 1) {
            $(this).closest('tr').remove();
            calculateRemaining();
        }
    });

    $(document).on('input', '.dist-amount', function () {
        calculateRemaining();
    });

    $('#updateBankPart').click(function() {
        const self = $(this);
        self.attr('disabled', true).text('Saving...');

        const distributions = [];
        const gross = $('#gross').val();
        let hasError = false;

        $('#distribution-tbody .dist-row').each(function () {
            var $row = $(this);
            var bankId = $row.find('select.dist-bank').val();
            var amount = $row.find('input.dist-amount').val();
            
            var hasBank = (bankId !== "" && bankId !== null && bankId !== undefined);
            var hasAmount = (amount !== "" && amount !== null && amount !== undefined);

            if (!hasBank && !hasAmount) {
                return true; 
            }

            if (hasBank && hasAmount) {
                distributions.push({ bank_id: bankId, amount: amount });
            } else {
                hasError = true;
            }
        });

        if (hasError) {
            toastr.error('Please complete all distribution rows');
            self.attr('disabled', false).text('Update');
            return;
        }

        const totalDistributed = distributions.reduce((sum, d) => sum + parseFloat(d.amount), 0);
        
        if (totalDistributed > parseFloat(gross)) {
            toastr.error('Total distributed bank amount (' + totalDistributed + ') cannot exceed Gross Salary (' + gross + ')');
            self.attr('disabled', false).text('Update');
            return;
        }

        // Calculate cash amount automatically instead of passing it from un-editable display
        const cashAmount = parseFloat(gross) - totalDistributed;

        var formData = {
            id: {{ $bankPart->id }},
            cash_amount: cashAmount,
            remarks: $('#remarks').val(),
            effective_date: $('#effective_date').val(),
            distributions: distributions,
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: '/update-bank-part',
            type: 'POST',
            data: formData,
            success: function(response) {
                if(response.status == 'success') {
                    self.attr('disabled', false).text('Update');
                    toastr.success(response.message || 'Data updated successfully.');
                    // calculateRemaining(); 
                } else {
                    self.attr('disabled', false).text('Update');
                    toastr.error(response.message || 'Error updating data.');
                }
            },
            error: function(xhr) {
                self.attr('disabled', false).text('Update');
                console.error(xhr.responseText);
                toastr.error('Something went wrong. Please try again.');
            }
        });
    });

    calculateRemaining(); // Initialize on load
});
</script>
@stop
