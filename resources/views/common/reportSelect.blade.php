<select class="form-control" id="report-select" onchange="handleSelectChange()">
    <option value="">Select Option</option>
    <option value="{{ url('employee/report') }}" {{ Request::is('employee/report') ? 'selected' : '' }}>Employee Report</option>
    <option value="{{ url('employee-blood-group') }}" {{ Request::is('employee-blood-group') ? 'selected' : '' }}>Employee Blood Group</option>
    <option value="{{ url('employee-transfer/report') }}" {{ Request::is('employee-transfer/report') ? 'selected' : '' }}>Employee Transfer Report</option>
    <option value="{{ url('attendance-report') }}" {{ Request::is('attendance-report') ? 'selected' : '' }}>Monthly Attendance Report</option>
    <option value="{{ url('daily-attendance-report') }}" {{ Request::is('daily-attendance-report') ? 'selected' : '' }}>Daily Attendance Report</option>
    <option value="{{ url('leave-report') }}" {{ Request::is('leave-report') ? 'selected' : '' }}>Leave Report</option>
    <option value="{{ url('employee-separation-report') }}" {{ Request::is('employee-separation-report') ? 'selected' : '' }}>Employee Separation Report</option>
    <option value="{{ url('increment-and-promotion-report') }}" {{ Request::is('increment-and-promotion-report') ? 'selected' : '' }}>Promotion/Increment Report</option>
    <option value="{{ url('salary-report') }}" {{ Request::is('salary-report') ? 'selected' : '' }}>Salary Slab Report</option>
    <option value="{{ url('salary-slip') }}" {{ Request::is('salary-slip') ? 'selected' : '' }}>Salary Slip Panel</option>
    <option value="{{ url('slary-shit-report') }}" {{ Request::is('slary-shit-report') ? 'selected' : '' }}>Salary Report</option>
    <option value="{{ url('letter-noc') }}" {{ Request::is('letter-noc') ? 'selected' : '' }}>NOC Letter</option>
    <option value="{{ url('letter-jec') }}" {{ Request::is('letter-jec') ? 'selected' : '' }} >JEC Letter</option>
    <option value="{{ url('letter-increment') }}" {{ Request::is('letter-increment') ? 'selected' : '' }}>Increment Letter</option>
    <option value="{{ url('letter-increment-promotion') }}" {{ Request::is('letter-increment-promotion') ? 'selected' : '' }}>Increment and Promotion Letter</option>
    <option value="{{ url('salary-summary') }}" {{ Request::is('salary-summary') ? 'selected' : '' }}>Salary Summary</option>
    <option value="{{ url('salary-bank-statement') }}" {{ Request::is('salary-bank-statement') ? 'selected' : '' }}>Salary Bank Statement</option>
    <option value="{{ url('salary-transfer-glance') }}" {{ Request::is('salary-transfer-glance') ? 'selected' : '' }}>Salary Transfer at a Glance</option>
    <option value="{{ url('gender-wise-report') }}" {{ Request::is('gender-wise-report') ? 'selected' : '' }}>Gender Wise Report</option>
    <option value="{{ url('religion-wise-report') }}" {{ Request::is('religion-wise-report') ? 'selected' : '' }}>Religion Wise Report</option>
</select>
