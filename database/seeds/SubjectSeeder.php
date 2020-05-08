<?php

use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {          
        // 10-MM            

        DB::table('subjects')->insert([
            'CODE' => '10-MM-A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-MM-A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-MM-A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-MM-A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-MM-A-5',
            'DESCRIPTION' => 'Sejarah Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-MM-A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-MM-B-1',
            'DESCRIPTION' => 'Seni Budaya',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-MM-B-2',
            'DESCRIPTION' => 'Pendidikan Jasmani, Olah Raga, dan Kesehatan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-MM-B-3',
            'DESCRIPTION' => 'Bahasa Jawa',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-MM-C1-1',
            'DESCRIPTION' => 'Fisika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'DBK',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-MM-C1-2',
            'DESCRIPTION' => 'Kimia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'DBK',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-MM-C1-3',
            'DESCRIPTION' => 'Simulasi dan Komunikasi Digital',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DBK',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-MM-C2-1',
            'DESCRIPTION' => 'Komputer dan Jaringan Dasar',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-MM-C2-2',
            'DESCRIPTION' => 'Pemrograman Dasar',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-MM-C2-3',
            'DESCRIPTION' => 'Dasar Desain Grafis',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK',
            'DEPARTMENTS_ID' => '6'
        ]);

        
        // 11-MM

        DB::table('subjects')->insert([
            'CODE' => '11-MM-A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-MM-A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-MM-A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-MM-A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-MM-A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-MM-B-2',
            'DESCRIPTION' => 'Pendidikan Jasmani, Olah Raga, dan Kesehatan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-MM-B-3',
            'DESCRIPTION' => 'Bahasa Jawa',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-MM-C3-1',
            'DESCRIPTION' => 'Desain Grafis Percetakan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-MM-C3-3',
            'DESCRIPTION' => 'Teknik Animasi 2D dan 3D',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-MM-C3-5',
            'DESCRIPTION' => 'Produk Kreatif dan Kewirausahaan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '6'
        ]);

        // 12 MM 

        DB::table('subjects')->insert([
            'CODE' => '12-MM-A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-MM-A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-MM-A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-MM-A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-MM-A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-MM-B-3',
            'DESCRIPTION' => 'Bahasa Jawa',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-MM-C3-2',
            'DESCRIPTION' => 'Teknik Pengolahan Audio Video',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-MM-C3-4',
            'DESCRIPTION' => 'Design Media Interaktif',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '6'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-MM-C3-5',
            'DESCRIPTION' => 'Produk Kreatif dan Kewirausahaan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '6'
        ]);
                  
        // 10-TAV

        DB::table('subjects')->insert([
            'CODE' => '10-TAV-A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TAV-A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TAV-A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TAV-A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TAV-A-5',
            'DESCRIPTION' => 'Sejarah Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TAV-A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TAV-B-1',
            'DESCRIPTION' => 'Seni Budaya',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TAV-B-2',
            'DESCRIPTION' => 'Pendidikan Jasmani, Olah Raga, dan Kesehatan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TAV-B-3',
            'DESCRIPTION' => 'Bahasa Jawa',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TAV-C1-1',
            'DESCRIPTION' => 'Fisika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'DBK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TAV-C1-2',
            'DESCRIPTION' => 'Kimia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'DBK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TAV-C1-3',
            'DESCRIPTION' => 'Simulasi dan Komunikasi Digital',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DBK',
            'DEPARTMENTS_ID' => '7'            
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '10-TAV-C2-1',
            'DESCRIPTION' => 'Kerja Bengkel dan Gambar Teknik',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TAV-C2-2',
            'DESCRIPTION' => 'Dasar Listrik dan Elektronika',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TAV-C2-3',
            'DESCRIPTION' => 'Dasar Pemrograman',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        // 11-TAV

        DB::table('subjects')->insert([
            'CODE' => '11-TAV-A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TAV-A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TAV-A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TAV-A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TAV-A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TAV-B-2',
            'DESCRIPTION' => 'Pendidikan Jasmani, Olah Raga, dan Kesehatan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TAV-C3-1',
            'DESCRIPTION' => 'Mikroprosesor dan Mikrokontroler',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TAV-C3-2',
            'DESCRIPTION' => 'Penerapan Rangkaian Elektronika',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TAV-C3-3',
            'DESCRIPTION' => 'Perencanaan dan Instalasi Sistem Audio Video',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TAV-C3-4',
            'DESCRIPTION' => 'Penerapan Sistem Radio dan Televisi',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TAV-C3-6',
            'DESCRIPTION' => 'Produk Kreatifitas dan Kewirausahaan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        // 12-TAV

        DB::table('subjects')->insert([
            'CODE' => '12-TAV-A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TAV-A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TAV-A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TAV-A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TAV-A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TAV-C3-2',
            'DESCRIPTION' => 'Penerapan Rangkaian Elektronika',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TAV-C3-3',
            'DESCRIPTION' => 'Perencanaan dan Instalasi Sistem Audio Video',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TAV-C3-4',
            'DESCRIPTION' => 'Penerapan Sistem Radio dan Televisi',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TAV-C3-5',
            'DESCRIPTION' => 'Perawatan dan Perbaikan Peralatan Audio dan Video',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TAV-C3-6',
            'DESCRIPTION' => 'Produk Kreatifitas dan Kewirausahaan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '7'            
        ]);

        // 10-TKJ

        DB::table('subjects')->insert([
            'CODE' => '10-TKJ-A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '8'            
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKJ-A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKJ-A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKJ-A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKJ-A-5',
            'DESCRIPTION' => 'Sejarah Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKJ-A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKJ-B-1',
            'DESCRIPTION' => 'Seni Budaya',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKJ-B-2',
            'DESCRIPTION' => 'Pendidikan Jasmani, Olah Raga, dan Kesehatan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKJ-B-3',
            'DESCRIPTION' => 'Bahasa Jawa',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKJ-C1-1',
            'DESCRIPTION' => 'Fisika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'DBK',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKJ-C1-2',
            'DESCRIPTION' => 'Kimia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'DBK',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKJ-C1-3',
            'DESCRIPTION' => 'Simulasi dan Komunikasi Digital',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DBK',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKJ-C2-1',
            'DESCRIPTION' => 'Komputer dan Jaringan Dasar',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKJ-C2-2',
            'DESCRIPTION' => 'Pemrograman Dasar',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKJ-C2-3',
            'DESCRIPTION' => 'Dasar Desain Grafis',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '8'
        ]);

        // 11-TKJ

        DB::table('subjects')->insert([
            'CODE' => '11-TKJ-A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKJ-A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKJ-A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKJ-A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKJ-A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKJ-B-2',
            'DESCRIPTION' => 'Pendidikan Jasmani, Olah Raga, dan Kesehatan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKJ-B-3',
            'DESCRIPTION' => 'Bahasa Jawa',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKJ-C3-1',
            'DESCRIPTION' => 'Teknologi Jaringan Berbasis Luas',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKJ-C3-2',
            'DESCRIPTION' => 'Administrasi Infrastruktur Jaringan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKJ-C3-3',
            'DESCRIPTION' => 'Administrasi Sistem Jaringan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKJ-C3-4',
            'DESCRIPTION' => 'Teknologi Layanan Jaringan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKJ-C3-5',
            'DESCRIPTION' => 'Produk Kreatif dan Kewirausahaan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '8'
        ]);


        // 12-TKJ

        DB::table('subjects')->insert([
            'CODE' => '12-TKJ-A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TKJ-A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TKJ-A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TKJ-A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TKJ-A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TKJ-B-3',
            'DESCRIPTION' => 'Bahasa Jawa',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TKJ-C3-2',
            'DESCRIPTION' => 'Administrasi Infrastruktur Jaringan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TKJ-C3-3',
            'DESCRIPTION' => 'Administrasi Sistem Jaringan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TKJ-C3-4',
            'DESCRIPTION' => 'Teknologi Layanan Jaringan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '8'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TKJ-C3-5',
            'DESCRIPTION' => 'Produk Kreatif dan Kewirausahaan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '8'
        ]);

        // 10-TKR

        DB::table('subjects')->insert([
            'CODE' => '10-TKR-A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKR-A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKR-A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKR-A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKR-A-5',
            'DESCRIPTION' => 'Sejarah Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKR-A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKR-B-1',
            'DESCRIPTION' => 'Seni Budaya',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKR-B-2',
            'DESCRIPTION' => 'Pendidikan Jasmani, Olah Raga, dan Kesehatan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKR-B-3',
            'DESCRIPTION' => 'Bahasa Jawa',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKR-C1-1',
            'DESCRIPTION' => 'Fisika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'DBK',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKR-C1-2',
            'DESCRIPTION' => 'Kimia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'DBK',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKR-C1-3',
            'DESCRIPTION' => 'Simulasi dan Komunikasi Digital',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DBK',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKR-C2-1',
            'DESCRIPTION' => 'Gambar Teknik Otomotif',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKR-C2-2',
            'DESCRIPTION' => 'Teknologi Dasar Otomotif',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TKR-C2-3',
            'DESCRIPTION' => 'Pekerjaan Dasar Otomotif',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK',
            'DEPARTMENTS_ID' => '9'
        ]);

        // 11-TKR

        DB::table('subjects')->insert([
            'CODE' => '11-TKR-A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKR-A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKR-A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKR-A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '9'
        ]);        

        DB::table('subjects')->insert([
            'CODE' => '11-TKR-A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKR-B-2',
            'DESCRIPTION' => 'Pendidikan Jasmani dan Olahraga',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKR-C3-1',
            'DESCRIPTION' => 'Pemeliharaan Mesin Kendaraan Ringan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKR-C3-2',
            'DESCRIPTION' => 'Pemeliharaan Sasis dan Pemindaha Tenaga Kendaraan Ringan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKR-C3-3',
            'DESCRIPTION' => 'Pemeliharaan Kelistrikan Kendaraan Ringan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TKR-C3-4',
            'DESCRIPTION' => 'Produk Kreatif dan Kewirausahaan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '9'
        ]);

        // 12-TKR

        DB::table('subjects')->insert([
            'CODE' => '12-TKR-A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TKR-A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TKR-A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TKR-A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '9'
        ]);        

        DB::table('subjects')->insert([
            'CODE' => '12-TKR-A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TKR-C3-1',
            'DESCRIPTION' => 'Pemeliharaan Mesin Kendaraan Ringan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TKR-C3-2',
            'DESCRIPTION' => 'Pemeliharaan Sasis dan Pemindaha Tenaga Kendaraan Ringan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TKR-C3-3',
            'DESCRIPTION' => 'Pemeliharaan Kelistrikan Kendaraan Ringan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '9'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TKR-C3-4',
            'DESCRIPTION' => 'Produk Kreatif dan Kewirausahaan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '9'
        ]);

        // 10-TPm

        DB::table('subjects')->insert([
            'CODE' => '10-TPm-A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TPm-A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TPm-A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TPm-A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TPm-A-5',
            'DESCRIPTION' => 'Sejarah Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TPm-A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TPm-B-1',
            'DESCRIPTION' => 'Seni Budaya',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TPm-B-2',
            'DESCRIPTION' => 'Pendidikan Jasmani, Olah Raga, dan Kesehatan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TPm-B-3',
            'DESCRIPTION' => 'Bahasa Jawa',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TPm-C1-1',
            'DESCRIPTION' => 'Fisika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'DBK',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TPm-C1-2',
            'DESCRIPTION' => 'Kimia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'DBK',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TPm-C1-3',
            'DESCRIPTION' => 'Simulasi dan Komunikasi Digital',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DBK',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TPm-C2-1',
            'DESCRIPTION' => 'Gambar Teknik Mesin',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TPm-C2-2',
            'DESCRIPTION' => 'Pekejeraan Dasar Teknik Mesin',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TPm-C2-3',
            'DESCRIPTION' => 'Dasar Perancangan Teknik Mesin',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '10'
        ]);


        // 11-TPm

        DB::table('subjects')->insert([
            'CODE' => '11-TPm-A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TPm-A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TPm-A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TPm-A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '10'
        ]);        

        DB::table('subjects')->insert([
            'CODE' => '11-TPm-A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TPm-B-2',
            'DESCRIPTION' => 'Pendidikan Jasmani dan Olahraga',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '10'
        ]);        

        DB::table('subjects')->insert([
            'CODE' => '11-TPm-C3-1',
            'DESCRIPTION' => 'Gambar Teknik Manufaktur',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TPm-C3-2',
            'DESCRIPTION' => 'Teknik Pemesinan Bubut',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TPm-C3-3',
            'DESCRIPTION' => 'Teknik Pemesinan Frais',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TPm-C3-5',
            'DESCRIPTION' => 'Teknik Pemesinan NC/CNC dan CAM',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TPm-C3-6',
            'DESCRIPTION' => 'Produk Kreatif dan Kewirausahaan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '10'
        ]);

        // 12-TPm

        DB::table('subjects')->insert([
            'CODE' => '12-TPm-A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TPm-A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TPm-A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TPm-A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '10'
        ]);        

        DB::table('subjects')->insert([
            'CODE' => '12-TPm-A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TPm-C3-1',
            'DESCRIPTION' => 'Gambar Teknik Manufaktur',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TPm-C3-2',
            'DESCRIPTION' => 'Teknik Pemesinan Bubut',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TPm-C3-3',
            'DESCRIPTION' => 'Teknik Pemesinan Frais',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TPm-C3-4',
            'DESCRIPTION' => 'Teknik Pemesinan Gerinda',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TPm-C3-5',
            'DESCRIPTION' => 'Teknik Pemesinan NC/CNC dan CAM',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '10'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TPm-C3-6',
            'DESCRIPTION' => 'Produk Kreatif dan Kewirausahaan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '10'
        ]);
        
        // 10-TSM

        DB::table('subjects')->insert([
            'CODE' => '10-TSM-A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '10-TSM-A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '10-TSM-A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '10-TSM-A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '10-TSM-A-5',
            'DESCRIPTION' => 'Sejarah Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '10-TSM-A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '10-TSM-B-1',
            'DESCRIPTION' => 'Seni Budaya',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '10-TSM-B-2',
            'DESCRIPTION' => 'Pendidikan Jasmani, Olah Raga, dan Kesehatan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '10-TSM-B-3',
            'DESCRIPTION' => 'Bahasa Jawa',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '10-TSM-C1-1',
            'DESCRIPTION' => 'Fisika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'DBK',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '10-TSM-C1-2',
            'DESCRIPTION' => 'Kimia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'DBK',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '10-TSM-C1-3',
            'DESCRIPTION' => 'Simulasi dan Komunikasi Digital',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DBK',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '10-TSM-C2-1',
            'DESCRIPTION' => 'Gambar Teknik Otomotif',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK',
            'DEPARTMENTS_ID' => '11'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TSM-C2-2',
            'DESCRIPTION' => 'Teknologi Dasar Otomotif',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK',
            'DEPARTMENTS_ID' => '11'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '10-TSM-C2-3',
            'DESCRIPTION' => 'Pekerjaan Dasar Otomotif',
            'MINIMALPOIN' => '80',
            'TYPE' => 'DPK',
            'DEPARTMENTS_ID' => '11'
        ]);


        // 11-TSM

        DB::table('subjects')->insert([
            'CODE' => '11-TSM-A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '11-TSM-A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '11-TSM-A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '11-TSM-A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '11'
        ]);        
        
        DB::table('subjects')->insert([
            'CODE' => '11-TSM-A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '11-TSM-B-2',
            'DESCRIPTION' => 'Pendidikan Jasmani dan Olahraga',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MK',
            'DEPARTMENTS_ID' => '11'
        ]);                

        DB::table('subjects')->insert([
            'CODE' => '11-TSM-C3-1',
            'DESCRIPTION' => 'Pemeliharaan Mesin Sepeda Motor',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '11'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TSM-C3-2',
            'DESCRIPTION' => 'Pemeliharaan Sasis Sepeda Motor',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '11'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TSM-C3-3',
            'DESCRIPTION' => 'Pemeliharaan Kelistrikan Sepeda Motor dan Pengelolaan Bengkel Sepeda Motor',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '11'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '11-TSM-C3-4',
            'DESCRIPTION' => 'Produk Kreatif dan Kewirausahaan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '11'
        ]);

        // 12-TSM

        DB::table('subjects')->insert([
            'CODE' => '12-TSM-A-1',
            'DESCRIPTION' => 'Pendidikan Agama dan Budi Pekerti',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '12-TSM-A-2',
            'DESCRIPTION' => 'Pendidikan Pancasila dan Kewarganegaraan',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '12-TSM-A-3',
            'DESCRIPTION' => 'Bahasa Indonesia',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '11'
        ]);
        
        DB::table('subjects')->insert([
            'CODE' => '12-TSM-A-4',
            'DESCRIPTION' => 'Matematika',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '11'
        ]);        
        
        DB::table('subjects')->insert([
            'CODE' => '12-TSM-A-6',
            'DESCRIPTION' => 'Bahasa Inggris',
            'MINIMALPOIN' => '75',
            'TYPE' => 'MN',
            'DEPARTMENTS_ID' => '11'
        ]);
        

        DB::table('subjects')->insert([
            'CODE' => '12-TSM-C3-1',
            'DESCRIPTION' => 'Pemeliharaan Mesin Sepeda Motor',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '11'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TSM-C3-2',
            'DESCRIPTION' => 'Pemeliharaan Sasis Sepeda Motor',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '11'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TSM-C3-3',
            'DESCRIPTION' => 'Pemeliharaan Kelistrikan Sepeda Motor dan Pengelolaan Bengkel Sepeda Motor',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '11'
        ]);

        DB::table('subjects')->insert([
            'CODE' => '12-TSM-C3-4',
            'DESCRIPTION' => 'Produk Kreatif dan Kewirausahaan',
            'MINIMALPOIN' => '80',
            'TYPE' => 'KK',
            'DEPARTMENTS_ID' => '11'
        ]);
    }
}
