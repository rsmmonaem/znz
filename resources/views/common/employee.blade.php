<div class="form-group">
    <label>Employee ID</label>
    <select class="form-control" name="{{ $name }}" id="{{ $id }}">
        @php 
         $employee = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->select('users.first_name', 'users.id', 'profile.employee_code')
        ->get();
        @endphp
        <option value="">Select Branch</option>
        @foreach ($employee as $e)
            <option value="{{ $e->id }}">{{ $e->employee_code }} -
              {{ $e->first_name }}
            </option>
        @endforeach
    </select>
</div>

