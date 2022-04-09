<?php
 
namespace App\Logging;
 
use Monolog\Formatter\LineFormatter;
 
class CustomizeFormatter
{
    /**
     * Customize the given logger instance.
     *
     * @param  \Illuminate\Log\Logger  $logger
     * @return void
     */
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler){
            // save only json in logger
            $handler->setFormatter(new LineFormatter(
                "\n%context%"
            ));
        }
    }
}