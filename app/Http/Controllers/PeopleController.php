<?php

namespace App\Http\Controllers;

use App\Person;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Jobs\WelcomeNewFamilyMembers;

class PeopleController extends Controller
{
    public function index()
    {
        $currentView = 'peopleView';

        return view('people.index', compact('currentView'));
    }

    public function orphans()
    {
        return response()->json(Person::whereNull('family_id')->get());
    }

    public function store(Request $request)
    {
        Person::create($request->all());

        return response()->json([
            'status' => 'ok'
        ]);
    }

    public function show($id)
    {
        $person = Person::findOrFail($id);

        return view('people.show', compact('person'));
    }

    public function attachToFamily($personId, Request $request)
    {
        $person = Person::findOrFail($personId);

        $person->fill($request->all());

        $this->dispatch(new WelcomeNewFamilyMembers($person));

        $person->save();
    }
}
