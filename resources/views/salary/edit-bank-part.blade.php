@extends('layouts.default')

@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
    <li><a href="/salary-bank-part">{!! trans('messages.Salary_BankPart') !!}</a></li>
    <li class="active">{!! trans('messages.edit') !!} {!! trans('messages.Salary_BankPart') !!}</li>
</ul>
@stop

@section('content')
<style>
    .flex-form-group {
        display: flex;
        align-items: center;
    }

    .flex-form-group label {
        margin-bottom: 0;
        margin-right: 10px;
        min-width: 120px;
        flex-shrink: 0;
    }

    .flex-form-group .form-control {
        flex-grow: 1;
    }

    .employee-info {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .action-buttons {
        text-align: center;
        margin-top: 30px;
    }
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="box-info full">
            <div class="user-profile-content-wm">
                <h2>{!! trans('messages.edit') !!} {!! trans('messages.Salary_BankPart') !!}</h2>
                
                <!-- Employee Information -->
                <div class="employee-info">
                    <h4>Employee Information</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <strong>Employee ID:</strong> {{ isset($bankPart->employee_code) ? $bankPart->employee_code : 'N/A' }}
                        </div>
                        <div class="col-sm-6">
                            <strong>Employee Name:</strong> {{ isset($bankPart->first_name) ? $bankPart->first_name : 'N/A' }}
                        </div>
                    </div>
                </div>

                <!-- Display Success/Error Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('update-bank-part', $bankPart->id) }}" method="POST" id="editBankPartForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-sm-6">
                            <div class="form-group flex-form-group">
                                <label for="gross">{!! trans('messages.gross') !!} {!! trans('messages.salary') !!} <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="gross" name="gross"
                                    value="{{ old('gross') ? old('gross') : $bankPart->gross }}" required step="0.01" min="0">
                            </div>

                            <div class="form-group flex-form-group">
                                <label for="cash_amount">{!! trans('messages.cash') !!} {!! trans('messages.amount') !!} <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="cash_amount" name="cash_amount"
                                    value="{{ old('cash_amount') ? old('cash_amount') : $bankPart->cash_amount }}" required step="0.01" min="0">
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-sm-6">
                            <div class="form-group flex-form-group">
                                <label for="effective_date">{!! trans('messages.effective') !!} {!! trans('messages.date') !!} <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="effective_date" name="effective_date"
                                    value="{{ old('effective_date') ? old('effective_date') : $bankPart->effective_date }}" required>
                            </div>

                            <div class="form-group flex-form-group">
                                <label for="bank_amount">{!! trans('messages.bank') !!} {!! trans('messages.amount') !!} <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="bank_amount" name="bank_amount"
                                    value="{{ old('bank_amount') ? old('bank_amount') : $bankPart->bank_amount }}" required step="0.01" min="0">
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> {!! trans('messages.update') !!}
                        </button>
                        <a href="{{ url('/salary-bank-part') }}" class="btn btn-default">
                            <i class="fa fa-times"></i> {!! trans('messages.cancel') !!}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>
$(document).ready(function() {
    // Form validation
    $('#editBankPartForm').on('submit', function(e) {
        var gross = parseFloat($('#gross').val()) || 0;
        var bankAmount = parseFloat($('#bank_amount').val()) || 0;
        var cashAmount = parseFloat($('#cash_amount').val()) || 0;
        
        // Validate that bank amount + cash amount equals gross
        if (Math.abs((bankAmount + cashAmount) - gross) > 0.01) {
            e.preventDefault();
            alert('Bank Amount + Cash Amount must equal Gross Salary');
            return false;
        }
        
        // Validate that amounts are not negative
        if (gross < 0 || bankAmount < 0 || cashAmount < 0) {
            e.preventDefault();
            alert('Amounts cannot be negative');
            return false;
        }
    });
    
    // Auto-calculate cash amount when gross or bank amount changes
    $('#gross, #bank_amount').on('input', function() {
        var gross = parseFloat($('#gross').val()) || 0;
        var bankAmount = parseFloat($('#bank_amount').val()) || 0;
        var cashAmount = gross - bankAmount;
        
        if (cashAmount >= 0) {
            $('#cash_amount').val(cashAmount.toFixed(2));
        }
    });
});
</script>
@endsection
