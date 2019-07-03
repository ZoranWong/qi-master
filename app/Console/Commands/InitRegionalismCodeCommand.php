<?php

namespace App\Console\Commands;

use App\Models\Region;
use Illuminate\Console\Command;

class InitRegionalismCodeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:region';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init regionalism codes to database';

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
        $choice = $this->choice('可爱的小君君可以不要生我气吗？', [
            '好的！'
        ]);
        if(!$choice){
            return;
        }
        $choice = $this->ask('This command will truncate regions table,confirm(y/n)?', 'y');

        if ($choice !== 'y') {
            return;
        }

        Region::truncate();

        $regions = config('regionalism-codes');

        $bar = $this->output->createProgressBar(count($regions));

        $bar->start();

        foreach ($regions as $code => $name) {
            Region::create([
                'region_code' => $code,
                'name' => $name,
                'status' => Region::STATUS_ON
            ]);
            $bar->advance();
        }

        $bar->finish();

        $this->info('Region table init success.');
    }
}
