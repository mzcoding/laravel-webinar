<?php

declare(strict_types=1);

namespace App\Services\Output;

use PhpAmqpLib\Channel\AbstractChannel;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

final class RabbitMqService
{
    private AMQPStreamConnection $connection;

    private AbstractChannel|AMQPChannel $channel;

    /**
     * @throws \Exception
     */
    public function __construct(string $host, int $port, string $user, string $password)
    {
        $this->connection = new AMQPStreamConnection($host, $port, $user, $password);
        $this->channel = $this->connection->channel();
    }

    public function sendMessage(string $message): void
    {
        $this->channel->queue_declare('test', false, true, false, false);

        $msg = new AMQPMessage($message);
        $this->channel->basic_publish($msg, '', 'test');

    }

    public function closeConnection(): void
    {
        $this->channel->close();
        $this->connection->close();
    }
}
