<?php

namespace Database\Seeders;

use App\Models\Direction;
use Illuminate\Database\Seeder;

class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Direction::factory()->create(['title' => 'Херсонська область']);
        Direction::factory()->create(['title' => 'Запорізька область']);
        Direction::factory()->create(['title' => 'Луганська область']);
        Direction::factory()->create(['title' => 'Донецька область']);
        Direction::factory()->create(['title' => 'АР Крим']);
        Direction::factory()->create(['title' => 'рф']);
        Direction::factory()->create(['title' => 'рб']);
    }
}
