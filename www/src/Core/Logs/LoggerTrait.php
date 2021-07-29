<?php


namespace Core\Logs;


trait LoggerTrait
{
    /** @var LoggerInterface $logger */
    protected $logger;

    public function setLogger(LoggerInterface $logger): self
    {
        $this->logger = $logger;

        return $this;
    }

    public function log(string $message): void
    {
        $this->logger->writeLog($message);
    }
}