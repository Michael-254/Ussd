<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Subtopic;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubtopicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subtopic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        $slug = Str::slug($title);
        return [
            'title' => $title,
            'slug' => $slug,
            'course_id' => Course::pluck('id')->random()
        ];
    }
}
