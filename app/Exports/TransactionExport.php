<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\TransactionPerMonthSheet;
use Illuminate\Support\Facades\DB;

class TransactionExport implements WithMultipleSheets
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    protected $year;

    public function __construct(int $year)
    {
        $this->year = $year;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        for ($month = 1; $month <= 12; $month++) {
            $i = DB::table('carts')
                ->whereYear('created_at', $this->year)
                ->whereMonth('created_at', $month)
                ->where('status', 'Complete')
                ->count();
            $sheets[] = new TransactionPerMonthSheet($this->year, $month);
        }

        return $sheets;
    }
}
