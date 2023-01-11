<?php

namespace App\Console\Commands;

use App\Models\VerifyCode;
use Illuminate\Console\Command;

class ResetVerifyCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:verifyCodes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Очистка таблицы [verify_codes]';

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
        VerifyCode::where('created_at', '<=', now()->modify('-5 minutes'))
            ->where('attempt', '>=', config('app.auth_sms_send_limit'))
            ->orWhere('created_at', '<=', now()->modify('-6 hours'))
            ->delete();
    }
}
