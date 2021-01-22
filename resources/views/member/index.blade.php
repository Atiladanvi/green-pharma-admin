@extends('adminlte::page')

@section('title', 'Members')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="m-0 p-0 float-left">Members</h3>
            <a href="/dashboard/member/create" role="button" class="btn btn-outline-primary float-right">New Member</a>
        </div>
        <div class="card-body">
            <x-octo-table :table="$table"/>
        </div>
    </div>
    <style>
        .material-icons {
            color: white !important;
        }
    </style>
@stop


