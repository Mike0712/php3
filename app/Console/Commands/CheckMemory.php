<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class CheckMemory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'memory:check {number}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Сheck the size of available memory';

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
        $number = (int) $this->argument('number');
        $before = memory_get_usage(true);
        $array = range(1 ,$number);
        $after = memory_get_usage(true);

        $total = (int) $after - (int) $before;

        $single = $total/count($array);
        $result = ['total memory on 1 million items ' . $total . ' bytes', 'result of one integer set is ' . $single .  'bytes'];


        $log = new Logger('Checking Memory');
        $log->pushHandler(new StreamHandler(base_path('storage/logs/checkmem.log', Logger::INFO)));
        $log->info('report', $result);
    }
}
