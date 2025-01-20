@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Tax Bank Branch</li>
    </ul>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <!-- Tax Bank Form -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add New Tax Bank Branch</h3>
                    </div>
                    <div class="panel-body">
                        <form id="jobNatureForm" class="form-inline">
                            <div class="form-group">
                                <select class="form-control" id="taxbank">
                                    <option value="">Select Tax Bank</option>
                                    @foreach ($bank as $tb)
                                       <option value="{{ $tb->id }}">{{ $tb->name }}</option>
                                    @endforeach
                                </select>
                                <input type="text" id="name" class="form-control" placeholder="Tax Bank Branch Name"
                                    required>
                                 <input type="text" id="description" class="form-control" placeholder="description"
                                    required>
                            </div>
                            <button type="button" id="saveBtn" class="btn btn-primary">Add Tax Bank Branch</button>
                        </form>
                    </div>
                </div>

                <!-- Tax Bank Table -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tax Bank Branch List</h3>
                    </div>
                    <div class="panel-body">
                        <table id="jobNatureTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Branch Name</th>
                                    <th>Bank Name</th>
                                    <th>Description</th>
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
                                <h4 class="modal-title" id="editModalLabel">Edit Tax Bank</h4>
                            </div>
                            <div class="modal-body">
                                <select class="form-control" id="edittaxbank" style="margin-bottom: 10px">
                                    <option value="">Select Tax Bank</option>
                                    @foreach ($bank as $tb)
                                       <option value="{{ $tb->id }}">{{ $tb->name }}</option>
                                    @endforeach
                                </select>
                                <input type="text" id="editName" style="margin-bottom: 10px" class="form-control" required>
                                <input type="text" id="editDescription" style="margin-bottom: 10px" class="form-control" required>
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
                    url: '/tax-bank-branch',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name,
                        description: description,
                        tax_bank_id: $('#taxbank').val(),
                    },
                    success: function(response) {
                        toastr.success('Tax Bank Branch added successfully.');
                        loadJobNatures();
                        $('#name').val('');
                        $('#description').val('');
                        window.location.reload();
                    }
                });
            });

            // Load job natures into table
            function loadJobNatures() {
                $.get('/tax-bank-branch', function(response) {
                    var rows = '';
                    $.each(response, function(index, item) {
                        rows += `
                        <tr data-id="${item.bid}">
                            <td>${item.branchname}</td>
                            <td>${item.name}</td>
                            <td>${item.bdescription}</td>
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
                var description = row.find('td').eq(2).text();
                $('#editName').val(name);
                $('#editDescription').val(description);
                $('#editModal').modal('show');

                // Update job nature
                $('#updateBtn').on('click', function() {
                    $.ajax({
                        url: '/tax-bank-branch/' + id,
                        method: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}',
                            name: $('#editName').val(),
                            description: $('#editDescription').val(),
                            tax_bank_id: $('#edittaxbank').val(),
                            id: id
                        },
                        success: function(response) {
                            loadJobNatures();
                            $('#editModal').modal('hide');
                            // window.location.reload();
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
                    url: '/tax-bank-branch/' + id,
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
