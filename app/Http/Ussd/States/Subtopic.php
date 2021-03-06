<?php

namespace App\Http\Ussd\States;

use App\Models\Course;
use App\Models\SubTopic as ModelsSubTopic;
use Sparors\Ussd\State;

class Subtopic extends State
{
    protected function beforeRendering(): void
    {
        $this->record->SubTopicNo = 1;
        $skip = $this->record->get('course');

        $course = Course::skip($skip - 1)->first();
        $sub_topics = ModelsSubTopic::whereCourseId($course->id)->pluck('title')->toArray();

        $this->menu->text('CON '. $course->title)
            ->lineBreak(1)
            ->line('Provider: '. $course->provider)
            ->line('Instructor: '. $course->instructor)
            ->lineBreak(2)
            ->line('Select a Sub topic')
            ->paginateListing(
                $sub_topics
                , 1, 5, ':')
            ->lineBreak(1)
            ->line('97:Ask a question')
            ->line('98:More')
            //->line('0:Back')
            ->line('00:Main Menu');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->subTopic = $argument;
        $this->decision->equal('000', Logout::class)                       
                       ->equal('97', AskQuestion::class)
                       ->equal('98', NextSubTopic::class)
                       ->equal('99', Welcome::class)
                       ->between(1, 5, Content::class)
                       ->any(Error::class);
    }
}
