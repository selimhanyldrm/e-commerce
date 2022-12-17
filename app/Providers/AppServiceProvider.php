<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use App\Models\Models\Siparis;
use App\Models\Models\Urun;
use App\Models\Models\Kullanici;
use App\Models\Models\Kategori;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      $bitisZamani = now()->addMinutes(10);
      $istatistikler = Cache::remember('istatistikler',$bitisZamani, function(){

     return [
               'bekleyen_siparis' =>Siparis::where('durum','Siparişiniz Alındı')->count(),
               'tamamlanan_siparis' =>Siparis::where('durum','Siparişiniz Tamamlandı')->count(),
               'toplam_urun' =>Urun::count(),
               'toplam_kategori' =>Kategori::count(),
               'toplam_kullanici' => Kullanici::count()

     ];

      });
      View::share('istatistikler',$istatistikler);
    }
}
