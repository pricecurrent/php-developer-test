<?php

namespace App\Http\Controllers;

use App\Family;
use App\Person;
use App\Http\Requests;
use Illuminate\Http\Request;

class FamiliesController extends Controller
{
    public function index()
    {
        return Family::all();
    }

    public function store(Request $request)
    {
        Family::create($request->all());

        return response()->json([
            'status' => 'ok'
        ]);
    }

    public function availablePositions(Request $request)
    {
        if (! $request->exists('personId')) return false;

        $person = Person::findOrFail($request->get('personId'));

        return $person->potentialRelatives($request->get('familyId'));
    }

    public function potentialMothers(Request $request)
    {
        # code...
    }
}
