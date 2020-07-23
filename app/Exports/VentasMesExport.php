<?php

namespace App\Exports;

use App\compra;
use Maatwebsite\Excel\Concerns\FromCollection;

class VentasMesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return compra::all()->where('mes', date('m'));
    }
}
