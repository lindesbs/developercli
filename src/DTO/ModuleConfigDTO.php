<?php declare(strict_types=1);

namespace lindesbs\DeveloperCLI\DTO;

use Symfony\Component\Console\Style\SymfonyStyle;

class ModuleConfigDTO
{
    public function __construct(
        public SymfonyStyle $io,
        public string $developerName='',
        public string $packageName='',
        public string $basePath='/',
        public bool $canUpdate=false,
        public bool $warnIfExists=true,
    )
    {
    }

}