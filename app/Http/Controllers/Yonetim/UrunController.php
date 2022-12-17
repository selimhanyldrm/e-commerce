<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\Urun;
use App\Models\Models\UrunDetay;
use App\Models\Models\Sepet;

class UrunController extends Controller
{
  public function index(){

      $list = Urun::orderByDesc('id')->paginate(8);
      return view('yonetim.urun.index',compact('list'));

      }



    public function form($id=0){
      $entry = new Urun;
      if($id > 0) {
        $entry = Urun::find($id);
      }

      $ürünler = Urun::all();

      return view ('yonetim.urun.form', compact('entry','ürünler'));
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

       $urun=Urun::find($id);
       $urun->kategoriler()->detach();
       $urun->delete();


      return redirect()
      ->route('yonetim.urun')
      ->with('mesaj','Kayıt Silindi')
      ->with('mesaj_tur','success');
    }
}
