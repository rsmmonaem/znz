{{-- <h3 class="text-center">Employee Transfer</h3> --}}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Group</label>
                <section class="form-control">
                    <option>J & J Group</option>
                </section>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="section-title">From</div>
            <div class="form-group">
                <label>Branch</label>
                <select class="form-control" name="fbranch">
                    <option value="">Select Branch</option>
                    @foreach ($branch as $b)
                        <option value="{{ $b->id }}" @if($b->id == $transfer->fbranch) selected @endif>{{ $b->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Department</label>
                <select class="form-control" name="fdepartment">
                    <option value="">Select Department</option>
                    @foreach ($department as $d)
                        <option value="{{ $d->id }}" @if($d->id == $transfer->fdepartment) selected @endif>{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Section</label>
                <select class="form-control" name="fsection">
                    <option value="">Select Section</option>
                    @foreach ($section as $s)
                        <option value="{{ $s->id }}" @if($s->id == $transfer->fsection) selected @endif>{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Designation</label>
                <select class="form-control select2me select2-offscreen" name="fdesignation">
                    <option value="">Select Designation</option>
                    @foreach ($designation as $d)
                        <option value="{{ $d->id }}" @if($d->id == $transfer->fdesignation) selected @endif>{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Transfer Date</label>
                <input type="date" class="form-control" name="ftransfer_date" value="{{ $transfer->ftransfer_date }}">
            </div>
            <div class="form-group">
                <label>Employee ID</label>
                <select class="form-control select2me select2-offscreen" name="femployee">
                    <option value="">Select Employee ID</option>
                    @foreach ($employee as $e)
                        <option value="{{ $e->id }}" @if($e->id == $transfer->femployee) selected @endif>{{  $e->first_name}} - {{ $e->employee_code }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="section-title">To</div>
            <div class="form-group">
                <label>Branch</label>
                <select class="form-control" name="tbranch">
                    <option value="">Select Branch</option>
                    @foreach ($branch as $b)
                        <option value="{{ $b->id }}" @if($b->id == $transfer->tbranch) selected @endif>{{ $b->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Department</label>
                <select class="form-control" name="tdepartment">
                    <option value="">Select Department</option>
                    @foreach ($department as $d)
                        <option value="{{ $d->id }}" @if($d->id == $transfer->tdepartment) selected @endif>{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Section</label>
                <select class="form-control" name="tsection">
                    <option value="">Select Section</option>
                    @foreach ($section as $s)
                        <option value="{{ $s->id }}" @if($s->id == $transfer->tsection) selected @endif>{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Designation</label>
                <select class="form-control" name="tdesignation">
                    <option value="">Select Designation</option>
                    @foreach ($designation as $d)
                        <option value="{{ $d->id }}" @if($d->id == $transfer->tdesignation) selected @endif>{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Join Date</label>
                <input type="date" class="form-control" name="tjoin_date" value="{{ $transfer->tjoin_date }}">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Remarks</label>
        <textarea class="form-control remarks-box" name="remarks">{{ $transfer->remarks }}</textarea>
    </div>