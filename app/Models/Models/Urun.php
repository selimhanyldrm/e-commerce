<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urun extends Model
{
    protected $table = "urun";
      protected $guarded = [];
      const created_at = "oluşturulma_tarihi";
      const updated_at = "güncelleme_tarihi";

      public function kategoriler()
      {
        return $this->belongsToMany('App\Models\Models\Kategori','kategori_urun');
      }
      public function detay()
      {
        return $this->hasOne('App\Models\Models\UrunDetay')->withDefault();
      }
}
