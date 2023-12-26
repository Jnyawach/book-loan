<?php

namespace App\Console\Commands;

use App\Enums\BorrowingStatusEnum;
use App\Models\BookLoan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MarkLoanDelayed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loan:delayed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $loans=BookLoan::whereIn('status',[BorrowingStatusEnum::BORROWED->value,BorrowingStatusEnum::EXTENDED->value])
            ->whereDate('due_date','<',Carbon::now())->get();

        foreach ($loans as $loan){
            $loan->update([
                'status'=>BorrowingStatusEnum::DELAYED->value
            ]);
        }
    }
}
