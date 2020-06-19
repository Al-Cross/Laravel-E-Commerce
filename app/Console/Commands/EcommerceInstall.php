<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class EcommerceInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecommerce:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install dummy data for the E-commerce application.';

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
     * @return mixed
     */
    public function handle()
    {
        $this->callSilent('storage:link');
        $copySuccess = File::copyDirectory(public_path('frontend/images/items'), public_path('storage/images'));

        if ($copySuccess) {
            $this->info('Images successfully copied to storage folder.');
        }

        $this->call('migrate:fresh', ['--seed' => true]);

        $this->info('Dummy data installed.');
    }
}
