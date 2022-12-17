@extends('yonetim.layouts.master')
@section('title','Ürün Yönetimi')
@section('content')
<div class="container-fluid">

<div class="row">

<div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-10 col-lg-offset-2 main">
  <h1 class="page-header">Ürün Yönetimi</h1>
                  <h1 class="sub-header">
                      <div class="btn-group pull-right">
                        <a href="{{route('yonetim.urun.yeni')}}" class="btn btn-primary">Yeni</a>
                      </div>
                      Table
                  </h1>

                @include('front.widgets.alert')
                  <div class="table-responsive">
                      <table class="table table-hover table-bordered">
                          <thead class="thead-dark">
                              <tr>
                                  <th>#</th>
                                  <th>Slug</th>
                                  <th>Ürün Adı</th>
                                  <th>Fiyatı</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($list as $entry)
                              <tr>
                                  <td>{{$entry->id}}</td>
                                  <td>{{$entry->slug}}</td>
                                  <td>{{$entry->urun_adi}}</td>
                                  <td>{{$entry->fiyati}}</td>
                                  <td>{{$entry->created_at}}</td>
                                  <td style="width: 100px">
                                      <a href="{{route('yonetim.urun.duzenle', $entry->id )}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                                          <span class="fa fa-pencil"></span>
                                      </a>
                                      <a href="{{route('yonetim.urun.sil',$entry->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin Misiniz ?')">
                                          <span class="fa fa-trash"></span>
                                      </a>
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
                  </div>
                  </div>
                  </div>
@endsection
