<?php

namespace App\Http\Controllers;
use App\Models\Models\Urun;
use App\Models\Models\Sepet;
use App\Models\Models\SepetUrun;
use Illuminate\Support\Facades\Auth;

use Cart;
use Validator;

use Illuminate\Http\Request;

class SepetController extends Controller
{
  public function index(){
    return view('front\sepet');
  }

  public function ekle(Request $request){
  $urun = Urun::find($request->id);
  $price=44;

  $cartItem=Cart::add($urun->id,$urun->urun_adi,1,$urun->fiyati);

  if (auth()->check())
  {
    $aktif_sepet_id = session('aktif_sepet_id');
     if(!isset($aktif_sepet_id)){

      $aktif_sepet =Sepet::create([
      'kullanici_id'=>auth()->id()
    ]);
    $aktif_sepet_id = $aktif_sepet->id;
    session()->put('aktif_sepet_id',$aktif_sepet_id);
  }
  SepetUrun::updateOrCreate(
    ['sepet_id'=>$aktif_sepet_id,'urun_id' =>$urun->id],
    ['adet' =>$cartItem->qty,'fiyati' =>$urun->fiyati,'durum'=>'beklemede']
  );

  }
  return redirect()->route('sepet')
  ->with('mesaj_tur','success.')
  ->with('mesaj','Ürün Sepete Eklendi.');

}

  public function kaldir($rowId){

   if (auth()->check())
   {
     $aktif_sepet_id = session ('aktif_sepet_id');
     $cartItem = Cart::get($rowId);
     SepetUrun::where('sepet_id',$aktif_sepet_id)->where('urun_id',$cartItem->id)->delete();
   }

  Cart::remove($rowId);
  return redirect()->route('sepet')
  ->with('mesaj_tur','success.')
  ->with('mesaj','Ürün Sepetten Kaldırıldı.');

}

public function bosalt(){
  if (auth()->check())
  {
    $aktif_sepet_id = session ('aktif_sepet_id');
    SepetUrun::where('sepet_id',$aktif_sepet_id)->delete();
  }

  Cart::destroy();
  return redirect()->route('sepet')
  ->with('mesaj_tur','success')
  ->with('mesaj', 'Sepetiniz boşaltıldı');
}
public function guncelle($rowId){
  $validator = Validator::make(request()->all(),[
          'adet' =>'required|numeric|between:0,5'
  ]);
        if($validator->fails())
        {
          session()->flash('mesaj_tur','danger');
          session()->flash('mesaj','Adet Değeri 1 ile 5 Arasında Olmalıdır.');
              return response()->json(['success'=>false]);
        }
        if (auth()->check())
        {

          $aktif_sepet_id = session ('aktif_sepet_id');
          $cartItem = Cart::get($rowId);
          SepetUrun::where('sepet_id',$aktif_sepet_id)->where('urun_id',$cartItem->id)
            ->update(['adet' =>request('adet')]);
        }

  Cart::update($rowId, request('adet'));

  session()->flash('mesaj_tur','success');
  session()->flash('mesaj','Adet Bilgisi Güncellendi');
  return response()->json(['success'=>true]);
}
}
