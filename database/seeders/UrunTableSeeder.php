<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Models\Urun;
use App\Models\Models\UrunDetay;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UrunTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    DB::statement('SET FOREIGN_KEY_CHECKS=0');
    Urun::truncate();
    UrunDetay::truncate();

       $faker=Faker::create();

      for($i = 0; $i < 30; $i++){

        $urun_adi = $faker ->streetName;
        $urun = Urun::create([
          'urun_adi' => $urun_adi,
          'slug' =>Str::slug($urun_adi),
          'aciklama' => $faker->sentence(20),
          'fiyati' => $faker->randomFloat(3,1,20)
        ]);

        $detay= $urun->detay()->create([
          'goster_slider' => rand(0,1),
          'goster_gunun_firsati' =>rand(0,1),
          'goster_one_cikan'=>rand(0,1),
          'goster_cok_satan'=>rand(0,1),
          'goster_indirimli'=>rand(0,1)

        ]);
      }
       DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
