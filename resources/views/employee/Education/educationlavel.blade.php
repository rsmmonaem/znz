@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Education Level</li>
    </ul>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <!-- Cost Unit Type Form -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Education Level</h3>
                            </div>
                            <div class="panel-body">
                                <form id="jobNatureForm" class="form-inline">
                                    <div class="form-group">
                                        <input type="text" id="name" class="form-control"
                                            placeholder="Education Level" required>
                                    </div>
                                    <button type="button" id="saveBtn" class="btn btn-primary">Education Level</button>
                                </form>
                            </div>
                        </div>

                        <!-- Cost Unit Type Table -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Education Level List</h3>
                            </div>
                            <div class="panel-body">
                                <table id="EducationLavelTable" class="table table-striped">
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
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <!-- Cost Unit Type Form -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Class/Subject</h3>
                            </div>
                            <div class="panel-body">
                                <form id="jobNatureForm" class="form-inline">
                                    <div class="form-group">
                                        <input type="text" id="name_class" class="form-control"
                                            placeholder="Class/Subject" required>
                                    </div>
                                    <button type="button" id="ClassSubjectSaveBtn" class="btn btn-primary">Class/Subject</button>
                                </form>
                            </div>
                        </div>

                        <!-- Cost Unit Type Table -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Class/Subject List</h3>
                            </div>
                            <div class="panel-body">
                                <table id="ClassSubjectTable" class="table table-striped">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            // Load job natures on page load
            loadJobNatures();
            loadClassSubject();

            // Save job nature
            $('#saveBtn').on('click', function(e) {
                e.preventDefault();
                var name = $('#name').val();
                $.ajax({
                    url: '/education-lavel-create',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name,
                    },
                    success: function(response) {
                        toastr.success('Education Level added successfully.');
                        loadJobNatures();
                        $('#name').val('');
                        window.location.reload();
                    }
                });
            });
            
            $('#ClassSubjectSaveBtn').on('click', function(e) {
                e.preventDefault();
                var name = $('#name_class').val();
                $.ajax({
                    url: '/class-subject-create',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name,
                    },
                    success: function(response) {
                        toastr.success('Education Level added successfully.');
                        loadClassSubject();
                        $('#name').val('');
                        window.location.reload();
                    }
                });
            });

            // Load job natures into table
            function loadJobNatures() {
                $.get('/education-lavel-list', function(response) {
                    var rows = '';
                    $.each(response, function(index, item) {
                        rows += `
                        <tr data-id="${item.id}">
                            <td>${item.name}</td>
                            <td>
                                <button class="btn btn-danger btn-sm deleteBtn">Delete</button>
                            </td>
                        </tr>
                    `;
                    });
                    $('#EducationLavelTable tbody').html(rows);
                });
            }
            function loadClassSubject() {
                $.get('/class-subject-list', function(response) {
                    var rows = '';
                    $.each(response, function(index, item) {
                        rows += `
                        <tr data-id="${item.id}">
                            <td>${item.name}</td>
                            <td>
                                <button class="btn btn-danger btn-sm deleteClassSubject">Delete</button>
                            </td>
                        </tr>
                    `;
                    });
                    $('#ClassSubjectTable tbody').html(rows);
                });
            }

            // Delete job nature
            $(document).on('click', '.deleteBtn', function() {
                var confirmDelete = confirm('Are you sure you want to delete this job nature?');
                if (!confirmDelete) {
                    return;
                }
                var row = $(this).closest('tr');
                var id = row.data('id');
                $.ajax({
                    url: '/education-lavel-delete/' + id,
                    method: 'post',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        loadJobNatures();
                    }
                });
            }); 
            
            $(document).on('click', '.deleteClassSubject', function() {
                var confirmDelete = confirm('Are you sure you want to delete this job nature?');
                if (!confirmDelete) {
                    return;
                }
                var row = $(this).closest('tr');
                var id = row.data('id');
                $.ajax({
                    url: '/class-subject-delete/' + id,
                    method: 'post',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        toastr.success('Class/Subject deleted successfully.');
                        loadClassSubject();
                    }
                });
            });
        });
    </script>
@endsection
