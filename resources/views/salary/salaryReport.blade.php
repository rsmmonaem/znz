@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.Salary_BankPart') !!}</li>
    </ul>
@stop

@section('content')
    <style>
        .form-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .form-section .form-group {
            width: 48%;
            /* Adjust width to make space for both sides */
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group select,
        .form-group input {
            width: 100%;
        }

        .form-section-right {
            display: flex;
            flex-direction: column;
        }

        .form-section-right .form-group {
            margin-bottom: 15px;
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .report-header h3 {
            text-align: center;
        }

        .table-responsive {
            margin-top: 20px;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="container">
                    <!-- Report Header -->
                    <div class="report-header">
                        <div class="logo">Logo</div>
                        <h3>Salary Report</h3>
                    </div>

                    <!-- Form Section -->
                    <div class="row">
                        <!-- Left Section: Filters -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="group">Group</label>
                                <input type="text" class="form-control" id="group" placeholder="Group">
                            </div>
                            <div class="form-group">
                                <label for="branch">Branch</label>
                                <input type="text" class="form-control" id="branch" placeholder="Branch">
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <input type="text" class="form-control" id="department" placeholder="Department">
                            </div>
                            <div class="form-group">
                                <label for="section">Section</label>
                                <input type="text" class="form-control" id="section" placeholder="Section">
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control" id="designation" placeholder="Designation">
                            </div>
                            <div class="form-group">
                                <label for="employee-id">Employee ID</label>
                                <input type="text" class="form-control" id="employee-id" placeholder="Employee ID">
                            </div>
                        </div>

                        <!-- Right Section: Report Type and Category -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="report-type">Report Type</label>
                                <select class="form-control" id="report-type">
                                    <option value="salary-slab">Salary Slab</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category">
                                    <option value="management">Management</option>
                                    <option value="corporate">Corporate</option>
                                    <option value="all">All</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" id="type">
                                    <option value="management">Management</option>
                                    <option value="corporate">Corporate</option>
                                    <option value="all">All</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons Section -->
                    <div class="buttons">
                        <button class="btn btn-primary">Report</button>
                        <button class="btn btn-danger">Close</button>
                    </div>

                    <!-- Table Section -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Department</th>
                                    <th>Section</th>
                                    <th>DOJ</th>
                                    <th>Grade</th>
                                    <th>Account Number</th>
                                    <th>Bank Amount</th>
                                    <th>Cash Amount</th>
                                    <th>Gross</th>
                                    <th>Basic</th>
                                    <th>HRont</th>
                                    <th>Medical</th>
                                    <th>Other</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example Data Row -->
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td>Manager</td>
                                    <td>Sales</td>
                                    <td>North</td>
                                    <td>2022-05-12</td>
                                    <td>A</td>
                                    <td>123456</td>
                                    <td>5000</td>
                                    <td>2000</td>
                                    <td>7000</td>
                                    <td>3000</td>
                                    <td>1500</td>
                                    <td>500</td>
                                    <td>200</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
