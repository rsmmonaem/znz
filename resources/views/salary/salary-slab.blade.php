@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Salary Slab</li>
    </ul>
@stop

@section('content')
    <style>
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-group label {
            width: 150px !important;
            margin-right: 10px;
        }

        .form-group input,
        .form-group select {
            flex: 1;
            /* width: 150px !important; */
        }

        .panel-section {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .panel-left,
        .panel-right {
            flex: 1;
            margin-right: 20px;
        }

        .panel-right {
            margin-right: 0;
        }

        .table-container {
            margin-top: 30px;
        }

        .action-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .radio-group {
            display: flex;
            justify-content: flex-start;
            gap: 20px;
        }
        .form-control {
            width: 69% !important;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="container">
                    <h2 class="text-center">Salary Slab - Entry Panel</h2>
                    <div class="panel-section">
                        <!-- Left Panel -->
                        <div class="panel-left">
                            <form>
                                <div class="form-group">
                                    <label for="group">Group</label>
                                    <select id="group" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($group as $g)
                                            <option value="{{ $g->id }}" selected>{{ $g->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="branch">Branch</label>
                                    <select id="branch" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($branch as $b)
                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="employeeId">Employee ID</label>
                                    <select id="employeeId" class="form-control select2me">
                                        <option value="">Select</option>
                                        @foreach ($employee as $e)
                                            <option value="{{ $e->id }}">{{ $e->first_name }} - {{ $e->employee_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <input type="text" id="designation" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="joiningDate">Joining Date</label>
                                    <input type="text" id="date_of_joining" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <input type="text" id="category" class="form-control" disabled>
                                </div>
                            </form>
                        </div>

                        <!-- Right Panel -->
                        <div class="panel-right">
                            <form>
                                <div class="form-group">
                                    <label for="entryDate">Entry Date</label>
                                    <input type="date" id="entryDate" class="form-control" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="form-group">
                                    <label for="effectiveDate">Effective Date</label>
                                    <input type="date" id="effectiveDate" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="gross">Gross</label>
                                    <input type="text" id="gross" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Basic </label>
                                    <input type="text" class="form-control" id="basic1" disabled value="">
                                    <input type="hidden" class="form-control" id="basic" disabled value="50">
                                </div>
                                <div class="form-group">
                                    <label>House Rent </label>
                                    <input type="text" class="form-control" id="houseRent1" disabled value="">
                                    <input type="hidden" class="form-control" id="houseRent" disabled value="28">
                                </div>
                                <div class="form-group">
                                    <label>Medical </label>
                                    <input type="text" class="form-control" id="medical1" disabled value="">
                                    <input type="hidden" class="form-control" id="medical" disabled value="9">
                                </div>
                                <div class="form-group">
                                    <label>Conveyance </label>
                                    <input type="text" class="form-control" id="conveyance1" disabled value="">
                                    <input type="hidden" class="form-control" id="conveyance" disabled value="8">
                                </div>
                                <div class="form-group">
                                    <label>Others </label>
                                    <input type="text" class="form-control" id="others1" disabled value="">
                                    <input type="hidden" class="form-control" id="others" disabled value="5">
                                </div>
                                <script>
                                const basic = document.getElementById('basic1');
                                const houseRent = document.getElementById('houseRent1');
                                const medical = document.getElementById('medical1');
                                const conveyance = document.getElementById('conveyance1');
                                const others = document.getElementById('others1');
                                const grossInput = document.getElementById('gross'); 

                                grossInput.addEventListener('input', () => {
                                const gross = parseFloat(grossInput.value) || 0; 
                                    basic.value = (gross * 0.50).toFixed();        
                                    houseRent.value = (gross * 0.28).toFixed();
                                    medical.value = (gross * 0.09).toFixed();
                                    conveyance.value = (gross * 0.08).toFixed();
                                    others.value = (gross * 0.05).toFixed();
                                });
                                </script>
                                <div class="radio-group">
                                    <label><input type="radio" name="management" value="management"> Management</label>
                                    <label><input type="radio" name="management" value="corporate"> Corporate</label>
                                    <label><input type="radio" name="management" value="all" checked> All</label>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="action-buttons">
                        <button class="btn btn-success" id="saveData">Save</button>
                        <button class="btn btn-danger" id="close" type="reset">Close</button>
                    </div>

                    <!-- Table Section -->
                    <div class="table-container" style="display: none;">
                        <table class="table table-bordered table-striped" id="salaryTable">
                            <thead>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <th>ID</th>
                                    <th>Increment Date</th>
                                    <th>Effective Date</th>
                                    <th>Entry Date</th>
                                    <th>Gross</th>
                                    <th>Basic</th>
                                    <th>HR</th>
                                    <th>Medical</th>
                                    <th>Conveyance</th>
                                    <th>Others</th>
                                </tr>
                            </thead>
                            <tbody id="tableData">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script>
        $(document).ready(function() {
            // getData();
            $('#employeeId').on('change', function() {
                var employeeId = $(this).val();
                $.ajax({
                    url: '/get-employee-details/' + employeeId,
                    type: "POST",
                    dataType: "json",
                    success: function(data) {
                        $('#name').val(data.first_name);
                        $('#branch').val('data.branch');
                        $('#designation').val(data.designation);
                        $('#date_of_joining').val(data.date_of_joining);
                        $('#category').val(data.category);
                        //$('#gross').val(Math.round(data.amount));
                    },
                    error: function() {
                        console.log('error');
                    }
                });
            })

            // Create Slab
            $('#saveData').on('click', function(e) {
                e.preventDefault();
                $('#saveData').attr('disabled', true);
                $('#saveData').text('Saving...');
                const FormData = {
                    employeeId: $('#employeeId').val(),
                    entryDate: $('#entryDate').val(),
                    effectiveDate: $('#effectiveDate').val(),
                    gross: $('#gross').val(),
                    basic: $('#basic').val(),
                    house_rent : $('#houseRent').val(),
                    medical: $('#medical').val(),
                    conveyance: $('#conveyance').val(),
                    others: $('#others').val(),
                    management: $('input[name="management"]:checked').val()
                };
                $.ajax({
                    url: '/salary-slab-create',
                    type: "POST",
                    dataType: "json",
                    data: FormData,
                    success: function(data) {
                        $('#saveData').attr('disabled', false);
                        $('#saveData').text('Save');
                        console.log(data.data);
                        toastr.success(data.message || 'Slab created successfully.');
                        getData(data.data);
                    },
                    error: function() {
                        $('#saveData').attr('disabled', false);
                        $('#saveData').text('Save');
                        console.log('error');
                        toastr.error('Slab save failed.');
                    }
                })
            })
        })

        $('#close').on('click', function() {
            $('#saveData').attr('disabled', false);
            $('#saveData').text('Save');
            $('#salaryTable_wrapper').hide();
            $('#tableData').empty();
        })

        
        function getData(id=null){
          $.ajax({
                url: "/slary-slab-list?id=" + id, 
                method: "GET",
                success: function (data) {
                    const salaryTable_wrapper = $('.table-container');
                    salaryTable_wrapper.show();
                    const datatable = $('#salaryTable');
                    // Destroy the existing DataTable to reinitialize with new data
                    datatable.DataTable().destroy();
                     
                    var tableBody = $('#tableData');
                    tableBody.empty(); // Clear the existing table body
                    
                    // Loop through each user in the data
                    data.forEach(function (item) {
                        var row = `<tr>
                            <td><input type="checkbox"></td>
                            <td>${item.user_info.employee_code}</td>
                            <td>${item.contract_details.from_date}</td>
                            <td>${item.user_info.effective_date ? item.user_info.effective_date : ' '}</td>
                            <td>${item.user_info.entry_date ? item.user_info.entry_date : ' '}</td>
                            <td>${item.user_info.gross ? item.user_info.gross : ' '}</td>`;

                        // Loop through each salary type and add to row
                        item.salaries.forEach(function (salary) {
                            row += `<td>${salary.amount}</td>`;
                        });

                        row += `</tr>`;
                        tableBody.append(row); // Append each row to the table body
                    });

                    // Reinitialize the DataTable after adding new rows
                    datatable.DataTable({
                        lengthMenu: [10, 20, 50, 100],
                    });
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching data:", error);
                }
            });
        }
    </script>
@stop