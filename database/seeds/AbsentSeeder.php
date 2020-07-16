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
        // TAHUN AJARAN 7 - 2018/2019 - KELAS 12 MM

        DB::table('absents')->insert([
            'START_DATE' => '2019-08-05',
            'END_DATE' => '2019-08-05',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt1.jpg',
            'STUDENTS_ID' => '1',
            'ACADEMIC_YEAR_ID' => '7',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2019-08-05',
            'END_DATE' => '2019-08-05',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt10.jpg',
            'STUDENTS_ID' => '3',
            'ACADEMIC_YEAR_ID' => '7',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2019-08-07',
            'END_DATE' => '2019-08-07',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir main ke warnet',
            'RECEIPT_IMG' => 'receipt2.jpg',
            'STUDENTS_ID' => '5',
            'ACADEMIC_YEAR_ID' => '7',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2019-08-07',
            'END_DATE' => '2019-08-11',
            'TYPE' => 'LEAVE',
            'DESCRIPTION' => 'Opung dari pihak ibu siswa meninggal',
            'RECEIPT_IMG' => 'receipt3.jpg',
            'STUDENTS_ID' => '6',
            'ACADEMIC_YEAR_ID' => '7',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2019-08-12',
            'END_DATE' => '2019-08-12',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa keterangan',
            'RECEIPT_IMG' => 'receipt4.jpg',
            'STUDENTS_ID' => '10',
            'ACADEMIC_YEAR_ID' => '7',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2019-09-05',
            'END_DATE' => '2019-09-05',
            'TYPE' => 'SICK',
            'DESCRIPTION' => 'Diare buang-buang air besar',
            'RECEIPT_IMG' => 'receipt5.jpg',
            'STUDENTS_ID' => '3',
            'ACADEMIC_YEAR_ID' => '7',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2019-09-05',
            'END_DATE' => '2019-09-05',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt6.jpg',
            'STUDENTS_ID' => '5',
            'ACADEMIC_YEAR_ID' => '7',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2019-09-05',
            'END_DATE' => '2019-09-05',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt7.jpg',
            'STUDENTS_ID' => '6',
            'ACADEMIC_YEAR_ID' => '7',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2019-09-05',
            'END_DATE' => '2019-09-05',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt6.jpg',
            'STUDENTS_ID' => '15',
            'ACADEMIC_YEAR_ID' => '7',
            'STAFFS_ID' => '4'
        ]);

        // TAHUN AJARAN 7 - 2018/2019 - KELAS 12 TPM

        DB::table('absents')->insert([
            'START_DATE' => '2019-08-07',
            'END_DATE' => '2019-08-07',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'xxx.jpg',
            'STUDENTS_ID' => '77',
            'ACADEMIC_YEAR_ID' => '7',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2019-08-07',
            'END_DATE' => '2019-08-07',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'absds.jpg',
            'STUDENTS_ID' => '82',
            'ACADEMIC_YEAR_ID' => '7',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2019-08-20',
            'END_DATE' => '2019-08-28',
            'TYPE' => 'SICK',
            'DESCRIPTION' => 'Sakit tipes harus rawat inap',
            'RECEIPT_IMG' => 'abxs.jpg',
            'STUDENTS_ID' => '80',
            'ACADEMIC_YEAR_ID' => '7',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2019-08-21',
            'END_DATE' => '2019-08-21',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa keterangan',
            'RECEIPT_IMG' => 'opeas.jpg',
            'STUDENTS_ID' => '79',
            'ACADEMIC_YEAR_ID' => '7',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2019-08-22',
            'END_DATE' => '2019-08-22',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa keterangan',
            'RECEIPT_IMG' => 'iwef.jpg',
            'STUDENTS_ID' => '79',
            'ACADEMIC_YEAR_ID' => '7',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2019-08-22',
            'END_DATE' => '2019-08-22',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa keterangan',
            'RECEIPT_IMG' => 'iwef.jpg',
            'STUDENTS_ID' => '79',
            'ACADEMIC_YEAR_ID' => '7',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2019-09-09',
            'END_DATE' => '2019-09-09',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa keterangan',
            'RECEIPT_IMG' => 'asdasdk.jpg',
            'STUDENTS_ID' => '94',
            'ACADEMIC_YEAR_ID' => '7',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2019-09-21',
            'END_DATE' => '2019-09-21',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa keterangan',
            'RECEIPT_IMG' => 'asdasdk.jpg',
            'STUDENTS_ID' => '90',
            'ACADEMIC_YEAR_ID' => '7',
            'STAFFS_ID' => '4'
        ]);

        // TAHUN AJARAN 8 - 2018/2019 - KELAS 12 MM

        DB::table('absents')->insert([
            'START_DATE' => '2020-02-13',
            'END_DATE' => '2020-02-13',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt6.jpg',
            'STUDENTS_ID' => '10',
            'ACADEMIC_YEAR_ID' => '8',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2020-02-13',
            'END_DATE' => '2020-02-13',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt6.jpg',
            'STUDENTS_ID' => '19',
            'ACADEMIC_YEAR_ID' => '8',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2020-02-20',
            'END_DATE' => '2020-02-20',
            'TYPE' => 'SICK',
            'DESCRIPTION' => 'Badan panas tinggi',
            'RECEIPT_IMG' => 'receipt12.jpg',
            'STUDENTS_ID' => '7',
            'ACADEMIC_YEAR_ID' => '8',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2020-02-20',
            'END_DATE' => '2020-02-20',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt12.jpg',
            'STUDENTS_ID' => '8',
            'ACADEMIC_YEAR_ID' => '8',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2020-03-20',
            'END_DATE' => '2020-03-20',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt12.jpg',
            'STUDENTS_ID' => '2',
            'ACADEMIC_YEAR_ID' => '8',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2020-04-07',
            'END_DATE' => '2019-04-08',
            'TYPE' => 'LEAVE',
            'DESCRIPTION' => 'Mengikuti lomba nasional ke Jakarta',
            'RECEIPT_IMG' => 'receipt12.jpg',
            'STUDENTS_ID' => '17',
            'ACADEMIC_YEAR_ID' => '8',
            'STAFFS_ID' => '4'
        ]);        

        DB::table('absents')->insert([
            'START_DATE' => '2020-04-11',
            'END_DATE' => '2019-04-11',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa alasan',
            'RECEIPT_IMG' => 'receipt12.jpg',
            'STUDENTS_ID' => '13',
            'ACADEMIC_YEAR_ID' => '8',
            'STAFFS_ID' => '4'
        ]);        

        // TAHUN AJARAN 8 - 2018/2019 - KELAS 12 TPM

        DB::table('absents')->insert([
            'START_DATE' => '2020-02-21',
            'END_DATE' => '2020-02-21',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa keterangan',
            'RECEIPT_IMG' => 'bkadsf.jpg',
            'STUDENTS_ID' => '87',
            'ACADEMIC_YEAR_ID' => '8',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2020-04-03',
            'END_DATE' => '2020-04-03',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa keterangan',
            'RECEIPT_IMG' => 'bkadsf.jpg',
            'STUDENTS_ID' => '88',
            'ACADEMIC_YEAR_ID' => '8',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2020-04-10',
            'END_DATE' => '2020-04-10',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa keterangan',
            'RECEIPT_IMG' => 'aaa.jpg',
            'STUDENTS_ID' => '81',
            'ACADEMIC_YEAR_ID' => '8',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2020-04-19',
            'END_DATE' => '2020-04-19',
            'TYPE' => 'LEAVE',
            'DESCRIPTION' => 'Izin menghadiri acara keluarga di bojonegoro',
            'RECEIPT_IMG' => 'aaa.jpg',
            'STUDENTS_ID' => '81',
            'ACADEMIC_YEAR_ID' => '8',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2020-02-12',
            'END_DATE' => '2020-02-13',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Bolos 2 hari tanpa ada keterangan',
            'RECEIPT_IMG' => 'aaa.jpg',
            'STUDENTS_ID' => '2',
            'ACADEMIC_YEAR_ID' => '8',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2020-03-04',
            'END_DATE' => '2020-03-04',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Bolos tanpa ada keterangan',
            'RECEIPT_IMG' => 'aaaadf.jpg',
            'STUDENTS_ID' => '2',
            'ACADEMIC_YEAR_ID' => '8',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2020-03-12',
            'END_DATE' => '2020-03-14',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak masuk karena kabur main ke warnet',
            'RECEIPT_IMG' => 'aa1239ad.jpg',
            'STUDENTS_ID' => '2',
            'ACADEMIC_YEAR_ID' => '8',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2020-04-04',
            'END_DATE' => '2020-04-04',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Alasan izin sakit ternyata pergi ke tretes',
            'RECEIPT_IMG' => 'aa1239ad.jpg',
            'STUDENTS_ID' => '2',
            'ACADEMIC_YEAR_ID' => '8',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2020-04-20',
            'END_DATE' => '2020-04-20',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak masuk karena bangun kesiangan',
            'RECEIPT_IMG' => 'aa1239ad.jpg',
            'STUDENTS_ID' => '2',
            'ACADEMIC_YEAR_ID' => '8',
            'STAFFS_ID' => '4'
        ]);

        DB::table('absents')->insert([
            'START_DATE' => '2020-05-01',
            'END_DATE' => '2020-05-01',
            'TYPE' => 'ABSENT',
            'DESCRIPTION' => 'Tidak hadir tanpa keterangan',
            'RECEIPT_IMG' => 'aa1239ad.jpg',
            'STUDENTS_ID' => '2',
            'ACADEMIC_YEAR_ID' => '8',
            'STAFFS_ID' => '4'
        ]);
    }
}
