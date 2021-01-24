@extends('layouts.dashboard')

@section('title', 'Members')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <h3 class="m-0 p-0 float-left">Members</h3>
        @can('create_member')
        <a href="/dashboard/member/create" role="button" class="btn btn-outline-primary float-right">New Member</a>
        @endcan
    </div>
    <div class="card-body">
        {{ $table }}
    </div>
</div>
@stop
