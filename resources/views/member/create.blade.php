@extends('adminlte::page')

@section('title', 'Create Member')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="m-0 p-0 float-left">Create Member</h3>
            <a href="/dashboard/member" role="button" class="btn btn-outline-primary float-right">Back to List</a>
        </div>
        <div class="card-body">
            {!! form($form) !!}
        </div>
    </div>
@stop


