<?php
/**
 * Created by PhpStorm.
 * User: claygorman
 * Date: 3/13/18
 * Time: 4:25 PM
 */
sleep(30);
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
while ($count <= 10) {
    $data = [
        'correlation_id' => '6abf812a-2386-11e8-a428-0242ac110002.1.9.1.1',
        'environment' => 'prod',
        'level' => 200,
        'level_name' => 'INFO',
        'message' => 'Correlation-Id (6abf812a-2386-11e8-a428-0242ac110002.1.9.1.1) received.',
        'service' => 'ows-product',
        'service_version' => '1.0.0',
        'tag' => 'ows1',
        'timestamp' => '2018-03-09T10:41:24.802469'
    ];
    $event = json_encode($data);
    $logger->addInfo($event);
    $count++;
}

$time_end = microtime(true);
$time = $time_end - $time_start;

echo "Ran in $time seconds\n";
