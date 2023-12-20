<?php declare(strict_types=1);

namespace lindesbs\DeveloperCLI\Command;

use lindesbs\DeveloperCLI\DTO\ModuleConfigDTO;
use lindesbs\DeveloperCLI\Service\ModuleInspect;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'developercli:inspect:module')]
class ModuleCheckCommand extends Command
{

    public function __construct(
        private readonly ModuleInspect $moduleInspect,
        private string $basePath
    )
    {
parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('moduleName',null,'Name of the module')
            ->addOption('basePath',
                null,
                InputOption::VALUE_OPTIONAL,
                'basePath of your development tree',
                $this->basePath
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($input->getOption('basePath'))
            $this->basePath = $input->getOption('basePath');

        $moduleConfig = new ModuleConfigDTO(
            io: new SymfonyStyle($input, $output),
            basePath: $this->basePath
        );

        $this->moduleInspect->check($moduleConfig);

        return COMMAND::SUCCESS;
    }

}