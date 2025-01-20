@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Cost Unit Type</li>
    </ul>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <!-- Cost Unit Type Form -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cost Unit Type</h3>
                    </div>
                    <div class="panel-body">
                        <form id="jobNatureForm" class="form-inline">
                            <div class="form-group">
                                <input type="text" id="name" class="form-control" placeholder="Cost Unit Type Name"
                                    required>
                                 <input type="text" id="description" class="form-control" placeholder="description"
                                    required>
                            </div>
                            <button type="button" id="saveBtn" class="btn btn-primary">Cost Unit Type</button>
                        </form>
                    </div>
                </div>

                <!-- Cost Unit Type Table -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cost Unit Type List</h3>
                    </div>
                    <div class="panel-body">
                        <table id="jobNatureTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be loaded here by AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal for editing -->
                <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="editModalLabel">Edit Cost Unit Type</h4>
                            </div>
                            <div class="modal-body">
                                <input type="text" id="editName" class="form-control" required>
                                <input type="text" id="editDescription" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="closeModal"
                                    data-dismiss="modal">Close</button>
                                <button type="button" id="updateBtn" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Load job natures on page load
            loadJobNatures();

            // Save job nature
            $('#saveBtn').on('click', function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var description = $('#description').val();
                $.ajax({
                    url: '/tax-cost-unit-type',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name,
                        description: description
                    },
                    success: function(response) {
                        toastr.success('Cost Unit Type added successfully.');
                        loadJobNatures();
                        $('#name').val('');
                        $('#description').val('');
                        window.location.reload();
                    }
                });
            });

            // Load job natures into table
            function loadJobNatures() {
                $.get('/tax-cost-unit-type', function(response) {
                    var rows = '';
                    $.each(response, function(index, item) {
                        rows += `
                        <tr data-id="${item.id}">
                            <td>${item.name}</td>
                            <td>${item.description}</td>
                            <td>
                                <button class="btn btn-warning btn-sm editBtn">Edit</button>
                                <button class="btn btn-danger btn-sm deleteBtn">Delete</button>
                            </td>
                        </tr>
                    `;
                    });
                    $('#jobNatureTable tbody').html(rows);
                });
            }

            // Edit job nature
            $(document).on('click', '.editBtn', function() {
                var row = $(this).closest('tr');
                var id = row.data('id');
                var name = row.find('td').eq(0).text();
                var description = row.find('td').eq(1).text();
                $('#editName').val(name);
                $('#editDescription').val(description);
                $('#editModal').modal('show');

                // Update job nature
                $('#updateBtn').on('click', function() {
                    $.ajax({
                        url: '/tax-cost-unit-type/' + id,
                        method: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}',
                            name: $('#editName').val(),
                            description: $('#editDescription').val(),
                            id: id
                        },
                        success: function(response) {
                            loadJobNatures();
                            $('#editModal').modal('hide');
                            window.location.reload();
                        }
                    });
                });
            });

            // Delete job nature
            $(document).on('click', '.deleteBtn', function() {
                var confirmDelete = confirm('Are you sure you want to delete this job nature?');
                if (!confirmDelete) {
                    return;
                }
                var row = $(this).closest('tr');
                var id = row.data('id');
                $.ajax({
                    url: '/tax-cost-unit-type/' + id,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        loadJobNatures();
                    }
                });
            });
        });
    </script>
@endsection
