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
            'id' => 'Planificación',
        ]);

        DB::table('state')->insert([
            'id' => 'Proceso',
        ]);

        DB::table('state')->insert([
            'id' => 'Finalizado',
        ]);
    }
}
