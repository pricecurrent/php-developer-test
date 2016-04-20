<?php

namespace App\Jobs;

use App\Person;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeNewFamilyMembers extends Job
{
    protected $person;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->attachNewMembersToCurrentFamily();

        $this->relateMotherAndFather();
    }

    protected function relateMotherAndFather()
    {
        $mother = $this->person->mother;
        $father = $this->person->father;

        if ($mother && $father) {
            $mother->spouse_id = $father->id;
            $father->spouse_id = $mother->id;
            $mother->save();
            $father->save();
        }
    }

    protected function attachNewMembersToCurrentFamily()
    {
        $family_id = $this->person->family_id;

        $father = $this->person->father;
        if ($father) {
            $father->family_id = $family_id;
            $this->person->father->save();
        }

        $mother = $this->person->mother;
        if ($mother) {
            $mother->family_id = $family_id;
            $this->person->mother->save();
        }

        $spouse = $this->person->spouse;
        if ($spouse) {
            $spouse->family_id = $family_id;
            $this->person->spouse->save();
        }
    }
}
