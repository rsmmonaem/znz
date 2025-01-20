@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Month Wise Adjustment Panel</li>
    </ul>
@stop
@section('content')
    <div class="row" style="overflow: auto">
        <div class="col-md-12" style="overflow: auto">
            <div class="box-info full" style="padding-bottom:20px; overflow: auto;">
                <h2 class="text-center"><strong>Month Wise Adjustment Panel</strong></h2>
                 <div class="container">
                    <!-- Entry Panel -->
                    <div class="panel-section">
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="taxfinancialyear">Tax Financial Year</label>
                                        <select class="form-control" id="taxfinancialyear">
                                            <option value="">Select</option>
                                             @foreach ($taxFinacialyear as $taxfinacialyear)
                                                 <option value="{{ $taxfinacialyear }}">{{ $taxfinacialyear }}</option>
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
                                      <label for="employee_id">Employee ID</label>
                                        <select class="form-control" id="employee_id" name="employee_id">
                                            {{-- <option value="">Select</option> --}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="action-buttons">
                                <button type="button" class="btn btn-primary" id="search">Search</button>
                                <button type="button" id="save" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-danger" onclick="window.location.reload();">Close</button>
                            </div>
                        </form>
                    </div>
                </div>

            <table class="table table-bordered month-table" id="month-table" style="width: 100%; padding: 10px; margin-top: 20px; display: none">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>July</th>
                    <th>August</th>
                    <th>September</th>
                    <th>October</th>
                    <th>November</th>
                    <th>December</th>
                    <th>January</th>
                    <th>February</th>
                    <th>March</th>
                    <th>April</th>
                    <th>May</th>
                    <th>June</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="emp_id"></td>
                    <td id="emp_name"></td>
                    <td><input type="number" id="july" style="width:60px; height:20px"  class="empty-box" oninput="calculateTotal()"></td>
                    <td><input type="number" id="aug" style="width:60px; height:20px"  class="empty-box" oninput="calculateTotal()"></td>
                    <td><input type="number" id="sep" style="width:60px; height:20px"  class="empty-box" oninput="calculateTotal()"></td>
                    <td><input type="number" id="oct" style="width:60px; height:20px"  class="empty-box" oninput="calculateTotal()"></td>
                    <td><input type="number" id="nov" style="width:60px; height:20px"  class="empty-box" oninput="calculateTotal()"></td>
                    <td><input type="number" id="dec" style="width:60px; height:20px"  class="empty-box" oninput="calculateTotal()"></td>
                    <td><input type="number" id="jan" style="width:60px; height:20px"  class="empty-box" oninput="calculateTotal()"></td>
                    <td><input type="number" id="feb" style="width:60px; height:20px"  class="empty-box" oninput="calculateTotal()"></td>
                    <td><input type="number" id="mar" style="width:60px; height:20px"  class="empty-box" oninput="calculateTotal()"></td>
                    <td><input type="number" id="apr" style="width:60px; height:20px"  class="empty-box" oninput="calculateTotal()"></td>
                    <td><input type="number" id="may" style="width:60px; height:20px" class="empty-box" oninput="calculateTotal()"></td>
                    <td><input type="number" id="jun" style="width:60px; height:20px"  class="empty-box" oninput="calculateTotal()"></td>
                    <td><input type="text" style="width:100px; height:20px" id="total" disabled></td>
                </tr>
            </tbody>
        </table>

            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#branch').on('change', function() {
                var branch_id = $(this).val();
                $('#employee_id').val('').trigger('change');
                HandleBranchWiseEmployees(branch_id, '#employee_id');
            });

            $('#search').on('click', function() {
                // $('#month-table tbody').empty();
                var branch_id = $('#branch').val();
                var employee_id = $('#employee_id').val();
                const clerarInput = document.querySelectorAll('.empty-box');
                const total = document.getElementById('total');
                total.value = '';
                clerarInput.forEach(input => {
                    input.value = '';
                });
                const formData = {
                    branch_id: branch_id,
                    employee_id: employee_id,
                    _token: '{{ csrf_token() }}',
                }
                $.ajax({
                    url: '/month-wise-adjutment-panel-search',
                    type: 'post',
                    data: formData,
                    success: function(response) {
                        if(response.data) {
                           $('#month-table').show();
                           $('#emp_id').text(response.data.employee_code);
                           $('#emp_name').text(response.data.name);
                        }
                    }
                })
            });

            $('#save').on('click', function() {
                var branch_id = $('#branch').val();
                var finacialyear = $('#taxfinancialyear').val();
                var employee_id = $('#employee_id').val();
                var july = $('#july').val();
                var aug = $('#aug').val();
                var sep = $('#sep').val();
                var oct = $('#oct').val();
                var nov = $('#nov').val();
                var dec = $('#dec').val();
                var jan = $('#jan').val();
                var feb = $('#feb').val();
                var mar = $('#mar').val();
                var apr = $('#apr').val();
                var may = $('#may').val();
                var jun = $('#jun').val();
                var total = $('#total').val();
                const formData = {
                    branch_id: branch_id,
                    employee_id: employee_id,
                    finacialyear: finacialyear,
                    july: july,
                    aug: aug,
                    sep: sep,
                    oct: oct,
                    nov: nov,
                    dec: dec,
                    jan: jan,
                    feb: feb,
                    mar: mar,
                    apr: apr,
                    may: may,
                    jun: jun,
                    total: total,
                    _token: '{{ csrf_token() }}',
                }
                $.ajax({
                    url: '/month-wise-adjutment-panel',
                    type: 'post',
                    data: formData,
                    success: function(response) {
                       toastr.success('Tax Month Wise Cost Unit Set Successfully.');
                       $('#emp_id').text('');
                       $('#emp_name').text('');
                       $('#july').val('');
                       $('#aug').val('');
                       $('#sep').val('');
                       $('#oct').val('');
                       $('#nov').val('');
                       $('#dec').val('');
                       $('#jan').val('');
                       $('#feb').val('');
                       $('#mar').val('');
                       $('#apr').val('');
                       $('#may').val('');
                       $('#jun').val('');
                       $('#total').val('');
                    }
                });
            })
        });
    </script>

     <script>
        function calculateTotal() {
            let total = 0;
            const inputs = document.querySelectorAll('.empty-box');
            
            inputs.forEach(input => {
                total += parseFloat(input.value) || 0; // Add the value of the input to the total
            });
            
            // Display the total in the "Total" column
            document.getElementById('total').value = total.toFixed(2); // Show total with 2 decimal points
        }
    </script>
@stop