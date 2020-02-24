<?php

use Illuminate\Database\Seeder;
use App\Position;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::truncate();

        factory(Position::class)->create([
            'title' => 'founder'
        ]);

        factory(Position::class)->create([
            'title' => 'director'
        ]);

        factory(Position::class)->create([
            'title' => 'cto'
        ]);

        factory(Position::class)->create([
            'title' => 'teamlead'
        ]);

        factory(Position::class)->create([
            'title' => 'developer'
        ]);
    }
}
