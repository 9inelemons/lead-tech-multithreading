<?php

require_once("vendor/autoload.php");

$command = new LeadsProcessingCommand(10000);

$command->execute();
