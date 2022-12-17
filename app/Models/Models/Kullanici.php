<?php

namespace App\Models\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Kullanici extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;



     protected $table = "kullanici";
    protected $fillable = [
        'adsoyad',
        'email',
        'sifre',
        'aktivasyon_anahtari',
        'aktif_mi'
    ];


    protected $hidden = [
        'sifre',
        'aktivasyon_anahtari',
    ];



    const created_at = "oluşturulma_tarihi";
    const updated_at = "güncelleme_tarihi";

    public function getAuthPassword()
    {
      return $this->sifre;
    }


    public function detay()
    {
      return $this->hasOne('App\Models\Models\KullaniciDetay')->withDefault();
    }
}
