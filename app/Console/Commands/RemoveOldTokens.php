<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RemoveOldTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'removeOldTokens:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'removing old tokens';

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
        \DB::delete('DELETE FROM user_tokens WHERE expires_at < NOW()');
        return 0;
    }
}
