<div class="form-group">
    <label>Financial Year</label>
    <select class="form-control" name="financial_year" id="financial_year">
        <option value="">Select Year</option>
         @for($i = 2030; $i >= date('Y')-10; $i--)
            <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
        @endfor
    </select>
</div>

