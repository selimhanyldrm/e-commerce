<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Urun;
class UrunController extends Controller
{
  public function index($slug_urunadi){
  $urun=Urun::where('slug',$slug_urunadi)->firstOrFail();
    return view('front\urun',compact('urun'));
  }
    public function ara(){
      $aranan=request()->input('aranan');
      $urunler=Urun::where('urun_adi','like',"%$aranan%")
      ->orWhere('aciklama','like',"%$aranan%")
      ->paginate(100);

      return view('front\arama',compact('urunler'));
    }
}
