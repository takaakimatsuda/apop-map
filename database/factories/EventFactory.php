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
    protected static $eventCount = 1; // staticを追加してクラス変数として定義

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = "イベント" . self::$eventCount++;
        return [
            'title' => $title,
            'user_id' => 1,
            'image_url' => $this->faker->imageUrl(),
            'region_id' => 1,
            'venue_name' => $this->faker->company,
            'venue_address' => $this->faker->address,
            'description' => $this->faker->paragraph,
            'reference_url' => $this->faker->url,
            'visibility' => 2,
            'date' => $this->faker->date,
            'start_time' => $this->faker->time,
            'end_time' => $this->faker->time,
        ];
    }

    public static function resetEventCount() // リセットメソッドを追加
    {
        self::$eventCount = 1;
    }
}
