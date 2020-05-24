<?php

use Illuminate\Database\Seeder;
use App\Student;
use App\Bank;
use App\Religion;
use App\Classes;
use App\Token;
use App\User;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'ATT_ID' => '101',
            'CARD_NUM' => '4F9899A6',
            'NIS' => '',
            'PASSWORD' => 'sdfa7#2ksdv*&af',
            'NISN' =>  '0047723307',
            'NIK' =>  '3178010108990002',
            'FNAME' =>  'Ahmad',
            'LNAME' => 'Abdul',
            'GENDER' => 'MALE',
            'BPLACE' => 'Bali',
            'BDATE' => '1998-08-01',
            'MAIL' => 'abdulahmad@gmail.com',
            'PHONE' => '0887866554432',
            'ADDRESS' => 'Kaliwaru',
            'RT' => '009',
            'RW' => '001',
            'DISTRICT' => 'Tenggilis',                          
            'SUBDISTRICT' => 'Rungkut',
            'CITY' => 'Surabaya',
            'PROVINCE' => 'Jawa Timur',
            'GR_FROM' => 'SMP Gabagus',
            'BANK_ACC' => '0003334444',                 
            'STATUS' => 'STUDENT',
            'NOTES' => 'Catatan',            
            'IMG_PATH' => 'abdul.jpg',
            'BANKS_ID' => '1',
            'RELIGIONS_ID' => '3',
            'ACADEMIC_YEAR_ID' => '7',
            'TOKENS_ID' => '1',
            'GRADES_ID' => '1'
        ]);

        DB::table('students')->insert([
            'ATT_ID' => '102',
            'CARD_NUM' => '5F43231CV',
            'NIS' => '',
            'PASSWORD' => 'DAFop88&%4KL12f',
            'NISN' =>  '0034711217',
            'NIK' =>  '3178050608990012',
            'FNAME' =>  'Marion',
            'LNAME' => 'Jola',
            'GENDER' => 'FEMALE',
            'BPLACE' => 'Kupang',
            'BDATE' => '1999-12-21',
            'MAIL' => 'marion@gmail.com',
            'PHONE' => '088655991022',
            'ADDRESS' => 'Rungkut Mejoyo Selatan',
            'RT' => '008',
            'RW' => '001',
            'DISTRICT' => 'Tandes',                          
            'SUBDISTRICT' => 'Darmo',
            'CITY' => 'Surabaya',
            'PROVINCE' => 'Jawa Timur',
            'GR_FROM' => 'SMP Kurang Baik',
            'BANK_ACC' => '00044555',                 
            'STATUS' => 'STUDENT',
            'NOTES' => 'Catatan Kecil',
            'IMG_PATH' => 'marion.jpg',
            'BANKS_ID' => '3',
            'RELIGIONS_ID' => '1',
            'ACADEMIC_YEAR_ID' => '7',
            'TOKENS_ID' => '1',
            'GRADES_ID' => '1'
        ]);

        DB::table('students')->insert([
            'ATT_ID' => '103',
            'CARD_NUM' => '69G234TV',
            'NIS' => '',
            'PASSWORD' => 'gwob##2v%%op',
            'NISN' =>  '0024524884',
            'NIK' =>  '3175050506996616',
            'FNAME' =>  'Wilhelm',
            'LNAME' => 'Mozes',
            'GENDER' => 'MALE',
            'BPLACE' => 'Bogor',
            'BDATE' => '1998-09-18',
            'MAIL' => 'wilmozes@gmail.com',
            'PHONE' => '087886002060',
            'ADDRESS' => 'Karang Asem',
            'RT' => '018',
            'RW' => '011',
            'DISTRICT' => 'Kenjeran',                          
            'SUBDISTRICT' => 'Asem',
            'CITY' => 'Surabaya',
            'PROVINCE' => 'Jawa Timur',
            'GR_FROM' => 'SMP Sinlui',
            'BANK_ACC' => '210223235',                 
            'STATUS' => 'STUDENT',
            'NOTES' => 'Badannya Besar',
            'IMG_PATH' => 'mozes.jpg',
            'BANKS_ID' => '2',
            'RELIGIONS_ID' => '5',
            'ACADEMIC_YEAR_ID' => '1',
            'TOKENS_ID' => '1',
            'GRADES_ID' => '1'
        ]);

        DB::table('students')->insert([
            'ATT_ID' => '104',
            'CARD_NUM' => '159898YYYE',
            'NIS' => '',
            'PASSWORD' => 'ADFsehy&*&*@dafa',
            'NISN' =>  '0023671289',
            'NIK' =>  '317707777790012',
            'FNAME' =>  'Alan',
            'LNAME' => 'Budiman',
            'BPLACE' => 'Manggarai - NTT',
            'GENDER' => 'MALE',
            'BDATE' => '1999-10-10',
            'MAIL' => 'alan@gmail.com',
            'PHONE' => '088230354546',
            'ADDRESS' => 'Raya Tenggilis',
            'RT' => '008',
            'RW' => '21',
            'DISTRICT' => 'Tenggilis',                          
            'SUBDISTRICT' => 'Rungkut',
            'CITY' => 'Surabaya',
            'PROVINCE' => 'Jawa Timur',
            'GR_FROM' => 'SMP Manggarai NTT',
            'BANK_ACC' => '03563755',                 
            'STATUS' => 'STUDENT',
            'NOTES' => 'Anak Nakal',
            'IMG_PATH' => 'alan.jpg',
            'BANKS_ID' => '2',
            'RELIGIONS_ID' => '2',
            'ACADEMIC_YEAR_ID' => '7',
            'TOKENS_ID' => '1',
            'GRADES_ID' => '1'
        ]);

        DB::table('students')->insert([
            'ATT_ID' => '105',
            'CARD_NUM' => 'P123HUJADN',
            'NIS' => '',
            'PASSWORD' => 'NBBHH901ia',
            'NISN' =>  '0052398765',
            'NIK' =>  '3181248900012',
            'FNAME' =>  'Daniel',
            'LNAME' => 'Suparto',
            'GENDER' => 'MALE',
            'BPLACE' => 'Surabaya',
            'BDATE' => '1993-05-17',
            'MAIL' => 'asuparto@gmail.com',
            'PHONE' => '081288991022',
            'ADDRESS' => 'Citraland Bos',
            'RT' => '18',
            'RW' => '01',
            'DISTRICT' => 'Barat',                          
            'SUBDISTRICT' => 'Gwalk',
            'CITY' => 'Surabaya',
            'PROVINCE' => 'Jawa Timur',
            'GR_FROM' => 'Tidak SMP',
            'BANK_ACC' => '1234567',                 
            'STATUS' => 'STUDENT',
            'NOTES' => 'Udah Tua',
            'IMG_PATH' => 'suparto.jpg',
            'BANKS_ID' => '1',
            'RELIGIONS_ID' => '1',
            'ACADEMIC_YEAR_ID' => '7',
            'TOKENS_ID' => '2',
            'GRADES_ID' => '1'
        ]);
    }
}
