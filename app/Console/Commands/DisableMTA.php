<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\MTAServer;

class DisableMTA extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jetMailer:DisableMTA {mta_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disable MTA server';

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
        // Check How many MTA Servers are Enabled
        if(MTAServer::where('enabled', 1)->count() == 1){
            
            $this->question("You only have one MTA Server Enabled,");
            $this->question("There should be at least one enabled MTA server to deliver emails.");
            
            if (!$this->confirm('Are you sure you need to proceed with disabling this server?')) {
                $this->info("Good Choise.");
                return 1;
            }
        }

        MTAServer::where('id', $this->argument('mta_id'))->update(['enabled' => 0]);
        $this->info("Done");
        return 0;
    }
}
