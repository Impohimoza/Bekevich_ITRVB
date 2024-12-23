<?php
namespace Test\Utils;
use Psr\Log\AbstractLogger;

class TestLogger extends AbstractLogger
{
    private array $logs = [];

    public function log($level, $message, array $context = []): void
    {
        $this->logs[] = compact('level', 'message', 'context');
    }

    public function getLogs(): array
    {
        return $this->logs;
    }
}
