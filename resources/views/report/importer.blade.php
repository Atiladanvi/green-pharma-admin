@extends('layouts.dashboard')

@section('title', 'Report Importer')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="m-0 p-0 float-left">Report Importer</h3>
            @can('export_report')
            <a href="/dashboard/report/exporter" role="button" class="btn btn-outline-primary float-right">Go to Exporter</a>
            @endcan
        </div>
        <div class="card-body">
            {!! form($form) !!}
        </div>
    </div>
@stop


