<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sepet extends Model
{
    protected $table = "sepet";
    protected $guarded = [];
    const created_at = "oluşturulma_tarihi";
    const updated_at = "güncelleme_tarihi";


      public function siparis()
      {
        return $this->hasOne('App\Models\Models\Siparis');
      }
}
