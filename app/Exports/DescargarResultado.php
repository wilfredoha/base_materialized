<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DescargarResultado implements WithMultipleSheets
{
	use Exportable;

	protected $id;

	public function __construct(int $id)
	{
	    $this->id    = $id;
	}
    /**
    * @return \Illuminate\Support\Collection
    */
    public function  sheets(): array
    {
        $sheets = [];

        $sheets[] = new ResultadoDescargar($this->id);
        
        return $sheets;
    }
}
