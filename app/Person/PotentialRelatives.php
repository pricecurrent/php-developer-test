<?php

namespace App\Person;

use App\Person;

class PotentialRelatives
{
    protected $person;
    protected $familyId;

    public function __construct(Person $person, $familyId)
    {
        $this->person = $person;
        $this->familyId = $familyId;
    }

    public function mothers()
    {
        if ($this->person->hasMother()) return [];

        return Person::whereGender('female')->whereNull('family_id')->where('id', '!=', $this->person->id)->get();
    }

    public function fathers()
    {
        if ($this->person->hasFather()) return [];

        return Person::whereGender('male')->whereNull('family_id')->where('id', '!=', $this->person->id)->get();
    }

    public function spouses()
    {
        if ($this->person->hasSpouse()) return [];

        $desiredGender = $this->person->gender == 'male' ? 'female' : 'male';

        return Person::whereGender($desiredGender)
            ->where('id', '!=', $this->person->id)
            ->whereNull('spouse_id')
            ->whereNull('family_id')
            ->get();
    }

}