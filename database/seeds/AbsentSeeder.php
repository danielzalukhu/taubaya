<?php

use Illuminate\Database\Seeder;

class AbsentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('absents')->insert([
            'START_DATE' => '2016-08-13',
            'END_DATE' => '2016-08-13',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt1.jpg',
            'STUDENTS_ID' => '1',
            'ACADEMIC_YEAR_ID' => '1',
            'STAFFS_ID' => '1'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2016-08-13',
            'END_DATE' => '2016-08-13',
            'TYPE' => 'LEAVE',
            'DESCRIPTION' => 'Acara keluarga di bandung',
            'RECEIPT_IMG' => 'receipt2.jpg',
            'STUDENTS_ID' => '1',
            'ACADEMIC_YEAR_ID' => '1',
            'STAFFS_ID' => '1'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2016-11-10',
            'END_DATE' => '2016-11-10',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt3.jpg',
            'STUDENTS_ID' => '1',
            'ACADEMIC_YEAR_ID' => '1',
            'STAFFS_ID' => '1'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2016-11-11',
            'END_DATE' => '2016-11-11',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt3.jpg',
            'STUDENTS_ID' => '1',
            'ACADEMIC_YEAR_ID' => '1',
            'STAFFS_ID' => '1'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2016-09-09',
            'END_DATE' => '2016-09-14',
            'TYPE' => 'SICK',
            'DESCRIPTION' => 'Tipes dan harus di rawat inap',
            'RECEIPT_IMG' => 'receipt4.jpg',
            'STUDENTS_ID' => '2',
            'ACADEMIC_YEAR_ID' => '1',
            'STAFFS_ID' => '2'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2016-12-01',
            'END_DATE' => '2016-12-01',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt35.jpg',
            'STUDENTS_ID' => '2',
            'ACADEMIC_YEAR_ID' => '1',
            'STAFFS_ID' => '1'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2016-08-12',
            'END_DATE' => '2016-08-12',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt33.jpg',
            'STUDENTS_ID' => '4',
            'ACADEMIC_YEAR_ID' => '1',
            'STAFFS_ID' => '3'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2016-08-23',
            'END_DATE' => '2016-08-23',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt34.jpg',
            'STUDENTS_ID' => '4',
            'ACADEMIC_YEAR_ID' => '1',
            'STAFFS_ID' => '3'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2016-11-11',
            'END_DATE' => '2016-11-11',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt5.jpg',
            'STUDENTS_ID' => '4',
            'ACADEMIC_YEAR_ID' => '1',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2016-11-12',
            'END_DATE' => '2016-11-12',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt6.jpg',
            'STUDENTS_ID' => '5',
            'ACADEMIC_YEAR_ID' => '1',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2016-11-13',
            'END_DATE' => '2016-11-13',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt1.jpg',
            'STUDENTS_ID' => '5',
            'ACADEMIC_YEAR_ID' => '1',
            'STAFFS_ID' => '1'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2016-12-01',
            'END_DATE' => '2016-12-01',
            'TYPE' => 'LEAVE',
            'DESCRIPTION' => 'Menghadiri pernihakan saudara sehingga izin untuk tidak hadir sekolah',
            'RECEIPT_IMG' => 'receipt12.jpg',
            'STUDENTS_ID' => '5',
            'ACADEMIC_YEAR_ID' => '1',
            'STAFFS_ID' => '3'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-02-07',
            'END_DATE' => '2017-02-09',
            'TYPE' => 'LEAVE',
            'DESCRIPTION' => 'Masih berada diluar negri untuk berlibur',
            'RECEIPT_IMG' => 'receipt12.jpg',
            'STUDENTS_ID' => '1',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '1'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-02-20',
            'END_DATE' => '2017-02-20',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt12.jpg',
            'STUDENTS_ID' => '1',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '1'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-02-21',
            'END_DATE' => '2017-02-21',
            'TYPE' => 'LEAVE',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt12.jpg',
            'STUDENTS_ID' => '1',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '1'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-03-01',
            'END_DATE' => '2017-03-02',
            'TYPE' => 'SICK',
            'DESCRIPTION' => 'Diare atau buang-buang air sehingga harus istirahat dirumah',
            'RECEIPT_IMG' => 'receipt13.jpg',
            'STUDENTS_ID' => '1',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '2'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-04-11',
            'END_DATE' => '2017-04-11',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa keterangan',
            'RECEIPT_IMG' => 'receipt14.jpg',
            'STUDENTS_ID' => '1',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '3'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-05-14',
            'END_DATE' => '2017-05-14',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa keterangan',
            'RECEIPT_IMG' => 'receipt13.jpg',
            'STUDENTS_ID' => '1',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '2'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-03-11',
            'END_DATE' => '2017-03-11',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt13.jpg',
            'STUDENTS_ID' => '2',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-03-12',
            'END_DATE' => '2017-03-12',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt13.jpg',
            'STUDENTS_ID' => '2',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-03-13',
            'END_DATE' => '2017-03-13',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt13.jpg',
            'STUDENTS_ID' => '2',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '1'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-04-20',
            'END_DATE' => '2017-04-22',
            'TYPE' => 'SICK',
            'DESCRIPTION' => 'Terkena penyakit demam berdarah',
            'RECEIPT_IMG' => 'receipt13.jpg',
            'STUDENTS_ID' => '2',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '3'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-02-08',
            'END_DATE' => '2017-02-08',
            'TYPE' => 'LEAVE',
            'DESCRIPTION' => 'Izin tidak masuk karena periksa mata ke dokter',
            'RECEIPT_IMG' => 'receipt13.jpg',
            'STUDENTS_ID' => '4',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '1'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-02-15',
            'END_DATE' => '2017-02-15',
            'TYPE' => 'SICK',
            'DESCRIPTION' => 'Tidak hadir tanpa keterangan',
            'RECEIPT_IMG' => 'receipt200.jpg',
            'STUDENTS_ID' => '4',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '1'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-04-04',
            'END_DATE' => '2017-04-04',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa keterangan',
            'RECEIPT_IMG' => 'receipt13.jpg',
            'STUDENTS_ID' => '4',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '1'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-05-09',
            'END_DATE' => '2017-05-09',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa keterangan',
            'RECEIPT_IMG' => 'receipt13.jpg',
            'STUDENTS_ID' => '4',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-05-10',
            'END_DATE' => '2017-05-10',
            'TYPE' => 'SICK',
            'DESCRIPTION' => 'Tidak hadir tanpa keterangan',
            'RECEIPT_IMG' => 'receipt14.jpg',
            'STUDENTS_ID' => '4',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '2'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-02-07',
            'END_DATE' => '2017-02-07',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa keterangan',
            'RECEIPT_IMG' => 'receipt13.jpg',
            'STUDENTS_ID' => '5',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '1'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-02-26',
            'END_DATE' => '2017-02-26',
            'TYPE' => 'SICK',
            'DESCRIPTION' => 'Muntah-muntah karena salah makan',
            'RECEIPT_IMG' => 'receipt13.jpg',
            'STUDENTS_ID' => '5',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '1'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-03-09',
            'END_DATE' => '2017-03-10',
            'TYPE' => 'SICK',
            'DESCRIPTION' => 'Diare dan muntaber',
            'RECEIPT_IMG' => 'receipt13.jpg',
            'STUDENTS_ID' => '5',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '1'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2017-02-07',
            'END_DATE' => '2017-04-07',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa keterangan',
            'RECEIPT_IMG' => 'receipt25.jpg',
            'STUDENTS_ID' => '5',
            'ACADEMIC_YEAR_ID' => '2',
            'STAFFS_ID' => '2'
        ]);
    }
}
