<?php

use Illuminate\Database\Seeder;
use App\Activity;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activities')->insert([
            'MODULE' => 'Tugas',
            'DESCRIPTION' => 'Tugas harian atau pekerjaan rumah',
        ]);

        DB::table('activities')->insert([
            'MODULE' => 'PH',
            'DESCRIPTION' => 'Ulangan Harian',
        ]);

        DB::table('activities')->insert([
            'MODULE' => 'PTS',
            'DESCRIPTION' => 'Ulangan Tengah Semester',
        ]);

        DB::table('activities')->insert([
            'MODULE' => 'PAS',
            'DESCRIPTION' => 'Ulangan Akhir Semester',
        ]);
    }
}
