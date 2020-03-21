<?php

use Illuminate\Database\Seeder;
use App\Bank;
class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->insert([
            'NAME' => 'BCA',
            'DESCRIPTION' => 'Bank Swasta'
        ]);
        DB::table('banks')->insert([
            'NAME' => 'BNI',
            'DESCRIPTION' => 'Bank BUMN'
        ]);
        DB::table('banks')->insert([
            'NAME' => 'MANDIRI',
            'DESCRIPTION' => 'Bank BUMN'
        ]);
        DB::table('banks')->insert([
            'NAME' => 'BRI',
            'DESCRIPTION' => 'Bank BUMN'
        ]);
        DB::table('banks')->insert([
            'NAME' => 'DANAMON',
            'DESCRIPTION' => 'Bank Swasta'
        ]);
        DB::table('banks')->insert([
            'NAME' => 'HANABANK',
            'DESCRIPTION' => 'Bank Swasta'
        ]);
        
    }
}
