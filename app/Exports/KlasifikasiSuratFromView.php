<?php

namespace App\Exports;

use App\Models\LetterTypes;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use \PhpOffice\PhpSpreadsheet\Style\Border;
use \PhpOffice\PhpSpreadsheet\Style\Alignment;

class KlasifikasiSuratFromView implements FromView, ShouldAutoSize, WithStyles
{
    public function view(): View
    {
        return view('exports.klasifikasi-surat', [
            'klasifikasi' => LetterTypes::all()
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);
        $sheet->setShowGridlines(false);

        $count =  LetterTypes::count() + 1;

        for($i = 1; $i <= $count; $i++) {
            $sheet->getStyle("A". $i . ":" . "C".$i)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ]);

            $sheet->getStyle("A". $i)->applyFromArray([
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
            ]);
        }
    }
}
