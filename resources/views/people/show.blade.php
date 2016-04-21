@extends('layouts.app', ['currentView' => 'PersonView'])

@section('content')

    <div class="panel panel-info">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left">{{ $person->name }}</h3>
            <div class="pull-right">
                @if ($person->isOrphan())
                <button class="btn btn-sm btn-default"
                        v-on:click="giveFamilyModal = true"
                >
                    Give a Family
                </button>
                @else
                    <a class="btn btn-sm btn-info" href="/families/{{ $person->family_id }}">view family tree</a>
                @endif
            </div>
        </div>
        <div class="panel-body">
            @if ($person->isOrphan())
                <p>This poor little guy has no family yet, assign one for him!</p>
            @else
                <strong>Mother: </strong>{{ $person->mother ? $person->mother->name : '' }} <br><br>
                <strong>Father: </strong>{{ $person->father ? $person->father->name : '' }} <br><br>
                <strong>Spouse:</strong> {{ $person->spouse ? $person->spouse->name : '' }} <br><br>
                <strong>Siblings:</strong>
                @if ($person->siblings())
                    <ul class="list-group">
                        @foreach ($person->siblings() as $sibling)
                            <li class="list-group-item">{{ $sibling->name }}</li>
                        @endforeach
                    </ul>
                @endif
                <br> <br>
                <strong>Children:</strong>
                @if ($person->children())
                    <ul class="list-group">
                        @foreach ($person->children() as $person)
                            <li class="list-group-item">{{ $person->name }}</li>
                        @endforeach
                    </ul>
                @endif
                <br> <br>
            @endif
        </div>
    </div>
@stop

@section('modals')
    <give-family person-id="{{ $person->id }}" :show.sync="giveFamilyModal"></give-family>
@stop