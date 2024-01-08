<?php

namespace App\Exports;

use App\Models\LetterTypes;
use Maatwebsite\Excel\Concerns\FromCollection;

class KlasifikasiSuratExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LetterTypes::all();
    }
}
