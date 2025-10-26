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

    .alert {
        margin-bottom: 20px;
    }

    .loading {
        opacity: 0.6;
        pointer-events: none;
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
                            <strong>Employee ID:</strong> <span id="employee-id">{{ isset($bankPart->employee_code) ? $bankPart->employee_code : 'N/A' }}</span>
                        </div>
                        <div class="col-sm-6">
                            <strong>Employee Name:</strong> <span id="employee-name">{{ isset($bankPart->first_name) ? $bankPart->first_name : 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Alert Messages -->
                <div id="alert-container"></div>

                <!-- Edit Form -->
                <form id="editBankPartForm">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-sm-6">
                            <div class="form-group flex-form-group">
                                <label for="gross">{!! trans('messages.gross') !!} {!! trans('messages.salary') !!} <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="gross" name="gross"
                                    value="{{ isset($bankPart->gross) ? $bankPart->gross : '' }}" required step="0.01" min="0">
                            </div>

                            <div class="form-group flex-form-group">
                                <label for="cash_amount">{!! trans('messages.cash') !!} {!! trans('messages.amount') !!} <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="cash_amount" name="cash_amount"
                                    value="{{ isset($bankPart->cash_amount) ? $bankPart->cash_amount : '' }}" required step="0.01" min="0">
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-sm-6">
                            <div class="form-group flex-form-group">
                                <label for="effective_date">{!! trans('messages.effective') !!} {!! trans('messages.date') !!} <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="effective_date" name="effective_date"
                                    value="{{ isset($bankPart->effective_date) ? $bankPart->effective_date : '' }}" required>
                            </div>

                            <div class="form-group flex-form-group">
                                <label for="bank_amount">{!! trans('messages.bank') !!} {!! trans('messages.amount') !!} <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="bank_amount" name="bank_amount"
                                    value="{{ isset($bankPart->bank_amount) ? $bankPart->bank_amount : '' }}" required step="0.01" min="0">
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <button type="submit" class="btn btn-success" id="updateBtn">
                            <i class="fa fa-save"></i> {!! trans('messages.update') !!}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

