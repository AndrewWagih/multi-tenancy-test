<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Tenant;

class TenantsMigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "tenants:migrate {tenant?} {--fresh} {--seed}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Command description";

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
        if($this->argument("tenant")){
            $this->migrate(
                Tenant::find($this->argument("tenant"))
            );  
        }else{
            Tenant::all()->each(
                fn($tenant) => $this->migrate($tenant)
            );
        }
        return Command::SUCCESS;
    }

    public function migrate($tenant){ 
        $tenant->configure()->use();
        $this->line("");
        $this->line("------------------------------------------------");
        $this->line("migrating Tenant #{$tenant->id} ({$tenant->name})");
        $this->line("------------------------------------------------");
        $options = ['--force' => true];
        if($this->option('seed')){
            $options['--seed'] = true;
        }
        $this->call(
            $this->option("fresh") ? "migrate:fresh" : "migrate",
            $options
        );
    }
}
;