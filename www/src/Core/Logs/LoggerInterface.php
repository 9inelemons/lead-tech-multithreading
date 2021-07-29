<?php


namespace Core\Logs;


interface LoggerInterface
{
    public function writeLog(string $message): void;

    public static function log(string $message): void;
}