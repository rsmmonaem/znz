@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Cost Unit Wise Challan List</li>
    </ul>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box-info full" style="padding-bottom:20px">
                <h2 class="text-center"><strong>Cost Unit Wise Challan List</strong></h2>

                <div class="col-md-12">
                    <div class="row">
                        <!-- Cost Unit Dropdown -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="costUnit">Cost Unit</label>
                                <select class="form-control" id="costUnit">
                                    <option value="">Select</option>
                                    @foreach ($tax_cost_unit_type as $bt)
                                        <option value="{{ $bt->id }}">{{ $bt->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Report Type Selection -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="costUnit">Report Type</label>
                                @include('common.reportSelect')
                            </div>
                        </div>
                    </div>

                    <!-- Buttons Section -->
                    <div class="text-center" style="margin-top: 120px;">
                        <button class="btn btn-primary" id="report">Report</button>
                        <button class="btn btn-danger">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#report').on('click', function() {
                var costUnit = $('#costUnit').val();
                var reportType = $('#reportType').val();
                var formData = {
                    costUnit: costUnit,
                    reportType: reportType
                };

                $.ajax({
                    url: '/cost-unit-wise-challan-list',
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        console.log(data);
                        GetReport(data)
                    },
                    error: function(xhr, status, error) {
                        console.error("Error saving leave data:", error);
                    }
                });
            });
        });

         function GetReport(response){
            let tableRows = '';
            response.forEach((item, index) => {
                tableRows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.branch}</td>
                        <td>${item.employee_code}</td>
                        <td>${item.first_name || ''}</td>
                        <td>${item.designation || ''}</td>
                        <td>${item.department || ''}</td>
                        <td>${item.section || ''}</td>
                        <td>${item.challan_no || ''}</td>
                        <td>${item.challan_amount || ''}</td>
                        <td>${parseFloat(item.july) + parseFloat(item.august) + parseFloat(item.september) + parseFloat(item.october) + parseFloat(item.november) + parseFloat(item.december) + parseFloat(item.january) + parseFloat(item.february) + parseFloat(item.march) + parseFloat(item.april) + parseFloat(item.may) + parseFloat(item.june) || ''}</td>
                        <td>${item.paymentdate || ''}</td>
                    </tr>
                `;
            });

            // Open a new window and inject HTML content
            const newWindow = window.open('', '_blank', 'width=1000,height=800');
            newWindow.document.open();

            // Build the report layout in the new window
            const reportHTML = `
                <html>
                <head>
                    <title>Cost Unit Wise Challan List</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            margin: 20px;
                        }
                        .display-flex {
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            border: 1px solid #ccc;
                            padding: 10px;
                            margin-bottom: 20px;
                        }
                        .center-item {
                            text-align: center;
                            margin: auto;
                        }
                        table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-bottom: 20px;
                        }
                        th, td {
                            border: 1px solid #ccc;
                            padding: 8px;
                            text-align: left;
                        }
                        th {
                            background-color: #f4f4f4;
                        }
                        h3 {
                            text-align: center;
                        }
                    </style>
                </head>
                <body>
                    <div class="table-container">
                        <div class="display-flex">
                            <div class="left-item">
                                <img src="{{ URL::to(config('constants.upload_path.logo').config('config.logo')) }}" width="100px" style="margin-left:20px;">
                            </div>
                            <div class="center-item">
                                <h2 style="margin:10px;" >J & Z Group</h2>
                                <h2 style="margin:10px;">Cost Unit Wise Challan List</h2>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Branch</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Department</th>
                                    <th>Section</th>
                                    <th>Challan No</th>
                                    <th>Challan Amount</th>
                                    <th>Tax Amount</th>
                                    <th>Challan Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${tableRows}
                            </tbody>
                        </table>
                        <div class="display-flex">
                            <div class="center-item">
                                <button onclick="window.print()" class="btn btn-primary">Print</button>
                            </div>
                        </div>
                    </div>
                </body>
                </html>
            `;

            newWindow.document.write(reportHTML);
            newWindow.document.close();
        }
    </script>
@stop
