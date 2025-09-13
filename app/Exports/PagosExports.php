<?php

namespace App\Exports;

use App\Models\Pago;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PagosExports implements FromCollection, WithHeadings
{
    /**
     * Retorna todos los pagos
     */
    public function collection()
    {
        return Pago::all(['id', 'estudiante_documento', 'tipo', 'fecha_pago', 'valor', 'medio_pago', 'estado']);
    }

    /**
     * Define los encabezados de las columnas
     */
    public function headings(): array
    {
        return [
            'ID',
            'Documento del Estudiante',
            'Tipo de Pago',
            'Fecha de Pago',
            'Valor',
            'Medio de Pago',
            'Estado',
        ];
    }
}
