<?php

namespace App\Jobs;

use Slack;
use App\Person;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifySlack extends Job implements ShouldQueue
{
    protected $person;

    use InteractsWithQueue, SerializesModels;

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
        Slack::send("A new person {$this->person->name} has just been added to our system");
    }
}
