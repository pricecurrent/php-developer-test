@extends('layouts.app', ['currentView' => 'peopleView'])

@section('content')
    <add-person :show.sync="showNewPersonModal"></add-person>
    <add-family :show.sync="showNewFamilyModal"></add-family>
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h3 class="panel-title pull-left">People with no family :(</h3>
                <span class="pull-right">
                    <button @click="addPerson" class="btn btn-sm btn-default">Add people</button>
                </span>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item"
                        v-for="person in orphans"
                    >
                        <a :href="'/people/' + person.id">
                            @{{ person.name }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h3 class="panel-title pull-left">People with family :)</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                @foreach ($people as $person)
                    <li class="list-group-item">
                        <a href="/people/{{ $person->id }}">
                            {{ $person->name }}
                        </a>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h3 class="panel-title pull-left">
                    Families
                </h3>
                <div class="pull-right">
                    <button class="btn btn-default" @click="addFamily">Add</button>
                </div>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item clearfix"
                        v-for="family in families"
                    >
                        @{{ family.family_name }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
@stop