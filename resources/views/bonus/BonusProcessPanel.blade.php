@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Bonus Process Panel</li>
    </ul>
@stop

@section('content')
    <style>
        .panel-section {
            margin: 20px 0;
        }

        .form-group {
            display: flex;
            align-items: center;
        }

        .form-group label {
            width: 150px;
            margin-right: 10px;
        }

        .form-group input,
        .form-group select {
            flex: 1;
        }

        .action-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .table-container {
            margin-top: 30px;
        }

        .iconrotate {
            font-size: 50px;
            display: block;
            margin: 10px auto;
        }

        .iconrotate.rotate {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(-360deg);
            }
        }

        button#rotateButton {
            padding: 10px 20px;
            font-size: 16px;
            background-color: transparent;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="container">
                    <h2 class="text-center">Bonus Process Panel</h2>
                    <!-- Entry Panel -->
                    <div class="panel-section">
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="group">Group</label>
                                        <select class="form-control" id="group">
                                            <option value="">Select</option>
                                            @foreach ($groups as $g)
                                                <option value="{{ $g->id }}" selected>{{ $g->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="branch">Branch</label>
                                        <select class="form-control" id="branch">
                                            <option value="">Select</option>
                                            @foreach ($branches as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <select class="form-control" id="department">
                                            <option value="">Select</option>
                                            @foreach ($departments as $d)
                                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Designation</label>
                                        <select class="form-control" id="designation">
                                            <option value="">Select</option>
                                            @foreach ($designation as $d)   
                                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="section">Section</label>
                                        <select class="form-control" id="section">
                                            <option value="">Select</option>
                                            @foreach ($section as $s)
                                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="employeeId">Employee ID</label>
                                        <select class="form-control" id="employeeId">
                                            <option value="">Select</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="religion">Religion</label>
                                        <select class="form-control" id="religion">
                                            <option value="">Select</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Hinduism">Hinduism</option>
                                            <option value="Christianity">Christianity</option>
                                            <option value="Buddhism">Buddhism</option>
                                            <option value="Judaism">Judaism</option>
                                            <option value="Sikhism">Sikhism</option>
                                            <option value="Jainism">Jainism</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="entryDate">Month</label>
                                        <select class="form-control" id="month">
                                            <option value="">Select</option>
                                            @for ($month = 1; $month <= 12; $month++)
                                                <option value="{{ $month }}" {{ $month == date('m') ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $month, 10)) }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="bonusType">Bonus Type</label>
                                        <select class="form-control" id="bonusType">
                                            <option value="">Select</option>
                                            @foreach ($bonusType as $bt)
                                                <option value="{{ $bt->id }}">{{ $bt->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="entryDate">Entry Date</label>
                                        <input type="date" class="form-control" id="entryDate" value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="effectiveDate">Effective Date</label>
                                        <input type="date" class="form-control" id="effectiveDate">
                                    </div>
                                </div>
                            </div>
                            <div class="action-buttons">
                                <button type="button" id="rotateButton">
                                    <span><img class="iconrotate" id="rotateIcon"
                                            src="https://www.emoji.family/api/emojis/1f504/openmoji/svg" alt=""
                                            style="width: 1.5em; height: 1.5em;" /></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script>
        $(document).ready(function() {
            $('#branch').on('change', function() {
                var branch_id = $(this).val();
                $('#employeeId').val('').trigger('change');
                HandleBranchWiseEmployees(branch_id, '#employeeId');
            });
            const $icon = $('#rotateIcon');
            $('#rotateButton').click(function() {
                // Start rotation
                $icon.addClass('rotate');
                const FormData = {
                   branch: $('#branch').val(),
                   department: $('#department').val(),
                   designation: $('#designation').val(),
                   section: $('#section').val(),
                   employeeId: $('#employeeId').val(),
                   religion: $('#religion').val(),
                   month: $('#month').val(),
                   bonusType: $('#bonusType').val(),
                   entryDate: $('#entryDate').val(),
                   effectiveDate: $('#effectiveDate').val(),
                };
                if(FormData.branch === '') {
                    return validate('Please select branch');
                }
                if(FormData.bonusType === '') {
                    return validate('Please select bonus type');
                }   
                if(FormData.entryDate === '') {
                    return validate('Please select entry date');
                }
                if(FormData.effectiveDate === '') {
                    return validate('Please select effective date');
                }      
                $.ajax({
                    url: "/bonus-process",
                    method: "POST",
                    data: FormData,
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#rotateIcon').removeClass('rotate');
                        if (response.status === 'success') {
                            toastr.success(response.message);
                        } else {
                            toastr.error('An error occurred.');
                        }
                    }
                })       
            });
            function validate(message) {
                toastr.error(message);
                $icon.removeClass('rotate');
            }
        });
    </script>
@stop
