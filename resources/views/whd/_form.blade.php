<div class="form-group">
    <labe>Group</label>
    <select class="form-control" name="group_id" id="group_id">
        <option value="">Select Group</option>
        @foreach ($group as $g)
            <option value="{{ $g->id }}" selected>{{ $g->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Brach</label>
    <select class="form-control" name="branch_id" id="branch_id">
        <option value="">Select Branch</option>
        @foreach ($branch as $b)
            <option value="{{ $b->id }}">{{ $b->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Date</label>
    <input type="text" name="date" id="date" readonly placeholder="{{ trans('messages.date')}}" class="form-control mdatepicker">
</div>
<div class="form-group">
    <label>Employee ID</label>
    <select class="form-control" name="employee_id" id="employee_id">
        <option value="">Select Employee</option>
    </select>
</div>