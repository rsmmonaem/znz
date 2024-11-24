@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.Salary_BankPart') !!}</li>
    </ul>
@stop

@section('content')
    <style>
        .panel-section {
            margin: 20px 0;
        }

        .form-group {
            display: flex;
            align-items: center;
        }

        .form-group label {
            width: 150px;
            margin-right: 10px;
        }

        .form-group input,
        .form-group select {
            flex: 1;
        }

        .action-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .table-container {
            margin-top: 30px;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="container">
                    <h2 class="text-center">Salary Bank Panel</h2>
                    <!-- Entry Panel -->
                    <div class="panel-section">
                        <form >
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="group">Group</label>
                                        <select class="form-control" id="group">
                                            <option value="">Select</option>
                                            @foreach ($group as $g)
                                                <option value="{{ $g->id }}" selected>{{ $g->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="branch">Branch</label>
                                        <select class="form-control" id="branch">
                                            <option value="">Select</option>
                                            @foreach ($branch as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <select class="form-control" id="department">
                                            <option value="">Select</option>
                                            @foreach ($department as $d)
                                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="section">Section</label>
                                        <select class="form-control" id="section">
                                            <option value="">Select</option>
                                            @foreach ($section as $s)
                                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="employeeId">Employee ID</label>
                                        <select class="form-control" id="employeeId">
                                            <option value="">Select</option>
                                            @foreach ($employee as $e)
                                                <option value="{{ $e->id }}">{{ $e->first_name }} - {{ $e->employee_code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <input type="text" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <input type="text" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Gross</label>
                                        <input type="text" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="entryDate">Entry Date</label>
                                        <input type="date" class="form-control" id="entryDate">
                                    </div>
                                    <div class="form-group">
                                        <label for="effectiveDate">Effective Date</label>
                                        <input type="date" class="form-control" id="effectiveDate">
                                    </div>
                                    <div class="form-group">
                                        <label for="bankAmount">Bank Amount</label>
                                        <input type="text" class="form-control" id="bankAmount">
                                    </div>
                                </div>
                            </div>  
                            <div class="action-buttons">
                                <button type="button" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-danger">Close</button>
                            </div>
                        </form>
                    </div>

                    <!-- Data Table -->
                    <div class="table-container">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <th>Emp ID</th>
                                    <th>Effective Date</th>
                                    <th>Bank Amount</th>
                                    <th>Cash Amount</th>
                                    <th>Hold</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>1000</td>
                                    <td>01 Nov 2024</td>
                                    <td>30,000</td>
                                    <td></td>
                                    <td><input type="checkbox"></td>
                                    <td>False</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
