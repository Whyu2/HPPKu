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
            'nama_bahan' => 'Kulit Lumpia',
            'satuan' => 'LBR',
            'harga' => '582',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB002',
            'nama_bahan' => 'Daging Ayam',
            'satuan' => 'GRM',
            'harga' => '30',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB003',
            'nama_bahan' => 'Wortel',
            'satuan' => 'GRM',
            'harga' => '8',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB004',
            'nama_bahan' => 'Tauge',
            'satuan' => 'GRM',
            'harga' => '8',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB005',
            'nama_bahan' => 'Daun Bawang',
            'satuan' => 'GRM',
            'harga' => '10',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB006',
            'nama_bahan' => 'Bawang Putih',
            'satuan' => 'GRM',
            'harga' => '31',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB007',
            'nama_bahan' => 'Udang Rebus',
            'satuan' => 'GRM',
            'harga' => '135',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB008',
            'nama_bahan' => 'Telur',
            'satuan' => 'PCS',
            'harga' => '1200',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB009',
            'nama_bahan' => 'Tepung Kanji',
            'satuan' => 'GRM',
            'harga' => '9',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB010',
            'nama_bahan' => 'Minyak Goreng',
            'satuan' => 'CC',
            'harga' => '12',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB011',
            'nama_bahan' => 'Sambel Kacang',
            'satuan' => 'GRM',
            'harga' => '23',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB012',
            'nama_bahan' => 'Beef Stock',
            'satuan' => 'L',
            'harga' => '10882',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB013',
            'nama_bahan' => 'Bakso Sapi',
            'satuan' => 'PCS',
            'harga' => '630',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB014',
            'nama_bahan' => 'Soon',
            'satuan' => 'GRM',
            'harga' => '20',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB015',
            'nama_bahan' => 'Bawang Goreng',
            'satuan' => 'GRM',
            'harga' => '39',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB016',
            'nama_bahan' => 'Bawang',
            'satuan' => 'GRM',
            'harga' => '14',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB017',
            'nama_bahan' => 'Mrica',
            'satuan' => 'GRM',
            'harga' => '60',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB018',
            'nama_bahan' => 'Motto',
            'satuan' => 'GRM',
            'harga' => '24',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['kd_bahan' => 'KB019',
            'nama_bahan' => 'Arak Masak',
            'satuan' => 'SDT',
            'harga' => '452',
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
