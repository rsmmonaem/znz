@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.leave') !!}</li>
    </ul>
@stop

@section('content')
{{-- 
    <div class="container card">
        <h2>Employee Management Leave Requests</h2>
        <!-- Filter Controls -->
        <div class="row">
            <div class="col-md-3">
                <select class="form-control input-xlarge select2me" id="status" name="status"
                    title="Leave Management Status">
                    <option value="pending">Pending</option>
                    <option value="approved" selected="selected">Approved</option>
                    <option value="lwp">LWP</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>

            <div class="col-md-9">
                <button id="filterPending" class="btn btn-primary">Filter</button>
            </div>
        </div>
        <br />
        <!-- Table -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Actions</th>
                    <th>Employee Name</th>
                    <th>Leave Type</th>
                    <th>Request Duration</th>
                    <th>Approved Duration</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leaves as $leave)
                    @php
                        // Determine the leave duration
                        if ($leave->from_date == $leave->to_date) {
                            $leave_duration = showDate($leave->from_date);
                        } else {
                            $leave_duration =
                                showDate($leave->from_date) .
                                ' ' .
                                trans('messages.to') .
                                ' ' .
                                showDate($leave->to_date);
                        }

                        $days_count = dateDiff($leave->from_date, $leave->to_date);

                        // Approved dates logic
                        if ($leave->approved_date && count(explode(',', $leave->approved_date)) != $days_count) {
                            $approved_dates = explode(',', $leave->approved_date);
                            $leave_approved = '<ol>';
                            foreach ($approved_dates as $approved_date) {
                                $leave_approved .= '<li>' . showDate($approved_date) . '</li>';
                            }
                            $leave_approved .= '</ol>';
                        } elseif ($leave->approved_date && count(explode(',', $leave->approved_date)) == $days_count) {
                            $leave_approved = $leave_duration;
                        } else {
                            $leave_approved = '';
                        }
                    @endphp

                    <tr>
                        <td>
                            <div class="btn-group btn-group-xs">
                                <a href="/leave/{{ $leave->id }}" class="btn btn-default btn-xs" data-toggle="tooltip"
                                    title="{{ trans('messages.view') }}">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                                
                                        <a href="#" data-href="/leave/{{ $leave->id }}/edit"
                                            class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-edit" data-toggle="tooltip"
                                                title="{{ trans('messages.edit') }}"></i>
                                        </a>
                               
                                       <form method="POST" action="{{ route('leave.destroy', $leave->id) }}" accept-charset="UTF-8" class="form-inline" style="display:inline;">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="return confirm('Are you sure you want to delete this leave?')">
									<i class="fa fa-trash-o"></i>
								</button>
							</form>
                               
                            </div>
                        </td>
                        <td>{{ $leave->User->full_name_with_designation }}</td>
                        <td>{{ $leave->LeaveType->name }}</td>
                        <td>{!! $leave_duration !!}</td>
                        <td>{!! $leave_approved !!}</td>
                        <td>{{ trans('messages.' . $leave->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
       <div class="pagination-container">
			  {!! $leaves->links() !!}
		</div>

    </div> --}}
	
    <div class="row">
			@if (Entrust::can('request_leave'))
			<div class="col-sm-12 collapse" id="box-detail">
				<div class="row">
					<div class="col-sm-4">
						<div class="box-info">
							<h2><strong>{{ trans('messages.leave') }}</strong> {{ trans('messages.statistics') }}</h2>
							<div id="leave-statistics">
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="box-info">
							<h2><strong>{!! trans('messages.request') !!}</strong> {!! trans('messages.leave') !!}
							<div class="additional-btn">
								<button class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#box-detail"><i class="fa fa-minus icon"></i> {!! trans('messages.hide') !!}</button>
							</div></h2>
							{!! Form::open(['route' => 'leave.store','role' => 'form', 'class'=>'leave-form','id' => 'leave-form','data-form-table' => 'leave_table']) !!}
								@include('leave._form')
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
			@endif

			<div class="col-sm-12">
				<div class="box-info full">
					<h2><strong>{!! trans('messages.list_all') !!}</strong> {!! trans('messages.leave').' '.trans('messages.request') !!}
					@if (Entrust::can('request_leave'))
					<div class="additional-btn">
						<a href="#" data-toggle="collapse" data-target="#box-detail"><button class="btn btn-sm btn-primary"><i class="fa fa-plus icon"></i> {!! trans('messages.request') !!}</button></a>
					</div>
					@endif
					</h2>
					@include('common.datatable',['col_heads' => $col_heads])
				</div>
			</div>
		</div>

		{{-- <div class="row" id="leave-graph">
		@foreach ($leave_types as $leave_type)
				<div class="col-md-12">
					<div class="box-info">
						<div id="{{\App\Classes\Helper::createSlug($leave_type)}}-graph"></div>
					</div>
				</div>
		@endforeach
		</div> --}}

@stop
