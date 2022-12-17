<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SepetUrun extends Model
{
   protected $table = "sepet_urun";
    protected $guarded = [];
    const created_at = "oluşturulma_tarihi";
    const updated_at = "güncelleme_tarihi";

public function urun()
{
  return $this->belongsTo('App\Models\Models\Urun');
}
}
