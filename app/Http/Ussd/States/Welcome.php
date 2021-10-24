<?php

namespace App\Http\Ussd\States;

use App\Models\Course;
use Sparors\Ussd\State;

class Welcome extends State
{
    protected function beforeRendering(): void
    {
        $courses = Course::pluck('title')->toArray();
        $this->record->pageNo = 1;

        $this->menu->text('CON Welcome To Agriculture training center')
            ->lineBreak(2)
            ->line('Select a course')
            ->paginateListing(
                $courses
                , 1, 5, ':')
            ->lineBreak(1)
            ->line('97:Ask a question')
            ->line('98:More')
            ->line('0:Exit');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->course = $argument;
        $this->decision->equal('98', Next::class)
                       ->between(1, 5, Subtopic::class)
                       ->equal('97', AskQuestion::class)
                       ->equal('0', Logout::class)
                       ->any(Error::class);
    }
}
