<?php

namespace Core\Logs;

use Core\Exceptions\System\NoWriteAccessException;

use Core\Utility\Singleton;

class Logger extends Singleton implements LoggerInterface
{
    private const PATH = "/var/logs/log.txt";

    /**
     * @throws NoWriteAccessException
     */
    protected function __construct()
    {
        if (!file_exists(self::PATH))
            if (!touch(self::PATH)) throw new NoWriteAccessException(self::PATH);
    }


    public function writeLog(string $message): void
    {
        file_put_contents(self::PATH, $message, FILE_APPEND);
    }

    public static function log(string $message): void
    {
        $logger = static::getInstance();
        $logger->writeLog($message);
    }
}