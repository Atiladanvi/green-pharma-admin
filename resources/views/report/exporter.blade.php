@extends('layouts.dashboard')

@section('title', 'Report Exporter')

@section('content')
    @if(session()->has('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success !</strong> {{ session('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session()->has('err'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error !</strong> {{ session('err') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="m-0 p-0 float-left">Report Exporter</h3>
            @can('import_report')
                <a
                    href="/dashboard/report/importer"
                    role="button"
                    class="btn btn-outline-primary float-right"
                >
                    New Upload
                </a>
            @endcan
            @if(request()->get('filter'))
                <a
                    href="{{ url()->full() . '&export=true' }}"
                    role="button"
                    class="btn @if(!isset($results) || $results->count() === 0) disabled @endif mx-2 btn-outline-success float-right"
                >
                    Export XLSX
                </a>
            @endif
            @if(!request()->get('filter'))
                <a
                    href="/dashboard/report/exporter?filter=true"
                    role="button"
                    class="btn mx-2 btn-outline-primary float-right"
                >
                    Filter
                </a>
            @else
                <a
                    href="/dashboard/report/exporter"
                    role="button"
                    class="btn btn-primary float-right"
                >
                    Filter
                </a>
            @endif
        </div>
        <div class="mx-3 mt-2">
            @if(request()->get('filter'))
                {!! form($form) !!}
            @endif
        </div>
        <div class="card-body">
            @if(!request()->get('filter'))
                {{ $table }}
            @elseif(isset($results) && $results->count() > 0)
                @include('report.table')
            @else
                <div class="container">
                    <h1 class="text-center">Empty</h1>
                    <p class="text-center">Try change filters</p>
                </div>
            @endif
        </div>
    </div>
@stop
