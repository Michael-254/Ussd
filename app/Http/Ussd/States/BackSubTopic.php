<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;
use App\Models\Course;
use App\Models\SubTopic as ModelsSubTopic;

class BackSubTopic extends State
{
    protected function beforeRendering(): void
    {
        $previous_no = $this->record->get('SubTopicNo');
        $current_page = (int)$previous_no - 1;
        $this->record->set('SubTopicNo', $current_page);

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
                , $current_page, 5, ':')
            ->lineBreak(1)
            ->line('97:Ask a question')
            ->line('98:More')
            ->line('99:Back')
            ->line('00:Main Menu');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('98', NextSubTopic::class)
                       ->between(6, 10, Subtopic::class)
                       ->equal('99', BackSubTopic::class)
                       ->equal('100', Welcome::class)
                       ->equal('0', Logout::class)
                       ->any(Error::class);
    }
}
