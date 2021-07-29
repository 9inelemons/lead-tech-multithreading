<?php

require_once 'vendor/autoload.php';

use LeadGenerator\Generator;
use LeadGenerator\Lead;

class LeadThread extends Threaded
{
    private $lead;
    private $logFile;
    public const LOG_PATH = '/var/logs/log.txt';

    public function __construct(Lead $lead, $logFile)
    {
        $this->lead = $lead;
        $this->logFile = $logFile;
    }

    public function run()
    {
        usleep(2000000); // Wait 2s
        $this->log();
    }

    private function log()
    {
        $leadId = $this->lead->id;
        $category = $this->lead->categoryName;
        $currentDateTime = date('Y-m-d H:i:s');
        fwrite($this->logFile, "$leadId | $category | $currentDateTime" . PHP_EOL);
    }
}

$logFilePath = LeadThread::LOG_PATH;

if (!file_exists($logFilePath)) touch($logFilePath);

$logFile = fopen($logFilePath, 'w');

$count = 10000;

$pool = new Pool($count/5);

$generator = new Generator();

$generator->generateLeads($count, function (Lead $lead) use ($pool, $logFile) {
    $pool->submit(new LeadThread($lead, $logFile));
});

$pool->shutdown();

fclose($logFile);
