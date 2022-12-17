@extends('yonetim.layouts.master')
@section('title','Kullanıcı Yönetimi')
@section('content')
<div class="container-fluid">

<div class="row">

<div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-10 col-lg-offset-2 main">
  <h1 class="page-header">Kullanıcı Yönetimi</h1>
  @include('front.widgets.errors')
  @include('front.widgets.alert')
  <form method="post" action="{{route('yonetim.kullanici.kaydet',$entry->id)}}">
    @csrf
   <div class="pull-right">
      <button type="submit" class="btn btn-primary">
      {{@$entry->id>0 ? "Güncelle" : "Kaydet"}}
      </button>
    </div>
    <h1 class="sub-header">Kullanıcı   {{@$entry->id>0 ? "Düzenle" : "Ekle"}}</h1>



      <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="adsoyad">Ad Soyad</label>
                <input type="text" class="form-control" id="adsoyad" name="adsoyad" placeholder="Adınızı Ve Soyadınızı Giriniz" value="{{old('adsoyad',$entry->adsoyad)}}">
            </div>
        </div>
          <div class="col-md-6">
              <div class="form-group">
                  <label for="email">Email Adresi</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email Adresinizi Giriniz" value="{{old('email',$entry->email)}}">
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                  <label for="sifre">Şifre</label>
                  <input type="password" class="form-control" id="sifre" name="sifre" placeholder="Şifrenizi Giriniz">
              </div>
          </div>
      </div>

      @if($entry->detay != null)
      <div class="row">
          <div class="col-md-12">
            <div class="form-group">
                <label for="adres">Adres</label>
                <input type="text" class="form-control" id="adres" placeholder="Adresinizi Giriniz" value="{{old('adres',$entry->detay->adres)}}">
            </div>

          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                  <label for="adres">Telefon</label>
                  <input type="text" class="form-control" id="telefon" placeholder="Telefon Numaranızı Giriniz" value="{{old('telefon',$entry->detay->telefon)}}">
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                  <label for="ceptelefonu">Cep Telefonu</label>
                  <input type="text" class="form-control" id="ceptelefonu" placeholder=" Cep Telefon Numaranızı Giriniz" value="{{old('ceptelefonu',$entry->detay->ceptelefonu)}}">
              </div>
          </div>
      </div>
      @endif



      <div class="checkbox">
          <label>
            <input type="hidden" name="aktif_mi" value="0">
              <input type="checkbox" name="aktif_mi" value="1" {{old('aktif_mi',$entry->aktif_mi) ? 'checked' : ''}}> Aktif Mi ?
          </label>
      </div>
      <div class="checkbox">
          <label>
              <input type="hidden" name="yonetici_mi" value="0">
              <input type="checkbox" name="yonetici_mi" value="1" {{old('yonetici_mi',$entry->yonetici_mi) ? 'checked' : ''}}> Yönetici Mi ?
          </label>
      </div>

  </form>
</div>


</div>
</div>
</div>

  @endsection
