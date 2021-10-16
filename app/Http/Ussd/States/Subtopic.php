<?php

namespace App\Http\Ussd\States;

use App\Models\SubTopic as ModelsSubTopic;
use Sparors\Ussd\State;

class Subtopic extends State
{
    public function beforeRendering(): void
    {
        $sub_topics = ModelsSubTopic::pluck('title')->toArray();

        $this->menu->text('CON Selected Course')
            ->lineBreak(2)
            ->line('Select a Sub topic')
            ->paginateListing(
                $sub_topics
                , 1, 5, ':')
            ->lineBreak(1)
            ->line('98:More')
            ->line('0:Back')
            ->line('00:Main Menu');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->in(['0', '00'], Back::class)
                       ->equal('000', Logout::class)
                       ->any(Error::class);
    }
}
