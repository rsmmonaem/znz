@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.employee_separetion') !!}</li>
    </ul>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="container">
                    <h2 class="text-center">Employee Separation (Entry Panel)</h2>
                </div>
            </div>
        </div>
    </div>
@stop