@extends('layouts.default')
@section('content')
    
    <div class="container">
        <h2>Edit Salary Bank Part</h2>
        <form action="{{ route('update-bank-part', $bankPart->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="effective_date">Effective Date:</label>
                <input type="date" class="form-control" id="effective_date" name="effective_date" value="{{ $bankPart->effective_date }}" required>
            </div>
            <div class="form-group">
                <label for="gross">Gross:</label>
                <input type="number" class="form-control" id="gross" name="gross" value="{{ $bankPart->gross }}" required>
            </div>
            <div class="form-group">
                <label for="bank_amount">Bank Amount:</label>
                <input type="number" class="form-control" id="bank_amount" name="bank_amount" value="{{ $bankPart->bank_amount }}" required>
            </div>
            <div class="form-group">
                <label for="cash_amount">Cash Amount:</label>
                <input type="number" class="form-control" id="cash_amount" name="cash_amount" value="{{ $bankPart->cash_amount }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

@endsection