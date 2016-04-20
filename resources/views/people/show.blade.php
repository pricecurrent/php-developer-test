@extends('layouts.app', ['currentView' => 'PersonView'])

@section('content')

    <div class="panel panel-info">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left">{{ $person->name }}</h3>
            <div class="pull-right">
                <button class="btn btn-sm btn-default"
                        v-on:click="giveFamilyModal = true"
                >
                    Give Family
                </button>
            </div>
        </div>
        <div class="panel-body">
            Panel content
        </div>
    </div>
@stop

@section('modals')
    <give-family person-id="{{ $person->id }}" :show.sync="giveFamilyModal"></give-family>
@stop