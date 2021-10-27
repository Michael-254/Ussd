<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Faq extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'faq_id' => $this->id,
                'question' => $this->question,
                'answer' => $this->answer,
                'created' => $this->created_at->format('d-m-Y'),
            ]
        ];
    }
}
