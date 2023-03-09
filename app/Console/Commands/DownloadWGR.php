<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DownloadWGR extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:wgr';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download WGR data from the web';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
