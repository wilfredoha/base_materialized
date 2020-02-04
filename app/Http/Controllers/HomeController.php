<?php

namespace App\Http\Controllers;
use App\Mail\TestEmail;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard');
    }

    public function buscarPalabras()
    {
        $palabras = $_POST['palabras_clave'];
        $palabras = '"'.$palabras.'"';

        $data = ['message' => 'This is a test!'];

        Mail::to('wilfredoholguin76@gmail.com')->send(new TestEmail($data));

        // exec('runredalyc '.$palabras.' .');

        // echo $palabras . ' - ' . $_POST['i_ide_usr'];
    }
}
