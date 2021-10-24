<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

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
            'user_id' => 1,
            'title' => $title,
            'slug' => $slug,
            'instructor' => $this->faker->name(),
            'provider' => Str::limit($this->faker->sentence,5),
        ];
    }
}
