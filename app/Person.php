<?php

namespace App;

use App\Person\PotentialRelatives;
use App\Person\InteractsWithRelatives;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use InteractsWithRelatives;

    protected $fillable = ['family_id', 'father_id', 'mother_id', 'spouse_id', 'name', 'age', 'gender'];

    public function potentialRelatives($familyId)
    {
        $relatives = New PotentialRelatives($this, $familyId);

        return response()->json([
            'fathers' => $relatives->fathers(),
            'mothers' => $relatives->mothers(),
            'spouses' => $relatives->spouses(),
        ]);
    }

    public function isOrphan()
    {
        return !! $this->family_id ? false : true;
    }
}
