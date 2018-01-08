<?php

namespace App\Console\Commands;

use App\SomeClass;
use Illuminate\Console\Command;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ChasingTheCicle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chasing:cycle {quantity} {iterateNum}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking the size of memory in manupulate with cycle';

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
        $quantity = (int) $this->argument('quantity');
        $iterateNum = (int) $this->argument('iterateNum');

        $i=1;

        $log = new Logger('Checking Memory');
        $log->pushHandler(new StreamHandler(base_path('storage/logs/chasing.log', Logger::INFO)));

        while ($i <= $quantity){
            $obj = new SomeClass();
            $obj->value = rand(1, 100000);
            $obj->self = &$obj;
            if ($i%$iterateNum == 0){
                $memSize = memory_get_usage(false);
                $log->info('number iteration - ' . $i, [$memSize . ' bytes', 'value - ' . $obj->value]);
            }
            $i++;
        }
    }
}
