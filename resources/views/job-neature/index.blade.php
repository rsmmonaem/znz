@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Job Nature</li>
    </ul>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <!-- Job Nature Form -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add New Job Nature</h3>
                    </div>
                    <div class="panel-body">
                        <form id="jobNatureForm" class="form-inline">
                            <div class="form-group">
                                <label for="name">Job Nature Name</label>
                                <input type="text" id="name" class="form-control" placeholder="Job Nature Name"
                                    required>
                            </div>
                            <button type="submit" id="saveBtn" class="btn btn-primary">Add Job Nature</button>
                        </form>
                    </div>
                </div>

                <!-- Job Nature Table -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Job Nature List</h3>
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
                                <h4 class="modal-title" id="editModalLabel">Edit Job Nature</h4>
                            </div>
                            <div class="modal-body">
                                <input type="text" id="editName" class="form-control" required>
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
            $('#jobNatureForm').on('submit', function(e) {
                e.preventDefault();
                var name = $('#name').val();
                $.ajax({
                    url: '/job-nature',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name
                    },
                    success: function(response) {
                        loadJobNatures();
                        $('#name').val('');
                    }
                });
            });

            // Load job natures into table
            function loadJobNatures() {
                $.get('/job-nature', function(response) {
                    var rows = '';
                    $.each(response, function(index, item) {
                        rows += `
                        <tr data-id="${item.id}">
                            <td>${item.name}</td>
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
                $('#editName').val(name);
                $('#editModal').modal('show');

                // Update job nature
                $('#updateBtn').on('click', function() {
                    $.ajax({
                        url: '/job-nature/' + id,
                        method: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}',
                            name: $('#editName').val()
                        },
                        success: function(response) {
                            loadJobNatures();
                            $('#editModal').modal('hide');
                        }
                    });
                });
            });

            // Delete job nature
            $(document).on('click', '.deleteBtn', function() {
                var row = $(this).closest('tr');
                var id = row.data('id');
                $.ajax({
                    url: '/job-nature/' + id,
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
