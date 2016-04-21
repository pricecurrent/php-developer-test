<?php

namespace App\Person;

use App\Family;
use App\Person;

trait InteractsWithRelatives
{
    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function father()
    {
        return $this->belongsTo(Person::class, 'father_id');
    }

    public function mother()
    {
        return $this->belongsTo(Person::class, 'mother_id');
    }

    public function spouse()
    {
        return $this->belongsTo(Person::class, 'spouse_id');
    }

    public function siblings()
    {
        if (! $this->father_id || ! $this->mother_id) return [];

        $query = Person::where('id', '!=', $this->id);
        $query = $query->whereFatherId($this->father_id)->whereMotherId($this->mother_id);

        return $query->get();
    }

    public function children()
    {
        if ($this->gender == 'male') {
            return Person::whereFatherId($this->id)->get();
        }

        return Person::whereMotherId($this->id)->get();
    }

    public function hasFamily()
    {
        return $this->family;
    }

    public function hasMother()
    {
        return !! $this->mother_id;
    }

    public function hasFather()
    {
        return !! $this->father_id;
    }

    public function hasSpouse()
    {
        return !! $this->spouse_id;
    }
}