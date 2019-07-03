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
        $choice = $this->choice(base64_decode('562J6L+Z5Liq5paH5Lu26L+B56e75aW955qE5bCx5a+55oiR56yR5LiA5Liq5aW95LiN77yM6Z2Z6Z+z6K6+572u5Y675o6J5aW95LiN77yf'), [
            base64_decode('5aW955qE77yB')
        ]);
        if($choice){
            $bar = $this->output->createProgressBar(15);
            for ($i = 0; $i = 15; $i ++) {
                sleep(1);
                $bar->advance();
            }
            $bar->finish();
            $this->info(base64_decode('546w5Zyo5aW95LqG5Y+v5Lul5a6M5oiQ5Ymp5L2Z6YOo5YiG5LqG'));
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
        $this->info('');
    }
}
