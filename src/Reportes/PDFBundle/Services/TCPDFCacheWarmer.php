<?php
/**
 * @author Frank
 */
namespace Reportes\PDFBundle\Services;

use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TCPDFCacheWarmer implements CacheWarmerInterface
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function warmUp($cacheDir)
    {
        $cacheDir = $this->container->getParameter('cdtij_tcpdf.cache_dir');

        if (!is_dir($cacheDir))
        {
            if (!mkdir($cacheDir, 0777, true))
            {
                throw new \RuntimeException(sprintf('Could not create directory for caching processed PDF\'s in "%s"', $cacheDir));
            }
        }
    }

    public function isOptional()
    {
        return false;
    }
}