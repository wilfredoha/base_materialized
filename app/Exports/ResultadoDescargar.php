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

        $reporte = DB::table('informacion')->where('id_busqueda', $id)->get();

        return collect($reporte);
    }

    public function title(): string
    {
        return 'Resultado ';
    }

    public function headings() : array
    {
        return [
            '1',
            '2',
            '3',
            '4',
            '5'
        ];
    }
}
