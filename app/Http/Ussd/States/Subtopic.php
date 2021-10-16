<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class Subtopic extends State
{
    public function beforeRendering(): void
    {
        $this->menu->text('CON Subtopic menu');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->in(['0', '00'], Back::class)
                       ->equal('000', Logout::class)
                       ->any(Error::class);
    }
}
