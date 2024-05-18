<?php declare(strict_types=1);

namespace lindesbs\DeveloperCLI\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use lindesbs\DeveloperCLI\DeveloperCLIBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(DeveloperCLIBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
