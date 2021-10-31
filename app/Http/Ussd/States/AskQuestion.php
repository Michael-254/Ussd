<?php

namespace App\Http\Ussd\States;

use App\Models\Question;
use App\Models\User;
use App\Models\FAQ;
use Illuminate\Support\Facades\Session;
use Evans\BulkSms\BulkSmsService;
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

        $answer = FAQ::where('question', 'LIKE', '%'.$argument.'%')->first()->answer;
        $bulkSms = new BulkSmsService('mikedee_254', 'fEA8HhTJfY3evyn', 'http://bulksms.vsms.net:5567');
        if(null != $answer) {
            $request = $bulkSms->sendMessage($phone, $answer);
        }
        else {
            $request = $bulkSms->sendMessage($phone, 'We have received your question and we will get back to you as soon as possible.');
        }

        $this->decision->equal('0', Logout::class)
                       ->any(SavedQuestion::class);
    }
}
