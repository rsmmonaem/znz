@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">ID Card Checklist</li>
    </ul>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" id="id_card_checklist">
                <div class="panel-heading text-center">
                    <h2 class="panel-title">ID Card Checklist</h2>
                </div>
                <div class="panel-body">
                    <div class="container">
                        <!-- Header -->
                        <div class="header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                            <p style="margin: 0;">Date: {{ date('d-m-Y') }}</p>
                            <div class="form-inline" id="search-form">
                                <input type="text" id="search-input" class="form-control" placeholder="Search anything (ID, Name, Branch, etc.)" value="{{ Request::get('search') }}">
                                <button type="button" id="search-btn" class="btn btn-primary">Search</button>
                                <button type="button" id="reset-btn" class="btn btn-default" style="margin-left: 5px;">Reset</button>
                            </div>
                        </div>

                        <!-- Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Branch</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Department</th>
                                    <th>Section</th>
                                    <th>Check Box</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($id_card_checklist as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->branch_name }}</td>
                                        <td>{{ $item->employee_code }}</td>
                                        <td>{{ $item->first_name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->department_name }}</td>
                                        <td>{{ $item->section_name }}</td>
                                        <td><input type="checkbox" data-id="{{ $item->id }}" name="check"
                                                {{ $item->status == 1 ? 'checked' : '' }}></td>
                                        <td class="remarks">{{ $item->remarks }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No data found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="pagination" style="display: flex; justify-content: end;">
                            {{ $id_card_checklist->appends(request()->query())->links() }}
                        </div>
                        <!-- Buttons -->
                        <div class="text-center">
                            <button class="btn btn-primary" id="save">Save</button>
                            <button class="btn btn-default" id="close">Close</button>
                        </div>

                        <!-- Instructions -->
                        <div class="instructions" style="margin-top: 30px;">
                            <p>ID card provide check panel. When a new joiner is added, their ID appears here. After
                                completing the task, click the checkbox and save. This marks the ID card as provided.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#close').on('click', function() {
                window.location.reload();
            });
            $('#search-btn').on('click', function() {
                var searchValue = $('#search-input').val();
                window.location.href = "{{ url('/id-card-checklist') }}?search=" + encodeURIComponent(searchValue);
            });
            $('#reset-btn').on('click', function() {
                window.location.href = "{{ url('/id-card-checklist') }}";
            });
            $('#search-input').on('keypress', function(e) {
                if(e.which == 13) {
                    $('#search-btn').click();
                }
            });

            $('#save').on('click', function(e) {
                e.preventDefault();
                $(this).attr('disabled', true);
                $(this).text('Saving...');
                var data = [];

                // Iterate through all checkboxes
                $('input[name="check"]').each(function() {
                    var id = $(this).data('id');
                    var status = $(this).is(':checked') ? 1 : 0;
                    data.push({
                        id: id,
                        status: status
                    });
                });

                // If there are no checked boxes, do not send data
                if (data.length > 0) {
                    $.ajax({
                        url: '/id-card-checklist',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            data: data
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                toastr.success(response.message);
                                 $('input[name="check"]').each(function() {
                                    if ($(this).is(':checked')) {
                                        $(this).closest('tr').find('.remarks').text('ID Card Provided');
                                    } else {
                                        $(this).closest('tr').find('.remarks').text('');
                                    }
                                });
                                $('#save').attr('disabled', false);
                                $('#save').text('Save');
                            } else {
                                toastr.error(response.message);
                                $('#save').attr('disabled', false);
                                $('#save').text('Save');
                            }
                        },
                        error: function(xhr) {
                            toastr.error("Error: " + xhr.status + " " + xhr.statusText);
                            $('#save').attr('disabled', false);
                            $('#save').text('Save');
                        }
                    });
                } else {
                    toastr.warning("No rows found to save.");
                }
            });
        });
    </script>
@stop
