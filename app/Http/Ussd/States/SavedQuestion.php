<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class SavedQuestion extends State
{
    protected $action = self::PROMPT;

    protected function beforeRendering(): void
    {
        $this->menu->text('END Your question has been saved. We shall revert');
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
