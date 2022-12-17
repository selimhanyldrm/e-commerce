<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\Siparis;
use App\Models\Models\Sepet;
use App\Models\Models\SepetUrun;
use App\Models\Models\Urun;
use App\Models\Models\UrunDetay;


class SiparisController extends Controller
{
  public function index(){

      $list = Siparis::orderByDesc('id')->paginate(8);
      return view('yonetim.siparis.index',compact('list'));

      }



    public function form($id=0){

      if($id > 0) {
        $entry = Siparis::with('sepet.sepet_urunler.urun')->find($id);
        
      }



      return view ('yonetim.siparis.form', compact('entry'));
    }



    public function kaydet($id=0){

      $this->validate(request(),[
        'urun_adi' => 'required',
        'fiyati' => 'required',


      ]);


      $data = request()->only('urun_adi','slug','aciklama','fiyati');

      $data_detay = request()->only('goster_slider','goster_gunun_firsati',
      'goster_one_cikan','goster_cok_satan','goster_indirimli');

      if($id>0)
      {
       $entry =Urun::where('id',$id)->firstOrFail();

       $entry -> update($data);

      $entry->detay()->update($data_detay);





      }
      else {
      $entry = Urun::create($data);
      $entry->detay()->create($data_detay);
      }


     if(request()->hasFile('urun_resmi'))
     {
       $this->validate(request(),[
         'urun_resmi' =>'image|mimes:jpg,png,jpeg,gif|max:2048'
       ]);

       $urun_resmi = request()->file('urun_resmi');
       $urun_resmi = request()->urun_resmi;

       $dosyaadi = $entry->id . "-" . time() . "." . $urun_resmi->extension();

       if($urun_resmi->isValid())
       {
         $urun_resmi->move('uploads/urunler',$dosyaadi);

         UrunDetay::updateOrCreate(

           ['urun_id' =>$entry->id],
           ['urun_resmi' => $dosyaadi]

         );
       }
 }




      return redirect()
      ->route('yonetim.urun.duzenle',$entry->id)
      ->with('mesaj',($id > 0 ? 'Güncellendi' : 'Kaydedildi'))
      ->with('mesaj_tur','success');
    }


    public function sil($id){

       Siparis::destroy($id);



      return redirect()
      ->route('yonetim.siparis')
      ->with('mesaj','Kayıt Silindi')
      ->with('mesaj_tur','success');
    }
}
