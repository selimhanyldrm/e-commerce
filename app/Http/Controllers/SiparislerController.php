<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiparislerController extends Controller
{
  public function index(){
    return view('front\siparisler');
  }
  public function detay(){
    return view('front\siparis');
  }
}
