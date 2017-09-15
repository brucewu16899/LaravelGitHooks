<?php

namespace Feek\LaravelGitHooks\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class PreCommit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hooks:pre-commit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Invoked within git pre-commit hook';

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
        foreach (config('hooks.pre-commit') as $command) {
            $statusCode = $this->call($command);

            if ($statusCode !== 0) {
                return $statusCode;
            }
        }

        $this->info('commit allowed!');

        return 0;
    }
}