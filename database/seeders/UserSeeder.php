<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create();
        User::factory()->count(2)->create(['role' => 'officer']);
        User::factory()->count(3)->create(['role' => 'agent', 'officer_id' => 2]);
        User::factory()->count(3)->create(['role' => 'agent', 'officer_id' => 3]);
    }
}
