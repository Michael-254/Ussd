<?php

namespace App\Http\Ussd\States;

use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Sparors\Ussd\State;

class AskQuestion extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('CON Type your question')
            ->lineBreak(2)
            ->line('0:Back');
    }

    protected function afterRendering(string $argument): void
    {
        $phone = Session::get('phone_number');
        $user_id = User::wherePhoneNumber($phone)->first()->id;
        Question::create(['user_id' => $user_id, 'question' => $argument]);
        $this->decision->equal('0', Logout::class)
                       ->any(SavedQuestion::class);
    }
}
