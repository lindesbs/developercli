<?php declare(strict_types=1);

namespace lindesbs\DeveloperCLI\Service;

use lindesbs\DeveloperCLI\DTO\ModuleConfigDTO;

class ModuleInspect
{
    public function check(ModuleConfigDTO $moduleConfig)
    {
        $moduleConfig->io->section('Checks');

        $moduleConfig->io->writeln($moduleConfig->basePath);
    }

}