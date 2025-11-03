@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">WHD</li>
    </ul>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box-info">
                <h2><strong>WHD</strong> Create</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            @include('whd._form')

                            <div class="form-group">
                                <button type="button" id="save" class="btn btn-primary">Save WHD</button>
                            </div>
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
           $('#branch_id').on('change', function() {
               var branch_id = $(this).val();
               if (branch_id == 0) {
                   $('#branch_id').val('');
               }
               HandleBranchWiseEmployees(branch_id, '#employee_id');
           });

           $('#save').on('click', function() {
               $('#save').text('Please Wait...');
               $('#save').attr('disabled', true);
               const formData = {
                    branch_id: $('#branch_id').val(),
                    employee_id: $('#employee_id').val(),
                    group_id: $('#group_id').val(),
                    days: $("input[name='days[]']:checked").map(function() {
                        return $(this).val();
                    }).get(),
                    fromdate : $('#fromdate').val(),
                    todate : $('#todate').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
               };
               if(formData.branch_id == 0) {
                   return validate('Please select branch');
               }
               if(formData.date == '') {
                   return validate('Please select date');
               }
               if(formData.fromdate == '') {
                   return validate('Please select from date');
               }
               if(formData.todate == '') {
                   return validate('Please select to date');
               }

               $.ajax({
                   url: '/whd-create',
                   type: 'POST',
                   data: formData,
                   success: function(data) {
                    $('#save').text('Save WHD');
                    $('#save').attr('disabled', false);
                    toastr.success('WHD created successfully');
                   }
               });
           });
           function validate(data) {
               $('#save').attr('disabled', false).text('Save WHD');
               return toastr.error(data);
           }
        });
    </script>
@stop