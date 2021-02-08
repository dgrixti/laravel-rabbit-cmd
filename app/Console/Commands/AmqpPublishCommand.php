<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Bschmitt\Amqp\Consumer;
use Bschmitt\Amqp\Facades\Amqp;
use MongoDB\Model\BSONDocument;


class AmqpPublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
	echo "publishing message...";
	try {
        	// Amqp::publish('routing-key', 'message');
        	Amqp::publish('routing-key', 'message' , ['queue' => 'queue_name_other']);
        

        }catch(\PhpAmqpLib\Exception\AMQPTimeoutException $ex){
            echo "Connection timed out. Restarting.";
        }
        echo "done! \n";

	return 0;
    }
}
