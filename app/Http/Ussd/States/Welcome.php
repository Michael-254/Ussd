<?php

namespace App\Http\Ussd\States;

use App\Models\Course;
use Sparors\Ussd\State;

class Welcome extends State
{
    protected function beforeRendering(): void
    {
        $courses = Course::pluck('title')->toArray();
        $pages= $courses->count()/5;
        $this->menu->text('Welcome To Agriculture training center')
            ->lineBreak(2)
            ->line('Select a course')
            ->paginateListing(
                $courses
                , 1, $pages, '. ')
            ->lineBreak(2)
            ->line('98. Next Page')
            ->line('#. Back')
            ->line('Main Menu');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1', Airtime::class)
                       ->between(2, 4, Payment::class)
                       ->in(['9', '#'], Wait::class)
                       ->any(Error::class);
    }
}
