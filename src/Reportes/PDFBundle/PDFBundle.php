<?php
/**
 * @author Frank
 */
namespace Reportes\PDFBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PDFBundle extends Bundle
{
    /**
     * Ran on bundle boot, our TCPDF configuration constants
     * get defined here if required
     */
    public function boot()
    {
        // Define our TCPDF variables
        $config = $this->container->getParameter('cdtij_tcpdf.tcpdf');
        // Add our cache path to the correct section of the configuration
        $cacheDir = $this->container->getParameter('cdtij_tcpdf.cache_dir');
        $config['k_path_cache'] = $cacheDir;
        $config['k_path_url_cache'] = $cacheDir;
        // Define TCPDF constants it needs
        if ($config['k_tcpdf_external_config'])
        {
            foreach ($config as $k => $v)
            {
                $constKey = strtoupper($k);

                // All K_ constants are required
                if (preg_match("/^k_/i", $k))
                {
                    if (!defined($constKey))
                    {
                        define($constKey, $this->container->getParameterBag()->resolveValue($v));
                    }
                }
                // and one special value which TCPDF will use if present
                if (strtolower($k) == "pdf_font_name_main" && !defined($constKey))
                {
                    define($constKey, $v);
                }
            }
        }
    }
}