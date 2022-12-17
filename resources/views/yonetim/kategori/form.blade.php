@extends('yonetim.layouts.master')
@section('title','Kategori Yönetimi')
@section('content')
<div class="container-fluid">

<div class="row">

<div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-10 col-lg-offset-2 main">
  <h1 class="page-header">Kategori Yönetimi</h1>
  @include('front.widgets.errors')
  @include('front.widgets.alert')
  <form method="post" action="{{route('yonetim.kategori.kaydet',$entry->id)}}">
    @csrf
   <div class="pull-right">
      <button type="submit" class="btn btn-primary">
      {{@$entry->id>0 ? "Güncelle" : "Kaydet"}}
      </button>
    </div>
    <h1 class="sub-header">Kategori   {{@$entry->id>0 ? "Düzenle" : "Ekle"}}</h1>

    <div class="row">
      <div class="col-md-6">
          <div class="form-group">

              <label for="ust_id">Üst Kategori</label>
              <select name="ust_id" id="ust_id" class="form-control">
              @foreach($kategoriler as $kategori)
              <option value="{{$kategori->id}}">{{$kategori->kategori_adi}} </option>
              @endforeach
              </select>

          </div>
      </div>
    </div>

      <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="kategori_adi">Kategori Adı</label>
                <input type="text" class="form-control" id="kategori_adi" name="kategori_adi" placeholder="Kategori Adı " value="{{old('kategori_adi',$entry->kategori_adi)}}">
            </div>
        </div>
      </div>
      <div class="row">
          <div class="col-md-12">
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control"  id="slug" name="slug" placeholder="Slug" value="{{old('slug',$entry->slug)}}">
            </div>

          </div>
      </div>

</form>
</div>


</div>
</div>
</div>

  @endsection
