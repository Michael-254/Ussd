<?php

namespace Database\Factories;

use App\Models\Content;
use App\Models\SubTopic;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Content::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        return [
            'content' => $title,
            'sub_topic_id' => SubTopic::pluck('id')->random()
        ];
    }
}
