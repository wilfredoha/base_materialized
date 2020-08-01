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

        usort($anios, function($a, $b) {
            return $b['nombre'] <=> $a['nombre'];
        });

        usort($idioma, function($a, $b) {
            return $a['nombre'] <=> $b['nombre'];
        });

        usort($disciplina, function($a, $b) {
            return $a['nombre'] <=> $b['nombre'];
        });

        usort($pais, function($a, $b) {
            return $a['nombre'] <=> $b['nombre'];
        });

        return view('home.ajax.primeraConsulta', compact('pal_bus', 'palabras_clave', 'totalResultados', 'anios', 'idioma', 'disciplina', 'pais'));
    }

    public function buscarPalabras()
    {
        $i_ide_usr = Auth::user()->id;
        $limite    = Auth::user()->limite;
        $url       = $_POST['url'];
        $fil       = $_POST['filtro'];
        $pal       = $_POST['textoABuscar'];

        exec("runredalyc $pal $i_ide_usr $url $fil $limite .");

        $email = DB::table('users')->select('email')->where('id', $i_ide_usr)->first();
        $email = $email->email;

        $data = ['message' => 'El resultado de la búsqueda - ' . str_replace("%20"," ", $pal) . ' - ha finalizado'];
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

    public function descargarResultadoBib()
    {
        $id_busqueda = $_GET['id_busqueda'];
        $datosBib = "";

        $reporte = DB::table('informacion')->where('id_busqueda', $id_busqueda)
               ->select('id', 'institucion', 'titulo', 'revista', 'autores', 'resumen', 'contenido', 'palabras', 'doi', 'idioma_articulo', 'ruta_html', 'ruta_pdf', 'paginas', 'issn', 'id_revista', 'id_articulo')
               ->get();
        $contador = 0;
        foreach ($reporte as $repo) {
          if ($contador == 0) {
            $datosBib =  $datosBib . "@article{";
          }else{
            $datosBib =  $datosBib . "\n@article{";
          }
          
          $datosBib = $datosBib . $repo->id.",\ninstitucion={".$repo->institucion."},\ntitulo={".$repo->titulo."},\nrevista={".$repo->revista."},\nautores={".$repo->autores."},\nresumen={".$repo->resumen."},\ncontenido={".$repo->contenido."},\npalabras={".$repo->palabras."},\ndoi={".$repo->doi."},\nidioma_articulo={".$repo->idioma_articulo."},\nruta_html={".$repo->ruta_html."},\nruta_pdf={".$repo->ruta_pdf."},\npaginas={".$repo->paginas."},\nissn={".$repo->issn."},\nid_revista={".$repo->id_revista."},\nid_articulo={".$repo->id_articulo."}},";
          
          $contador = $contador + 1;
        }

        $ubicacion = "bib/Descarga Bib " . $id_busqueda . ".bib";

        $myfile = fopen($ubicacion, "w");
        fwrite($myfile, substr($datosBib, 0, -1));
        fclose($myfile);

        return $ubicacion;
    }
}
