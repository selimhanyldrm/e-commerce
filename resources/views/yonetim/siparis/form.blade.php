@extends('yonetim.layouts.master')
@section('title','Sipariş Yönetimi')
@section('content')
<div class="container-fluid">

<div class="row">

<div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-10 col-lg-offset-2 main">
  <h1 class="page-header">Sipariş Yönetimi</h1>
  @include('front.widgets.errors')
  @include('front.widgets.alert')
  <form method="post" action="{{route('yonetim.siparis.kaydet',$entry->id)}}" >
    @csrf
   <div class="pull-right">
      <button type="submit" class="btn btn-primary">
      {{@$entry->id>0 ? "Güncelle" : "Kaydet"}}
      </button>
    </div>
    <h1 class="sub-header">Sipariş  {{@$entry->id>0 ? "Düzenle" : "Ekle"}}</h1>


      <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="adsoyad">Ad Soyad</label>
                <input type="text" class="form-control" id="adsoyad" name="adsoyad" placeholder="Ad Soyad" value="{{old('adsoyad',$entry->adsoyad)}}">
            </div>
        </div>
      </div>
      <div class="row">
          <div class="col-md-12">
            <div class="form-group">
                <label for="telefon">Telefon</label>
                <input type="text" class="form-control"  id="telefon" name="telefon" placeholder="telefon" value="{{old('telefon',$entry->telefon)}}">
            </div>

          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
            <div class="form-group">
                <label for="ceptelefonu">Cep Telefonu</label>
                <input type="text" class="form-control"  id="ceptelefonu" name="ceptelefonu" placeholder="ceptelefonu" value="{{old('ceptelefonu',$entry->ceptelefonu)}}">
            </div>

          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
            <div class="form-group">
                <label for="telefon">Adres</label>
                <input type="text" class="form-control"  id="adres" name="adres" placeholder="adres" value="{{old('adres',$entry->adres)}}">
            </div>

          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
            <div class="form-group">
                <label for="durum">Durum</label>
                <select name="durum" class="form-control" id="durum">
                  <option {{ old('durum',$entry->durum) == 'Siparişiniz alındı' ? 'selected' : '' }}>Siparişiniz Alındı</option>
                  <option {{ old('durum',$entry->durum) == 'Ödemeniz alındı' ? 'selected' : '' }}>Ödeme Alındı</option>
                  <option {{ old('durum',$entry->durum) == 'Kargoya Verildi' ? 'selected' : '' }}>Kargoya Verildi</option>
                  <option {{ old('durum',$entry->durum) == 'Siparişiniz Tamamlandı' ? 'selected' : '' }}>Sipariş Tamamlandı</option>

            </div>

          </div>
      </div>


</form>

 <h3>Sipariş (SP-{{$entry->id }})</h3>
 <table class="table table-bordererd table-hover">
   <tr>
     <th colspan="2">Ürün</th>
     <th>Tutar</th>
     <th>Adet</th>
     <th>Ara Toplam</th>
     <th>Durum</th>
   </tr>
@foreach($siparis->sepet->sepet_urunler as $sepet_urun)
<tr>
  <td style="...">
    <a href="{{route('urun',$sepet_urun->urun->slug)}}"
      <img src=" ">
    </a>
    <td>
      <a href="{{route('urun',$sepet_urun->urun->slug)}}">
        {{$sepet_urun->urun->urun_adi}}
      </a>
    </td>
    <td>{{$sepet_urun->fiyati}}</td>
    <td>{{$sepet_urun->adet}}</td>
    <td>{{$sepet_urun->fiyati*$sepet_urun->adet}}</td>
    <td>{{$sepet_urun->durum}}</td>
  </tr>
  @endforeach

  <tr>
    <th colspan="4" class="text-right">Toplam Tutar</th>
      <td colspan="2" >{{$entry->siparis_tutari}}</td>
 </tr>

 <tr>
   <th colspan="4" class="text-right">Toplam Tutar (KDV'li)</th>
     <td colspan="2" >{{$entry->siparis_tutari*((100+config('cart.tax'))/100 )}}</td>
</tr>

<tr>
  <th colspan="4" class="text-right">Sipariş Durumu</th>
    <td colspan="2" >{{$entry->durum}}</td>
</tr>
</div>


</div>
</div>
</div>

  @endsection
