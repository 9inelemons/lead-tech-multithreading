<?php

namespace Threads;

use Core\Logs\LoggerInterface;
use Core\Logs\LoggerTrait;
use LeadGenerator\Lead;
use Threaded;

class LeadThread extends Threaded
{
    use LoggerTrait;

    /** @var Lead $lead */
    private $lead;

    public function __construct(Lead $lead, LoggerInterface $logger)
    {
        $this->lead = $lead;
        $this->setLogger($logger);
    }

    public function run()
    {
        usleep(2000000); // Wait 2s
        $this->writeLog();
    }


    private function writeLog()
    {
        $leadId = $this->lead->id;
        $category = $this->lead->categoryName;
        $currentDateTime = date('Y-m-d H:i:s');
        $this->log("$leadId | $category | $currentDateTime" . PHP_EOL);
    }
}