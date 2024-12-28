<div class="form-group">
    <label>Branch</label>
    <select class="form-control" name="branch_id" id="branch_id">
        @php $branch = DB::table('branchs')->get(); @endphp
        <option value="">Select Branch</option>
        @foreach ($branch as $b)
            <option value="{{ $b->id }}">{{ $b->name }}</option>
        @endforeach
    </select>
</div>

