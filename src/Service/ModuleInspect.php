<?php declare(strict_types=1);

namespace lindesbs\DeveloperCLI\Service;

use Symfony\Component\Console\Output\OutputInterface;

class ModuleInspect
{
    public function __construct(
        private readonly string $basePath
    )
    {

    }

    public function check()
    {
        dump($this->basePath);
    }

}