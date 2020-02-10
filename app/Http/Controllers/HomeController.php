<?php

namespace App\Http\Controllers;
use App\Mail\TestEmail;
use App\Exports\DescargarResultado;
// use Excel;
use Mail;
use Auth;
use DB;

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
        $consultas = DB::table('busqueda')->where([['user_id',Auth::user()->id],['estado',1]])->get();
        return view('dashboard', compact('consultas'));
    }

    public function buscarPalabras()
    {
        $i_ide_usr = $_POST['i_ide_usr'];

        $palabras  = $_POST['palabras_clave'];
        $palabras  = '"'.$palabras.'"';
        
        exec("runredalyc $palabras $i_ide_usr .");

        $email = DB::table('users')->select('email')->where('id', $i_ide_usr)->first();
        $email = $email->email;

        $data = ['message' => 'This is a test!'];
        Mail::to($email)->send(new TestEmail($data));
    }

    public function descargarResultado()
    {
        $id_busqueda = $_GET['id_busqueda'];

        return (new DescargarResultado( $id_busqueda ))->download('Descarga '. $id_busqueda .'.xlsx');
    }
}
