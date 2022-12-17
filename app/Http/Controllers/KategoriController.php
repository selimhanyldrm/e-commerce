<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Kategori;
class KategoriController extends Controller
{
    public function index($slug_kategoriadi){
      $kategori=Kategori::where('slug',$slug_kategoriadi)->firstOrFail();
      $alt_kategoriler = Kategori::where('ust_id',$kategori->id)->get();
       $order=request('order');

       if($order=='coksatanlar')
       {
          $urunler=$kategori->urunler()
          ->distinct()
          ->join('urun_detay','urun_detay.urun_id','urun.id')
          ->where('urun_detay.goster_cok_satan',1)
          ->orderBy('urun_detay.goster_cok_satan','desc')
          ->paginate(2);
       } else if($order=='yeni'){
          $urunler = $kategori->urunler()->orderByDesc('guncelleme_tarihi')->paginate(2);
       }else{
         $urunler = $kategori->urunler;
       }


      return view('front\kategori',compact('kategori','alt_kategoriler','urunler'));
    }
}
