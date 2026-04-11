<div class="row">
    <div class="col-sm-6">
        <div class="form-group flex-form-group">
            {!! Form::label('bank_account_count', 'From how many bank accounts?') !!}
            {!! Form::input('number', 'bank_account_count', '', ['class' => 'form-control', 'placeholder' => 'e.g. 2', 'min' => 1]) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group flex-form-group">
            {!! Form::label('amount', trans('messages.amount')) !!}
            {!! Form::input('text', 'amount', '', ['class' => 'form-control', 'placeholder' => trans('messages.amount')]) !!}
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-bordered" id="salary-distribution-table">
                <thead>
                    <tr>
                        <th style="width: 60%;">{!! trans('messages.bank_account') !!}</th>
                        <th style="width: 30%;">{!! trans('messages.amount') !!}</th>
                        <th style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody id="distribution-rows">
                    <tr>
                        <td>
                            <select name="bank_account_id[]" class="form-control select2me">
                                <option value="">Select Account</option>
                                {{-- Assuming $employee->BankAccounts is available --}}
                                @if(isset($employee->BankAccount))
                                    @foreach($employee->BankAccount as $account)
                                        <option value="{{ $account->id }}">{{ $account->bank_name }} ({{ $account->account_number }})</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                        <td>
                            {!! Form::input('text', 'distribution_amount[]', '', ['class' => 'form-control', 'placeholder' => trans('messages.amount')]) !!}
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-xs remove-row"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-success btn-sm" id="add-distribution-row">
                <i class="fa fa-plus"></i> Add Another Account
            </button>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-6 pull-right">
        <div class="form-group flex-form-group">
            {!! Form::label('total_amount', 'Total Amount') !!}
            {!! Form::input('text', 'total_amount', '', ['class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => '0.00']) !!}
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Add row functionality (Frontend View Only)
        $('#add-distribution-row').click(function() {
            var newRow = $('#distribution-rows tr:first').clone();
            newRow.find('input').val('');
            newRow.find('select').val('');
            $('#distribution-rows').append(newRow);
        });

        // Remove row functionality
        $(document).on('click', '.remove-row', function() {
            if ($('#distribution-rows tr').length > 1) {
                $(this).closest('tr').remove();
            } else {
                alert('At least one row is required.');
            }
        });
    });
</script>
