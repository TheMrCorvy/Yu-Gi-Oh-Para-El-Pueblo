<?php

namespace App\Imports;

use App\Product;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProductsImport implements ToCollection
{
    /**
    * @param Collection $collection
    */

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            // $categoria;

            // switch ($row[2]) {
            //     case 1:
            //         $categoria = "Yu-Gi-Oh!";
            //         break;
                
            //     default:
            //         $categoria = "Yu-Gi-Oh!";
            //         break;
            // }

            // $producto;

            // switch ($row[1]) {
            //     case 1:
            //         $producto = 'Carta de Yu-Gi-Oh!';
            //         break;
            //     case 2:
            //         $producto = 'Sobres Sellados Yu-Gi-Oh!';
            //         break;
            //     case 3:
            //         $producto = 'Tin de Yu-Gi-Oh!';
            //         break;
            //     case 4:
            //         $producto = 'Boosterbox de Yu-Gi-Oh!';
            //         break;
            //     case 5:
            //         $producto = 'Deckbox';
            //         break;
            //     case 6:
            //         $producto = 'Folios Para Cartas';
            //         break;
            //     case 7:
            //         $producto = 'Playmat / Manta';
            //         break;
            //     case 8:
            //         $producto = 'Core de Yu-Gi-Oh!';
            //         break;
            //     case 9:
            //         $producto = 'Mazo Estructura de Yu-Gi-Oh!';
            //         break;
                
            //     default:
            //         $producto = 'Carta de Yu-Gi-Oh!';
            //         break;
            // }

            // $tipo;

            // switch ($row[7]) {
            //     case 1:
            //         $tipo = 'Carta de Trampa';
            //         break;
            //     case 2:
            //         $tipo = 'Carta Mágica';
            //         break;
            //     case 3:
            //         $tipo = 'Carta de Monstruo';
            //         break;
            //     case 4:
            //         $tipo = 'Token';
            //         break;
            //     case 5:
            //         $tipo = 'Field Center (Centro de Campo)';
            //         break;
            //     default:
            //         $tipo = '';
            //         break;
            // }
            Product::create([
                'nombre' => $row[0], 
                'producto' => $row[1], 
                'categoria' => $row[2],
                'stock' => $row[3], 
                'precio' => $row[4], 
                'estado' => $row[5], 
                'idioma' => $row[6], 
                'tipo_carta' => $row[7], 
                'rareza' => $row[8], 
                'expansion' => $row[9], 
                'marca' => $row[10], 
                'cantidad_incluida' => $row[11], 
                'color' => $row[12],
                'capacidad' => $row[13],
                'size' => $row[14],
                'descripcion' => $row[15],
                'oferta' => $row[16], 
                'fecha_oferta' => Date::excelToDateTimeObject($row[17]),
                'link_img' => $row[18], 
            ]);
        }
    }
}