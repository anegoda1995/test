<?php

use Illuminate\Database\Seeder;
use App\Employee;
use App\Position;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::truncate();

        factory(Employee::class, 1)->create([
            'position_id' => Position::FOUNDER,
        ])->each(function ($founders) {
            $founders->children()->saveMany(factory(Employee::class, 2)->create([
                'position_id' => Position::DIRECTOR,
            ]))->each(function ($directors) {
                $directors->children()->saveMany(factory(Employee::class, 5)->create([
                    'position_id' => Position::CTO,
                ]))->each(function ($ctos) {
                    $ctos->children()->saveMany(factory(Employee::class, 10)->create([
                        'position_id' => Position::TEAMLEAD,
                    ]))->each(function ($teamleads) {
                        $teamleads->children()->saveMany(factory(Employee::class, 500)->create([
                            'position_id' => Position::DEVELOPER,
                        ]));
                    });
                });
            });
        });
    }
}
