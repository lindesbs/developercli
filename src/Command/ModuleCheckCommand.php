<?php declare(strict_types=1);

namespace lindesbs\DeveloperCLI\Command;

use lindesbs\DeveloperCLI\Service\ModuleInspect;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\KernelInterface;

#[AsCommand(name: 'developercli:inspect:module')]
class ModuleCheckCommand extends Command
{

    public function __construct(
        private readonly ModuleInspect $moduleInspect,
        private readonly string $basePath
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

        $output->writeln($this->basePath);
        $this->moduleInspect->check();

        return COMMAND::SUCCESS;
    }

}