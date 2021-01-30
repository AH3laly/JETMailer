<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\MTAServer;

class EnableMTA extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jetMailer:EnableMTA {mta_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enable MTA server';

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
        MTAServer::where('id', $this->argument('mta_id'))->update(['enabled' => 1]);
        $this->info("Done".$this->argument('mta_id'));
        return 0;
    }
}
