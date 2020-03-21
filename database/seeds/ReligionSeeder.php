<?php

use Illuminate\Database\Seeder;
use App\Religion;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('religions')->insert([
            'NAME' => 'kristen'
        ]);
        DB::table('religions')->insert([
            'NAME' => 'katolik'
        ]);
        DB::table('religions')->insert([
            'NAME' => 'islam'
        ]);
        DB::table('religions')->insert([
            'NAME' => 'budha'
        ]);
        DB::table('religions')->insert([
            'NAME' => 'hindu'
        ]);
    }
}
