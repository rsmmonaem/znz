@extends('layouts.default')

@section('content')

<div class="panel-section">
    <h3 class="mb-4">Edit Salary Bank Part</h3>

    <form action="{{ route('update-bank-part', $bankPart->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Left Column -->
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="gross">Gross Salary <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="gross" name="gross"
                        value="{{ $bankPart->gross }}" required>
                </div>

                <div class="form-group">
                    <label for="cash_amount">Cash Amount <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="cash_amount" name="cash_amount"
                        value="{{ $bankPart->cash_amount }}" required>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="effective_date">Effective Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="effective_date" name="effective_date"
                        value="{{ $bankPart->effective_date }}" required>
                </div>

                <div class="form-group">
                    <label for="bank_amount">Bank Amount <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="bank_amount" name="bank_amount"
                        value="{{ $bankPart->bank_amount }}" required>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons mt-3">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-save"></i> Update
            </button>

        </div>
    </form>
</div>

@endsection
