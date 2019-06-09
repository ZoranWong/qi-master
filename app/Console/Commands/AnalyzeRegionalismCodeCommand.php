<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AnalyzeRegionalismCodeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analyze:regionalism-code';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Analyze region code txt data to json';

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
        $filePath = database_path('regions.data');
        $originContent = file_get_contents($filePath);
        $regions = explode(PHP_EOL, $originContent);
        $final = "<?php" . PHP_EOL . "return [" . PHP_EOL;
        foreach ($regions as $region) {
            if (trim($region)) {
                list($key, $value) = explode("\t", $region);
                $final .= "\t" . "'{$key}' => '{$value}'," . PHP_EOL;
            }
        }
        $final .= "];";

        $filePath = config_path('regionalism-codes.php');
        file_put_contents($filePath, $final);
    }
}
