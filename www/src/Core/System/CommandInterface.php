<?php

namespace Core\System;

interface CommandInterface
{
    public function execute(): void;
}