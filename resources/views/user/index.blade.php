@extends('layouts.dashboard')

@section('title', 'List Users')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <h3 class="m-0 p-0 float-left">Users</h3>
        @can('create_user')
            <a href="/dashboard/user/create" role="button" class="btn btn-outline-primary float-right">New User</a>
        @endcan
    </div>
    <div class="card-body">
        {{ $table }}
    </div>
</div>
@stop
