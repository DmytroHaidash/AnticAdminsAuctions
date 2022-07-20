<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class LotsExport implements FromView , ShouldAutoSize, WithColumnFormatting
{
    public $lots;
    public $columns;

    public function __construct($lots, $columns)
    {
        $this->lots = $lots;
        $this->columns = $columns;
    }

    public function view(): View
    {
        return view('exports.lots', [
            'lots' => $this->lots,
            'columns' => $this->columns,
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}