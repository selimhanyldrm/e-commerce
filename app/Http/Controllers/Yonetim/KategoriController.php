<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\Kategori;
use App\Models\Models\Sepet;

class KategoriController extends Controller
{

public function index(){

    $list = Kategori::orderByDesc('id')->paginate(8);
    return view('yonetim.kategori.index',compact('list'));

    }



  public function form($id=0){
    $entry = new Kategori;
    if($id > 0) {
      $entry = Kategori::find($id);
    }

    $kategoriler = Kategori::all();

    return view ('yonetim.kategori.form', compact('entry','kategoriler'));
  }



  public function kaydet($id=0){

    $this->validate(request(),[
      'kategori_adi' => 'required',

    ]);


    $data = request()->only('kategori_adi','slug','ust_id');


    if($id>0)
    {
     $entry =Kategori::where('id',$id)->firstOrFail();

     $entry -> update($data);



    }
    else {
    $entry = Kategori::create($data);
    }





    return redirect()
    ->route('yonetim.kategori.duzenle',$entry->id)
    ->with('mesaj',($id > 0 ? 'Güncellendi' : 'Kaydedildi'))
    ->with('mesaj_tur','success');
  }


  public function sil($id){

     $kategori=Kategori::find($id);
     $kategori->urunler()->detach();
     $kategori->delete();


    return redirect()
    ->route('yonetim.kategori')
    ->with('mesaj','Kayıt Silindi')
    ->with('mesaj_tur','success');
  }
}
