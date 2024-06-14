<?php

namespace lindesbs\DeveloperCLI\Command;

use App\Command\Filesystem;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'contao-cli:generate-bundle',
    description: 'Add a short description for your command',
)]
class ContaoCliGenerateBundleCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Generates a directory structure with files')
            ->addArgument('targetDir', InputArgument::REQUIRED, 'The target directory');
            ->addArgument('namespace', InputArgument::REQUIRED, 'used namespace');
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $targetDir = $input->getArgument('targetDir');
        $filesystem = new Filesystem();


        $directories = [
            'src',
            'src/Resources',
            'src/Resources/contao',
            'src/Resources/config',
        ];

        $files = [
            'dir1/file1.txt' => 'Content for file1',
            'dir2/file2.txt' => 'Content for file2',
            'dir3/subdir1/file3.txt' => 'Content for file3',
        ];


        foreach ($directories as $directory) {
            $filesystem->mkdir($targetDir . '/' . $directory);
        }

        // Create files
        foreach ($files as $file => $content) {
            $filesystem->dumpFile($targetDir . '/' . $file, $content);
        }

        $output->writeln('Directory structure generated successfully.');

        return Command::SUCCESS;
    }
}
