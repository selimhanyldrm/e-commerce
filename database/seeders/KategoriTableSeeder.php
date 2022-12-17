<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Models\Kategori;
use App\Models\Models\Urun;
use App\Models\Models\UrunDetay;
use Illuminate\Support\Str;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0');
      DB::table('kategori')->truncate();
      $id = DB::table('kategori')->insertGetId(['kategori_adi'=>'Elektronik','slug'=>'elektronik']);
        DB::table('kategori')->insert(['kategori_adi'=>'Bilgisayar/Tablet','slug'=>'bilgisayar-tablet',
      'ust_id'=>$id]);

        $id =  DB::table('kategori')->insertGetId(['kategori_adi'=>'Kitap','slug'=>'kitap']);
        DB::table('kategori')->insert(['kategori_adi'=>'Edebiyat','slug'=>'edebiyat',
      'ust_id'=>$id]);
       DB::table('kategori')->insert(['kategori_adi'=>'Kpss','slug'=>'kpss',
      'ust_id'=>$id]);

            DB::table('kategori')->insert(['kategori_adi'=>'Dergi','slug'=>'dergi']);
              DB::table('kategori')->insert(['kategori_adi'=>'Mobilya','slug'=>'mobilya']);
                DB::table('kategori')->insert(['kategori_adi'=>'Dekorasyon','slug'=>'dekorasyon']);
                  DB::table('kategori')->insert(['kategori_adi'=>'Kozmetik','slug'=>'kozmetik']);
                    DB::table('kategori')->insert(['kategori_adi'=>'Kişisel Bakım','slug'=>'kisisel-bakim']);
                      DB::table('kategori')->insert(['kategori_adi'=>'Giyim','slug'=>'giyim']);
                        DB::table('kategori')->insert(['kategori_adi'=>'Anne Ve Çocuk','slug'=>'anne-cocuk']);

DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
