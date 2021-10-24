<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Course extends JsonResource
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
                'course_id' => $this->id,
                'title' => $this->title,
                'instructor' => $this->instructor,
                'provider' => $this->provider,
                'created' => $this->created_at->format('d-m-Y'),
            ]
        ];
    }
}
