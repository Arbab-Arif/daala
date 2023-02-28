<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daala:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install project requirement things';

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
     */
    public function handle()
    {
        Artisan::call('daala:permissions');
        Artisan::call('daala:regions');
        Artisan::call('daala:areas');
    }
}
