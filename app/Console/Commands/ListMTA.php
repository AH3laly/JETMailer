<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MTAServer;

class ListMTA extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jetMailer:ListMTA
        {--enabled : Only list enabled servers} 
        {--disabled : Only list disabled servers}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List All MTA Servers';

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
        $enabledOption = $this->option('enabled');
        $disabledOption = $this->option('disabled');
        
        if($enabledOption && $disabledOption){
            $this->error("You can't use both --enabled and --disabled arguments at the same time.");
            return 1;
        }

        $filter = -1;
        if($enabledOption){
            $filter = 1;
        } elseif ($disabledOption){
            $filter = 0;
        }
        
        if($filter != -1){
            // List servers based on the requested filtering
            $this->table(
                ["ID", "Host", "Port", "Security", "Failures"], 
                MTAServer::where("enabled", $filter)->select('id','host','port','security','failures')->get()
            );
        } else {
            // List All Servers
            $this->table(
                ["ID", "Host", "Port", "Security", "Failures", "Enabled"], 
                MTAServer::select('id','host','port','security','failures','enabled')->get()
            );
        }
        
        

        return 0;
    }
}
