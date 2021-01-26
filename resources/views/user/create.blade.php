@extends('layouts.dashboard')

@section('title', 'Create User')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="m-0 p-0 float-left">Create User</h3>
            @can('list_users')
            <a href="/dashboard/users" role="button" class="btn btn-outline-primary float-right">Back to List</a>
            @endcan
        </div>
        <div class="card-body">
            {!! form($form) !!}
        </div>
    </div>
@stop


