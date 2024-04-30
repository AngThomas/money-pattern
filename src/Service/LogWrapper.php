<?php

namespace Mkt\MoneyPattern\Service;

use Psr\Log\LoggerInterface;

class LogWrapper
{
    private const MP_LOG = 'mp';

    public function __construct(private LoggerInterface $logger)
    {}

    public function info(string $content)
    {
        $this->logger->info($content, ['channel' => self::MP_LOG]);
    }

    public function error(string $content)
    {
        $this->logger->error($content, ['channel' => self::MP_LOG]);
    }
}