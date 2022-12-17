<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Kategori;
use App\Models\Models\Urun;
use App\Models\Models\UrunDetay;


class AnasayfaController extends Controller
{
  public function index(){
    $kategoriler=Kategori::whereRaw('ust_id is null')->take(5)->get();
    $urunler_slider=UrunDetay::with('urun')->where('goster_slider',1)->take(5)->get();

    $urun_gunun_firsati=Urun::select('urun.*')
    ->join('urun_detay','urun_detay.urun_id','urun.id')
    ->where('urun_detay.goster_gunun_firsati',1)
    ->first();

      $urunler_one_cikan=UrunDetay::with('urun')->where('goster_one_cikan',1)->take(4)->get();
        $urunler_cok_satan=UrunDetay::with('urun')->where('goster_cok_satan',1)->take(4)->get();
          $urunler_indirimli=UrunDetay::with('urun')->where('goster_indirimli',1)->take(4)->get();



    return view('front\homepage',compact('kategoriler','urunler_slider','urun_gunun_firsati','urunler_one_cikan','urunler_cok_satan','urunler_indirimli'));
}
}
