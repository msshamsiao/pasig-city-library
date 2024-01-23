<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteOverdueTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:overdue-transactions';
    protected $description = 'Delete overdue transactions';

    public function handle()
    {
        // Delete transactions that are overdue (return_date is in the past)
        DB::table('transactions')->where('return_date', '<', now())->delete();

        $this->info('Overdue transactions deleted successfully.');
    }
}
