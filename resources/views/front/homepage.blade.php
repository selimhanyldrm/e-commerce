@extends('front.layouts.master')
@section('title','Anasayfa')
@section('content')
<body id="commerce">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('anasayfa')}}">
                    <img src="{{asset('img/logo3 .png')}}">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <form class="navbar-form navbar-left" action="{{route('urun_ara')}}" method="POST">
                  @csrf
                    <div class="input-group">
                        <input type="text" name="aranan" id="navbar-search" class="form-control" placeholder="Ara">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{route('sepet')}}"><i class="fa fa-shopping-cart"></i> Sepet <span class="badge badge-theme">{{Cart::count()}}</span></a></li>
                    @guest
                    <li><a href="{{route('kullanici.oturumac')}}">Oturum Aç</a></li>
                    <li><a href="{{route('kullanici.kaydol')}}">Kaydol</a></li>
                    @endguest


                    @auth
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Profil <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Siparişlerim</a></li>
                            <li role="separator" class="divider"></li>
                            <li>
                              <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Çıkış</a>
                              <form id="logout-form" action="{{route('kullanici.oturumukapat')}}" method="POST" style="display: none;">
                                @csrf
                              </form>
                            </li>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <br>
    @include('front.widgets.alert')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Kategoriler</div>
                    <div class="list-group categories">
                      @foreach($kategoriler as $kategori)
                        <a href="{{route('kategori',$kategori->slug)}}" class="list-group-item">
                          <i class="fa fa-arrow-circle-o-right"></i>
                        {{$kategori->kategori_adi}}
                         </a>
         @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      @for($i=0;$i<count($urunler_slider);$i++)
                        <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner" role="listbox">
                      @foreach($urunler_slider as $index => $urun_detay)
                        <div class="item {{ $index ==0 ? 'active' : '' }}">
                            <img src="https://st.myideasoft.com/idea/cr/39/myassets/products/962/1-turbox-tr-215.jpg?revision=1623755264" alt="...">
                            <div class="carousel-caption">
                                {{$urun_detay->urun->urun_adi}}
                            </div>
                        </div>
                           @endforeach
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default" id="sidebar-product">
                    <div class="panel-heading">Günün Fırsatı</div>
                    <div class="panel-body">
                        <a href="{{route('urun',$urun_gunun_firsati->slug)}}">
                            <img src="https://productimages.hepsiburada.net/s/43/1500/10764631343154.jpg" class="img-responsive">
                            {{$urun_gunun_firsati->urun_adi}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Öne Çıkan Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                      @foreach($urunler_one_cikan as $urun_detay)
                        <div class="col-md-3 product">
                            <a href="{{route('urun',$urun_detay->urun->slug)}}">
                              <img src="https://img.vivense.com/1920x1280/images/08c9e040d28c48f88c07e720353c5afe.jpg">
                            </a>
                            <p><a href="{{route('urun',$urun_detay->urun->slug)}}">
                              {{$urun_detay->urun->urun_adi}}</a>
                            </p>
                            <p class="price">{{$urun_detay->urun->fiyati}}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Çok Satan Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                      @foreach($urunler_cok_satan as $urun_detay)
                        <div class="col-md-3 product">
                            <a href="{{route('urun',$urun_detay->urun->slug)}}">
                              <img src="https://cdn.dmags.net/assets/covers/490x576/forbes-20160501-6045.jpg">
                            </a>
                            <p><a href="{{route('urun',$urun_detay->urun->slug)}}">
                              {{$urun_detay->urun->urun_adi}}</a>
                            </p>
                            <p class="price">{{$urun_detay->urun->fiyati}}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">İndirimli Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                      @foreach($urunler_indirimli as $urun_detay)
                        <div class="col-md-3 product">
                            <a href="{{route('urun',$urun_detay->urun->slug)}}">
                              <img src="https://m.media-amazon.com/images/I/41SgfaPgmEL._AC_SY780_.jpg">
                            </a>
                            <p><a href="{{route('urun',$urun_detay->urun->slug)}}">{{$urun_detay->urun->urun_adi}}</a></p>
                            <p class="price">{{$urun_detay->urun->fiyati}}</p>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
