<?php

use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('state')->insert([
            'stateName' => 'Planificación',
        ]);

        DB::table('state')->insert([
            'stateName' => 'Proceso',
        ]);

        DB::table('state')->insert([
            'stateName' => 'Finalizado',
        ]);
    }
}
