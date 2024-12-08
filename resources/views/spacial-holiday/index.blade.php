@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Spacial Holiday</li>
    </ul>
@stop

@section('content')
    <div class="row">
        @if (Entrust::can('create_holiday'))
            <div class="col-sm-4">
                <div class="box-info">
                    <h2><strong>{!! trans('messages.add_new') !!}</strong></h2>
                    {!! Form::open([
                        'route' => 'spacial-holiday.store',
                        'role' => 'form',
                        'class' => 'holiday-form',
                        'id' => 'holiday-form',
                        'data-form-table' => 'holiday_table',
                    ]) !!}
                    @include('spacial-holiday._form')
                    {!! Form::close() !!}
                </div>
            </div>
        @endif
        @if (Entrust::can('list_holiday'))
            <div class="col-sm-8">
                <div class="box-info full">
                    <h2><strong>{!! trans('messages.list_all') !!}</strong> Spacial Holiday</h2>
                    {{-- @include('common.datatable',['col_heads' => $col_heads]) --}}
				<div class="table-responsive" style="margin:20px">	
                    <table class="table table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>ID</th>
                                <th>Branch Name</th>
                                <th>Date</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <!-- Rows will go here -->
                        </tbody>
                    </table>
				</div>
            </div>
            </div>
    </div>
    @endif
    </div>
@stop


@section('javascript')
    <script>
		$(document).ready(function() {
            getSeparationData();
            $('body').attr('aria-hidden', 'true'); // Hide background content
  		    $(this).removeAttr('aria-hidden');  
        // Handle form submission
		$('.Spacial-Holiday-save').on('click', function(e){
			  e.preventDefault(); 
            // Get data from form fields by name
            const formData = {
                date: $('[name="date"]').val(),
                branch: $('[name="branch"]').val(),
                description: $('#description').val(),
            };

           // Send AJAX request
            $.ajax({
                url: '{{ route("spacial-holiday.store") }}', 
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', 
                },
                success: function (response) {
                    // Handle success
                    console.log(response);
                    toastr.success('Spacial Holiday Added Successfully');
                    getSeparationData();
                    $('#holiday-form')[0].reset();
                },
                error: function (xhr, status, error) {
                    // Handle error
                    toastr.error(xhr.responseText);
                }
            });
		});

        $(document).on('click', '#deleteHoliday', function(e) {
            e.preventDefault();
            if(confirm('Are you sure you want to delete this Spacial Holiday?'))
            var id = $(this).data('id');
            $.ajax({
                url: '/spacial-holiday/' + id,
                type: 'POST', 
                success: function(response) {
                    getSeparationData();
                    toastr.success('Spacial Holiday Deleted Successfully');
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });

        function getSeparationData() {
            $.ajax({
                url: '/spacial-holiday/lists',
                type: 'POST',
                success: function(response) {
                    const datatable = $('#datatable');
                    datatable.DataTable().destroy();
                    var tableBody = $('#tbody');
                    tableBody.empty(); // Clear any existing rows
                    // Loop through each separation record and append a row
                    response.forEach(function(separation) {
                        var row = `<tr>
                            <td>
                                <div class="btn-group btn-group-xs dflex">
                                    <a href="#" data-href="/spacial-holiday/${separation.id}/edit" class="btn btn-default btn-xs md-trigger" data-toggle="modal" data-target="#myModal"> <i class="fa fa-edit" data-toggle="tooltip" title="{{trans('messages.edit')}}"></i></a>
                                    <a href="#" data-id="${separation.id}" class="btn btn-danger btn-xs" id="deleteHoliday"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                            <td>${separation.id}</td>
                            <td>${separation.bname || ' '}</td>
                            <td>${separation.date}</td> 
                            <td>${separation.description || ' '}</td> 
                        </tr>`;
                        tableBody.append(row);
                    });
                    datatable.DataTable({
                        lengthMenu: [10, 20, 50, 100],
                    })
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        }
    });
	</script>
@stop
