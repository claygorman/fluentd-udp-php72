<?php
/**
 * Created by PhpStorm.
 * User: claygorman
 * Date: 3/13/18
 * Time: 4:25 PM
 */
sleep(5);
$time_start = microtime(true);

require __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\SocketHandler;

// Setup the logger
$logger = new Logger('my_logger');
$udpHandler = new SocketHandler('udp://fluentd:20001');
$udpHandler->setFormatter(new JsonFormatter());
$logger->pushHandler($udpHandler);

$count = 0;
while ($count <= 10000) {
    $logger->addInfo('Monolog test');
    $count++;
}

$time_end = microtime(true);
$time = $time_end - $time_start;

echo "Ran in $time seconds\n";
