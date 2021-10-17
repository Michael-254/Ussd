<?php

namespace App\Http\Ussd\States;

use App\Models\Content as ModelsContent;
use App\Models\Course;
use App\Models\SubTopic;
use Sparors\Ussd\State;

class Content extends State
{
    protected function beforeRendering(): void
    {
        $skip = $this->record->get('course');
        $course = Course::skip($skip - 1)->first();
        $skip_b = $this->record->get('subTopic');

        $subtopic = SubTopic::whereCourseId($course->id)->skip((int)$skip_b - 1)->first();

        $content = ModelsContent::whereSubTopicId($subtopic->id)->first();

        $this->menu->text('CON '. $subtopic->title)
            ->lineBreak(2)
            ->line('Subtopic Contents')
            ->line($content->content)
            ->lineBreak(1)
            ->line('98:More')
            ->line('0:Back')
            ->line('00:Main Menu');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('000', Logout::class)
                       ->equal('98', Next::class)
                       ->any(Error::class);
    }
}
