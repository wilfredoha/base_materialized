<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformacionController extends Controller
{
    public function informacion()
    {
      return view('informacion');
    }
}
