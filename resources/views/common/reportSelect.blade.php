<select class="form-control" id="report-select" onchange="handleSelectChange()">
    <option value="">Select Option</option>
    <option value="{{ url('employee/report') }}" {{ Request::is('employee/report') ? 'selected' : '' }}>Employee Report</option>
    <option value="{{ url('employee-transfer/report') }}" {{ Request::is('employee-transfer/report') ? 'selected' : '' }}>Employee Transfer Report</option>
    <option value="{{ url('attendance-report') }}" {{ Request::is('attendance-report') ? 'selected' : '' }}>Attendance Report</option>
    <option value="{{ url('daily-attendance-report') }}" {{ Request::is('daily-attendance-report') ? 'selected' : '' }}>Daily Attendance Report</option>
    <option value="{{ url('leave-report') }}" {{ Request::is('leave-report') ? 'selected' : '' }}>Leave Report</option>
    <option value="{{ url('employee-separation-report') }}" {{ Request::is('employee-separation-report') ? 'selected' : '' }}>Employee Separation Report</option>
    <option value="{{ url('increment-and-promotion-report') }}" {{ Request::is('increment-and-promotion-report') ? 'selected' : '' }}>Promotion/Increment Report</option>
    <option value="{{ url('salary-report') }}" {{ Request::is('salary-report') ? 'selected' : '' }}>Salary Slab Report</option>
    <option value="{{ url('salary-slip') }}" {{ Request::is('salary-slip') ? 'selected' : '' }}>Salary Slip Panel</option>
    <option value="{{ url('slary-shit-report') }}" {{ Request::is('slary-shit-report') ? 'selected' : '' }}>Salary Report</option>
</select>
