<?php

declare(strict_types=1);

namespace JUIT\PiFace\Hardware;

abstract class Pin
{
    /** @var int */
    protected $id;

    /** @var ProcessRunner */
    protected $processRunner;

    public function __construct(int $id, ProcessRunner $processRunner = null)
    {
        $this->id = $id;

        if (!$processRunner) {
            $processRunner = new ProcessRunner();
        }
        $this->processRunner = $processRunner;
    }
}
