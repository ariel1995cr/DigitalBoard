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
        DB::table('states')->insert([
            'id' => 'Planificación',
        ]);

        DB::table('states')->insert([
            'id' => 'Proceso',
        ]);

        DB::table('states')->insert([
            'id' => 'Finalizado',
        ]);
    }
}
