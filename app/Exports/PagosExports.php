<?php

namespace App\Exports;

use App\Models\Pago;
use Maatwebsite\Excel\Concerns\FromCollection;

class PagosExports implements FromCollection
{
    public function collection()
    {
        return Pago::all();
    }
}
