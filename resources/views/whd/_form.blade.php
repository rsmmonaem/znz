<div class="form-group">
    <label>Group</label>
    <select class="form-control" name="group_id" id="group_id">
        <option value="">Select Group</option>
        @foreach ($group as $g)
            <option value="{{ $g->id }}">{{ $g->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Branch</label>
    <select class="form-control" name="branch_id" id="branch_id">
        <option value="">Select Branch</option>
        @foreach ($branch as $b)
            <option value="{{ $b->id }}">{{ $b->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Days</label><br>
    @php
        $days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    @endphp
    @foreach ($days as $day)
        <label style="margin-right: 10px;">
            <input type="checkbox" name="days[]" value="{{ $day }}"> {{ $day }}
        </label>
    @endforeach
</div>

<div class="form-group">
    <label>Employee ID</label>
    <select class="form-control" name="employee_id" id="employee_id">
        <option value="">Select Employee</option>
    </select>
</div>
