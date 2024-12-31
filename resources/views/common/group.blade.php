<div class="form-group">
    <label>Group</label>
    <select class="form-control" name="branch_id" id="branch_id">
        @php $group = DB::table('com_group')->get(); @endphp
        <option value="">Select Group</option>
        @foreach ($group as $b)
            <option value="{{ $b->id }}" selected>{{ $b->name }}</option>
        @endforeach
    </select>
</div>

