<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siparis extends Model
{

  protected $table = 'siparis';
  protected $fillable = ['sepet_id','siparis_tutari','banka','taksit_sayisi','durum'];

    public $timestamps = false;

  public function sepet()
  {
    return $this->belongsTo('App\Models\Models\Sepet');
  }

}
