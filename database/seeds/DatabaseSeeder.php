<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ReligionSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(AcademicYearSeeder::class);
        $this->call(ClassesSeeder::class);
        $this->call(TokenSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(ViolationSeeder::class);
        $this->call(AchievementSeeder::class);
        $this->call(StudentClassesSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(AbsentSeeder::class);
        
        Model::reguard();
    }
}
