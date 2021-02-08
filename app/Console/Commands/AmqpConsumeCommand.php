<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Bschmitt\Amqp\Consumer;
use Bschmitt\Amqp\Facades\Amqp;
use MongoDB\Model\BSONDocument;

class AmqpConsumeCommand extends Command
{
       /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:custom';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Catches Data from RabbitMQ';

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
        echo "Consuming queue... \n";
        try {
            Amqp::consume('queue_name', function ($message, $resolver) {
                $data = $message->body;
                // do things with data here
		echo "\n received: " . $data;

                $resolver->acknowledge($message);
            });
        }catch(\PhpAmqpLib\Exception\AMQPTimeoutException $ex){
            echo "Connection timed out. Restarting.";
        }
        echo "done! \n";
    }
}

?>
