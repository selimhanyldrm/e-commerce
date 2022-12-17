<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = "kategori";
  //  protected $fillable = ['kategori_adi','slug'];
    protected $guarded = [];
    const created_at = "oluşturulma_tarihi";
    const updated_at = "güncelleme_tarihi";

    public function urunler()
    {
      return $this->belongsToMany('App\Models\Models\Urun','kategori_urun');
    }

    public function ust_kategori(){
      return $this->belongsto('App\Models\Models\Kategori','ust_id')->withDefault([
        'kategori_adi' => 'Ana Kategori'
      ]);
    }
}
