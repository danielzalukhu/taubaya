<?php

use Illuminate\Database\Seeder;
use App\Token;

class TokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tokens')->insert([
            'CODE' => 'UX88abfj12',
            'STATUS' => 'ACTIVE'
        ]);

        DB::table('tokens')->insert([
            'CODE' => 'oPUEe712HJ',
            'STATUS' => 'ACTIVE'
        ]);
    }
}
