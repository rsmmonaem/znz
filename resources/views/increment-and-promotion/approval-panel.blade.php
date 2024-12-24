@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.promotion_increment') !!}</li>
    </ul>
@stop

@section('content')
    <style>
        /* Make the form group flexible */
        .form-group {
            display: flex;
            flex-direction: row;
            align-items: center;
            /* Align items vertically centered */
            margin-bottom: 15px;
            /* Space between fields */
        }

        .form-group label {
            width: 120px;
            /* Set a fixed width for the label */
            margin-right: 10px;
            /* Add space between label and input */
            text-align: left;
            /* Align the text to the right */
        }

        .form-group .form-control {
            flex-grow: 1;
            /* Let the input field grow to fill available space */
        }

        .btn-section {
            text-align: center;
        }

        .mb {
            margin-bottom: 30px;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="form-container mb">
                    <div class="row mb">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <h2 class="text-center mb">Promotion & Increment (Approval Panel)</h2>
                            {{-- <h5 class="text-center"></h5> --}}
                            <form>
                                <!-- Form Fields -->
                                <div class="form-group">
                                    <label for="group">Group</label>
                                    <select class="form-control">
                                        <option value="J & J Group">J & J Group</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="branch">Branch</label>
                                    {{-- <input type="text" id="branch" class="form-control" placeholder="Enter Branch"> --}}
                                    <select class="form-control" id="branch">
                                        <option value="">Select Branch</option>
                                        @foreach ($branch as $b)
                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    {{-- <input type="text" id="department" class="form-control"
                                        placeholder="Enter Department"> --}}
                                    <select class="form-control" id="department">
                                        <option value="">Select Department</option>
                                        @foreach ($department as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="section">Section</label>
                                    {{-- <input type="text" id="section" class="form-control" placeholder="Enter Section"> --}}
                                    <select class="form-control" id="section">
                                        <option value="">Select Section</option>
                                        @foreach ($section as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    {{-- <input type="text" id="category" class="form-control" placeholder="Enter Category"> --}}
                                    {{-- <select class="form-control" id="category">
                                        <option value="">Select Category</option>
                                        @foreach ($catregory as $c)
                                            <option value="{{ $c }}">{{ $c }}</option>
                                        @endforeach
                                    </select> --}}
                                     @include('common.category')
                                </div>
                                <div class="form-group">
                                    <label for="approvalDate">Approval Date</label>
                                    <input type="date" id="approvalDate" class="form-control">
                                </div>
                                <div class="btn-section">
                                    <button type="button" class="btn btn-primary" id="search">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-container mb">
                        <table class="table table-bordered table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th><input class="form-check-input select-all" id="select-all" type="checkbox"> All</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Promoted Designation</th>
                                    <th>Increment Amount</th>
                                </tr>
                            </thead>
                            <tbody id="tableData">

                            </tbody>
                        </table>
                    </div>

                    <!-- Approve Button -->
                    <div class="btn-section mb">
                        <button type="button" class="btn btn-success" onclick="Approved()">Approve</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            GetData();
        });

        $('#search').on('click', function() {
            var formData = {
                branch: $('#branch').val(),
                department: $('#department').val(),
                section: $('#section').val(),
                category: $('#category').val(),
                approvalDate: $('#approvalDate').val(),
            };
            GetData(formData);
        });

        // Approved Function
        function Approved() {
            const selectedIds = [];
            $('.select:checked').each(function() {
                selectedIds.push($(this).data('id'));
            });
            var approvalDate = $('#approvalDate').val();
            // console.log(selectedIds);
            if (selectedIds.length > 0 && approvalDate.length > 0) {
                $.ajax({
                    url: "{{ url('increment-and-promotion-approve') }}",
                    type: "POST",
                    dataType: "json",
                    data: { 
                        ids: selectedIds,
                        approved_date: approvalDate,
                     },
                    success: function(response) {
                        GetData();
                        toastr.success('Incriments record approved successfully.');
                    },
                    error: function() {
                        console.log('error');
                    }
                });
            }else{
                toastr.error('Please select at date and select at least one record.');
            }
        }

        // Get Data
        function GetData(formData = null) {
            $('#search').attr('disabled', true);
            $('#search').text('Please Wait...');
            $.ajax({
                url: "{{ url('increment-and-promotion-approval') }}",
                type: "POST",
                dataType: "json",
                data: formData,
                success: function(response) {
                    $('#search').attr('disabled', false);
                    $('#search').text('Search');
                    console.log(response);
                    const datatable = $('#datatable');
                    datatable.DataTable().destroy();
                    var tableBody = $('#tableData');
                    tableBody.empty(); // Clear any existing rows
                    // Loop through each separation record and append a row
                    response.forEach(function(inandpro) {
                        var row = `<tr>
                            <td>
                              <input type="checkbox" class="select" data-id="${inandpro.id}">
                            </td>
                            <td>${inandpro.employee_code}</td>
                            <td>${inandpro.first_name}</td>
                            <td>${inandpro.department}</td>
                            <td>${inandpro.designation}</td>
                            <td>${inandpro.promotedDesignation}</td>
                            <td>${inandpro.promotedAmount}</td>
                        </tr>`;
                        tableBody.append(row);
                    });
                    datatable.DataTable({
                        // order: [
                        //     [1, 'desc']
                        // ],
                        lengthMenu: [10, 20, 50, 100],
                    })
                },
                error: function(xhr, status, error) {
                    $('#search').attr('disabled', false);
                    $('#search').text('Search');
                    toastr.error("An error occurred. Please check the console for details.");
                }
            })
        }
    </script>
@stop
