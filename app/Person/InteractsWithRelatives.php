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