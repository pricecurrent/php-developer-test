<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $fillable = ['family_name'];

    public function people()
    {
        return $this->hasMany(Person::class);
    }

    public function add(Person $person)
    {
        return $this->people()->save($person);
    }
}
