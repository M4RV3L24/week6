<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndUsersSeeder::class);
        $this->call(DogsSeeder::class);
        $this->call(OwnersSeeder::class);
        $this->call(DogOwnersSeeder::class);
        $this->call(WalksSeeder::class);
    }
}
