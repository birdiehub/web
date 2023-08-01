<?php

namespace Database\Factories;

use DragonCode\Support\Facades\Helpers\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{

    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $images = [
            'http://www.nerdclub.io/golf/media/courses/golf-course-1.jpg',
            'http://www.nerdclub.io/golf/media/courses/golf-course-2.jpg',
            'http://www.nerdclub.io/golf/media/courses/golf-course-3.jpg',
            'http://www.nerdclub.io/golf/media/courses/golf-course-4.jpg',
            'http://www.nerdclub.io/golf/media/courses/golf-course-5.jpg',
            'http://www.nerdclub.io/golf/media/courses/golf-course-6.jpg',
            'http://www.nerdclub.io/golf/media/courses/golf-course-7.jpg',
            'http://www.nerdclub.io/golf/media/courses/golf-course-8.jpg',
            'http://www.nerdclub.io/golf/media/courses/golf-course-9.jpg',
            'http://www.nerdclub.io/golf/media/courses/golf-course-10.jpg',
            'http://www.nerdclub.io/golf/media/courses/golf-course-11.jpg',
            'http://www.nerdclub.io/golf/media/courses/golf-course-12.jpg',
            'http://www.nerdclub.io/golf/media/courses/golf-course-13.jpg',
        ];

        return [
            'name' => fake()->unique()->company(),
            'address' => fake()->city() . ', ' . fake()->postcode() . ' - ' . fake()->countryCode(),
            'image' => Arr::random($images),
        ];
    }
}
