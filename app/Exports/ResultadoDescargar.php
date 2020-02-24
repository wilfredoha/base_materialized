<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

use DB;

class ResultadoDescargar implements FromCollection, WithHeadings, WithTitle
{
	protected $id;

	public function __construct(int $id)
	{
	    $this->id    = $id;
	}
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $id = $this->id;

        $reporte = DB::table('informacion')->where('id_busqueda', $id)
               ->select('institucion', 'titulo', 'revista', 'autores', 'resumen', 'contenido', 'palabras', 'doi', 'idioma_articulo', 'ruta_html', 'ruta_pdf', 'paginas', 'issn', 'id_revista', 'id_articulo')
               ->get();

        return collect($reporte);
    }

    public function title(): string
    {
        return 'Resultado ';
    }

    public function headings() : array
    {
        return [
            'INSTITUCION',
            'TITULO',
            'REVISTA',
            'AUTORES',
            'RESUMEN',
            'CONTENIDO',
            'PALABRAS',
            'DOI',
            'IDIOMA',
            'RUTA HTML',
            'RUTA PDF',
            'PAGINAS',
            'ISSN',
            'ID REVISTA',
            'ID ARTICULO'
        ];
    }
}
