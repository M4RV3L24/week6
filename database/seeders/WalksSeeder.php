<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WalksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            //Kalau data genap ada data finished_at
            //Anjing telah selesai diajak jalan
            if($i%2 == 0) {
                DB::table('walks')->insert([
                    'dog_owner_id' => $i,
                    'started_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'finished_at' => Carbon::now()->addHours(1)->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
            } else {
                DB::table('walks')->insert([
                    'dog_owner_id' => $i,
                    'started_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
            }
        }
    }
}
