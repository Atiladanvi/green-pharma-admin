@extends('layouts.dashboard')

@section('title', 'Edit User')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="m-0 p-0 float-left">Edit User</h3>
            @can('list_users')
                <a href="/dashboard/users/" role="button" class="btn btn-outline-primary float-right">Back to list</a>
            @endcan
        </div>
        <div class="card-body">
            {!! form($form) !!}
        </div>
    </div>
@stop


