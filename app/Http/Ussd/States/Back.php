<?php

namespace App\Http\Ussd\States;

use App\Models\Course;
use Sparors\Ussd\State;

class Back extends State
{
    protected function beforeRendering(): void
    {
        $previous_no = $this->record->get('pageNo');
        $current_page = (int)$previous_no - 1;
        $this->record->set('pageNo', $current_page);

        $courses = Course::pluck('title')->toArray();
        $this->menu->text('CON Welcome To Agriculture training center')
            ->lineBreak(2)
            ->line('Select a course')
            ->paginateListing(
                $courses
                , $current_page, 5, ':')
            ->lineBreak(1)
            ->line('97:Ask a question')
            ->line('98:More')
            ->line('99:Back')
            ->line('100:Main Menu')
            ->line('0:Exit');;
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('98', Next::class)
                       ->between(6, 10, Subtopic::class)
                       ->equal('99', Back::class)
                       ->equal('100', Welcome::class)
                       ->equal('0', Logout::class)
                       ->any(Error::class);
    }
}
