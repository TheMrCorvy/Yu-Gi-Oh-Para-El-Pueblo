<?php

namespace App\Exports;

use App\OrdenCompra;
use Maatwebsite\Excel\Concerns\FromCollection;

class VentasAllExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return OrdenCompra::all();
    }
}
