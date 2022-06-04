<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['username' => 'chef',
            'password' => bcrypt('1234'),
            'level' => 'user'],
            ['username' => 'admin',
            'password' => bcrypt('1234'),
            'level' => 'admin'],
           ]);

           DB::table('kategoris')->insert([
            ['nama_kategori' => 'Appetizer',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['nama_kategori' => 'Sup',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['nama_kategori' => 'Main course',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['nama_kategori' => 'Desert',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
           ]);

           DB::table('bahanbakus')->insert([
            ['kd_bahan' => 'KB001',
            'nama_bahan' => 'KULIT LUMPIA',
            'satuan' => 'LBR',
            'harga' => '582',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB002',
            'nama_bahan' => 'DAGING AYAM',
            'satuan' => 'GRM',
            'harga' => '30',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB003',
            'nama_bahan' => 'WORTEL',
            'satuan' => 'GRM',
            'harga' => '8',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB004',
            'nama_bahan' => 'TAUGE',
            'satuan' => 'GRM',
            'harga' => '8',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB005',
            'nama_bahan' => 'DAUN BAWANG',
            'satuan' => 'GRM',
            'harga' => '10',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB006',
            'nama_bahan' => 'BAWANG PUTIH',
            'satuan' => 'GRM',
            'harga' => '31',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB007',
            'nama_bahan' => 'UDANG REBUS',
            'satuan' => 'GRM',
            'harga' => '135',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB008',
            'nama_bahan' => 'TELUR',
            'satuan' => 'PCS',
            'harga' => '1200',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB009',
            'nama_bahan' => 'TEPUNG KANJI',
            'satuan' => 'GRM',
            'harga' => '9',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB010',
            'nama_bahan' => 'MINYAK GORENG',
            'satuan' => 'CC',
            'harga' => '12',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB011',
            'nama_bahan' => 'SAMBEL KACANG',
            'satuan' => 'GRM',
            'harga' => '23',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
           ]);

           DB::table('bops')->insert([
            ['nama_bop' => 'Garnitures & other',
            'keterangan' => 'Berisi biaya bahan - bahan penolong (bumbu, listrik, gas dll)',
            'besaran' => 10,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
           ]);
           DB::table('btkls')->insert([
            ['nama_btkl' => 'chef',
            'keterangan' => 'kepala koki',
            'besaran' => 200,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
           ]);

           DB::table('waktus')->insert([
            ['nama_waktu' => 'Breakfast ',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['nama_waktu' => 'Lunch ',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['nama_waktu' => 'Dinner',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s')]
           ]);
           DB::table('costs')->insert([
            ['nama_cost' => 'Cost Percentace',
            'keterangan' => 'Penentuan Harga jual',
            'besaran' => 30,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
           ]);
      
           
    }
}
