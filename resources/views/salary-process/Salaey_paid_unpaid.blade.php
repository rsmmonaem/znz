@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Salary Paid Unpaid Panel</li>
    </ul>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <h2 class="text-center"><strong>Salary Paid Unpaid Panel</strong></h2>
                <div class="container">
                    <div class="form-container">
                        {{-- <h3>Report for Employee Database</h3> --}}
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Group</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="group">
                                        <option selected>J & Z Group</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Branch</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="branch" id="branch">
                                        <option value="">Select</option>
                                        @foreach ($branches as $b)
                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Department</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="department" id="department">
                                        <option value="">Select</option>
                                        @foreach ($departments as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Section</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="section" id="section">
                                        <option value="">Select</option>
                                        @foreach ($section as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Designation</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="designation" id="designation">
                                        <option value="">Select</option>
                                        @foreach ($designation as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Employee ID</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="employee_id" id="employee_id">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Year</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="year" id="year">
                                        <option value="">Select</option>
                                       @for($i = 2050; $i >= 2010; $i--)
                                            <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Month</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="month" id="month">
                                        <option value="">Select</option>
                                        @for($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ $i == date('m') ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Payment On</label>
                                <div class="col-sm-4">
                                    Full Paid <input type="checkbox" name="full_paid" id="full_paid">
                                    Pertial Paid <input type="checkbox" name="partial_paid" id="partial_paid">
                                    Due <input type="checkbox" name="due" id="due" checked>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" id="Savebtn" class="btn btn-primary">Search</button>
                                    <button type="reset" class="btn btn-default" id="reset" onclick="window.location.reload();">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div>
                    <button type="button" id="FullPaidBTN" class="btn btn-primary">Full Paid</button>
                    <button type="button" id="PaidBtn" class="btn btn-primary">Partial Paid</button>
                </div>
                {{-- Data Table --}}
                <div class="table-responsive" id="table-container">
                    <table id="salaryTable" class="table table-bordered table-striped table-responsive" >
                        <thead>
                            <tr>
                                <th><input id="checkAllHeader" type="checkbox"></th>
                                <th>Paid Amount</th>
                                <th>Unpaid Amount</th>
                                <th>Month</th>
                                <th>Net Payable</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Branch</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Section</th>
                                <th>Bank Pay</th>
                                <th>Cash Pay</th>
                                <th>Gross</th>
                                <th>Total Payable</th>
                                <th>Total Deduction</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody id="salaryTable-Body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            LoadData();
            $('#branch').on('change', function() {
                var branch_id = $(this).val();
                $('#employee_id').val('').trigger('change');
                HandleBranchWiseEmployees(branch_id, '#employee_id');
            });  

            $('#Savebtn').on('click', function() {
                 LoadData();
            });

            function LoadData() {
                // $('#Savebtn').attr('disabled', true);
                const FormData = {
                    employeeId: $('#employee_id').val(),
                    section: $('#section').val(),
                    department: $('#department').val(),
                    designation: $('#designation').val(),
                    branch: $('#branch').val(),
                    year: $('#year').val(),
                    month: $('#month').val(),
                    full_paid: $('#full_paid').is(':checked') ? 1 : '',
                    partial_paid: $('#partial_paid').is(':checked') ? 1 : '',
                    due: $('#due').is(':checked') ? 1 : '',
                };

                $.ajax({
                    url: '/salary-paid-unpaid',
                    type: 'POST',
                    data: FormData,
                    success: function(response) {
                        GetReport(response);
                        $('#Savebtn').attr('disabled', false);
                    }
                });
            }

            function GetReport(response){
                $('#salaryTable').DataTable().destroy();
                $('#salaryTable-Body').empty();
                response.forEach((item, index) => {
                    $('#salaryTable-Body').append(`
                        <tr>
                            <td><input class="checkAllRow" value="${item.id}" type="checkbox"></th></td>
                            <td><input style="width:100px" type="text" name="paid_amount" value="${item.PaidAmount}"/></td>
                            <td><input style="width:100px" type="text" value="${item.UnpaidAmount}"/></td>
                            <td>${new Date(item.ToDate).toLocaleString('default', { month: 'long' })}</td>
                            <td>${item.NetPayable}</td>
                            <td>${item.employee_code}</td>
                            <td>${item.employee_name}</td>
                            <td>${item.branch_name}</td>
                            <td>${item.name}</td>
                            <td>${item.department_name}</td>
                            <td>${item.section_name}</td>
                            <td>${item.BankPay}</td>
                            <td>${item.CashPay}</td>
                            <td>${item.Gross}</td>
                            <td>${item.TotalPayable}</td>
                            <td>${item.TotalDeduction}</td>
                            <td>${item.Remarks}</td>
                        </tr>
                    `);
                });

                $('#salaryTable').DataTable({
                    dom: 'Bfrtip',
                    lengthMenu: [10, 20, 50, 100],
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    pageLength: 10,
                    order: [[0, 'desc']],
                });
            }

            $('#PaidBtn').on('click', function() {
                if ($('.checkAllRow:checked').length == 0) {
                 return toastr.warning('Please select at least one row');
               }
               $('#PaidBtn').attr('disabled', true);
                const idWithAmount = [];
                // Loop through each checked checkbox and collect its ID and corresponding amount
                $('.checkAllRow:checked').each(function() {
                    const id = $(this).val(); // Get the checkbox value (ID)
                    const amount = $(this).closest('tr').find('input[name="paid_amount"]').val(); // Get the amount
                    // Push the ID and amount as an object into the array
                    idWithAmount.push({ id: id, amount: amount });
                });
                // Prepare the data to send
                const FormData = {
                    idWithAmount: idWithAmount
                };
               $.ajax({
                   url: '/salary-paid-unpaid-pertial-paid',
                   type: 'POST',
                   data: FormData,
                   success: function(response) {
                       LoadData();
                       toastr.success(response.message);
                       $('#PaidBtn').attr('disabled', false);
                   }
               })
            });

            $('#FullPaidBTN').on('click', function() {
               if ($('.checkAllRow:checked').length == 0) {
                 return toastr.warning('Please select at least one row');
               }
               $('#FullPaidBTN').attr('disabled', true);
               const checkedrowsids = [];
               $('.checkAllRow:checked').each(function() {
                 checkedrowsids.push($(this).val());
               });
               const FormData = {
                 checkedrowsids: checkedrowsids
               }
               $.ajax({
                   url: '/salary-paid-unpaid-update',
                   type: 'POST',
                   data: FormData,
                   success: function(response) {
                       LoadData();
                       toastr.success(response.message);
                       $('#FullPaidBTN').attr('disabled', false);
                   }
               });
            });
            // Select all checkboxes functionality
            const checkAllHeader = $('#checkAllHeader');
            
            $(document).on('change', '.checkAllRow', function() {
                const checkAllRows = $('.checkAllRow');
                const allChecked = checkAllRows.length === checkAllRows.filter(':checked').length;
                checkAllHeader.checked = allChecked;
            });

            $(document).on('change', '#checkAllHeader', function() {
                const isChecked = $(this).prop('checked');
                $('.checkAllRow').prop('checked', isChecked);
            });
        });
    </script>
@stop