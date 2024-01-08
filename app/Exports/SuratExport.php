<?php

namespace App\Exports;

use App\Models\Letters;
use Maatwebsite\Excel\Concerns\FromCollection;

class SuratExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Letters::all();
    }
}
