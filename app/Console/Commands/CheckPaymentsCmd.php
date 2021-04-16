<?php

namespace App\Console\Commands;

use App\Http\Controllers\CompanyPaymentController;
use Illuminate\Console\Command;

class CheckPaymentsCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chk:payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Odemeleri check eder.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo CompanyPaymentController::check();
        return 0;
    }
}
