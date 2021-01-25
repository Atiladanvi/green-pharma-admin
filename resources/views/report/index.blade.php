@extends('layouts.dashboard')

@section('title', 'Members')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <h3 class="m-0 p-0 float-left">Report</h3>
        @can('upload_report')
        <a href="/dashboard/report/upload" role="button" class="btn btn-outline-primary float-right">New Upload</a>
        @endcan
    </div>
    <div class="card-body">
        {{ $table }}
    </div>
</div>
@stop
