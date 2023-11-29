<?php

namespace App\Exports\Sheets;

use App\Models\Transaction;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransactionPerMonthSheet implements FromView, WithTitle, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $month;
    private $year;

    public function __construct(int $year, int $month)
    {
        $this->month = $month;
        $this->year  = $year;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return Transaction
            ::query()
            ->where('status', '=', 'Complete')
            ->whereYear('created_at', $this->year)
            ->whereMonth('created_at', $this->month);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return DateTime::createFromFormat('!m', $this->month)->format('F');
    }

    public function view(): View
    {
        // Log::channel('excel')->info($this->year);
        // Log::channel('excel')->info($this->month);
        return view('admin.transaction.export', [
            'data' => DB::table('transactions')
                ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
                ->where('transactions.status', '=', 'Complete')
                ->whereYear('transactions.created_at', $this->year)
                ->whereMonth('transactions.created_at', $this->month)
                ->get()
        ]);
    }
}
