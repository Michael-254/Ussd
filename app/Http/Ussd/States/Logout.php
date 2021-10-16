<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class Logout extends State
{
    protected $action = self::PROMPT;

    protected function beforeRendering(): void
    {
        $this->menu->text('END You have successfully logged out!');
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
