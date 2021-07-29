<?php


use Core\Logs\Logger;
use Core\System\CommandInterface;
use LeadGenerator\Lead;
use LeadGenerator\Generator;
use Threads\LeadThread;

class LeadsProcessingCommand implements CommandInterface
{
    /** @var Pool $pool */
    private $pool;

    /** @var Generator $generator */
    private $generator;

    /** @var int $count */
    private $count;

    public function __construct(int $count)
    {
        $this->pool = new Pool($count/5);

        $this->generator = new Generator();

        $this->count = $count;
    }

    public function execute(): void
    {
        $this->generator->generateLeads($this->count, function (Lead $lead) {
            $this->pool->submit(new LeadThread($lead, Logger::getInstance()));
        });

        while ($this->pool->collect())

        $this->pool->shutdown();
    }
}