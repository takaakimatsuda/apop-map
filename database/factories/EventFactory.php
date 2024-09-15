<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'user_id' => 1,  // 必要に応じて関連するユーザーIDを指定
            'image_url' => $this->faker->imageUrl(),
            'dance_genre' => 'Hip-hop',
            'region' => 'Tokyo',
            'venue_name' => $this->faker->company,
            'venue_address' => $this->faker->address,
            'description' => $this->faker->paragraph,
            'reference_url' => $this->faker->url,
            'date' => $this->faker->date,
            'start_time' => $this->faker->time,
            'end_time' => $this->faker->time,
            'location' => $this->faker->address,  // 会場名などに適したランダムなアドレス情報
            'category_id' => 1,  // 必要に応じてカテゴリIDを指定
        ];
    }
}
