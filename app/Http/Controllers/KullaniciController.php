<?php

namespace App\Http\Controllers;
use App\Models\Models\Kullanici;
use App\Models\Models\KullaniciDetay;
use App\Models\Models\Sepet;
use App\Models\Models\SepetUrun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Cart;

class KullaniciController extends Controller
{


  public function giris_form(){
    return view('front\kullanici\oturumac');
  }



  public function giris(Request $request){

    $this->validate(request(),[
      'email' =>'required|email',
      'password' =>'required'
    ]);
  $credentials = ['email'=>request('email'),
                 'password'=>request('sifre'),
                 'aktif_mi' => 1
];
    if(auth()->attempt($credentials,request()->has('benihatirla')))

    {

      request()->session()->regenerate();

        $aktif_sepet_id = Sepet::firstOrCreate(['kullanici_id'=>auth()->id()])->id;
        session()->put('aktif_sepet_id',$aktif_sepet_id);

        if(Cart::count()>0)
        {

          foreach(Cart::content() as $cartItem){
          SepetUrun::updateOrCreate(
            ['sepet_id' => $aktif_sepet_id, 'urun_id' =>$cartItem->id],
            ['adet' =>$cartItem->qty,'fiyati' =>$cartItem->price,'durum' =>'Beklemede']

            );
          }
        }

              Cart::destroy();
              $sepetUrunler =SepetUrun::where('sepet_id',$aktif_sepet_id)->get();

              foreach($sepetUrunler as $sepetUrun)
              {
                Cart::add(
                  $sepetUrun->urun->id,
                  $sepetUrun->urun->urun_adi,
                  $sepetUrun->adet,
                  $sepetUrun->fiyati,
                  ['slug'=>$sepetUrun->urun->slug]);
              }

      return redirect()->intended('/');

    }else{
      $errors = ['email'=>'Hatalı giriş'];
      return back()->withErrors($errors);
    }

  }


  public function kaydol_form(){
    return view('front\kullanici\kaydol');
  }


    public function kaydol(Request $request){

       $this->validate(request(),[
             'adsoyad' => 'required|min:5|max:60',
             'email' => 'required|email|unique:kullanici',
             'password' =>'required|min:5|max:15',
             'sifre_confirmation'=> 'required|same:password'

       ]);

        $kullanici = Kullanici::create([
         'adsoyad' =>request('adsoyad'),
         'email' =>request('email'),
         'sifre' =>Hash::make(request('sifre')),
         'aktivasyon_anahtari' =>Str::random(60),
         'aktif_mi' =>0
       ]);

        $kullanici -> detay()->save(new KullaniciDetay());


       auth()->login($kullanici);
       return redirect()->route('anasayfa');
    }


    public function oturumukapat(){
      auth()->logout();
      request()->session()->flush();
        request()->session()->regenerate();
       return redirect()->route('anasayfa');
    }
}
