@extends('yonetim.layouts.master')
@section('title','Anasayfa')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-10 col-lg-offset-2 main">
                <h1 class="page-header">Kontrol Paneli</h1>

                <section class="row text-center placeholders">
                    <div class="col-6 col-sm-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Bekleyen Sipariş</div>
                            <div class="panel-body">
                                <h4>{{$istatistikler['bekleyen_siparis']}}</h4>
                                <p>adet</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Tamamlanan Sipariş</div>
                            <div class="panel-body">
                                <h4>{{$istatistikler['tamamlanan_siparis']}}</h4>
                                <p>adet</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Ürün</div>
                            <div class="panel-body">
                                <h4>{{$istatistikler['toplam_urun']}}</h4>
                                <p>adet</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Kullanıcı</div>
                            <div class="panel-body">
                                <h4>{{$istatistikler['toplam_kullanici']}}</h4>
                                <p>kişi</p>
                            </div>
                        </div>
                    </div>
                </section>




    <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <script src="{{asset('backend/js/admin-app.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
  
</body>
</html>
@endsection
