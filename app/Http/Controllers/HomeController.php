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

    public function primeraConsulta()
    {
        $palabras_clave  = $_POST['palabras_clave'];
        $pal_bus         = $_POST['pal_bus'];
        $get_data        = $this->callAPI('GET', "https://www.redalyc.org/service/r2020/getArticles/".$palabras_clave."/1/10/1/default", false);
        $response        = json_decode($get_data, true);
        $filtros         = $response['filtros'];
        $totalResultados = $response['totalResultados'];
        $anios           = $filtros[0]['elementos'];
        $idioma          = $filtros[1]['elementos'];
        $disciplina      = $filtros[2]['elementos'];
        $pais            = $filtros[3]['elementos'];

        return view('home.ajax.primeraConsulta', compact('pal_bus', 'palabras_clave', 'totalResultados', 'anios', 'idioma', 'disciplina', 'pais'));
    }

    public function buscarPalabras()
    {
        $i_ide_usr = Auth::user()->id;
        $limite    = Auth::user()->limite;
        $url       = $_POST['url'];
        $fil       = $_POST['filtro'];
        $pal       = $_POST['textoABuscar'];
dd($fil);
        exec("runredalyc $pal $i_ide_usr $url $fil .");

        $email = DB::table('users')->select('email')->where('id', $i_ide_usr)->first();
        $email = $email->email;

        $data = ['message' => 'This is a test!'];
        Mail::to($email)->send(new TestEmail($data));
    }

    public function callAPI($method, $url, $data){
       $curl = curl_init();
       switch ($method){
          case "POST":
             curl_setopt($curl, CURLOPT_POST, 1);
             if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
             break;
          case "PUT":
             curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
             if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);                              
             break;
          default:
             if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
       }
       // OPTIONS:
       curl_setopt($curl, CURLOPT_URL, $url);
       curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          'APIKEY: 111111111111111111111',
          'Content-Type: application/json',
       ));
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
       // EXECUTE:
       $result = curl_exec($curl);
       if(!$result){die("Connection Failure");}
       curl_close($curl);
       return $result;
    }

    public function descargarResultado()
    {
        $id_busqueda = $_GET['id_busqueda'];

        return (new DescargarResultado( $id_busqueda ))->download('Descarga '. $id_busqueda .'.xlsx');
    }
}
