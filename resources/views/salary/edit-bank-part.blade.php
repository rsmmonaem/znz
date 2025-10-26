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
    .flex-form-group { display: flex; align-items: center; }
    .flex-form-group label { margin-bottom: 0; margin-right: 10px; min-width: 120px; flex-shrink: 0; }
    .flex-form-group .form-control { flex-grow: 1; }
    .employee-info { background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
    .action-buttons { text-align: center; margin-top: 30px; }
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="box-info full">
            <div class="user-profile-content-wm">
                <h2>{!! trans('messages.edit') !!} {!! trans('messages.Salary_BankPart') !!}</h2>

                <!-- Employee Info -->
                <div class="employee-info">
                    <h4>Employee Information</h4>
                    <div class="row">
                        <div class="col-sm-6"><strong>Employee ID:</strong> {{ $bankPart->employee_code }}</div>
                        <div class="col-sm-6"><strong>Employee Name:</strong> {{ $bankPart->first_name }}</div>
                    </div>
                </div>



                <!-- Edit Form -->
                <form method="POST" action="{{ url('update-bank-part') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $bankPart->id }}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group flex-form-group">
                                <label for="gross">Gross Salary</label>
                                <input type="number" class="form-control" id="gross" name="gross"
                                    value="{{ $bankPart->gross }}" step="0.01" min="0" readonly>
                            </div>

                            <div class="form-group flex-form-group">
                                <label for="cash_amount">Cash Amount</label>
                                <input type="number" class="form-control" id="cash_amount" name="cash_amount"
                                    value="{{ $bankPart->cash_amount }}" step="0.01" min="0" required>
                            </div>

                            <div class="form-group flex-form-group">
                                <label for="remarks">Remarks</label>
                                <input type="text" class="form-control" id="remarks" name="remarks"
                                    value="{{ $bankPart->remarks }}">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group flex-form-group">
                                <label for="effective_date">Effective Date</label>
                                <input type="date" class="form-control" id="effective_date" name="effective_date"
                                    value="{{ $bankPart->effective_date }}" required>
                            </div>

                            <div class="form-group flex-form-group">
                                <label for="bank_amount">Bank Amount</label>
                                <input type="number" class="form-control" id="bank_amount" name="bank_amount"
                                    value="{{ $bankPart->bank_amount }}" step="0.01" min="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="action-buttons">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
