<?php declare(strict_types=1);

namespace lindesbs\DeveloperCLI\Command;

use Contao\Controller;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\StringUtil;
use lindesbs\DeveloperCLI\DTO\ModuleConfigDTO;
use lindesbs\DeveloperCLI\Service\ModuleInspect;
use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Twig\Environment;

#[AsCommand(name: 'developercli:dca2entity')]
class DCA2Entity extends Command
{


    const ENTITY = 'Entity';
    const REPOSITORY = 'Repository';


    public function __construct(
        private readonly ContaoFramework $framework,
        private readonly Environment $environment
    )
    {
        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->addArgument('dca',InputArgument::REQUIRED,'Name of the DCA')
            ->addArgument('basePath', InputArgument::REQUIRED, 'Base path of the dca')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $this->framework->initialize();

        $arrData = [];
        $basePath = $input->getArgument('basePath');
        $tableName=$input->getArgument('dca');
        $arrData['basePath'] = $basePath;
        $arrData['tableName'] = $tableName;

        $fs = new Filesystem();

        $fs->mkdir($basePath.'/Entity');
        $fs->mkdir($basePath.'/Repository');

        Controller::loadDataContainer($tableName);

        $entityName = ucfirst(str_replace('tl_','',$tableName));
        $namespace = 'App\\Entity\\'.$entityName;

        $arrData['entityName'] = $entityName;
        $arrData['namespace'] = $namespace;

        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../Templates/');
        $this->environment->setLoader($loader);
        $twig = $this->environment->load('D2M_Entity.twig');

        $io->writeln($twig->render($arrData));

        return COMMAND::SUCCESS;
    }

}