@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.employee_transfer') !!}</li>
    </ul>
@stop

@section('content')
    <style>
        .container {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .remarks-box {
            width: 100%;
            height: 60px;
            resize: none;
        }

        .btn-group {
            margin-top: 15px;
        }

        .table-container {
            margin-top: 30px;
        }
    </style>
    <div class="row">
        @if (Entrust::can('create_employee'))
            <div class="col-sm-12">
                <div class="box-info full">
                    <h2><strong>{!! trans('messages.employee_transfer') !!}</strong>
                        <div class="additional-btn">
                            {{-- @if (Entrust::can('create_employee'))
							<a href="#" data-toggle="collapse" data-target="#box-detail"><button class="btn btn-sm btn-primary"><i class="fa fa-plus icon"></i> {!! trans('messages.add_new') !!}</button></a>
							@endif --}}
                        </div>
                    </h2>
                    {{-- Transfer Form --}}
                    <div class="container">
                        {{-- <h3 class="text-center">Employee Transfer</h3> --}}
                        @include('employee_transfer._form')
                        <div class="btn-group" style="margin-bottom: 20px;">
                            <button type="button" class="btn btn-primary" id="save">Save</button>
                            <button type="button" class="btn btn-default" id="refresh">Refresh</button>
                            {{-- <button type="button" class="btn btn-danger">Close</button> --}}
                            <button type="reset" class="btn btn-danger" id="reset">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#save').on('click', function() {
                const fbranch = document.querySelector('select[name="fbranch"]').value;
                const fdepartment = document.querySelector('select[name="fdepartment"]').value;
                const fsection = document.querySelector('select[name="fsection"]').value;
                const fdesignation = document.querySelector('select[name="fdesignation"]').value;
                const ftransfer_date = document.querySelector('input[name="ftransfer_date"]').value;
                const femployee = document.querySelector('select[name="femployee"]').value;
                const tbranch = document.querySelector('select[name="tbranch"]').value;
                const tdepartment = document.querySelector('select[name="tdepartment"]').value;
                const tsection = document.querySelector('select[name="tsection"]').value;
                const tdesignation = document.querySelector('select[name="tdesignation"]').value;
                const tjoin_date = document.querySelector('input[name="tjoin_date"]').value;
                const remarks = document.querySelector('.remarks-box').value;
                const urlPath = window.location.pathname;
                const parts = urlPath.split('/');
                const id = parts[parts.length - 1]; 

                const formData = {
                    fbranch: fbranch,
                    fdepartment: fdepartment,
                    fsection: fsection,
                    fdesignation: fdesignation,
                    ftransfer_date: ftransfer_date,
                    femployee: femployee,
                    tbranch: tbranch,
                    tdepartment: tdepartment,
                    tsection: tsection,
                    tdesignation: tdesignation,
                    tjoin_date: tjoin_date,
                    remarks: remarks
                };

                $.ajax({
                    url: "{{ url('employee/transfer-edit') }}" + '/' + id,
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle success response
                        response.status == 'success' ? toastr.success(response.message) : toastr
                            .error(response.message);
                        // console.log(response);
                        getTransferData();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(error);
                    }
                })
            });
            $('#refresh').on('click', function() {
                location.reload();
            });
            $('#reset').on('click', function() {
                location.reload();
            });
        });
    </script>
@stop
