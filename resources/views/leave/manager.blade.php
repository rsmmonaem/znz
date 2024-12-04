@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Leave Approval Panel</li>
    </ul>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12" id="box-detail">
            <div class="box-info">
                <h2>Leave Approval Panel</h2>

                <!-- Add a scrollable container for the table -->
                <div class="table-responsive" id="table-container">
                    <table id="employeeTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>SL No</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Form Date</th>
                                <th>To Date</th>
                                <th>Applied Days</th>
                                <th>Balance</th>
                                <th>Leaves Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dynamic data should populate here -->
                        </tbody>
                    </table>
                </div>
                <!-- End of scrollable container -->
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#Updatemodal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var id = button.data('id'); // Extract info from data-* attributes
                var modal = $(this);
                modal.find('#id').val(id);
            });

            refreshTable();
            function refreshTable() {
                const table_container = $('#table-container');
                $.ajax({
                    url: '/leave/lists-manager',
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                    },
                    success: function(data) {
                        populateEmployeeTable(data);
                    },
                    error: function(xhr, status, error) {
                    console.log(error)
                    }
                });

            }
            function populateEmployeeTable(data) {
                const datatable = $('#employeeTable');
                datatable.DataTable().destroy(); // Destroy existing table instance if exists
                let tableBody = $('#employeeTable tbody');
                tableBody.empty(); // Clear existing rows

                // Append the data row
                data.forEach((item, index) => {
                    tableBody.append(`
						<tr>
							<td>
                                <div class="btn-group btn-group-xs">
                                   <a href="#" class="btn btn-default btn-xs btn-approve" data-toggle="tooltip" title="Approve" data-name="${item.first_name}" data-employee_id="${item.employee_id}" data-id="${item.id}" ><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></a>
                                </div>
                            </td>
							<td>${index + 1}</td>
							<td>${item.employee_id || 'N/A'}</td>
							<td>${item.first_name || 'N/A'}</td>
							<td>${item.designation_name || 'N/A'}</td>
							<td>${item.department_name || 'N/A'}</td>
							<td>${item.from_date || 'N/A'}</td>
							<td>${item.to_date || 'N/A'}</td>
							<td>${item.appliedDays || 'N/A'}</td>
							<td>${item.balance || 'N/A'}</td>
							<td>${item.lname || 'N/A'}</td>
							<td>${item.status || 'N/A'}</td>
						</tr>
					`);
                });

                const table = datatable.DataTable({
                    lengthMenu: [10, 20, 50, 100],
                    paging: true,
                    autoWidth: true,
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'excelHtml5',
                            text: 'Export to Excel',
                            title: 'Employee Details',
                        },
                        {
                            extend: 'print',
                            text: 'Print',
                            title: 'Employee Details',
                            customize: function(win) {
                                $(win.document.body)
                                    .css('font-size', '10pt')
                                    .find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                            },
                        },
                    ],
                    columnDefs: [{
                            targets: [0],
                            orderable: true
                        }, 
                    ],
                });
            }


            // Approve Leave
             $(document).on('click', '.btn-approve', function() {
                    const name = $(this).data('name');  // Get the current arrear amount
                    const id = $(this).data('id');  // Get the ID of the clicked element
                    const employee_id = $(this).data('employee_id');  // Get the name of the clicked employee
                    // Create the modal
                    console.log(id);

                    const modal = $('<div class="modal fade" id="UpdateModal" tabindex="-1" role="dialog" aria-labelledby="UpdateModal" aria-hidden="true">');
                    modal.html(`
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="UpdateModalLabel">Edit Leave Status</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to edit the Employee for <strong>${name}</strong>?</p>
                                    <label for="Status">Status</label>
                                    <select class="form-control" id="Status">
                                        <option value="approve">Approve</option>
                                        <option value="reject">Reject</option>
                                    </select>

                                    <label for="reamrk">Remark</label>
                                    <input type="text" class="form-control" id="remark">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="SaveStatus" data-id="${id}" data-employee_id="${employee_id}">Save</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    `);

                    // Append the modal to the body
                    $('body').append(modal);

                    // Show the modal
                    $('#UpdateModal').modal('show');

                    // Handle save button click
                    $('#SaveStatus').on('click', function() {
                        const status = $('#Status').val();  // Get the new arrear amount from the input field
                        const id = $(this).data('id');  // Get the ID
                        const employee_id = $(this).data('employee_id');  // Get the old arrear amount
                        
                        // Make the AJAX request to update the arrear amount
                        $.ajax({
                            url: '/leave/update-leave-status',
                            method: 'POST',
                            data: {
                                id: id,
                                employee_id: employee_id,
                                status: status,
                                remark: $('#remark').val()
                            },
                            success: function(response) {
                               refreshTable();
                               toastr.success(response.message);
                               console.log(response);
                               $('#UpdateModal').modal('hide');
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);  // Log any errors
                                toastr.error('An error occurred while updating the arrear amount.');
                            }
                        });
                    });

                    // Close modal on clicking outside or pressing the escape key
                    $('#UpdateModal').on('hidden.bs.modal', function() {
                        $(this).remove();  // Remove modal from the DOM after it is closed
                    });
                });
        })
    </script>
@stop
