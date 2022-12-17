<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\SepetUrun;
use App\Models\Models\Siparis;
use App\Models\Models\Sepet;
use Illuminate\Support\Facades\Auth;
use Cart;

class OdemeController extends Controller
{
  public function index(){

    if (!auth()->check())
    {
      return redirect()->route('kullanici.oturumac')
      ->with('mesaj_tur','info')
      ->with('mesaj','Odeme işlemi için oturum açmanız veya kullanıcı kaydı yapmanız gerekmektedir.');

    }
    else if(count(Cart::content())==0)
    {
      return redirect()->route('anasayfa')
      ->with('mesaj_tur','info')
      ->with('mesaj','Odeme işlemi için sepetinizde ürün bulunmamaktadır.');
    }

    $kullanici_detay = auth()->user()->detay;

    return view('front\odeme',compact('kullanici_detay'));
  }
  public function odemeyap(Request $req) {
    $total = 0;

    $kart_numarasi = str_replace('-', '', $req->kart_numarasi);
    $son_kullanma_tarihi_yil = $req->son_kullanma_tarihi_yil;
    $son_kullanma_tarihi_ay = $req->son_kullanma_tarihi_ay;
    $cardcvv2 = $req->cardcvv2;
    $adsoyad = $req->adsoyad;
    $adres = $req->adres;
    $telefon = $req->telefon;
    $total = Cart::total();
    //dd($request,$total,Cart::content(),Cart::total(),$kart_numarasi,$son_kullanma_tarihi_yil,$son_kullanma_tarihi_ay,$adsoyad);
    $options = new \Iyzipay\Options();
    $options->setApiKey(env("TEST_IYZI_API_KEY"));
    $options->setSecretKey(env("TEST_IYZI_SCRET_KEY"));
    $options->setBaseUrl(env("TEST_IYZI_BASE_URL"));

    $request = new \Iyzipay\Request\CreatePaymentRequest();
    $request->setLocale(\Iyzipay\Model\Locale::TR);
    $request->setConversationId("1231213");
    $request->setPrice($total);
    $request->setPaidPrice($total);
    $request->setCurrency(\Iyzipay\Model\Currency::TL);
    $request->setInstallment(1);
    $request->setBasketId($kart_numarasi.'-'.$adsoyad);
    $request->setPaymentChannel(\Iyzipay\Model\PaymentChannel::WEB);
    $request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);

    $paymentCard = new \Iyzipay\Model\PaymentCard();
    $paymentCard->setCardHolderName($adsoyad);
    $paymentCard->setCardNumber($kart_numarasi);
    $paymentCard->setExpireMonth($son_kullanma_tarihi_ay);
    $paymentCard->setExpireYear($son_kullanma_tarihi_yil);
    $paymentCard->setCvc($cardcvv2);
    $paymentCard->setRegisterCard(0);
    $request->setPaymentCard($paymentCard);

    $buyer = new \Iyzipay\Model\Buyer();
    $buyer->setId("BY789");
    $buyer->setName("John");
    $buyer->setSurname("Doe");
    $buyer->setGsmNumber("+905350000000");
    $buyer->setEmail("email@email.com");
    $buyer->setIdentityNumber("74300864791");
    $buyer->setLastLoginDate("2015-10-05 12:43:35");
    $buyer->setRegistrationDate("2013-04-21 15:12:09");
    $buyer->setRegistrationAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
    $buyer->setIp("85.34.78.112");
    $buyer->setCity("Istanbul");
    $buyer->setCountry("Turkey");
    $buyer->setZipCode("34732");
    $request->setBuyer($buyer);

    $shippingAddress = new \Iyzipay\Model\Address();
    $shippingAddress->setContactName("Jane Doe");
    $shippingAddress->setCity("Istanbul");
    $shippingAddress->setCountry("Turkey");
    $shippingAddress->setAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
    $shippingAddress->setZipCode("34742");
    $request->setShippingAddress($shippingAddress);

    $billingAddress = new \Iyzipay\Model\Address();
    $billingAddress->setContactName("Jane Doe");
    $billingAddress->setCity("Istanbul");
    $billingAddress->setCountry("Turkey");
    $billingAddress->setAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
    $billingAddress->setZipCode("34742");
    $request->setBillingAddress($billingAddress);

    $basketItems = array();
    foreach (Cart::content() as $key => $value) {
      $firstBasketItem = new \Iyzipay\Model\BasketItem();
      $firstBasketItem->setId($value->rowId);
      $firstBasketItem->setName($value->name);
      $firstBasketItem->setCategory1("Collectibles");
      $firstBasketItem->setCategory2("Accessories");
      $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
      $firstBasketItem->setPrice($total);
      $basketItems[0] = $firstBasketItem;
    }

    $request->setBasketItems($basketItems);
    $payment = \Iyzipay\Model\Payment::create($request, $options);
      if ($payment->getStatus() == 'success'){
        $sepet = Sepet::where('id',Auth::user()->id)->first();

        $siparis = new Siparis();
        $siparis->sepet_id = $sepet->id;
        $siparis->siparis_tutari = $total;
        $siparis->durum="Siparis Alındı";
        $siparis->save();
        $aktif_sepet_id = session ('aktif_sepet_id');
        SepetUrun::where('sepet_id',$aktif_sepet_id)->delete();
        Cart::destroy();
        return redirect()->route('anasayfa')
        ->with('mesaj_tur','success')
        ->with('mesaj', 'Ödeme Başarılı');
        } else{
          return redirect()->route('sepet')
          ->with('mesaj_tur','danger')
          ->with('mesaj', 'Ödeme Başarısız');
        }

  }
}
