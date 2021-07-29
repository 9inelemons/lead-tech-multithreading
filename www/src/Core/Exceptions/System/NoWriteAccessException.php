<?php

namespace Core\Exceptions\System;

use Core\Exceptions\CoreException;

class NoWriteAccessException extends CoreException
{
    public function __construct(string $path)
    {
        $message = "Failed to write a file $path";
        parent::__construct($message);
    }
}