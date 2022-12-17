<div class="col-sm-3 col-md-3 col-lg-2 sidebar collapse" id="sidebar">
    <div class="list-group">
        <a href="{{route('yonetim.anasayfa')}}" class="list-group-item">
            <span class="fa fa-fw fa-dashboard"></span> Giriş</a>


        <a href="{{route('yonetim.urun')}}" class="list-group-item">
            <span class="fa fa-fw fa-dashboard"></span> Ürünler
            <span class="badge badge-dark badge-pill pull-right">{{$istatistikler['toplam_urun']}}</span>
        </a>

        <a href="{{route('yonetim.kategori')}}" class="list-group-item">
            <span class="fa fa-fw fa-dashboard"></span> Kategoriler
            <span class="badge badge-dark badge-pill pull-right">{{$istatistikler['toplam_kategori']}}</span>
        </a>


      <a href="#" class="list-group-item collapsed" data-target="#submenu1" data-toggle="collapse" data-parent="#sidebar">
        <span class="fa fa-fw fa-dashboard"></span>Ürün Yorumları<span class="caret arrow"></span></a>


<div class="list-group collapse" id="submenu1">
<a href="#" class="list-group-item">Kategoriler</a>
<a href="#" class="list-group-item">Category</a>
</div>

        <a href="{{route('yonetim.kullanici')}}" class="list-group-item">
            <span class="fa fa-fw fa-dashboard"></span> Kullanıcılar
            <span class="badge badge-dark badge-pill pull-right">{{$istatistikler['toplam_kullanici']}}</span>
        </a>

        <a href="{{route('yonetim.siparis')}}" class="list-group-item">
            <span class="fa fa-fw fa-dashboard"></span> Siparişler
            <span class="badge badge-dark badge-pill pull-right">{{$istatistikler['bekleyen_siparis']}}</span>
        </a>

    </div>
</div>
